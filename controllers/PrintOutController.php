<?php

namespace app\controllers;

use Yii;
use app\models\AccountInvoice;
use app\models\AccountInvoiceSearch;

use app\models\OrderInvoiceReportForm;
use app\models\ResUsers;
use app\models\ResGroups;
use app\models\ResGroupsUsersRel;
use app\models\GroupSales;
use app\models\GroupSalesLine;
use app\models\ExecutiveSummarySales;
use app\models\ExecutiveSummaryGroup;
use app\models\ExecutiveSummaryGroupSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrinOutController implements the CRUD actions for AccountInvoice model.
 */
class PrintOutController extends Controller
{
	private function prepareTotal(){
		return [
			'subtotal'=>0,
			'subtotalMainCurr'=>0,
			'discountSubtotal'=>0,
			'discountSubtotalMainCurr'=>0,
			'amountUntaxed'=>0,
			'amountUntaxedMainCurr'=>0,
			'amountTax'=>0,
			'amountTaxMainCurr'=>0,
			'amountTotal'=>0,
			'amountTotalMainCurr'=>0,
		];
	}

	public function formatValue($value,$to){
		if($to==13){
			return Yii::$app->numericLib->indoStyle(floatval($value));
		}else{
			return Yii::$app->numericLib->westStyle(floatval($value));
		}
	}

	public function actionPrintInvoice($id,$uid=null,$printer="refa",$printForFaktur=false)
	{
		$uid = (int) $uid;
		$id = (int) $id;

		$this->layout = 'printout';

		$oe = Yii::$app->openERPLib;
		$login = $oe->login("admin","supra");
		// $login = $oe->login(Yii::$app->user->identity->username,Yii::$app->user->identity->password);


		# account invoice
		$modelAccInvoice = $oe->read([$id],['id','kwitansi','date_invoice','amount_untaxed','amount_untaxed_main','amount_tax','amount_total','amount_total_main','approver','partner_id','currency_id','invoice_line','pajak','comment','name','payment_for','payment_term'],"account.invoice");
		// var_dump($modelAccInvoice);

		if(!$modelAccInvoice){
			throw new NotFoundHttpException('Data not found.');
		}

		$model = $modelAccInvoice[0]; // karena sudah pasti 1 data yang dicari


		$idPartner = $model['partner_id'][0];

		# res partner
		$modelPartner = $oe->read([$idPartner],['id','name','street','street2','city','state_id','zip'],"res.partner");
		$partner = $modelPartner[0];
		// var_dump($partner);

		# account invoice line
		$modelAccInvoiceLines = $oe->read($model['invoice_line'],['id','unit_price_main','sub_total_main','price_unit','quantity','amount_discount','discount','product_id','name','sequence','uos_id','amount_discount_main','price_subtotal','tax_amount_main','amount_bruto'],'account.invoice.line');
		$isMainCurrency = false;
		if($model['currency_id'][0]==13){
			$isMainCurrency=true;
		}
		$invoice = [
			'no'=>null,
			'partner'=>null,
			'fakturNo'=>null,
			'currency'=>$model['currency_id'][1],
			'rate'=>($isMainCurrency?1:$model['pajak']),
			'comment'=>nl2br($model['comment']),
			'lines'=>[],
			'total'=>$this->prepareTotal()
		];

		$lines = [];
		$idx=0;
		$counterLinePriced = 0;

		foreach ($modelAccInvoiceLines as $key => $invLine) {

			# product product
			$idProduct = $invLine['product_id'][0].',';
			$product = $oe->read([$idProduct],['id','default_code','name_template','product_tmpl_id'],"product.product");
			// var_dump($product);
			$modelProduct = NULL;
			if($product != NULL){
				$modelProduct = $product[0];
			}

			# product template
			$idProductTemplate = $modelProduct['product_tmpl_id'][0].',';
			$productTemplate = $oe->read([$idProductTemplate],['id','type'],"product.template");
			$modelProductTemplate = NULL;
			if($productTemplate != NULL){
				$modelProductTemplate = $productTemplate[0];
			}
			// var_dump($productTemplate);



			$nameLine = (isset($modelProduct['name_template']) ? $modelProduct['name_template'] : null);
			if(trim($invLine['name'])):
				$nameLine .= (isset($modelProduct['name_template']) ? '<br/>':"").nl2br($invLine['name']);
			endif;
			if(isset($modelProduct['default_code'])){
				$nameLine .= '<br/>P/N : '.$modelProduct['default_code'];
			}

			$data['lines'][] = [
				'id'=>$invLine['id'],

				'no'=>($model['payment_for'] =='dp' || $model['payment_for'] =='completion' ? '':$invLine['sequence']),
				'name'=>$nameLine,

				'priceUnit'=>$invLine['price_unit'],
				'priceUnitMainCurr'=>$invLine['unit_price_main'],

				'qty'=>($model['payment_for'] ? '&nbsp;':Yii::$app->numericLib->westStyle($invLine['quantity']/*,$model['currency_id'][0]*/)),

				'unit'=>($model['payment_for'] ? '&nbsp;':$invLine['uos_id'][1]),

				'priceSubtotal'=>$invLine['price_subtotal'],
				'priceSubtotalMainCurr'=>$invLine['sub_total_main'],
				
				'discountPercentage'=>$invLine['discount'],
				'discountAmount'=>$invLine['amount_discount'],
				'discountMainCurr'=>$invLine['amount_discount_main'],

				'priceTotal'=>$model['amount_untaxed'],
				'priceTotalMainCurr'=>$model['amount_untaxed_main'],

				'taxMainCurr'=>$invLine['tax_amount_main'],
				'totalAmountMainCurr'=>$model['amount_total_main'],

				'formated'=>[
					'currency'=>($printForFaktur ? ($model['payment_for'] ? '&nbsp;':$model['currency_id'][1]):$model['currency_id'][1]),
					'priceUnit'=>($model['payment_for'] ? '':$this->formatValue($invLine['price_unit'],$model['currency_id'][0])),
					'priceUnitMainCurr'=>($model['payment_for'] ? '':$this->formatValue($invLine['unit_price_main'],$model['currency_id'][0])),
					
					'priceSubtotal'=>($printForFaktur ? ($model['payment_for'] ? '&nbsp;':$this->formatValue($invLine['price_subtotal'],$model['currency_id'][0])):$this->formatValue($invLine['price_subtotal'],$model['currency_id'][0])),
					'priceSubtotalMainCurr'=>($printForFaktur ? ($model['payment_for'] ? '&nbsp;':$this->formatValue($invLine['sub_total_main'],$model['currency_id'][0])):$this->formatValue($invLine['sub_total_main'],$model['currency_id'][0])),
					
					'discountPercentage'=>$this->formatValue($invLine['discount'],$model['currency_id'][0]),
					'discountAmount'=>$this->formatValue($invLine['amount_discount'],$model['currency_id'][0]),
					'discountMainCurr'=>$this->formatValue($invLine['amount_discount_main'],$model['currency_id'][0]),

					'priceTotal'=>$this->formatValue($model['amount_untaxed'],$model['currency_id'][0]),
					'priceTotalMainCurr'=>$this->formatValue($model['amount_untaxed_main'],$model['currency_id'][0]),

					'taxMainCurr'=>$this->formatValue($invLine['tax_amount_main'],$model['currency_id'][0]),
					'totalAmountMainCurr'=>$this->formatValue($model['amount_total_main'],$model['currency_id'][0]),
				]
			];

			$invoice['total']['subtotal'] += $data['lines'][$idx]['priceSubtotal'];

			$idx++;
		}


		// jika dp / complete
		// maka load data[lines] dari sale order
		$invoiceLine = $modelAccInvoiceLines[0];
		$sale_order_ids = $oe->search([['invoice_ids','=',$id]],'sale.order');
		// var_dump($sale_order_ids);


		$saleOrder = $oe->read($sale_order_ids,['id','order_line','amount_untaxed'],'sale.order');
		// var_dump($saleOrder);
		// $modelSaleOrder = $saleOrder[0];
		foreach ($saleOrder as $key => $modelSaleOrder) {

			$id_order_line = $modelSaleOrder['order_line'];
			$saleOrderLine = $oe->read($id_order_line,['id','price_unit','product_uom_qty','discount','discount_nominal','product_id','product_uom','sequence','product_ref','price_subtotal','name'],'sale.order.line');
			// var_dump($saleOrderLine);

			if($model['payment_for'] =='dp' || $model['payment_for'] =='completion'){
				
				$no=0;
				foreach ($saleOrderLine as $key => $soLine) {

					$no++;
					$idx++;
					
					# product product
					$idProduct = $soLine['product_id'][0].',';
					$product = $oe->read([$idProduct],['id','default_code','name_template'],"product.product");
					// var_dump($product);
					$modelProduct = NULL;
					if($product != NULL){
						$modelProduct = $product[0];
					}

					// var_dump($soLine);

					$data['lines'][] = [
						'id'=>$soLine['id'],

						'no'=>($model['payment_for'] =='dp' || $model['payment_for'] =='completion' ? $no:$soLine['sequence']),
						'name'=>(isset($soLine['product_ref']) ? $soLine['product_ref'].'<br/>'.nl2br($soLine['name']).'<br/>P/N : '.$modelProduct['default_code'].($printForFaktur ? '<br/>Rp<b>'.$this->formatValue($invoiceLine['unit_price_main']).' x '.$soLine['product_uom_qty'].'</b>':'&nbsp;'):nl2br($soLine['name']).($printForFaktur ? '<br/>'.$this->formatValue($invoiceLine['unit_price_main']).' x '.$soLine['product_uom_qty']:'&nbsp;')),

						'priceUnit'=>$soLine['price_unit'],
						'priceUnitMainCurr'=>$invoiceLine['unit_price_main'],
						'qty'=>$this->formatValue($soLine['product_uom_qty'],$model['currency_id'][0]),
						'unit'=>$soLine['product_uom'][1],

						'priceSubtotal'=>$invoiceLine['price_subtotal'],
						'priceSubtotalMainCurr'=>$invoiceLine['sub_total_main'],
						
						'discountPercentage'=>$soLine['discount'],
						'discountAmount'=>$soLine['discount_nominal'],
						'discountMainCurr'=>$invoiceLine['amount_discount_main'],

						'priceTotal'=>$modelSaleOrder['amount_untaxed'],
						'priceTotalMainCurr'=>$model['amount_untaxed_main'],

						'taxMainCurr'=>$invoiceLine['tax_amount_main'],
						'totalAmountMainCurr'=>$model['amount_total_main'],

						'formated'=>[
							'currency'=>($printForFaktur ? $model['currency_id'][1]:'&nbsp;'),
							'priceUnit'=>($printForFaktur ? $this->formatValue($soLine['price_unit'],$model['currency_id'][0]):'&nbsp;'),
							'priceUnitMainCurr'=>$this->formatValue($invoiceLine['unit_price_main'],$model['currency_id'][0]),
							
							'priceSubtotal'=>($printForFaktur ? $this->formatValue($soLine['price_subtotal'],$model['currency_id'][0]):'&nbsp;'),
							'priceSubtotalMainCurr'=>$this->formatValue($invoiceLine['sub_total_main'],$model['currency_id'][0]),
							
							'discountPercentage'=>$this->formatValue($soLine['discount'],$model['currency_id'][0]),
							'discountAmount'=>$this->formatValue($soLine['discount_nominal'],$model['currency_id'][0]),
							'discountMainCurr'=>$this->formatValue($invoiceLine['amount_discount_main'],$model['currency_id'][0]),

							'priceTotal'=>$this->formatValue($modelSaleOrder['amount_untaxed'],$model['currency_id'][0]),
							'priceTotalMainCurr'=>$this->formatValue($model['amount_untaxed_main'],$model['currency_id'][0]),

							'taxMainCurr'=>$this->formatValue($invoiceLine['tax_amount_main'],$model['currency_id'][0]),
							'totalAmountMainCurr'=>$this->formatValue($model['amount_total_main'],$model['currency_id'][0]),
						]
					];

				}
				
			}

		}

		

		$data['lines'][] = [
			'id'=>'notes',

			'no'=>'&nbsp;',
			'name'=>'PO NO : '.$model['name'].'<br/>'.nl2br($model['comment']),

			'priceUnit'=>'&nbsp;',
			'priceUnitMainCurr'=>'&nbsp;',
			'qty'=>'&nbsp;',
			'unit'=>'&nbsp;',

			'priceSubtotal'=>'&nbsp;',
			'priceSubtotalMainCurr'=>'&nbsp;',
			
			'discountPercentage'=>'&nbsp;',
			'discountAmount'=>'&nbsp;',
			'discountMainCurr'=>'&nbsp;',

			'priceTotal'=>'&nbsp;',
			'priceTotalMainCurr'=>'&nbsp;',

			'taxMainCurr'=>'&nbsp;',
			'totalAmountMainCurr'=>'&nbsp;',

			'formated'=>[
				'currency'=>'&nbsp;',
				'priceUnit'=>'&nbsp;',
				'priceUnitMainCurr'=>'&nbsp;',
				// 'qty'=>'&nbsp;',

				'priceSubtotal'=>'&nbsp;',
				'priceSubtotalMainCurr'=>'&nbsp;',
				
				'discountPercentage'=>'&nbsp;',
				'discountAmount'=>'&nbsp;',
				'discountMainCurr'=>'&nbsp;',

				'priceTotal'=>'&nbsp;',
				'priceTotalMainCurr'=>'&nbsp;',

				'taxMainCurr'=>'&nbsp;',
				'totalAmountMainCurr'=>'&nbsp;',
			]
		];
		// var_dump($data);

		if($printer == null && ($uid==100 || $uid == 191)){
			$printer='sri';
		}

		return $this->render('account-invoice/invoice',[
			'model'=>$model,
			'modelPartner'=>$partner,
			'printer'=>$printer,
			'uid'=>$uid,
			'data'=>$data,
			'invoice'=>$invoice
		]);
	}


	// print out e-faktur
	public function actionPrintEFaktur($id=null,$uid=null,$printer=null)
	{
		$this->layout = 'printout';

		$id = (int) $id;

		$oe = Yii::$app->openERPLib;
		$login = $oe->login("admin","supra");

		# account invoice
		$invoice = $oe->read([$id],[],"account.invoice");
		if(!$invoice){
			throw new NotFoundHttpException('Data not found.');
		}
		$modelInvoice = $invoice[0];

		# res partner
		$idPartner = $modelInvoice['partner_id'][0];
		$partner = $oe->read([$idPartner],[],"res.partner");
		$modelPartner = $partner[0];

		// var_dump($modelInvoice);
		// die();

		# account invoice line
		$invoice_line = $oe->read($modelInvoice['invoice_line'],[],'account.invoice.line');
		$invLine = $invoice_line[0];

		$lines = [];
		$priceTotal=0;
		foreach ($invoice_line as $key => $modelInvoiceLine) {

			# product product
			$idProduct = $modelInvoiceLine['product_id'][0].',';
			$product = $oe->read([$idProduct],['id','default_code','name_template','product_tmpl_id'],"product.product");
			$modelProduct = NULL;
			if($product != NULL){
				$modelProduct = $product[0];
			}

			# product template
			$idProductTemplate = $modelProduct['product_tmpl_id'][0].',';
			$productTemplate = $oe->read([$idProductTemplate],['id','type'],"product.template");
			$modelProductTemplate = NULL;
			if($productTemplate != NULL){
				$modelProductTemplate = $productTemplate[0];
			}


			$nameLine = (isset($modelProduct['name_template']) ? $modelProduct['name_template'] : null);
			if(trim($modelInvoiceLine['name'])):
				$nameLine .= (isset($modelProduct['name_template']) ? '<br/>':"").nl2br($modelInvoiceLine['name']);
			endif;
			if(isset($modelProduct['default_code'])){
				$nameLine .= '<br/>P/N : '.$modelProduct['default_code'];
			}
			if(!$modelInvoice['payment_for']){
				$nameLine .= '<br/><b>Rp '. Yii::$app->numericLib->indoStyle($modelInvoiceLine['unit_price_main']).' x '.floatval($modelInvoiceLine['quantity']).'</b>';
			}
			
			
			$lines[] = [
				'id'=>$modelInvoiceLine['id'],

				'no'=>($modelInvoice['payment_for']=='dp' || $modelInvoice['payment_for']=='completion' ? '':$modelInvoiceLine['sequence']),

				'name'=>$nameLine,

				'priceUnit'=>$this->formatValue($modelInvoiceLine['price_unit'],$modelInvoice['currency_id'][0]),
				'priceUnitMainCurr'=>$modelInvoiceLine['unit_price_main'],

				'currency'=>($modelInvoice['payment_for']=='dp' || $modelInvoice['payment_for']=='completion' ? '':$modelInvoice['currency_id'][1]),

				'qty'=>$modelInvoiceLine['quantity'],
				'unit'=>$modelInvoiceLine['uos_id'][1],

				'priceSubtotal'=>($modelInvoice['payment_for']=='dp' || $modelInvoice['payment_for']=='completion' ? '':$this->formatValue($modelInvoiceLine['price_subtotal'],$modelInvoice['currency_id'][0])),
				'subTotalMain'=>($modelInvoice['payment_for']=='dp' || $modelInvoice['payment_for']=='completion' ? '':Yii::$app->numericLib->indoStyle($modelInvoiceLine['sub_total_main'])),

				'amountBruto'=>$this->formatValue($modelInvoiceLine['amount_bruto'],$modelInvoice['currency_id'][0]),
				'amountBrutoMain'=>Yii::$app->numericLib->indoStyle($modelInvoiceLine['amount_bruto_main']),

				'discount'=>$modelInvoiceLine['discount'],
				'amountDiscount'=>$modelInvoiceLine['amount_discount'],
				'amountDiscountMain'=>$modelInvoiceLine['amount_discount_main'],

				'amountUntaxed'=>$modelInvoice['amount_untaxed'],
				'amountUntaxedMain'=>$modelInvoice['amount_untaxed_main'],

				'taxAmountMain'=>$modelInvoiceLine['tax_amount_main'],
				'amountTotalMain'=>$modelInvoice['amount_total_main'],
			];

			$priceTotal += $modelInvoiceLine['amount_bruto_main'];

		}

		// append
		$modelInvoice['total'] = $priceTotal;
		

		// jika dp / complete
		# sale order
		$idSaleOrder = $oe->search([['invoice_ids','=',$id]],'sale.order');
		$saleOrder = $oe->read($idSaleOrder,['id','order_line','amount_untaxed'],'sale.order');
		// $modelSaleOrder = $saleOrder[0];

		foreach ($saleOrder as $key => $modelSaleOrder) {
			
			# sale order line
			$idSaleOrderLine = $modelSaleOrder['order_line'];
			$saleOrderLine = $oe->read($idSaleOrderLine,['id','price_unit','product_uom_qty','discount','discount_nominal','product_id','product_uom','sequence','product_ref','price_subtotal','name'],'sale.order.line');

			if($modelInvoice['payment_for'] =='dp' || $modelInvoice['payment_for'] =='completion'){
				
				foreach ($saleOrderLine as $key => $modelSaleOrderLine) {

					$pajak = $modelInvoice['pajak'];
					if($modelInvoice['pajak'] > 0){
						$pajak = $modelInvoice['pajak'];
					} else {
						$pajak = 1;
					}

					$subTotalMain = $modelSaleOrderLine['price_unit']*$pajak;


					# product product
					$idProduct = $modelSaleOrderLine['product_id'][0].',';
					$product = $oe->read([$idProduct],['id','default_code','name_template','product_tmpl_id'],"product.product");
					$modelProduct = NULL;
					if($product != NULL){
						$modelProduct = $product[0];
					}

					$nameLine = (isset($modelSaleOrderLine['product_ref']) ? $modelSaleOrderLine['product_ref'] : null);
					if(trim($modelSaleOrderLine['name'])):
						$nameLine .= (isset($modelProduct['name_template']) ? '<br/>':"").nl2br($modelSaleOrderLine['name']);
					endif;
					if(isset($modelProduct['default_code'])){
						$nameLine .= '<br/>P/N : '.$modelProduct['default_code'];
					}
					if($modelInvoice['payment_for']){
						$nameLine .= '<br/><b>Rp '. Yii::$app->numericLib->indoStyle($subTotalMain).' x '.floatval($invLine['quantity']).'</b>';
					}


					$lines[] = [
						'id'=>$modelSaleOrderLine['id'],

						'no'=>$modelSaleOrderLine['sequence'],
						'name'=>$nameLine,

						'priceUnit'=>$this->formatValue($modelSaleOrderLine['price_unit'],$modelInvoice['currency_id'][0]),
						'priceUnitMainCurr'=>Yii::$app->numericLib->indoStyle($invLine['unit_price_main']),

						'currency'=>$modelInvoice['currency_id'][1],

						'qty'=>$invLine['quantity'],
						'unit'=>$invLine['uos_id'][1],

						'priceSubtotal'=>$this->formatValue($modelSaleOrderLine['price_subtotal'],$modelInvoice['currency_id'][0]),
						// 'subTotalMain'=>Yii::$app->numericLib->indoStyle($invLine['sub_total_main']),
						'subTotalMain'=>Yii::$app->numericLib->indoStyle($subTotalMain),

						'amountBruto'=>$this->formatValue($invLine['amount_bruto'],$modelInvoice['currency_id'][0]),
						'amountBrutoMain'=>Yii::$app->numericLib->indoStyle($invLine['amount_bruto_main']),

						'discount'=>$modelSaleOrderLine['discount'],
						'amountDiscount'=>$modelSaleOrderLine['discount_nominal'],
						'amountDiscountMain'=>$invLine['amount_discount_main'],

						'amountUntaxed'=>$modelInvoice['amount_untaxed'],
						'amountUntaxedMain'=>$modelInvoice['amount_untaxed_main'],

						'taxAmountMain'=>$invLine['tax_amount_main'],
						'amountTotalMain'=>$modelInvoice['amount_total_main'],
					];

				}

			}

		}



		// render
		// jika currency nya adalah IDR maka render ke faktur_rp
		if($modelInvoice['currency_id'][1]=='IDR' and $modelInvoice['currency_id'][0]==13)
		{
			return $this->render('account-invoice/faktur_rp',[
				'modelInvoice'=>$modelInvoice,
				'modelPartner'=>$modelPartner,
				'modelInvoiceLine'=>$invLine,
				'lines'=>$lines,
				'printer'=>$printer,
			]);
		}
		else 
		{
			return $this->render('account-invoice/faktur_vls',[
				'modelInvoice'=>$modelInvoice,
				'modelPartner'=>$modelPartner,
				'modelInvoiceLine'=>$invLine,
				'lines'=>$lines,
				'printer'=>$printer,
			]);
		}
	}


	// print out kwitansi	
	public function actionPrintKwitansi($id=null,$uid=null,$printer=null)
	{
		$this->layout = 'printout';

		$id = (int) $id;

		$oe = Yii::$app->openERPLib;
		$login = $oe->login("admin","supra");

		# account invoice
		$invoice = $oe->read([$id],[],"account.invoice");
		if(!$invoice){
			throw new NotFoundHttpException('Data not found.');
		}
		$modelInvoice = $invoice[0];

		# res partner
		$idPartner = $modelInvoice['partner_id'][0];
		$partner = $oe->read([$idPartner],[],"res.partner");
		$modelPartner = $partner[0];

		# acount invoice tax line
		$idTax = $modelInvoice['tax_line'];
		$tax = $oe->read($idTax,[],"account.invoice.tax");
		$modelTax = $tax[0];

		return $this->render('account-invoice/kwitansi',[
			'modelInvoice'=>$modelInvoice,
			'modelPartner'=>$modelPartner,
			'modelTax'=>$modelTax,
			'printer'=>$printer,
		]);
	}




}