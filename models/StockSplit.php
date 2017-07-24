<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_split".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_done
 * @property string $no
 * @property string $notes
 * @property string $state
 * @property integer $location
 * @property string $date_order
 * @property integer $picking_id
 * @property string $stock_split_no
 *
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property StockLocation $location0
 * @property StockPicking $picking
 * @property StockSplitItem[] $stockSplitItems
 * @property StockSplitItem[] $stockSplitItems0
 */
class StockSplit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_split';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'location', 'picking_id'], 'integer'],
            [['create_date', 'write_date', 'date_done', 'date_order'], 'safe'],
            [['no', 'location'], 'required'],
            [['no', 'notes', 'state', 'stock_split_no'], 'string']
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
            'date_done' => 'Date Done',
            'no' => 'No',
            'notes' => 'Notes',
            'state' => 'State',
            'location' => 'Location',
            'date_order' => 'Date Order',
            'picking_id' => 'Picking ID',
            'stock_split_no' => 'Stock Split No',
        ];
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
    public function getLocation0()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicking()
    {
        return $this->hasOne(StockPicking::className(), ['id' => 'picking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitItems()
    {
        return $this->hasMany(StockSplitItem::className(), ['stock_split_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockSplitItems0()
    {
        return $this->hasMany(StockSplitItem::className(), ['stock_split_id' => 'id']);
    }
}
