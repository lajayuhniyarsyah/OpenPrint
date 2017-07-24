<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perintah_kerja".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $kontrak
 * @property integer $creator
 * @property integer $approver
 * @property string $date
 * @property string $kontrakdate
 * @property integer $partner_id
 * @property string $name
 * @property integer $sale_id
 * @property string $state
 * @property string $note
 * @property integer $checker
 * @property string $workshop
 * @property string $type
 * @property string $delivery_date
 * @property integer $location_src_id
 * @property integer $location_dest_id
 * @property string $terms
 * @property boolean $special
 * @property integer $pr_id
 *
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property DeliveryNote[] $deliveryNotes
 * @property MrpProduction[] $mrpProductions
 * @property Pr $pr
 * @property ResPartner $partner
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property ResUsers $creator0
 * @property ResUsers $approver0
 * @property ResUsers $checker0
 * @property SaleOrder $sale
 * @property StockLocation $locationSrc
 * @property StockLocation $locationDest
 * @property PerintahKerjaLine[] $perintahKerjaLines
 * @property PurchaseRequisitionSubcontLine[] $purchaseRequisitionSubcontLines
 * @property RawMaterialLine[] $rawMaterialLines
 * @property WizardSpkRel[] $wizardSpkRels
 */
class PerintahKerja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perintah_kerja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'creator', 'approver', 'partner_id', 'sale_id', 'checker', 'location_src_id', 'location_dest_id', 'pr_id'], 'integer'],
            [['create_date', 'write_date', 'date', 'kontrakdate', 'delivery_date'], 'safe'],
            [['date', 'kontrakdate', 'name', 'location_src_id', 'location_dest_id'], 'required'],
            [['state', 'note', 'type', 'terms'], 'string'],
            [['special'], 'boolean'],
            [['kontrak', 'name', 'workshop'], 'string', 'max' => 64]
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
            'kontrak' => 'Kontrak',
            'creator' => 'Creator',
            'approver' => 'Approver',
            'date' => 'Date',
            'kontrakdate' => 'Kontrakdate',
            'partner_id' => 'Partner ID',
            'name' => 'Name',
            'sale_id' => 'Sale ID',
            'state' => 'State',
            'note' => 'Note',
            'checker' => 'Checker',
            'workshop' => 'Workshop',
            'type' => 'Type',
            'delivery_date' => 'Delivery Date',
            'location_src_id' => 'Location Src ID',
            'location_dest_id' => 'Location Dest ID',
            'terms' => 'Terms',
            'special' => 'Special',
            'pr_id' => 'Pr ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['spk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNotes()
    {
        return $this->hasMany(DeliveryNote::className(), ['work_order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['perintah_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPr()
    {
        return $this->hasOne(Pr::className(), ['id' => 'pr_id']);
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
    public function getCreator0()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprover0()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'approver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChecker0()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'checker']);
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
    public function getLocationSrc()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location_src_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationDest()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location_dest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLines()
    {
        return $this->hasMany(PerintahKerjaLine::className(), ['perintah_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLine::className(), ['wo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawMaterialLines()
    {
        return $this->hasMany(RawMaterialLine::className(), ['perintah_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardSpkRels()
    {
        return $this->hasMany(WizardSpkRel::className(), ['line_ids' => 'id']);
    }
}
