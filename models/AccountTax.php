<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_tax".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $ref_base_code_id
 * @property string $domain
 * @property string $description
 * @property integer $ref_tax_code_id
 * @property integer $sequence
 * @property integer $account_paid_id
 * @property double $ref_base_sign
 * @property string $type_tax_use
 * @property integer $base_code_id
 * @property double $base_sign
 * @property boolean $child_depend
 * @property boolean $include_base_amount
 * @property integer $account_analytic_collected_id
 * @property integer $account_analytic_paid_id
 * @property boolean $active
 * @property double $ref_tax_sign
 * @property string $applicable_type
 * @property integer $account_collected_id
 * @property integer $company_id
 * @property string $name
 * @property integer $tax_code_id
 * @property integer $parent_id
 * @property string $amount
 * @property string $python_compute
 * @property double $tax_sign
 * @property string $python_compute_inv
 * @property string $python_applicable
 * @property string $type
 * @property boolean $price_include
 *
 * @property AccountAccountTaxDefaultRel[] $accountAccountTaxDefaultRels
 * @property AccountConfigSettings[] $accountConfigSettings
 * @property AccountConfigSettings[] $accountConfigSettings0
 * @property AccountFiscalPositionTax[] $accountFiscalPositionTaxes
 * @property AccountFiscalPositionTax[] $accountFiscalPositionTaxes0
 * @property AccountFiscalPositionTaxGlobal[] $accountFiscalPositionTaxGlobals
 * @property AccountFiscalPositionTaxGlobal[] $accountFiscalPositionTaxGlobals0
 * @property AccountInvoiceLineTax[] $accountInvoiceLineTaxes
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountAccount $accountPaid
 * @property AccountAccount $accountCollected
 * @property AccountAnalyticAccount $accountAnalyticCollected
 * @property AccountAnalyticAccount $accountAnalyticPaid
 * @property AccountTax $parent
 * @property AccountTax[] $accountTaxes
 * @property AccountTaxCode $refBaseCode
 * @property AccountTaxCode $refTaxCode
 * @property AccountTaxCode $baseCode
 * @property AccountTaxCode $taxCode
 * @property ResCompany $company
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property AccountVoucher[] $accountVouchers
 * @property ProductSupplierTaxesRel[] $productSupplierTaxesRels
 * @property ProductTaxesRel[] $productTaxesRels
 * @property PurchaseOrderTaxe[] $purchaseOrderTaxes
 * @property SaleOrderTax[] $saleOrderTaxes
 */
class AccountTax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_tax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'ref_base_code_id', 'ref_tax_code_id', 'sequence', 'account_paid_id', 'base_code_id', 'account_analytic_collected_id', 'account_analytic_paid_id', 'account_collected_id', 'company_id', 'tax_code_id', 'parent_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['description', 'type_tax_use', 'applicable_type', 'python_compute', 'python_compute_inv', 'python_applicable', 'type'], 'string'],
            [['sequence', 'type_tax_use', 'applicable_type', 'company_id', 'name', 'amount', 'type'], 'required'],
            [['ref_base_sign', 'base_sign', 'ref_tax_sign', 'amount', 'tax_sign'], 'number'],
            [['child_depend', 'include_base_amount', 'active', 'price_include'], 'boolean'],
            [['domain'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 64],
            [['name', 'company_id'], 'unique', 'targetAttribute' => ['name', 'company_id'], 'message' => 'The combination of Company ID and Name has already been taken.']
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
            'ref_base_code_id' => 'Ref Base Code ID',
            'domain' => 'Domain',
            'description' => 'Description',
            'ref_tax_code_id' => 'Ref Tax Code ID',
            'sequence' => 'Sequence',
            'account_paid_id' => 'Account Paid ID',
            'ref_base_sign' => 'Ref Base Sign',
            'type_tax_use' => 'Type Tax Use',
            'base_code_id' => 'Base Code ID',
            'base_sign' => 'Base Sign',
            'child_depend' => 'Child Depend',
            'include_base_amount' => 'Include Base Amount',
            'account_analytic_collected_id' => 'Account Analytic Collected ID',
            'account_analytic_paid_id' => 'Account Analytic Paid ID',
            'active' => 'Active',
            'ref_tax_sign' => 'Ref Tax Sign',
            'applicable_type' => 'Applicable Type',
            'account_collected_id' => 'Account Collected ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'tax_code_id' => 'Tax Code ID',
            'parent_id' => 'Parent ID',
            'amount' => 'Amount',
            'python_compute' => 'Python Compute',
            'tax_sign' => 'Tax Sign',
            'python_compute_inv' => 'Python Compute Inv',
            'python_applicable' => 'Python Applicable',
            'type' => 'Type',
            'price_include' => 'Price Include',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTaxDefaultRels()
    {
        return $this->hasMany(AccountAccountTaxDefaultRel::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountConfigSettings()
    {
        return $this->hasMany(AccountConfigSettings::className(), ['default_purchase_tax' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountConfigSettings0()
    {
        return $this->hasMany(AccountConfigSettings::className(), ['default_sale_tax' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxes()
    {
        return $this->hasMany(AccountFiscalPositionTax::className(), ['tax_dest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxes0()
    {
        return $this->hasMany(AccountFiscalPositionTax::className(), ['tax_src_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxGlobals()
    {
        return $this->hasMany(AccountFiscalPositionTaxGlobal::className(), ['tax_dest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionTaxGlobals0()
    {
        return $this->hasMany(AccountFiscalPositionTaxGlobal::className(), ['tax_src_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLineTaxes()
    {
        return $this->hasMany(AccountInvoiceLineTax::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['account_tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaid()
    {
        return $this->hasOne(AccountAccount::className(), ['id' => 'account_paid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCollected()
    {
        return $this->hasOne(AccountAccount::className(), ['id' => 'account_collected_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticCollected()
    {
        return $this->hasOne(AccountAnalyticAccount::className(), ['id' => 'account_analytic_collected_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticPaid()
    {
        return $this->hasOne(AccountAnalyticAccount::className(), ['id' => 'account_analytic_paid_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AccountTax::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxes()
    {
        return $this->hasMany(AccountTax::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBaseCode()
    {
        return $this->hasOne(AccountTaxCode::className(), ['id' => 'ref_base_code_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTaxCode()
    {
        return $this->hasOne(AccountTaxCode::className(), ['id' => 'ref_tax_code_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseCode()
    {
        return $this->hasOne(AccountTaxCode::className(), ['id' => 'base_code_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxCode()
    {
        return $this->hasOne(AccountTaxCode::className(), ['id' => 'tax_code_id']);
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
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
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
    public function getAccountVouchers()
    {
        return $this->hasMany(AccountVoucher::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierTaxesRels()
    {
        return $this->hasMany(ProductSupplierTaxesRel::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTaxesRels()
    {
        return $this->hasMany(ProductTaxesRel::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderTaxes()
    {
        return $this->hasMany(PurchaseOrderTaxe::className(), ['tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderTaxes()
    {
        return $this->hasMany(SaleOrderTax::className(), ['tax_id' => 'id']);
    }
}
