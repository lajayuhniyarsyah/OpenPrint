<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_adhoc_order_request".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $cust_ref_no
 * @property integer $term_of_payment
 * @property string $scope_of_work
 * @property integer $attention_id
 * @property integer $sales_man_id
 * @property string $term_condition
 * @property string $name
 * @property integer $customer_site_id
 * @property string $cust_ref_type
 * @property string $state
 * @property integer $sale_group_id
 * @property integer $customer_id
 * @property string $notes
 * @property string $due_date
 *
 * @property AccountPaymentTerm $termOfPayment
 * @property GroupSales $saleGroup
 * @property ResPartner $attention
 * @property ResPartner $customerSite
 * @property ResPartner $customer
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property ResUsers $salesMan
 * @property SbmAdhocOrderRequestOutput[] $sbmAdhocOrderRequestOutputs
 * @property SbmWorkOrder[] $sbmWorkOrders
 */
class SbmAdhocOrderRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_adhoc_order_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'term_of_payment', 'attention_id', 'sales_man_id', 'customer_site_id', 'sale_group_id', 'customer_id'], 'integer'],
            [['create_date', 'write_date', 'due_date','customer_site_id'], 'safe'],
            [['cust_ref_no', 'term_of_payment', 'sales_man_id', 'name', 'cust_ref_type', 'sale_group_id', 'customer_id'], 'required'],
            [['cust_ref_no', 'scope_of_work', 'term_condition', 'name', 'cust_ref_type', 'state', 'notes'], 'string'],
            [['name'], 'unique']
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
            'cust_ref_no' => 'Cust Ref No',
            'term_of_payment' => 'Term Of Payment',
            'scope_of_work' => 'Scope Of Work',
            'attention_id' => 'Attention ID',
            'sales_man_id' => 'Sales Man ID',
            'term_condition' => 'Term Condition',
            'name' => 'Name',
            'customer_site_id' => 'Customer Site ID',
            'cust_ref_type' => 'Cust Ref Type',
            'state' => 'State',
            'sale_group_id' => 'Sale Group ID',
            'customer_id' => 'Customer ID',
            'notes' => 'Notes',
            'due_date' => 'Due Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTermOfPayment()
    {
        return $this->hasOne(AccountPaymentTerm::className(), ['id' => 'term_of_payment']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleGroup()
    {
        return $this->hasOne(GroupSales::className(), ['id' => 'sale_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttention()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'attention_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerSite()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'customer_site_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'customer_id']);
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
    public function getSalesMan()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'sales_man_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmAdhocOrderRequestOutputs()
    {
        return $this->hasMany(SbmAdhocOrderRequestOutput::className(), ['adhoc_order_request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrders()
    {
        return $this->hasMany(SbmWorkOrder::className(), ['adhoc_order_request_id' => 'id']);
    }
}
