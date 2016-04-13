<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_work_order_output".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $adhoc_output_ids
 * @property double $no
 * @property integer $uom_id
 * @property integer $work_order_id
 * @property integer $item_id
 * @property double $qty
 * @property string $desc
 *
 * @property SbmWorkOrderLineFiles[] $sbmWorkOrderLineFiles
 * @property ProductProduct $item
 * @property ProductUom $uom
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SbmAdhocOrderRequestOutput $adhocOutputIds
 * @property SbmWorkOrder $workOrder
 * @property SbmWorkOrderOutputPicking[] $sbmWorkOrderOutputPickings
 * @property SbmWorkOrderOutputRawMaterial[] $sbmWorkOrderOutputRawMaterials
 * @property WorkOrderOutputId[] $workOrderOutputs
 * @property WorkOrderRel[] $workOrderRels
 */
class SbmWorkOrderOutput extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_work_order_output';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'adhoc_output_ids', 'uom_id', 'work_order_id', 'item_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['no', 'qty'], 'number'],
            [['uom_id', 'item_id', 'qty'], 'required'],
            [['desc'], 'string']
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
            'adhoc_output_ids' => 'Adhoc Output Ids',
            'no' => 'No',
            'uom_id' => 'Uom ID',
            'work_order_id' => 'Work Order ID',
            'item_id' => 'Item ID',
            'qty' => 'Qty',
            'desc' => 'Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderLineFiles()
    {
        return $this->hasMany(SbmWorkOrderLineFiles::className(), ['work_order_output_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'uom_id']);
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
    public function getAdhocOutputIds()
    {
        return $this->hasOne(SbmAdhocOrderRequestOutput::className(), ['id' => 'adhoc_output_ids']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrder()
    {
        return $this->hasOne(SbmWorkOrder::className(), ['id' => 'work_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputPickings()
    {
        return $this->hasMany(SbmWorkOrderOutputPicking::className(), ['work_order_output_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputRawMaterials()
    {
        return $this->hasMany(SbmWorkOrderOutputRawMaterial::className(), ['work_order_output_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrderOutputs()
    {
        return $this->hasMany(WorkOrderOutputId::className(), ['sbm_work_order_output_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrderRels()
    {
        return $this->hasMany(WorkOrderRel::className(), ['work_order_id' => 'id']);
    }
}
