<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "account_invoice".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $date_due
 * @property string $check_total
 * @property string $reference
 * @property string $supplier_invoice_number
 * @property string $number
 * @property integer $account_id
 * @property integer $company_id
 * @property integer $currency_id
 * @property integer $partner_id
 * @property integer $fiscal_position
 * @property integer $user_id
 * @property integer $partner_bank_id
 * @property integer $payment_term
 * @property string $reference_type
 * @property integer $journal_id
 * @property string $amount_tax
 * @property string $state
 * @property string $type
 * @property string $internal_number
 * @property boolean $reconciled
 * @property string $residual
 * @property string $move_name
 * @property string $date_invoice
 * @property integer $period_id
 * @property string $amount_untaxed
 * @property integer $move_id
 * @property string $amount_total
 * @property string $name
 * @property string $comment
 * @property boolean $sent
 * @property integer $commercial_partner_id
 * @property string $kmk
 * @property string $faktur_pajak_no
 * @property string $kwitansi
 * @property string $pajak
 * @property string $kurs
 * @property integer $approver
 *
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property ResUsers $approver0
 * @property ResCompany $company
 * @property AccountPeriod $period
 * @property ResUsers $user
 * @property AccountFiscalPosition $fiscalPosition
 * @property ResCurrency $currency
 * @property AccountJournal $journal
 * @property AccountAccount $account
 * @property ResPartnerBank $partnerBank
 * @property AccountPaymentTerm $paymentTerm
 * @property ResPartner $partner
 * @property AccountMove $move
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property SaleOrderInvoiceRel[] $saleOrderInvoiceRels
 * @property StockPicking[] $stockPickings
 * @property PurchaseInvoiceRel[] $purchaseInvoiceRels
 */
class AccountInvoice extends \yii\db\ActiveRecord
{
	public $total_rated,$currency_rate;
	public $partner_to_print;

	// public $printForFaktur = false; #for printing use, if set to true
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'account_invoice';
	}
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['create_uid', 'write_uid', 'account_id', 'company_id', 'currency_id', 'partner_id', 'fiscal_position', 'user_id', 'partner_bank_id', 'payment_term', 'journal_id', 'period_id', 'move_id', 'commercial_partner_id', 'approver'], 'integer'],
			[['create_date', 'write_date', 'date_due', 'date_invoice','payment_for'], 'safe'],
			[['check_total', 'amount_tax', 'residual', 'amount_untaxed', 'amount_total', 'pajak', 'kurs','faktur_address','dp_percentage'], 'number'],
			[['account_id', 'company_id', 'currency_id', 'partner_id', 'reference_type', 'journal_id'], 'required'],
			[['reference_type', 'state', 'type', 'comment'], 'string'],
			[['reconciled', 'sent','print_all_taxes_line'], 'boolean'],
			[['origin', 'reference', 'supplier_invoice_number', 'number', 'move_name', 'name', 'kmk', 'kwitansi'], 'string', 'max' => 64],
			[['internal_number'], 'string', 'max' => 32],
			[['faktur_pajak_no'], 'string', 'max' => 20],
			[['number', 'company_id', 'journal_id', 'type'], 'unique', 'targetAttribute' => ['number', 'company_id', 'journal_id', 'type'], 'message' => 'The combination of Number, Company, Journal and Type has already been taken.']
		];
	}
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'create_uid' => 'Create Uid',
			'create_date' => 'Create Date',
			'write_date' => 'Write Date',
			'write_uid' => 'Write Uid',
			'origin' => 'Source Document',
			'date_due' => 'Due Date',
			'check_total' => 'Verification Total',
			'reference' => 'Invoice Reference',
			'supplier_invoice_number' => 'Supplier Invoice Number',
			'number' => 'Number',
			'account_id' => 'Account',
			'company_id' => 'Company',
			'currency_id' => 'Currency',
			'partner_id' => 'Partner',
			'fiscal_position' => 'Fiscal Position',
			'user_id' => 'Salesperson',
			'partner_bank_id' => 'Bank Account',
			'payment_term' => 'Payment Terms',
			'reference_type' => 'Payment Reference',
			'journal_id' => 'Journal',
			'amount_tax' => 'Tax',
			'state' => 'Status',
			'type' => 'Type',
			'internal_number' => 'Invoice Number',
			'reconciled' => 'Paid/Reconciled',
			'residual' => 'Balance',
			'move_name' => 'Journal Entry',
			'date_invoice' => 'Invoice Date',
			'period_id' => 'Force Period',
			'amount_untaxed' => 'Subtotal',
			'move_id' => 'Journal Entry',
			'amount_total' => 'Total',
			'name' => 'Description',
			'comment' => 'Additional Information',
			'sent' => 'Sent',
			'commercial_partner_id' => 'Commercial Entity',
			'kmk' => 'KMK',
			'faktur_pajak_no' => 'Faktur Pajak',
			'kwitansi' => 'Kwitansi',
			'pajak' => 'Kurs Pajak',
			'kurs' => 'Kurs BI',
			'approver' => 'Approved by',
			'currency_rate'=>'Currency Rate',
			'total_rated'=>'Subtotal In IDR',
			'dp_percentage'=>'DP/Termin Percentage'
		];
	}
	public function afterFind(){
		
		/*$this->amount_tax = $this->numberFormat($this->amount_tax);
		$this->amount_untaxed = $this->numberFormat($this->amount_untaxed);
		$this->amount_total = $this->numberFormat($this->amount_total);*/
		$this->setCurrencyRate();
		$this->setTotalRated();

		$this->setPartnerToPrint();
		return true;
	}
	private function setPartnerToPrint(){
		$prtName = (isset($this->partner->parent) ? $this->partner->parent->name:$this->partner->name);
		$expPartnerName = explode(',',$prtName );
		if(is_array($expPartnerName) && isset($expPartnerName[1])){
			$this->partner_to_print = $expPartnerName[1].'. '.$expPartnerName[0];
		}else{
			$this->partner_to_print = $this->partner->name;
		}
	}

	private function getCurrencyRate(){
		$res = 1;
		if($this->currency_id!=13){
			// if not RP
			$q = ResCurrencyRate::find()
				->where('currency_id=:currencyId AND name = :dateRate')
				->addParams(
					[
						':currencyId'=>$this->currency_id,
						':dateRate'=>($this->date_invoice ? $this->date_invoice:$this->create_date)
					]
				)
				->asArray()
				->one();
			$res = $q['rating'];
		}
		return $res;
	}
	private function setCurrencyRate(){
		$this->currency_rate=$this->getCurrencyRate();
	}
	private function setTotalRated(){
		$this->total_rated=($this->currency_rate*$this->amount_total);
	}
	private function numberFormat($val){
		return number_format($val,2,',','.');
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAccountInvoiceTaxes()
	{
		return $this->hasMany(AccountInvoiceTax::className(), ['invoice_id' => 'id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getApprover0()
	{
		return $this->hasOne(ResUsers::className(), ['id' => 'approver']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCompany()
	{
		return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPeriod()
	{
		return $this->hasOne(AccountPeriod::className(), ['id' => 'period_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(ResUsers::className(), ['id' => 'user_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFiscalPosition()
	{
		return $this->hasOne(AccountFiscalPosition::className(), ['id' => 'fiscal_position']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCurrency()
	{
		return $this->hasOne(ResCurrency::className(), ['id' => 'currency_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getJournal()
	{
		return $this->hasOne(AccountJournal::className(), ['id' => 'journal_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAccount()
	{
		return $this->hasOne(AccountAccount::className(), ['id' => 'account_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPartnerBank()
	{
		return $this->hasOne(ResPartnerBank::className(), ['id' => 'partner_bank_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPaymentTerm()
	{
		return $this->hasOne(AccountPaymentTerm::className(), ['id' => 'payment_term']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPartner()
	{
		return $this->hasOne(ResPartner::className(), ['id' => 'partner_id']);
	}

	public function getOrders(){
		return $this->hasMany(SaleOrder::className(),['id'=>'order_id'])->via('saleOrderInvoiceRels');
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getFakturAddress()
	{
		return $this->hasOne(ResPartner::className(), ['id' => 'faktur_address']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMove()
	{
		return $this->hasOne(AccountMove::className(), ['id' => 'move_id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getWriteU()
	{
		return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCreateU()
	{
		return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getAccountInvoiceLines()
	{
		return $this->hasMany(AccountInvoiceLine::className(), ['invoice_id' => 'id'])->orderBy('sequence ASC, id ASC');
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSaleOrderInvoiceRels()
	{
		return $this->hasMany(SaleOrderInvoiceRel::className(), ['invoice_id' => 'id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getStockPickings()
	{
		return $this->hasMany(StockPicking::className(), ['invoice_id' => 'id']);
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPurchaseInvoiceRels()
	{
		return $this->hasMany(PurchaseInvoiceRel::className(), ['invoice_id' => 'id']);
	}

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

	public function formatValue($value,$to=null){
		if(!$to) $to = $this->currency_id;

		if($to==13){
			return Yii::$app->numericLib->indoStyle(floatval($value));
		}else{
			return Yii::$app->numericLib->westStyle(floatval($value));
		}
	}


	public function getInvoiceMapData($printForFaktur=false){
		// $this->printForFaktur = $printForFaktur;
		$isMainCurrency = false;
		if($this->currency_id==13){
			$isMainCurrency=true;
		}
		$invoice = [

			'no'=>null,
			'partner'=>null,
			'fakturNo'=>null,
			'currency'=>$this->currency->name,
			'rate'=>($isMainCurrency?1:$this->pajak),
			'comment'=>nl2br($this->comment),
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
		// loopint invoice lines
		foreach($this->accountInvoiceLines as $invLine):

			$priceUnitMainCurr = round($invLine->price_unit * $invoice['rate'],2);
			if($invLine->price_unit>0){
				$counterLinePriced++;
			}
			$priceSubtotal = ($isMainCurrency ? round($invLine->quantity*$invLine->price_unit,2):($invLine->quantity*$invLine->price_unit));
			$priceSubtotalMainCurr = round($priceUnitMainCurr*$invLine->quantity,2);

			// $discountMainCurr = ($invLine->discount ? $priceSubtotalMainCurr*($invLine->discount/100):($invLine->amount_discount ? round($invLine->amount_discount*$invoice['rate']) : 0));

			if($isMainCurrency){
				// IF MAIN CURRENCY
				$discountMainCurr = $invLine->amount_discount;
			}
			else{
				// IF VALAS


				// discount filled, amount discount filled
				// OR
				// discount filled, amount discount not filled
				/*var_dump($invLine->discount);
				var_dump($invLine->amount_discount);*/
				/*if($invLine->discount<=0){
					die('xx');
				}*/
				if(($invLine->discount>0 && $invLine->amount_discount) || ($invLine->discount && !$invLine->amount_discount)){
					// THEN MAIN CURR WILL TAKE PERCENTAGE OF MAIN CURRENCY
					$discountMainCurr = round($priceSubtotalMainCurr*($invLine->discount/100),2);
				}
				// discount not filled amoount discount filled
				elseif($invLine->discount<=0 && $invLine->amount_discount){

					$discountMainCurr = round($invLine->amount_discount*$invoice['rate'],2);
					/*var_dump($discountMainCurr);
					echo '<br/>';*/
				}
				// disocunt not filled, amount discount not filled
				else{
					$discountMainCurr = 0;
				}

				
			}

			$priceTotal = ($invLine->price_unit*$invLine->quantity)-$invLine->amount_discount;
			$priceTotalMainCurr = round($priceSubtotalMainCurr-$discountMainCurr,2);
			/*echo $priceSubtotalMainCurr."-".$discountMainCurr;
			var_dump($priceTotalMainCurr);
			die('xx');*/
			// var_dump($invLine->accountInvoiceTaxes);
			if($invLine->accountInvoiceLineTaxes){
				$taxMainCurr = (10/100)*$priceTotalMainCurr;
			}else{
				$taxMainCurr = 0;
			}
			// $taxMainCurr = (10/100)*$priceTotalMainCurr;
			
			// var_dump($taxMainCurr);
			$totalAmountMainCurr = round($priceTotalMainCurr+$taxMainCurr,2);
			
			if ($invLine->uos){
				$unit=$invLine->uos->name;
			}else{
				$unit="";
			}
			
			$lines[$idx] = [
				'id'=>$invLine->id,

				'no'=>($this->payment_for =='dp' || $this->payment_for =='completion' ? '':$invLine->sequence),
				'name'=>$invLine->getNameLine($printForFaktur),


				'priceUnit'=>$invLine->price_unit,
				'priceUnitMainCurr'=>$priceUnitMainCurr,
				'qty'=>($this->payment_for ? '&nbsp;':$invLine->quantity),
				'unit'=>$unit,
				'priceSubtotal'=>($isMainCurrency ? round($invLine->quantity*$invLine->price_unit,2):round($invLine->quantity*$invLine->price_unit,2)),
				'priceSubtotalMainCurr'=>$priceSubtotalMainCurr,
				
				'discountPercentage'=>$invLine->discount,
				'discountAmount'=>$invLine->amount_discount,
				'discountMainCurr'=>$discountMainCurr,

				'priceTotal'=>$priceTotal,
				'priceTotalMainCurr'=>$priceTotalMainCurr,

				'taxMainCurr'=>$taxMainCurr,
				'totalAmountMainCurr'=>$totalAmountMainCurr,


				'formated'=>[
					// 'currency'=>$this->currency->name,
					'currency'=>($printForFaktur ? ($this->payment_for ? '&nbsp;':$this->currency->name):$this->currency->name),
					'priceUnit'=>($this->payment_for ? '':$this->formatValue($invLine->price_unit)),
					'priceUnitMainCurr'=>($this->payment_for ? '':$this->formatValue($priceUnitMainCurr)),
					// 'qty'=>$invLine->quantity,

					// 'priceSubtotal'=>$this->formatValue($priceSubtotal),
					'priceSubtotal'=>($printForFaktur ? ($this->payment_for ? '&nbsp;':$this->formatValue($priceSubtotal)):$this->formatValue($priceSubtotal)),
					'priceSubtotalMainCurr'=>($printForFaktur ? ($this->payment_for ? '&nbsp;':$this->formatValue($priceSubtotalMainCurr)):$this->formatValue($priceSubtotalMainCurr)),
					
					'discountPercentage'=>$this->formatValue($invLine->discount),
					'discountAmount'=>$this->formatValue($invLine->amount_discount),
					'discountMainCurr'=>$this->formatValue($discountMainCurr),

					'priceTotal'=>$this->formatValue($priceTotal),
					'priceTotalMainCurr'=>$this->formatValue($priceTotalMainCurr),

					'taxMainCurr'=>$this->formatValue($taxMainCurr),
					'totalAmountMainCurr'=>$this->formatValue($totalAmountMainCurr),
				]
			];

			$invoice['total']['subtotal'] += $lines[$idx]['priceSubtotal'];
			// echo $lines[$idx]['priceSubtotal'].'<br/>';
			$invoice['total']['subtotalMainCurr'] += $priceSubtotalMainCurr;
			// echo $priceSubtotalMainCurr.'<br/>';
			$invoice['total']['discountSubtotal'] += $invLine->amount_discount;
			
			$invoice['total']['discountSubtotalMainCurr'] += $discountMainCurr;
			$invoice['total']['amountUntaxed'] += $priceTotal;
			$invoice['total']['amountUntaxedMainCurr'] += $priceTotalMainCurr;
			// echo $discountMainCurr;
			$invoice['total']['amountTax'] += $priceTotal*(10/100);

			$invoice['total']['amountTaxMainCurr'] += $taxMainCurr;
			$invoice['total']['amountTotal'] += $invLine->price_subtotal;
			$invoice['total']['amountTotalMainCurr'] += $totalAmountMainCurr;

			$idx++;

			// var_dump($taxMainCurr);
			// echo $invoice['total']['amountTax'];
		endforeach;
		/*var_dump($invoice);
		die();
*/		// var_dump($counterLinePriced);
		if($counterLinePriced==1){

			$invoice['total']['amountUntaxedMainCurr'] = floor($lines[0]['priceSubtotalMainCurr'])-floor($lines[0]['discountMainCurr']);
			$taxes =  ['status'=>true];
			if($isMainCurrency){
				// if idr
				// if ppn total not same with counted then

				if(isset($this->accountInvoiceTaxes)){
					
					foreach($this->accountInvoiceTaxes as $tax)
					{
						if(preg_match('/10\%/', $tax->name)){
							if($tax->amount!=floor($invoice['total']['amountTaxMainCurr'])){
								$taxes=['status'=>false,'amount'=>$tax->amount];
							}
						}
					}
				}
			}

			// if tax not same with amount in account.invoice.tax ->amount

			if(!$taxes['status'])
			{
				$invoice['total']['amountTaxMainCurr'] = $taxes['amount'];
			}
			else
			{
				$invoice['total']['amountTaxMainCurr'] = floor((10/100)*$invoice['total']['amountUntaxedMainCurr']);
			}
			

		}
		/*var_dump(intval($lines[0]['priceSubtotalMainCurr']));
		var_dump(intval($lines[0]['discountMainCurr']));
		echo '=====>'.intval($invoice['total']['amountUntaxedMainCurr']);
		*/
		/*echo '=====>'.$invoice['total']['amountTaxMainCurr'];
		die('xx');*/
		$discountTotal['total'] = $invoice['total']['discountSubtotal'];
		$discountTotal['mainCurr'] = $invoice['total']['discountSubtotalMainCurr'];


		$invTotalTmp = $invoice['total'];
		// var_dump($invoice['total']['amountTaxMainCurr']);

		if($this->payment_for=='dp' || $this->payment_for=='completion'):
			
			if($printForFaktur){
				unset($invoice['total']);
				$invoice['total'] = $this->prepareTotal();
			}
			$diffCurrency = false;
			$soValasInvoiceIDR = false;
			foreach($this->orders as $order):
				if($order->pricelist->currency_id != $this->currency_id){
					$diffCurrency = true;
					if(preg_match('/idr/i', $this->currency->name)){
						// if invoice rupiah
						$invoice['rate'] = $this->pajak;
					}
				}
			endforeach;
			
			// then add so lines
			$no=0;
			foreach($this->orders as $so):
				$soDiscount = 0;
				foreach($so->saleOrderLines as $soLine):
					$no++;
					$idx++;

					$priceUnitMainCurr = round($soLine->price_unit * $invoice['rate'],2);

					$priceSubtotalMainCurr = round($priceUnitMainCurr*$soLine->product_uom_qty,2);
					/*echo '<br/>=====================<br/>';
					echo $soLine->price_unit.'-----..>';
					echo $priceUnitMainCurr.' X '.$soLine->product_uom_qty.'===';
					echo $priceSubtotalMainCurr;

					echo '<br/>=====================<br/>';*/
					// $discountMainCurr = ($soLine->discount ? $priceSubtotalMainCurr*($soLine->discount/100):($soLine->discount_nominal ? round($soLine->discount_nominal*$invoice['rate']) : 0));
					$discountMainCurr = $soLine->discount_nominal*$invoice['rate'];

					// var_dump($discountMainCurr);
					$priceTotal = ($soLine->price_unit*$soLine->product_uom_qty)-$soLine->discount_nominal;
					$priceTotalMainCurr = round($priceSubtotalMainCurr-$discountMainCurr,2);
					// echo $priceTotalMainCurr.'<br/>';
					$taxMainCurr = round(((10/100)*$priceTotalMainCurr),5);
					$totalAmountMainCurr = round($priceTotalMainCurr+$taxMainCurr,2);
					$lines[$idx] = [
						'id'=>$soLine->id,

						'no'=>($this->payment_for =='dp' || $this->payment_for =='completion' ? $no:$soLine->sequence),
						'name'=>(isset($soLine->product->name_template) ? $soLine->product->name_template.'<br/>'.nl2br($soLine->name).'<br/>P/N : '.$soLine->product->default_code.($printForFaktur ? '<br/>Rp<b>'.$this->formatValue($priceUnitMainCurr).' x '.$soLine->product_uom_qty.'</b>':'&nbsp;'):nl2br($soLine->name).($printForFaktur ? '<br/>'.$this->formatValue($priceUnitMainCurr).' x '.$soLine->product_uom_qty:'&nbsp;')),


						'priceUnit'=>$soLine->price_unit,
						'priceUnitMainCurr'=>$priceUnitMainCurr,
						'qty'=>$soLine->product_uom_qty,
						'unit'=>$soLine->productUom->name,

						'priceSubtotal'=>$soLine->product_uom_qty*$soLine->price_unit,
						'priceSubtotalMainCurr'=>$priceSubtotalMainCurr,
						
						'discountPercentage'=>$soLine->discount,
						'discountAmount'=>$soLine->discount_nominal,
						'discountMainCurr'=>$discountMainCurr,

						'priceTotal'=>$priceTotal,
						'priceTotalMainCurr'=>$priceTotalMainCurr,

						'taxMainCurr'=>$taxMainCurr,
						'totalAmountMainCurr'=>$totalAmountMainCurr,

						'formated'=>[
							'currency'=>($printForFaktur ? $this->currency->name:'&nbsp;'),
							// ($printForFaktur ? ($this->payment_for ? $this->currency->name:''):$this->currency->name),
							'priceUnit'=>($printForFaktur ? $this->formatValue($soLine->price_unit):'&nbsp;'),
							'priceUnitMainCurr'=>$this->formatValue($priceUnitMainCurr),
							// 'qty'=>$invLine->quantity,

							'priceSubtotal'=>($printForFaktur ? $this->formatValue($soLine->product_uom_qty*$soLine->price_unit):'&nbsp;'),
							'priceSubtotalMainCurr'=>$this->formatValue($priceSubtotalMainCurr),
							
							'discountPercentage'=>$this->formatValue($soLine->discount),
							'discountAmount'=>$this->formatValue($soLine->discount_nominal),
							'discountMainCurr'=>$this->formatValue($discountMainCurr),

							'priceTotal'=>$this->formatValue($priceTotal),
							'priceTotalMainCurr'=>$this->formatValue($priceTotalMainCurr),

							'taxMainCurr'=>$this->formatValue($taxMainCurr),
							'totalAmountMainCurr'=>$this->formatValue($totalAmountMainCurr),
						]
					];

					if($printForFaktur):

						$lines[$idx]['name'] .= ($discountMainCurr >0 ? '<br/><b>Discount</b> Rp'.$this->formatValue($discountMainCurr,13):null);

						$invoice['total']['subtotal'] += $lines[$idx]['priceSubtotal'];

						$invoice['total']['subtotalMainCurr'] += $priceSubtotalMainCurr;
						
						$invoice['total']['discountSubtotal'] += $soLine->discount_nominal;
						$discountTotal['mainCurr'] += $discountMainCurr;
						$discountTotal['total'] += $lines[$idx]['discountAmount'];
						$invoice['total']['discountSubtotalMainCurr'] += $discountMainCurr;
						$invoice['total']['amountUntaxed'] += $priceTotal;
						// echo $priceTotalMainCurr.'<br/>';
						$invoice['total']['amountUntaxedMainCurr'] += floor($priceTotalMainCurr);
						$invoice['total']['amountTax'] += round($priceTotal*(10/100),5);
						$invoice['total']['amountTaxMainCurr'] += $taxMainCurr;
						$invoice['total']['amountTotal'] += $priceTotal+$invoice['total']['amountTax'];
						$invoice['total']['amountTotalMainCurr'] += $totalAmountMainCurr;

					else:
						// do nothing
					endif;


				endforeach;
			endforeach;
			$invoice['total']['discountSubtotal'] = floor($discountTotal['total']);

			$invoice['total']['discountSubtotalMainCurr'] = floor($discountTotal['mainCurr']);
			
			/*echo $invoice['total']['subtotalMainCurr'];
			echo '<br/>';
			echo $invoice['total']['discountSubtotal'];*/
			// die($invTotalTmp['subtotalMainCurr']);
			if($this->dp_percentage && $printForFaktur){
				// $invoice['total']['subtotal'] = $lines[$idx]['priceSubtotal'];

				if($isMainCurrency){
					// if currency in main currency setting then 
					// use total in invoice
					// $invoice['total']['subtotalMainCurr'] = floor($invTotalTmp['subtotalMainCurr']);
					$invoice['total']['subtotalMainCurr'] = floor($invTotalTmp['subtotalMainCurr']);

					// $invoice['total']['discountSubtotal'] = $soLine->discount_nominal;
					$invoice['total']['discountSubtotalMainCurr'] = floor($invTotalTmp['discountSubtotalMainCurr']);
					// $invoice['total']['amountUntaxed'] = $priceTotal;
					$invoice['total']['amountUntaxedMainCurr'] = $invTotalTmp['amountUntaxedMainCurr'];

					$invoice['total']['amountTax'] = $invTotalTmp['amountTax'];
					$invoice['total']['amountTaxMainCurr'] = $invTotalTmp['amountTaxMainCurr'];
					$invoice['total']['amountTotal'] = $invTotalTmp['amountTotal'];
					$invoice['total']['amountTotalMainCurr'] = $invTotalTmp['amountTotalMainCurr'];

					$invoice['dp']['dpp'] = floor($invTotalTmp['amountUntaxedMainCurr']);
					$invoice['dp']['ppn'] = $invTotalTmp['amountTaxMainCurr'];
					$invoice['dp']['discount'] = 0;
				}
				else
				{
					// var_dump($invoice['total']);
					$invoice['total']['subtotalMainCurr'] = floor($invoice['total']['subtotalMainCurr']);

					// var_dump( $invoice['total']['amountUntaxedMainCurr']);
					// $invoice['total']['discountSubtotal'] = $soLine->discount_nominal;
					$invoice['total']['discountSubtotalMainCurr'] = floor($invoice['total']['discountSubtotalMainCurr']);
					// $invoice['total']['amountUntaxed'] = $priceTotal;
					$invoice['total']['amountUntaxedMainCurr'] = floor($invoice['total']['subtotalMainCurr'] - $invoice['total']['discountSubtotalMainCurr']);
					// echo $invoice['total']['subtotalMainCurr'].' - '.$invoice['total']['discountSubtotalMainCurr'].'<br/>';

					// var_dump( $invoice['total']['amountUntaxedMainCurr']);
					$invoice['total']['amountTax'] = $this->amount_tax;
					$invoice['total']['amountTaxMainCurr'] = floor($invoice['total']['amountUntaxedMainCurr']*(10/100));
					$invoice['total']['amountTotal'] = $priceTotal+$invoice['total']['amountTax'];
					$invoice['total']['amountTotalMainCurr'] = $totalAmountMainCurr;


					$invoice['dp']['dpp'] = floor($invoice['total']['amountUntaxedMainCurr'] * ($this->dp_percentage/100));
					$invoice['dp']['ppn'] = floor($invoice['dp']['dpp']*(10/100));
					$invoice['dp']['discount'] = 0;

				}

				
			}
			
		endif;


		$invoice['total']['subtotal']                   = round($invoice['total']['subtotal'],2);
		$invoice['total']['subtotalMainCurr']           = floor($invoice['total']['subtotalMainCurr']);
		$invoice['total']['discountSubtotal']           = round($invoice['total']['discountSubtotal'],2);

		$invoice['total']['discountSubtotalMainCurr']   = floor($invoice['total']['discountSubtotalMainCurr']);
		$invoice['total']['amountUntaxed']              = round($invoice['total']['amountUntaxed'],2);
		// echo $invTotalTmp['amountUntaxedMainCurr'].'<br/>';
		$invoice['total']['amountUntaxedMainCurr']      = floor($invoice['total']['amountUntaxedMainCurr']);
		// echo $discountMainCurr;
		$invoice['total']['amountTax']                  = round($invoice['total']['amountTax'],2);

		$invoice['total']['amountTaxMainCurr'] = floor($invoice['total']['amountTaxMainCurr']);
		
		$invoice['total']['amountTotal']                = round($invoice['total']['amountTotal'],2);
		$invoice['total']['amountTotalMainCurr']        = floor($invoice['total']['amountTotalMainCurr']);
		

		$invoice['total']['amountTotalMainCurrCounted'] = $invoice['total']['amountUntaxedMainCurr']+$invoice['total']['amountTaxMainCurr'];
		$invoice['total']['formated']['amountTotalMainCurrCounted'] = $this->formatValue($invoice['total']['amountTotalMainCurrCounted']);
		// var_dump($invoice['total']['amountTotalMainCurrCounted']);


		$invoice['lines'] = $lines;


		// var_dump($invoice);

		return $invoice;
	}

	
}