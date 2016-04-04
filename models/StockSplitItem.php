<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_split_item".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $convert_type
 * @property integer $product_split_id
 * @property string $notes
 * @property integer $stock_split_id
 * @property double $qty
 * @property integer $uom_id
 * @property integer $prodlot_id
 * @property boolean $qty_on_results
 * @property integer $move_id
 * @property integer $stock_split_item_ids
 * @property integer $parent_id
 *
 * @property ProductSplit $productSplit
 * @property ProductSplit $productSplit0
 * @property ProductUom $uom
 * @property ProductUom $uom0
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property StockMove $move
 * @property StockMove $move0
 * @property StockProductionLot $prodlot
 * @property StockProductionLot $prodlot0
 * @property StockSplit $stockSplit
 * @property StockSplit $stockSplit0
 * @property StockSplitItem $stockSplitItemIds
 * @property StockSplitItem[] $stockSplitItems
 * @property StockSplitItem $parent
 * @property StockSplitItem[] $stockSplitItems0
 */
class StockSplitItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_split_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_split_id', 'stock_split_id', 'uom_id', 'prodlot_id', 'move_id', 'stock_split_item_ids', 'parent_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['convert_type', 'notes'], 'string'],
            [['product_split_id', 'uom_id'], 'required'],
            [['qty'], 'number'],
            [['qty_on_results'], 'boolean']
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
            'convert_type' => 'Convert Type',
            'product_split_id' => 'Product Split ID',
            'notes' => 'Notes',
            'stock_split_id' => 'Stock Split ID',
            'qty' => 'Qty',
            'uom_id' => 'Uom ID',
            'prodlot_id' => 'Prodlot ID',
            'qty_on_results' => 'Qty On Results',
            'move_id' => 'Move ID',
            'stock_split_item_ids' => 'Stock Split Item Ids',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSplit()
    {
        return $this->hasOne(ProductSplit::className(), ['id' => 'product_split_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSplit0()
    {
        return $this->hasOne(ProductSplit::className(), ['id' => 'product_split_id']);
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
    public function getUom0()
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
    public function getMove()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'move_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMove0()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'move_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdlot()
    {
        return $this->hasOne(StockProductionLot::className(), ['id' => 'prodlot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdlot0()
    {
        return $this->hasOne(StockProductionLot::className(), ['id' => 'prodlot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplit()
    {
        return $this->hasOne(StockSplit::className(), ['id' => 'stock_split_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplit0()
    {
        return $this->hasOne(StockSplit::className(), ['id' => 'stock_split_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitItemIds()
    {
        return $this->hasOne(StockSplitItem::className(), ['id' => 'stock_split_item_ids']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitItems()
    {
        return $this->hasMany(StockSplitItem::className(), ['stock_split_item_ids' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(StockSplitItem::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitItems0()
    {
        return $this->hasMany(StockSplitItem::className(), ['parent_id' => 'id']);
    }
}
