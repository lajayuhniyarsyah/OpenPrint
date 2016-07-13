<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_preparation".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property integer $partner_shipping_id
 * @property integer $sale_id
 * @property string $duedate
 * @property string $note
 * @property string $state
 * @property string $tanggal
 * @property integer $picking_id
 * @property integer $partner_id
 * @property string $poc
 * @property string $terms
 * @property string $pick
 * @property integer $location_id
 *
 * @property DeliveryNote[] $deliveryNotes
 * @property ResPartner $partnerShipping
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SaleOrder $sale
 * @property StockLocation $location
 * @property StockPicking $picking
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property ProductBatchLine[] $productBatchLines
 */
class OrderPreparation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_preparation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'partner_shipping_id', 'sale_id', 'picking_id', 'partner_id', 'location_id'], 'integer'],
            [['create_date', 'write_date', 'duedate', 'tanggal'], 'safe'],
            [['name', 'sale_id', 'location_id'], 'required'],
            [['note', 'state', 'terms', 'pick'], 'string'],
            [['name', 'poc'], 'string', 'max' => 64]
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
            'partner_shipping_id' => 'Partner Shipping ID',
            'sale_id' => 'Sale ID',
            'duedate' => 'Duedate',
            'note' => 'Note',
            'state' => 'State',
            'tanggal' => 'Tanggal',
            'picking_id' => 'Picking ID',
            'partner_id' => 'Partner ID',
            'poc' => 'Poc',
            'terms' => 'Terms',
            'pick' => 'Pick',
            'location_id' => 'Location ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNotes()
    {
        return $this->hasMany(DeliveryNote::className(), ['prepare_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerShipping()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_shipping_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_id']);
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
    public function getSale()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'sale_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location_id']);
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
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['preparation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatchLines()
    {
        return $this->hasMany(ProductBatchLine::className(), ['preparation_id' => 'id']);
    }
}
