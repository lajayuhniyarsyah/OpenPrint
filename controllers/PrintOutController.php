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

	public function actionPrintInvoice($id,$uid=null,$printer="refa")
	{
		$id = (int) $id;
		$this->layout = 'printout';

		$oe = Yii::$app->openERPLib;
		$login = $oe->login("admin","supra");

		# account invoice
		$modelAccInvoice = $oe->read([$id],[],"account.invoice");
		// var_dump($modelAccInvoice);

		if(!$modelAccInvoice){
			throw new NotFoundHttpException('Data not found.');
		}

		$model = $modelAccInvoice[0]; // karena sudah pasti 1 data yang dicari

		$idPartner = $model['partner_id'][0];
		$idCurrency = $model['currency_id'][0];

		# res partner
		$modelPartner = $oe->read([$idPartner],[],"res.partner");
		$valuePartner = $modelPartner[0];

		# res currency
		$modelCurrency = $oe->read([$idCurrency],[],"res.currency");
		$valueCurrency = $modelCurrency[0];




		$isMainCurrency = false;
		if($idCurrency['currency_id']==13){
			$isMainCurrency=true;
		}
		$invoice = [
			'no'=>null,
			'partner'=>null,
			'fakturNo'=>null,
			'currency'=>$valueCurrency['name'],
			'rate'=>($isMainCurrency?1:$model['pajak']),
			'comment'=>nl2br($model['comment']),
			'lines'=>[
				/*'no'=>null,
				'name'=>null,
				'priceUnit'=>0,
				'priceUnitMainCurr'=>0,
				'qty'=>0,

				'priceSubtotal'=>0,
				'priceSubtotalMainCurr'=>0,
				
				'discountPercentage'=>0,
				'discountAmount'=>0,
				'discountMainCurr'=>0,

				'taxMainCurr'=>0,
				'totalAmountMainCurr'=>0,*/
			],
			'total'=>$this->prepareTotal()
		];
		$lines = [];
		$idx=0;
		$counterLinePriced = 0; #use for count how much inv line item has been priced,, is use for counting floor method in end of result

		# account invoice line
		$accInvoiceLine = $model['invoice_line'];
		foreach ($accInvoiceLine as $keyInvoiceLine => $valueInvoiceLine) {
			$idAccInvoiceLine = $valueInvoiceLine.',';
			$modelAccInvoiceLine = $oe->read([$idAccInvoiceLine],[],"account.invoice.line");
			foreach ($modelAccInvoiceLine as $keyAccInvoiceLine => $valueAccInvoiceLine) {

				$priceUnitMainCurr = round($valueAccInvoiceLine['price_unit'] * $invoice['rate'],2);
				if($valueAccInvoiceLine['price_unit']>0){
					$counterLinePriced++;
				}
				$priceSubtotal = ($isMainCurrency ? round($valueAccInvoiceLine['quantity']*$valueAccInvoiceLine['price_unit'],2):($valueAccInvoiceLine['quantity']*$valueAccInvoiceLine['price_unit']));
				$priceSubtotalMainCurr = round($priceUnitMainCurr*$valueAccInvoiceLine['quantity'],2);

				if($isMainCurrency){
					// IF MAIN CURRENCY
					$discountMainCurr = $valueAccInvoiceLine['amount_discount'];
				}
				else{
					// IF VALAS
					// discount filled, amount discount filled
					// OR
					// discount filled, amount discount not filled
					if(($valueAccInvoiceLine['discount']>0 && $valueAccInvoiceLine['amount_discount']) || ($valueAccInvoiceLine['discount'] && !$valueAccInvoiceLine['amount_discount'])){
						// THEN MAIN CURR WILL TAKE PERCENTAGE OF MAIN CURRENCY
						$discountMainCurr = round($priceSubtotalMainCurr*($valueAccInvoiceLine['discount']/100),2);
					}
					// discount not filled amoount discount filled
					elseif($valueAccInvoiceLine['discount']<=0 && $valueAccInvoiceLine['amount_discount']){

						$discountMainCurr = round($valueAccInvoiceLine['amount_discount']*$invoice['rate'],2);
					}
					// disocunt not filled, amount discount not filled
					else{
						$discountMainCurr = 0;
					}
				}

				$priceTotal = ($valueAccInvoiceLine['price_unit']*$valueAccInvoiceLine['quantity'])-$valueAccInvoiceLine['amount_discount'];
				$priceTotalMainCurr = round($priceSubtotalMainCurr-$discountMainCurr,2);

				$data['lines'][] = [
					'id'=>$valueAccInvoiceLine['id'],

		            'no'=>$valueAccInvoiceLine['sequence'],
		            'name'=>$valueAccInvoiceLine['name'].'<br><br>',

		            'priceUnit'=>$valueAccInvoiceLine['price_unit'],
		            'priceUnitMainCurr'=>'&nbsp;',
		            'qty'=>$valueAccInvoiceLine['quantity'].'.00 pcs',
		            'unit'=>'&nbsp;',

		            'priceSubtotal'=>'&nbsp;',
		            'priceSubtotalMainCurr'=>'&nbsp;',
		            
		            'discountPercentage'=>$valueAccInvoiceLine['discount'],
		            'discountAmount'=>$valueAccInvoiceLine['amount_discount'],
		            'discountMainCurr'=>'&nbsp;',

		            'priceTotal'=>'&nbsp;',
		            'priceTotalMainCurr'=>'&nbsp;',

		            'taxMainCurr'=>'&nbsp;',
		            'totalAmountMainCurr'=>'&nbsp;',

		            'formated'=>[
		                'currency'=>$valueCurrency['name'],
		                'priceUnit'=>$valueAccInvoiceLine['price_unit'],
		                'priceUnitMainCurr'=>'&nbsp;',
		                // 'qty'=>$invLine->quantity,

		                'priceSubtotal'=>round($valueAccInvoiceLine['quantity']*$valueAccInvoiceLine['price_unit'],2),
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

		if($printer == null && ($uid==100 || $uid == 191)){
			$printer='sri';
		}

		return $this->render('account-invoice/invoice',[
			'model'=>$model,
			'modelPartner'=>$valuePartner,
			'modelCurrency'=>$valueCurrency,
			'printer'=>$printer,
			'uid'=>$uid,
			'data'=>$data,
		]);
	}
}