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
            [['check_total', 'amount_tax', 'residual', 'amount_untaxed', 'amount_total', 'pajak', 'kurs','faktur_address'], 'number'],
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


    public function getInvoiceMapData(){
        $invoice = [

            'no'=>null,
            'partner'=>null,
            'fakturNo'=>null,
            'currency'=>$this->currency->name,
            'rate'=>($this->currency_id==13?1:$this->pajak),
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
        foreach($this->accountInvoiceLines as $invLine):

            $priceUnitMainCurr = round($invLine->price_unit * $invoice['rate'],2);
            $priceSubtotalMainCurr = round($priceUnitMainCurr*$invLine->quantity);

            $discountMainCurr = ($invLine->discount ? $priceSubtotalMainCurr*($invLine->discount/100):($invLine->amount_discount ? round($invLine->amount_discount*$invoice['rate']) : 0));

            $priceTotal = ($invLine->price_unit*$invLine->quantity)-$invLine->amount_discount;
            $priceTotalMainCurr = round($priceSubtotalMainCurr-$discountMainCurr);

            $taxMainCurr = floor((10/100)*$priceTotalMainCurr);
            $totalAmountMainCurr = round($priceTotalMainCurr+$taxMainCurr);
            $lines[$idx] = [
                'id'=>$invLine->id,

                'no'=>($this->payment_for =='dp' || $this->payment_for =='completion' ? '':$invLine->sequence),
                'name'=>$invLine->getNameLine(),


                'priceUnit'=>$invLine->price_unit,
                'priceUnitMainCurr'=>$priceUnitMainCurr,
                'qty'=>$invLine->quantity,

                'priceSubtotal'=>$invLine->quantity*$invLine->price_unit,
                'priceSubtotalMainCurr'=>$priceSubtotalMainCurr,
                
                'discountPercentage'=>$invLine->discount,
                'discountAmount'=>$invLine->amount_discount,
                'discountMainCurr'=>$discountMainCurr,

                'priceTotal'=>$priceTotal,
                'priceTotalMainCurr'=>$priceTotalMainCurr,

                'taxMainCurr'=>$taxMainCurr,
                'totalAmountMainCurr'=>$totalAmountMainCurr,


                'formated'=>[
                    'priceUnit'=>Yii::$app->numericLib->indoStyle($invLine->price_unit),
                    'priceUnitMainCurr'=>Yii::$app->numericLib->indoStyle($priceUnitMainCurr),
                    // 'qty'=>$invLine->quantity,

                    'priceSubtotal'=>Yii::$app->numericLib->indoStyle($invLine->quantity*$invLine->price_unit),
                    'priceSubtotalMainCurr'=>Yii::$app->numericLib->indoStyle($priceSubtotalMainCurr),
                    
                    'discountPercentage'=>Yii::$app->numericLib->indoStyle($invLine->discount),
                    'discountAmount'=>Yii::$app->numericLib->indoStyle($invLine->amount_discount),
                    'discountMainCurr'=>Yii::$app->numericLib->indoStyle($discountMainCurr),

                    'priceTotal'=>Yii::$app->numericLib->indoStyle($priceTotal),
                    'priceTotalMainCurr'=>Yii::$app->numericLib->indoStyle($priceTotalMainCurr),

                    'taxMainCurr'=>Yii::$app->numericLib->indoStyle($taxMainCurr),
                    'totalAmountMainCurr'=>Yii::$app->numericLib->indoStyle($totalAmountMainCurr),
                ]
            ];

            $invoice['total']['subtotal'] += $lines[$idx]['priceSubtotal'];
            $invoice['total']['subtotalMainCurr'] += $priceSubtotalMainCurr;
            $invoice['total']['discountSubtotal'] += $invLine->amount_discount;
            $invoice['total']['discountSubtotalMainCurr'] += $discountMainCurr;
            $invoice['total']['amountUntaxed'] += $priceTotal;
            $invoice['total']['amountUntaxedMainCurr'] += $priceTotalMainCurr;
            $invoice['total']['amountTax'] += $priceTotal*(10/100);
            $invoice['total']['amountTaxMainCurr'] += $taxMainCurr;
            $invoice['total']['amountTotal'] += $invLine->price_subtotal;
            $invoice['total']['amountTotalMainCurr'] += $totalAmountMainCurr;

            $idx++;
        endforeach;

        if($this->payment_for=='dp' || $this->payment_for=='completion'):
            unset($invoice['total']);
            $invoice['total'] = $this->prepareTotal();
            // then add so lines
            foreach($this->orders as $so):

                foreach($so->saleOrderLines as $soLine):
                    $idx++;

                    $priceUnitMainCurr = round($soLine->price_unit * $invoice['rate'],2);
                    $priceSubtotalMainCurr = round($priceUnitMainCurr*$soLine->product_uom_qty);

                    $discountMainCurr = ($soLine->discount ? $priceSubtotalMainCurr*($soLine->discount/100):($soLine->discount_nominal ? round($soLine->discount_nominal*$invoice['rate']) : 0));

                    $priceTotal = ($soLine->price_unit*$soLine->product_uom_qty)-$soLine->discount_nominal;
                    $priceTotalMainCurr = round($priceSubtotalMainCurr-$discountMainCurr);
                    // echo $priceTotalMainCurr.'<br/>';
                    $taxMainCurr = floor((10/100)*$priceTotalMainCurr);
                    $totalAmountMainCurr = round($priceTotalMainCurr+$taxMainCurr);
                    $lines[$idx] = [
                        'id'=>$soLine->id,

                        'no'=>($this->payment_for =='dp' || $this->payment_for =='completion' ? '':$soLine->sequence),
                        'name'=>(isset($soLine->product->name_template) ? $soLine->product->name_template.'<br/>'.$soLine->name.'<br/>P/N : '.$soLine->product->default_code:nl2br($soLine->name)),


                        'priceUnit'=>$soLine->price_unit,
                        'priceUnitMainCurr'=>$priceUnitMainCurr,
                        'qty'=>$soLine->product_uom_qty,

                        'priceSubtotal'=>$soLine->product_uom_qty*$soLine->price_unit,
                        'priceSubtotalMainCurr'=>$priceSubtotalMainCurr,
                        
                        'discountPercentage'=>$soLine->discount,
                        'discountAmount'=>$soLine->discount_nominal,
                        'discountMainCurr'=>$discountMainCurr,

                        'priceTotal'=>$priceTotal,
                        'priceTotalMainCurr'=>$priceTotalMainCurr,

                        'taxMainCurr'=>$taxMainCurr,
                        'totalAmountMainCurr'=>$totalAmountMainCurr,
                    ];
                    
                    if($this->currency_id!=13):
                        $invoice['total']['subtotal'] += $lines[$idx]['priceSubtotal'];
                        $invoice['total']['subtotalMainCurr'] += $priceSubtotalMainCurr;
                        $invoice['total']['discountSubtotal'] += $soLine->discount_nominal;
                        $invoice['total']['discountSubtotalMainCurr'] += $discountMainCurr;
                        $invoice['total']['amountUntaxed'] += $priceTotal;
                        $invoice['total']['amountUntaxedMainCurr'] += round($priceTotalMainCurr);
                        $invoice['total']['amountTax'] += round($priceTotal*(10/100));
                        $invoice['total']['amountTaxMainCurr'] += $taxMainCurr;
                        $invoice['total']['amountTotal'] += $priceTotal+$invoice['total']['amountTax'];
                        $invoice['total']['amountTotalMainCurr'] += $totalAmountMainCurr;
                    endif;



                endforeach;
            endforeach;
            if($this->dp_percentage && $this->currency_id!=13){
                // $invoice['total']['subtotal'] = $lines[$idx]['priceSubtotal'];
                $invoice['total']['subtotalMainCurr'] = round($invoice['total']['subtotalMainCurr'] * ($this->dp_percentage/100));
                // $invoice['total']['discountSubtotal'] = $soLine->discount_nominal;
                $invoice['total']['discountSubtotalMainCurr'] = $invoice['total']['discountSubtotalMainCurr'];
                // $invoice['total']['amountUntaxed'] = $priceTotal;
                $invoice['total']['amountUntaxedMainCurr'] = round($invoice['total']['subtotalMainCurr'] - $invoice['total']['discountSubtotalMainCurr']);
                $invoice['total']['amountTax'] = $this->amount_tax;
                $invoice['total']['amountTaxMainCurr'] = floor($invoice['total']['amountUntaxedMainCurr']*(10/100));
                $invoice['total']['amountTotal'] += $priceTotal+$invoice['total']['amountTax'];
                $invoice['total']['amountTotalMainCurr'] += $totalAmountMainCurr;
            }
            
        endif;

        $invoice['lines'] = $lines;
        // var_dump($invoice['total']);

        return $invoice;
    }

    
}