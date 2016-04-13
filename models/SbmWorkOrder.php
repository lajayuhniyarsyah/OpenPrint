<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_work_order".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $adhoc_order_request_id
 * @property string $due_date
 * @property integer $approver
 * @property integer $sale_order_id
 * @property string $state
 * @property integer $repeat_ref_id
 * @property string $order_date
 * @property integer $location_id
 * @property string $work_location
 * @property string $source_type
 * @property integer $customer_site_id
 * @property string $wo_no
 * @property integer $approver2
 * @property integer $approver3
 * @property string $request_no
 * @property integer $customer_id
 * @property string $notes
 * @property string $seq_wo_no
 * @property string $seq_req_no
 *
 * @property ResPartner $customerSite
 * @property ResPartner $customer
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property ResUsers $approver0
 * @property ResUsers $approver20
 * @property ResUsers $approver30
 * @property SaleOrder $saleOrder
 * @property SbmAdhocOrderRequest $adhocOrderRequest
 * @property SbmWorkOrder $repeatRef
 * @property SbmWorkOrder[] $sbmWorkOrders
 * @property StockLocation $location
 * @property SbmWorkOrderOutput[] $sbmWorkOrderOutputs
 * @property SbmWorkOrderOutputPicking[] $sbmWorkOrderOutputPickings
 */
class SbmWorkOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_work_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'adhoc_order_request_id', 'approver', 'sale_order_id', 'repeat_ref_id', 'location_id', 'customer_site_id', 'approver2', 'approver3', 'customer_id'], 'integer'],
            [['create_date', 'write_date', 'due_date', 'order_date'], 'safe'],
            [['due_date', 'location_id', 'work_location', 'source_type'], 'required'],
            [['state', 'work_location', 'source_type', 'wo_no', 'request_no', 'notes', 'seq_wo_no', 'seq_req_no'], 'string']
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
            'adhoc_order_request_id' => 'Adhoc Order Request ID',
            'due_date' => 'Due Date',
            'approver' => 'Approver',
            'sale_order_id' => 'Sale Order ID',
            'state' => 'State',
            'repeat_ref_id' => 'Repeat Ref ID',
            'order_date' => 'Order Date',
            'location_id' => 'Location ID',
            'work_location' => 'Work Location',
            'source_type' => 'Source Type',
            'customer_site_id' => 'Customer Site ID',
            'wo_no' => 'Wo No',
            'approver2' => 'Approver2',
            'approver3' => 'Approver3',
            'request_no' => 'Request No',
            'customer_id' => 'Customer ID',
            'notes' => 'Notes',
            'seq_wo_no' => 'Seq Wo No',
            'seq_req_no' => 'Seq Req No',
        ];
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
    public function getApprover0()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'approver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprover20()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'approver2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprover30()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'approver3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrder()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'sale_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdhocOrderRequest()
    {
        return $this->hasOne(SbmAdhocOrderRequest::className(), ['id' => 'adhoc_order_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepeatRef()
    {
        return $this->hasOne(SbmWorkOrder::className(), ['id' => 'repeat_ref_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrders()
    {
        return $this->hasMany(SbmWorkOrder::className(), ['repeat_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputs()
    {
        return $this->hasMany(SbmWorkOrderOutput::className(), ['work_order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputPickings()
    {
        return $this->hasMany(SbmWorkOrderOutputPicking::className(), ['work_order_id' => 'id']);
    }
}
