<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_order_material_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $no
 * @property integer $product_id
 * @property integer $picking_location
 * @property integer $sale_order_line_id
 * @property string $desc
 * @property integer $uom
 * @property double $qty
 * @property boolean $is_loaded_from_change
 *
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property ProductProduct $product
 * @property ProductUom $uom0
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SaleOrderLine $saleOrderLine
 * @property StockLocation $pickingLocation
 */
class SaleOrderMaterialLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_order_material_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'no', 'product_id', 'picking_location', 'sale_order_line_id', 'uom'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['product_id', 'picking_location', 'uom', 'qty'], 'required'],
            [['desc'], 'string'],
            [['qty'], 'number'],
            [['is_loaded_from_change'], 'boolean']
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
            'no' => 'No',
            'product_id' => 'Product ID',
            'picking_location' => 'Picking Location',
            'sale_order_line_id' => 'Sale Order Line ID',
            'desc' => 'Desc',
            'uom' => 'Uom',
            'qty' => 'Qty',
            'is_loaded_from_change' => 'Is Loaded From Change',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['sale_line_material_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom0()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'uom']);
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
    public function getSaleOrderLine()
    {
        return $this->hasOne(SaleOrderLine::className(), ['id' => 'sale_order_line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPickingLocation()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'picking_location']);
    }
}
