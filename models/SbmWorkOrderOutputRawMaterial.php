<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_work_order_output_raw_material".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $customer_material
 * @property integer $work_order_output_id
 * @property integer $uom_id
 * @property integer $item_id
 * @property string $desc
 * @property integer $adhoc_material_id
 * @property double $qty
 *
 * @property SbmWorkOrderOutputMove[] $sbmWorkOrderOutputMoves
 * @property ProductProduct $item
 * @property ProductUom $uom
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SbmAdhocOrderRequestOutputMaterial $adhocMaterial
 * @property SbmWorkOrderOutput $workOrderOutput
 */
class SbmWorkOrderOutputRawMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_work_order_output_raw_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'work_order_output_id', 'uom_id', 'item_id', 'adhoc_material_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['customer_material'], 'boolean'],
            [['work_order_output_id', 'uom_id', 'item_id', 'qty'], 'required'],
            [['desc'], 'string'],
            [['qty'], 'number']
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
            'customer_material' => 'Customer Material',
            'work_order_output_id' => 'Work Order Output ID',
            'uom_id' => 'Uom ID',
            'item_id' => 'Item ID',
            'desc' => 'Desc',
            'adhoc_material_id' => 'Adhoc Material ID',
            'qty' => 'Qty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputMoves()
    {
        return $this->hasMany(SbmWorkOrderOutputMove::className(), ['wo_raw_material_id' => 'id']);
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
    public function getAdhocMaterial()
    {
        return $this->hasOne(SbmAdhocOrderRequestOutputMaterial::className(), ['id' => 'adhoc_material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrderOutput()
    {
        return $this->hasOne(SbmWorkOrderOutput::className(), ['id' => 'work_order_output_id']);
    }
}
