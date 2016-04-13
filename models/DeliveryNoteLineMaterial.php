<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_note_line_material".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $name
 * @property integer $product_uom
 * @property string $desc
 * @property integer $stock_move_id
 * @property integer $note_line_id
 * @property double $qty
 * @property integer $prodlot_id
 *
 * @property DeliveryNoteLine $noteLine
 * @property ProductProduct $name0
 * @property ProductUom $productUom
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property StockMove $stockMove
 * @property StockProductionLot $prodlot
 */
class DeliveryNoteLineMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_note_line_material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'name', 'product_uom', 'stock_move_id', 'note_line_id', 'prodlot_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['name', 'product_uom', 'note_line_id', 'qty'], 'required'],
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
            'name' => 'Name',
            'product_uom' => 'Product Uom',
            'desc' => 'Desc',
            'stock_move_id' => 'Stock Move ID',
            'note_line_id' => 'Note Line ID',
            'qty' => 'Qty',
            'prodlot_id' => 'Prodlot ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoteLine()
    {
        return $this->hasOne(DeliveryNoteLine::className(), ['id' => 'note_line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName0()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUom()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'product_uom']);
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
    public function getProdlot()
    {
        return $this->hasOne(StockProductionLot::className(), ['id' => 'prodlot_id']);
    }
}
