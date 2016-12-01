<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_note_line_material_return".
 *
 * @property integer $delivery_note_line_material_id
 * @property integer $stock_move_id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $delivery_note_line_id
 * @property integer $stock_picking_id
 * @property integer $delivery_note_id
 * @property integer $id
 * @property string $return_no
 *
 * @property DeliveryNote $deliveryNote
 * @property DeliveryNoteLine $deliveryNoteLine
 * @property DeliveryNoteLineMaterial $deliveryNoteLineMaterial
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property StockMove $stockMove
 * @property StockPicking $stockPicking
 */
class DeliveryNoteLineMaterialReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_note_line_material_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['delivery_note_line_material_id', 'stock_move_id', 'create_uid', 'write_uid', 'delivery_note_line_id', 'stock_picking_id', 'delivery_note_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['return_no'], 'string'],
            [['delivery_note_line_material_id', 'stock_move_id'], 'unique', 'targetAttribute' => ['delivery_note_line_material_id', 'stock_move_id'], 'message' => 'The combination of Delivery Note Line Material ID and Stock Move ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'delivery_note_line_material_id' => 'Delivery Note Line Material ID',
            'stock_move_id' => 'Stock Move ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'delivery_note_line_id' => 'Delivery Note Line ID',
            'stock_picking_id' => 'Stock Picking ID',
            'delivery_note_id' => 'Delivery Note ID',
            'id' => 'ID',
            'return_no' => 'Return No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNote()
    {
        return $this->hasOne(DeliveryNote::className(), ['id' => 'delivery_note_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLine()
    {
        return $this->hasOne(DeliveryNoteLine::className(), ['id' => 'delivery_note_line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLineMaterial()
    {
        return $this->hasOne(DeliveryNoteLineMaterial::className(), ['id' => 'delivery_note_line_material_id']);
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
    public function getStockMove()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'stock_move_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPicking()
    {
        return $this->hasOne(StockPicking::className(), ['id' => 'stock_picking_id']);
    }
}
