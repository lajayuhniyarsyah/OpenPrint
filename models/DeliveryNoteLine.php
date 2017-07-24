<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_note_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $note_id
 * @property integer $product_uom
 * @property string $measurement
 * @property string $weight
 * @property string $product_qty
 * @property integer $product_packaging
 * @property integer $product_id
 * @property string $name
 * @property string $itemno
 * @property string $no_moved0
 * @property integer $no_moved1
 * @property string $no_moved2
 * @property integer $op_line_id
 * @property integer $no
 * @property string $state
 *
 * @property DeliveryNote $note
 * @property OrderPreparationLine $opLine
 * @property ProductPackaging $productPackaging
 * @property ProductProduct $product
 * @property ProductUom $productUom
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property DeliveryNoteLineMaterial[] $deliveryNoteLineMaterials
 * @property DeliveryNoteLineReturn[] $deliveryNoteLineReturns
 */
class DeliveryNoteLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_note_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'note_id', 'product_uom', 'product_packaging', 'product_id', 'no_moved1', 'op_line_id', 'no'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['note_id'], 'required'],
            [['product_qty'], 'number'],
            [['name', 'state'], 'string'],
            [['measurement', 'weight', 'itemno'], 'string', 'max' => 64],
            [['no_moved0', 'no_moved2'], 'string', 'max' => 3]
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
            'note_id' => 'Note ID',
            'product_uom' => 'Product Uom',
            'measurement' => 'Measurement',
            'weight' => 'Weight',
            'product_qty' => 'Product Qty',
            'product_packaging' => 'Product Packaging',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'itemno' => 'Itemno',
            'no_moved0' => 'No Moved0',
            'no_moved1' => 'No Moved1',
            'no_moved2' => 'No Moved2',
            'op_line_id' => 'Op Line ID',
            'no' => 'No',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(DeliveryNote::className(), ['id' => 'note_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpLine()
    {
        return $this->hasOne(OrderPreparationLine::className(), ['id' => 'op_line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPackaging()
    {
        return $this->hasOne(ProductPackaging::className(), ['id' => 'product_packaging']);
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
    public function getDeliveryNoteLineMaterials()
    {
        return $this->hasMany(DeliveryNoteLineMaterial::className(), ['note_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLineReturns()
    {
        return $this->hasMany(DeliveryNoteLineReturn::className(), ['delivery_note_line_id' => 'id']);
    }
}
