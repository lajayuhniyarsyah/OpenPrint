<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_adhoc_order_request_output_material".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $item_id
 * @property integer $adhoc_order_request_output_id
 * @property string $desc
 * @property integer $uom_id
 * @property double $qty
 *
 * @property ProductProduct $item
 * @property ProductUom $uom
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SbmAdhocOrderRequestOutput $adhocOrderRequestOutput
 * @property SbmWorkOrderOutputRawMaterial[] $sbmWorkOrderOutputRawMaterials
 */
class SbmAdhocOrderRequestOutputMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_adhoc_order_request_output_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'item_id', 'adhoc_order_request_output_id', 'uom_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['item_id', 'uom_id', 'qty'], 'required'],
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
            'item_id' => 'Item ID',
            'adhoc_order_request_output_id' => 'Adhoc Order Request Output ID',
            'desc' => 'Desc',
            'uom_id' => 'Uom ID',
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
    public function getAdhocOrderRequestOutput()
    {
        return $this->hasOne(SbmAdhocOrderRequestOutput::className(), ['id' => 'adhoc_order_request_output_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputRawMaterials()
    {
        return $this->hasMany(SbmWorkOrderOutputRawMaterial::className(), ['adhoc_material_id' => 'id']);
    }
}
