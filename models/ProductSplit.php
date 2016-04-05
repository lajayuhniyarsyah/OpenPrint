<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_split".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $result_qty_fix
 * @property integer $item_splited_to
 * @property integer $item_to_split
 * @property boolean $split_into_batch
 * @property string $state
 *
 * @property ProductProduct $itemSplitedTo
 * @property ProductProduct $itemToSplit
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property StockSplitItem[] $stockSplitItems
 * @property StockSplitItem[] $stockSplitItems0
 */
class ProductSplit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_split';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'item_splited_to', 'item_to_split'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['result_qty_fix', 'split_into_batch'], 'boolean'],
            [['item_splited_to', 'item_to_split'], 'required'],
            [['state'], 'string']
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
            'result_qty_fix' => 'Result Qty Fix',
            'item_splited_to' => 'Item Splited To',
            'item_to_split' => 'Item To Split',
            'split_into_batch' => 'Split Into Batch',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemSplitedTo()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'item_splited_to']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemToSplit()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'item_to_split']);
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
    public function getStockSplitItems()
    {
        return $this->hasMany(StockSplitItem::className(), ['product_split_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitItems0()
    {
        return $this->hasMany(StockSplitItem::className(), ['product_split_id' => 'id']);
    }
}
