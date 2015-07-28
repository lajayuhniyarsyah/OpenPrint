<?php

namespace app\controllers;

use Yii;
use app\models\AccountInvoice;
use app\models\AccountInvoiceSearch;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\ResCurrency;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\db\Query;

class ServiceController extends Controller{
	public function behaviors()
	{
		return [
			'access'=>[
				'class'=>\yii\filters\AccessControl::className(),
				'rules'=>[
					[
						'allow'=>true,
						'roles'=>['@']
					],
					[
						'allow'=>true,
						'roles'=>['?']
					]
				]
			]
		];
	}


	/**
	 * Get All User List for Searching with ajax in select2 widget
	 * @param  char $search 	query search
	 * @param  integer $id 		id of user
	 * @return array         	['user_id'=>'User Profile Name']
	 **/

	public function actionSearchUser($search = null, $id = null) {
		$out = ['more' => false];
		$q = new Query;
		if (!is_null($search)) {

			$q->select('usr.id, prf.name as text')
				->from(ResUsers::tableName().' as usr')
				->leftJoin(ResPartner::tableName().' prf', 'prf.id=usr.partner_id')
				->where('LOWER(prf.name) LIKE :search OR LOWER(usr.login) like :search')
				->addParams([':search'=>'%'.strtolower($search).'%']);
			$users = $q->createCommand()->queryAll();
			
			$out['results'] = array_values($users);
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResUsers::find()->where(['id'=>$id])->with('partner')->one()->partner->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}

	public function actionSearchCurrency($search=null,$id=null){
		$out = ['more' => false];
		$q = new Query;
		if (!is_null($search)) {

			$q->select('cur.id, cur.name as text')
				->from(ResCurrency::tableName().' as cur')
				->where('LOWER(cur.name) LIKE :search')
				->addParams([':search'=>'%'.strtolower($search).'%']);
			$users = $q->createCommand()->queryAll();
			
			$out['results'] = array_values($users);
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResCurrency::find()->where(['id'=>$id])->with('partner')->one()->partner->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}

	/**
	 * Action Ajax for searc customer list in select2 widget
	 * @param  [type] $search [description]
	 * @param  [type] $id     [description]
	 * @return [json]         JSON['customer_id'=>'name']
	 */
	public function actionSearchCustomer($search=null,$id=null){
		$out = ['more' => false];
		$q = new Query;
		if (!is_null($search)) {

			$q->select('p.id, p.name as text')
				->from(ResPartner::tableName().' as p')
				->where('LOWER(p.name) LIKE :search')
				->andWhere('employee is false and customer is true')
				->addParams([':search'=>'%'.strtolower($search).'%']);
			$users = $q->createCommand()->queryAll();

			$out['results'] = array_values($users);
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResPartner::find()->where(['id'=>$id])->one()->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}


	public function actionGetPartnerImage($id){
		$model = \app\models\ResPartner::find($id)->asArray()->one();
	}

	public function actionGetInvoicesCsv($ids)
	{
		$ids = explode(',', $ids);
		// \yii\helpers\VarDumper::dump($ids);
		if(is_array($ids)){
			$invoices = AccountInvoice::find()->where(['id'=>$ids])->with(['accountInvoiceLines','partner','partner.parent','accountInvoiceLines.product','stockPickings'])->asArray()->all();
			$maped = $this->prepareCsvInvoiceData($invoices);
			/*\yii\helpers\VarDumper::dump($maped);
			die();*/
			$filename = 'INVOICES-'.(isset($maped['OUT']) ? 'OUT':'IN').'-'.implode('+', array_keys($maped[(isset($maped['OUT']) ? 'OUT':'IN')])).'.csv';
			header( "Content-Type: text/csv;charset=utf-8" );
			header( "Content-Disposition: attachment;filename=\"$filename\"" );
			header("Pragma: no-cache");
			header("Expires: 0");

			$output = fopen('php://output','w');
			// $ctn = '';
			// 
			if(isset($maped['OUT'])){
				fputcsv(
					$output, 
					array_map(
						function($e){
							return $e;
						},
						["FK","KD_JENIS_TRANSAKSI","FG_PENGGANTI","NOMOR_FAKTUR","MASA_PAJAK","TAHUN_PAJAK","TANGGAL_FAKTUR","NPWP","NAMA","ALAMAT_LENGKAP","JUMLAH_DPP","JUMLAH_PPN","JUMLAH_PPNBM","ID_KETERANGAN_TAMBAHAN","FG_UANG_MUKA","UANG_MUKA_DPP","UANG_MUKA_PPN","UANG_MUKA_PPNBM","REFERENSI"]
					),
					','
				);
				fputcsv(
					$output, 
					array_map(
						function($e){
							return $e;
						},
						["LT","NPWP","NAMA","JALAN","BLOK","NOMOR","RT","RW","KECAMATAN","KELURAHAN","KABUPATEN","PROPINSI","KODE_POS","NOMOR_TELEPON"]
					),
					','
				);
				fputcsv(
					$output, 
					array_map(
						function($e){
							return $e;
						},
						["OF","KODE_OBJEK","NAMA","HARGA_SATUAN","JUMLAH_BARANG","HARGA_TOTAL","DISKON","DPP","PPN","TARIF_PPNBM","PPNBM"]
					),
					','
				);
				
				
				foreach($maped['OUT'] as $invId=>$map){
					/*echo count($map['fk']).'-';
					echo count($map['fapr']).'-';
					echo count($map['of'][0]).'-';*/
					fputcsv(
						$output, 
						array_map(
							function($e){
								return $e;
							},
							$map['fk']
						),','
					);
					fputcsv(
						$output, 
						array_map(
							function($e){
								return $e;
							},
							$map['fapr']
						),','
						
					);
					foreach($map['of'] as $of){
						fputcsv(
							$output, 
							array_map(
								function($e){
									return $e;
								},
								$of
							),','
						);
					}
				}
			}
			else{

				fputcsv($output, [
					"FM",
					"KD_JENIS_TRANSAKSI",
					"FG_PENGGANTI",
					"NOMOR_FAKTUR",
					"MASA_PAJAK",
					"TAHUN_PAJAK",
					"TANGGAL_FAKTUR",
					"NPWP",
					"NAMA",
					"ALAMAT_LENGKAP",
					"JUMLAH_DPP",
					"JUMLAH_PPN",
					"JUMLAH_PPNBM",
					"IS_CREDITABLE"
				]);

				foreach($maped['IN'] as $in):
					fputcsv($output, $in);
				endforeach;

			}
			
			
			
			fclose($output);
			Yii::$app->end();
		}
	}
	private function convertIdr($amount,$rate){
		$ret = 0;

		$ret = $amount*$rate;
		return (float)$ret;
	}
	/**
	 * [prepareCsvData description]
	 * @param  [array] $invoices array result of model->all()
	 * @return [type]           [description]
	 */
	private function prepareCsvInvoiceData(array $invoices){
		$res = [];
		// var_dump($invoices);
		
		
		foreach($invoices as $inv){
			// echo $inv['id'].'/';
			// var_dump($inv['faktur_pajak_no']);
			if($inv['state']=='draft' || $inv['state']=='cancel' || $inv['state']=='submited'){
				// continue to next pointer
				// we dont export draft invoice
				continue;
			}

			
			if($inv['type']=='out_invoice'){
				$indexArr = explode('/', $inv['kwitansi'])[0];
				$rate = ($inv['currency_id']==13 ? 1:$inv['pajak']);
				$all_tax_code = substr($inv['faktur_pajak_no'], 0,3);
				$tax_code_type =  substr($inv['faktur_pajak_no'], 0,2);
				$tax_replace_code = 0;
				$tax_mod = $all_tax_code % 10;
				if($tax_mod==1){
					// faktur pajak pengganti
					$tax_replace_code = 1;
				}

				$pure_faktur_code = substr(preg_replace('/[\s\W]+/', '', $inv['faktur_pajak_no']),3,strlen(preg_replace('/[\s\W]+/', '', $inv['faktur_pajak_no'])));
				$exp_tax_date = explode('-', $inv['date_invoice']);
				$tax_date = \DateTime::createFromFormat('Y-m-d',$inv['date_invoice']);
				$iAddr = $inv['partner']['street'].', '.$inv['partner']['street2'].' '.$inv['partner']['city'].', '.(isset($inv['partner']['state']->name) ? $inv['partner']['state']->name:'').($inv['partner']['zip'] ? ' - '.$inv['partner']['zip']:"");
				// "FK","09","0","0011578000001","6","2015","18/06/2015","010621191092000","INDOCEMENT TUNGGAL PRAKARSA TBK PT","Wisma Indocement Lt. 13   Blok - No.- RT:- RW:- Kel.- Kec.- Kota/Kab.- - 12910","56750000","5675000","0","","0","0","0","0","78049887/SBM/V/2015"
				
				$partner = (isset($inv['partner']['parent']) ? $inv['partner']['parent']: $inv['partner']);


				$amount_untaxed = floor($this->convertIdr($inv['amount_untaxed'],$rate));
				$amount_tax = floor((10/100) * $amount_untaxed);

				$res['OUT'][$indexArr]['fk'] = [
					'FK', #FK #0
					$tax_code_type, #KD JENIS TRANSAKSI #1
					$tax_replace_code, #FG PENGGANTI #2
					$pure_faktur_code, #NOMOR FAKTUR #3
					$tax_date->format('n'), #MASA PAJAK #4
					$tax_date->format('Y'), #TAHUN PAJAK #5
					$tax_date->format('d/m/Y'), #full tax date dd/mm/yyyy #6
					preg_replace('/[\s\W]+/', '', $partner['npwp']), #customer npwp #7
					$partner['name'], #customer name #8
					$iAddr, #invoice addres['OUT'] #9
					$this->convertIdr($inv['amount_untaxed'],$rate),#jumlah dpp, #10
					$this->convertIdr($inv['amount_tax'],$rate),#jumlah PPN #11
					'0', #Jumlah PPNBM #12
					'',#id keterangan tambahan #13
					($inv['payment_for']=='dp' ? '1':($inv['payment_for']=='completion' ? '2':'0')),#fg uang muka #14
					($inv['payment_for']=='dp' ? $amount_untaxed:($inv['payment_for']=='completion' ? $amount_untaxed:'0')),#uang muka dpp #15
					($inv['payment_for']=='dp' ? $amount_tax:($inv['payment_for']=='completion' ? $amount_tax:'0')),#uang muka ppn #16
					'0',#uang muka ppnbm, 0 karena tidak ada PPNBM (fix) #17
					'Invoice No : '.$inv['kwitansi'].'. Order No : '.$inv['origin'].'. Order Ref : '.$inv['name'],#referensi #18
					
				];

				// "FAPR","PT SINCHAN","JL PAHLAWAN BERTOPENG BLOK MATAHARI NO.11, KIOTO RT: 1 RW: 14 JAKARTA",,,,
				$res['OUT'][$indexArr]['fapr'] = [
					'FAPR',
					'SUPRABAKTI MANDIRI, PT',
					'Jl. Danau Sunter Utara Blok. A No. 9 Tanjung Priok - Jakarta Utara 14350',
					'','','',''
				];


				// EACH LINE ITEM
				if($inv['payment_for']){
					// IF PAYMENT FOR DP OR COMPLETION THEN ALL SALE ORDER ITEM WILL BE RENDERED
					// check from sale order invoice
					$soRel = \app\models\SaleOrderInvoiceRel::find()->where(['invoice_id'=>$inv['id']])->with(['order','order.saleOrderLines','order.saleOrderLines.product'])->asArray()->one();
					
					if($soRel)
					{
						$soInv = $soRel['order'];
					}else
					{
						// check if invoice made from picking
						if(count($inv['stockPickings'])>0){
							// if do
							$sid = [];
							$soid = null;
							foreach($inv['stockPickings'] as $no=>$pick):
								$sid[$pick['sale_id']] = $no++;
								$soid = $pick['sale_id'];
							endforeach;
							if(count($sid)==1){
								$soInv = \app\models\SaleOrder::find()->where(['id'=>$soid])->with(['saleOrderLines','saleOrderLines.product'])->asArray()->one();

							}else{
								// LOOP FROM INVOICE LINES
								foreach($inv['accountInvoiceLines'] as $item):
									$render = $this->prepareFromInvLine($item,$rate);
									
									$discountTotal += $render[6];
									$dppTotal += $render[7];
									$ppnTotal += $render[8];

									$res['OUT'][$indexArr]['of'][] = $render;

								endforeach;
								$soInv = false;
							}
							
						}
					}
					if($soInv):
						// if founded
						// override res['OUT'] fk
						// 
						$discountTotal = 0;
						$dppTotal = 0;
						$subtotalTotal = 0;

						// LOOP EACH SO RELS IN ORDER LINE RELATION
						foreach($soInv['saleOrderLines'] as $soLine):
							$pUnit = $this->convertIdr($soLine['price_unit'],$rate);

							$discountLine = 0;


							if(floatval($soLine['discount'])>0)
							{
								$discountLine = ($soLine['discount']/100) * ($pUnit*$soLine['product_uom_qty']);

								$discountTotal += $discountLine;
							}


							$subtotal = $pUnit * $soLine['product_uom_qty'];
							$subtotalTotal += $subtotal;

							$dpp = $subtotal - $discountLine;
							$dppTotal += $dpp;

							$ppn = (10/100) * $dpp;

							$res['OUT'][$indexArr]['of'][] = [
								'OF',
								(string)$soLine['product']['default_code'],#product code
								(string)$soLine['product']['name_template'],#product name
								$pUnit, #HARGA SATUAN
								(float)$soLine['product_uom_qty'], #qty
								$subtotal, #HARGA TOTAL
								$discountLine, #DISKON
								$dpp, #dpp
								$ppn, #ppn,
								0, #TARIF PPNBM
								'0.0' #ppnbm

							];


						endforeach;
						// HERE
						$ppnTotal = floor((10/100) * $dppTotal);

						$res['OUT'][$indexArr]['fk'][10] = floor($dppTotal);

						$res['OUT'][$indexArr]['fk'][11] = $ppnTotal;
						/*var_dump($ppnTotal);
						die();*/
					endif;
				}


				else{
					$discountTotal = 0;
					$dppTotal = 0;
					$ppnTotal = 0;
					// LOOP FROM INVOICE LINES
					foreach($inv['accountInvoiceLines'] as $item):
						$render = $this->prepareFromInvLine($item,$rate);
						
						$discountTotal += $render[6];
						$dppTotal += $render[7];
						$ppnTotal += $render[8];

						$res['OUT'][$indexArr]['of'][] = $render;
						// echo $item['price_subtotal'].'\\';
					endforeach;
					$res['OUT'][$indexArr]['fk'][10] = floor($dppTotal);
					$res['OUT'][$indexArr]['fk'][11] = floor($ppnTotal);
				}
			}elseif($inv['type']=='in_invoice'){
				// OUT INVOICE
				// SUPPLIER INVOICE
				
				$rate = ($inv['currency_id']==13 ? 1:$inv['pajak']);
				$tax_date = \DateTime::createFromFormat('Y-m-d',$inv['date_invoice']);
				

				$datainv[]=[
							"FM",
							substr($inv['faktur_pajak_no'],0,2),
							substr($inv['faktur_pajak_no'],2,1),
							substr(str_replace('-','',str_replace('.', '', $inv['faktur_pajak_no'])), 3),
							$tax_date->format('n'),
							$tax_date->format('Y'),
							$tax_date->format('d/m/Y'),
							preg_replace('/[\s\W]+/', '', $inv['partner']['npwp']),
							$inv['partner']['name'],
							$inv['partner']['street'],
							$this->convertIdr($inv['amount_untaxed'],$rate),
							$this->convertIdr($inv['amount_tax'],$rate),
							"0",
							"1"
						];

				/*var_dump($datainv);
				die();*/
				$res['IN'] =$datainv;
				// $res = $this->prepareIn();
			}
			
		}

		/*\yii\helpers\VarDumper::dump($res);
		die();*/

		return $res;
	}


	private function prepareFromInvLine($item,$rate){
		$res = [];
		$price_unit = $this->convertIdr($item['price_unit'],$rate);
		$price_subtotal = $price_unit*$item['quantity'];
		$discount=0;
		if($item['discount'] && floatval($item['discount'])>0){
			$discount = ($item['discount']/100) * ($price_unit*$item['quantity']);
		}elseif($item['amount_discount'] && $item['amount_discount']>0){
			$discount = $item['amount_discount'];
		}
		$dpp=$price_subtotal-$discount;
		$ppn=(10/100) * $dpp;

		if($item){
			$res = [
				'OF', #of
				(string)$item['product']['default_code'],#product code
				(string)$item['product']['name_template'],#product name
				$price_unit, #harga satuan
				(float)$item['quantity'], #jumlah barang
				$price_subtotal, #harga total
				$discount, #diskon
				$dpp, #dpp
				$ppn, #ppn,
				'0', #ppnbm,
				'0.0'

			];
		}
		



		return $res;
	}

}
?>