<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_adhoc_order_request_output".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $uom_id
 * @property integer $adhoc_order_request_id
 * @property integer $item_id
 * @property string $desc
 * @property double $qty
 *
 * @property ProductProduct $item
 * @property ProductUom $uom
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SbmAdhocOrderRequest $adhocOrderRequest
 * @property SbmAdhocOrderRequestOutputMaterial[] $sbmAdhocOrderRequestOutputMaterials
 * @property SbmWorkOrderOutput[] $sbmWorkOrderOutputs
 */
class SbmAdhocOrderRequestOutput extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_adhoc_order_request_output';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'uom_id', 'adhoc_order_request_id', 'item_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['uom_id', 'item_id', 'qty'], 'required'],
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
            'uom_id' => 'Uom ID',
            'adhoc_order_request_id' => 'Adhoc Order Request ID',
            'item_id' => 'Item ID',
            'desc' => 'Desc',
            'qty' => 'Qty',
        ];
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
    public function getAdhocOrderRequest()
    {
        return $this->hasOne(SbmAdhocOrderRequest::className(), ['id' => 'adhoc_order_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmAdhocOrderRequestOutputMaterials()
    {
        return $this->hasMany(SbmAdhocOrderRequestOutputMaterial::className(), ['adhoc_order_request_output_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputs()
    {
        return $this->hasMany(SbmWorkOrderOutput::className(), ['adhoc_output_ids' => 'id']);
    }
}
