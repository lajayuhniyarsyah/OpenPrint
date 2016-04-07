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
		$id = (int) $id;
		$this->layout = 'printout';

		$oe = Yii::$app->openERPLib;
		$login = $oe->login("admin","supra");

		# account invoice
		$modelAccInvoice = $oe->read([$id],['id','kwitansi','date_invoice','amount_untaxed','amount_untaxed_main','amount_tax','amount_total','amount_total_main','approver','partner_id','currency_id','invoice_line','pajak','comment','name','payment_for'],"account.invoice");
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
		$modelAccInvoiceLines = $oe->read($model['invoice_line'],['id','unit_price_main','sub_total_main','price_unit','quantity','amount_discount','discount','product_id','name','sequence','uos_id','amount_discount_main','price_subtotal','tax_amount_main'],'account.invoice.line');
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
	            if($modelProductTemplate['type']!='service'){
	                $nameLine .= '<br/>P/N : '.$modelProduct['default_code'];
	            }
	        }
	        // if(!$model['payment_for'] && $printForFaktur){
	        //     $nameLine .= '<br/><b>Rp'.Yii::$app->numericLib->indoStyle($this->price_unit_main_curr).' x '.floatval($invLine['quantity']).'</b>';
	        // }

			$data['lines'][] = [
				'id'=>$invLine['id'],

	            'no'=>($model['payment_for'] =='dp' || $model['payment_for'] =='completion' ? '':$invLine['sequence']),
	            'name'=>$nameLine,

	            'priceUnit'=>$invLine['price_unit'],
	            'priceUnitMainCurr'=>$invLine['unit_price_main'],
	            'qty'=>($model['payment_for'] ? '&nbsp;':$this->formatValue($invLine['quantity'],$model['currency_id'][0])),
	            'unit'=>$invLine['uos_id'][1],

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
			$invoice['total']['subtotalMainCurr'] += $invLine['sub_total_main'];
			$invoice['total']['discountSubtotal'] += $invLine['amount_discount'];
			
			$invoice['total']['discountSubtotalMainCurr'] += $invLine['amount_discount_main'];
			$invoice['total']['amountUntaxed'] += $model['amount_untaxed'];
			$invoice['total']['amountUntaxedMainCurr'] += $model['amount_untaxed_main'];
			$invoice['total']['amountTax'] += $model['amount_tax'];

			$invoice['total']['amountTaxMainCurr'] += $invLine['tax_amount_main'];
			$invoice['total']['amountTotal'] += $invLine['price_subtotal'];
			$invoice['total']['amountTotalMainCurr'] += $model['amount_total_main'];

			$idx++;
		}


		// jika dp / complete
		// maka load data[lines] dari sale order

		$sale_order_ids = $oe->search([['invoice_ids','=',$id]],'sale.order');
		// var_dump($sale_order_ids);
		$saleOrder = $oe->read($sale_order_ids,['id','order_line'],'sale.order');
		// var_dump($saleOrder);
		$modelSaleOrder = $saleOrder[0];
		$id_order_line = $modelSaleOrder['order_line'];
		$saleOrderLine = $oe->read($id_order_line,['id','price_unit','product_uom_qty','discount','discount_nominal','product_id','product_uom','sequence','product_ref','name'],'sale.order.line');
		// var_dump($saleOrderLine);

		if($model['payment_for'] =='dp' || $model['payment_for'] =='completion'){
			
			$no=0;
			foreach ($saleOrderLine as $key => $soLine) {

				$no++;
				$idx++;
				$priceUnitMainCurr = round($soLine['price_unit'] * $invoice['rate'],2);
				$priceSubtotalMainCurr = round($priceUnitMainCurr*$soLine['product_uom_qty'],2);
				$discountMainCurr = $soLine['discount_nominal']*$invoice['rate'];
				$priceTotal = ($soLine['price_unit']*$soLine['product_uom_qty'])-$soLine['discount_nominal'];
				$priceTotalMainCurr = round($priceSubtotalMainCurr-$discountMainCurr,2);
				$taxMainCurr = round(((10/100)*$priceTotalMainCurr),5);
				$totalAmountMainCurr = round($priceTotalMainCurr+$taxMainCurr,2);

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
		            'name'=>(isset($soLine['product_ref']) ? $soLine['product_ref'].'<br/>'.nl2br($soLine['name']).'<br/>P/N : '.$modelProduct['default_code'].($printForFaktur ? '<br/>Rp<b>'.$this->formatValue($priceUnitMainCurr).' x '.$soLine['product_uom_qty'].'</b>':'&nbsp;'):nl2br($soLine['name']).($printForFaktur ? '<br/>'.$this->formatValue($priceUnitMainCurr).' x '.$soLine['product_uom_qty']:'&nbsp;')),

		            'priceUnit'=>$soLine['price_unit'],
		            'priceUnitMainCurr'=>$priceUnitMainCurr,
		            'qty'=>$this->formatValue($soLine['product_uom_qty'],$model['currency_id'][0]),
		            'unit'=>$soLine['product_uom'][1],

		            'priceSubtotal'=>$soLine['product_uom_qty']*$soLine['price_unit'],
		            'priceSubtotalMainCurr'=>$priceSubtotalMainCurr,
		            
		            'discountPercentage'=>$soLine['discount'],
		            'discountAmount'=>$soLine['discount_nominal'],
		            'discountMainCurr'=>$discountMainCurr,

		            'priceTotal'=>$priceTotal,
		            'priceTotalMainCurr'=>$priceTotalMainCurr,

		            'taxMainCurr'=>$taxMainCurr,
		            'totalAmountMainCurr'=>$totalAmountMainCurr,

		            'formated'=>[
		                'currency'=>($printForFaktur ? $model['currency_id'][1]:'&nbsp;'),
		                'priceUnit'=>($printForFaktur ? $this->formatValue($soLine['price_unit'],$model['currency_id'][0]):'&nbsp;'),
		                'priceUnitMainCurr'=>$this->formatValue($priceUnitMainCurr,$model['currency_id'][0]),
						
						'priceSubtotal'=>($printForFaktur ? $this->formatValue(($soLine['product_uom_qty']*$soLine['price_unit']),$model['currency_id'][0]):'&nbsp;'),
						'priceSubtotalMainCurr'=>$this->formatValue($priceSubtotalMainCurr,$model['currency_id'][0]),
						
						'discountPercentage'=>$this->formatValue($soLine['discount'],$model['currency_id'][0]),
						'discountAmount'=>$this->formatValue($soLine['discount_nominal'],$model['currency_id'][0]),
						'discountMainCurr'=>$this->formatValue($discountMainCurr,$model['currency_id'][0]),

						'priceTotal'=>$this->formatValue($priceTotal,$model['currency_id'][0]),
						'priceTotalMainCurr'=>$this->formatValue($priceTotalMainCurr,$model['currency_id'][0]),

						'taxMainCurr'=>$this->formatValue($taxMainCurr,$model['currency_id'][0]),
						'totalAmountMainCurr'=>$this->formatValue($totalAmountMainCurr,$model['currency_id'][0]),
		            ]
				];

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
}