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
						'allow'=>false,
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
			$invoices = AccountInvoice::find()->where(['id'=>$ids])->with(['accountInvoiceLines','partner','accountInvoiceLines.product','stockPickings'])->asArray()->all();
			$maped = $this->prepareCsvInvoiceData($invoices);

			$filename = 'Invoices - Export - '.date('Y-m-d H:i:s').'.csv';
			header( "Content-Type: text/csv;charset=utf-8" );
			header( "Content-Disposition: attachment;filename=\"$filename\"" );
			header("Pragma: no-cache");
			header("Expires: 0");

			$output = fopen('php://output','w');
			// $ctn = '';
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
			
			
			foreach($maped as $invId=>$map){
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

			$tes = [
				["FK","01","0","0011578000002","6","2015","29/06/2015","710667502617000","ADIKARA JAYA SENTOSA PT","Perum. Graha Kota Blok A5 / 10-11 Blok - No.- RT:- RW:- Kel.- Kec.- Kota/Kab.- -","10000000","1000000","0","","0","0","0","0","cdscdsdsdsds"],
				["FAPR","PT SINCHAN","JL PAHLAWAN BERTOPENG BLOK MATAHARI NO.11, KIOTO RT: 1 RW: 14 JAKARTA","","","",""],
				["OF","0487060880","Secondary Board ESAB Caddy TM A 34","10000000","1.0","10000000","0.0","10000000","1000000.0","0","0.0"]
			];
			/*echo '<br/>'.count($tes[0]).'-';
			echo count($tes[1]).'-';
			echo count($tes[2]).'-';*/

			/*fputcsv($output, $tes[0]);
			fputcsv($output, $tes[1]);
			fputcsv($output, $tes[2]);*/
			
			fclose($output);
			Yii::$app->end();
		}
	}
	private function convertIdr($amount,$rate){
		$ret = 0;

		$ret = round($amount*$rate);
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
			if($inv['state']=='draft' || $inv['state']=='cancel'){
				// continue to next pointer
				// we dont export draft invoice
				continue;
			}

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
			$iAddr = $inv['partner']['street'].'\r\n'.$inv['partner']['street2'].' '.$inv['partner']['city'].', '.(isset($inv['partner']['state']->name) ? $inv['partner']['state']->name:'').($inv['partner']['zip'] ? ' - '.$inv['partner']['zip']:"");
			// "FK","09","0","0011578000001","6","2015","18/06/2015","010621191092000","INDOCEMENT TUNGGAL PRAKARSA TBK PT","Wisma Indocement Lt. 13   Blok - No.- RT:- RW:- Kel.- Kec.- Kota/Kab.- - 12910","56750000","5675000","0","","0","0","0","0","78049887/SBM/V/2015"
			$res[$inv['id']]['fk'] = [
				'FK', #FK
				$tax_code_type, #KD JENIS TRANSAKSI
				$tax_replace_code, #FG PENGGANTI
				$pure_faktur_code, #NOMOR FAKTUR
				$tax_date->format('n'), #MASA PAJAK
				$tax_date->format('Y'), #TAHUN PAJAK
				$tax_date->format('d/m/Y'), #full tax date dd/mm/yyyy
				preg_replace('/[\s\W]+/', '', $inv['partner']['npwp']), #customer npwp
				$inv['partner']['name'], #customer name
				$iAddr, #invoice address
				$this->convertIdr($inv['amount_untaxed'],$rate),#jumlah dpp,
				$this->convertIdr($inv['amount_tax'],$rate),#jumlah PPN
				'0', #Jumlah PPNBM
				'',#id keterangan tambahan
				($inv['payment_for']=='dp' ? '1':($inv['payment_for']=='completion' ? '2':'0')),#fg uang muka
				$this->convertIdr($inv['amount_untaxed'],$rate),#uang muka dpp
				$this->convertIdr($inv['amount_tax'],$rate),#uang muka ppn
				'0',#uang muka ppnbm, 0 karena tidak ada PPNBM (fix)
				$inv['origin'],#referensi
				
			];

			// "FAPR","PT SINCHAN","JL PAHLAWAN BERTOPENG BLOK MATAHARI NO.11, KIOTO RT: 1 RW: 14 JAKARTA",,,,
			$res[$inv['id']]['fapr'] = [
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
							foreach($inv['accountInvoiceLines'] as $item):
								$res[$inv['id']]['of'][] = [
									'OF', #of
									(string)$item['product']['default_code'],#product code
									(string)$item['product']['name_template'],#product name
									$this->convertIdr($item['price_unit'],$rate), #harga satuan
									(float)$item['quantity'], #jumlah barang
									$this->convertIdr($item['price_subtotal'],$rate), #harga total
									$this->convertIdr($item['discount'],$rate), #diskon
									$this->convertIdr($item['price_subtotal'],$rate), #dpp
									$this->convertIdr(($item['price_subtotal']*0.1),$rate), #ppn,
									0, #TARIF PPNBM
									'0.0' #ppnbm
								];

							endforeach;
							$soInv = false;
						}
						
					}
				}
				if($soInv):
					// if founded
					// override res fk
					$res[$inv['id']]['fk'][10] = $this->convertIdr($soInv['amount_untaxed'],$rate);
					$res[$inv['id']]['fk'][11] = $this->convertIdr($soInv['amount_total'],$rate);

					foreach($soInv['saleOrderLines'] as $soLine):
						$res[$inv['id']]['of'][] = [
							'OF',
							(string)$soLine['product']['default_code'],#product code
							(string)$soLine['product']['name_template'],#product name
							$this->convertIdr($soLine['price_unit'],$rate), #HARGA SATUAN
							(float)$soLine['product_uom_qty'], #qty
							$this->convertIdr(($soLine['price_unit']*$soLine['product_uom_qty']),$rate), #HARGA TOTAL
							$this->convertIdr($soLine['discount'],$rate), #DISKON
							$this->convertIdr(($soLine['price_unit']*$soLine['product_uom_qty']),$rate), #dpp
							$this->convertIdr((($soLine['price_unit']*$soLine['product_uom_qty'])*0.1),$rate), #ppn,
							0, #TARIF PPNBM
							'0.0' #ppnbm

						];	

					endforeach;
				endif;
			}else{
				foreach($inv['accountInvoiceLines'] as $item):
					$res[$inv['id']]['of'][] = [
						'OF', #of
						(string)$item['product']['default_code'],#product code
						(string)$item['product']['name_template'],#product name
						$this->convertIdr($item['price_unit'],$rate), #harga satuan
						(float)$item['quantity'], #jumlah barang
						$this->convertIdr($item['price_subtotal'],$rate), #harga total
						$this->convertIdr($item['discount'],$rate), #diskon
						$this->convertIdr($item['price_subtotal'],$rate), #dpp
						$this->convertIdr(($item['price_subtotal']*0.1),$rate), #ppn,
						'0', #ppnbm,
						'0.0'

					];
					// echo $item['price_subtotal'].'\\';
				endforeach;
			}
			
		}
		// \yii\helpers\VarDumper::dump($res);
		return $res;
	}
}
?>