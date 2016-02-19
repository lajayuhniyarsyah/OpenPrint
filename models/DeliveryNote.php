<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SaleOrder;

/**
 * This is the model class for table "delivery_note".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $colorcode
 * @property integer $partner_id
 * @property string $poc
 * @property string $name
 * @property integer $partner_shipping_id
 * @property string $note
 * @property string $state
 * @property string $tanggal
 * @property integer $prepare_id
 * @property string $ekspedisi
 * @property string $jumlah_coli
 * @property string $terms
 * @property boolean $special
 * @property integer $work_order_id
 * @property integer $work_order_in
 * @property integer $attn
 *
 * @property PackingListLine[] $packingListLines
 * @property StockPicking[] $stockPickings
 * @property ResPartner $attn0
 * @property PerintahKerjaInternal $workOrderIn
 * @property PerintahKerja $workOrder
 * @property OrderPreparation $prepare
 * @property ResPartner $partnerShipping
 * @property ResPartner $partner
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property DeliveryNoteLine[] $deliveryNoteLines
 */
class DeliveryNote extends \yii\db\ActiveRecord
{
    public $selisih_hari, $status/*, $year_tanggal, $month_tanggal*/;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'partner_id', 'partner_shipping_id', 'prepare_id', 'work_order_id', 'work_order_in', 'attn'], 'integer'],
            [['create_date', 'write_date', 'tanggal', 'state', 'selisih_hari', 'status'], 'safe'],
            [['name'], 'required'],
            [['note', 'state', 'terms'], 'string'],
            [['special'], 'boolean'],
            [['colorcode', 'poc', 'name', 'jumlah_coli'], 'string', 'max' => 64],
            [['ekspedisi'], 'string', 'max' => 128],
            // [['year_tanggal','month_tanggal'], 'integer'],
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
            'colorcode' => 'Colorcode',
            'partner_id' => 'Partner ID',
            'poc' => 'Poc',
            'name' => 'Delivery Note',
            'partner_shipping_id' => 'Partner Shipping ID',
            'note' => 'Note',
            'state' => 'State',
            'tanggal' => 'Tanggal Kirim',
            'prepare_id' => 'Prepare ID',
            'ekspedisi' => 'Ekspedisi',
            'jumlah_coli' => 'Jumlah Coli',
            'terms' => 'Terms',
            'special' => 'Special',
            'work_order_id' => 'Work Order ID',
            'work_order_in' => 'Work Order In',
            'attn' => 'Attn',
            'stockPicking0.date_done' => 'DN/SJ Date',
            'partner.display_name' => 'Address Name',
            'saleOrder.date_order' => 'Tgl PO/Barang Masuk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackingListLines()
    {
        return $this->hasMany(PackingListLine::className(), ['note_id' => 'id'])->orderBy('name ASC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['note_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttn0()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'attn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrderIn()
    {
        return $this->hasOne(PerintahKerjaInternal::className(), ['id' => 'work_order_in']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrder()
    {
        return $this->hasOne(PerintahKerja::className(), ['id' => 'work_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrepare()
    {
        return $this->hasOne(OrderPreparation::className(), ['id' => 'prepare_id']);
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
    public function getWriteU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
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
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['note_id' => 'id'])->orderBy('no, id ASC');
    }

    public function getSaleOrder(){
        return $this->hasOne(SaleOrder::className(),['id'=>'sale_id'])->via('prepare');
    }

    public function getStockPicking0(){
        return $this->hasOne(StockPicking::className(),['id'=>'partner_id']);
    }


    public function afterFind(){

        // var_dump($this->saleOrder->date_order);
        
        $date1 = date_create($this->saleOrder->date_order);
        $date2 = date_create($this->tanggal);
        if($this->tanggal === null) {
            $this->selisih_hari = null;
            $this->status = 'Tidak Tercapai';
        }
        else {
            $diff = date_diff($date1,$date2);
            if($diff->m === 0) {
                $this->selisih_hari = $diff->d." Hari ";
            }
            else {
                $this->selisih_hari = $diff->m." Bulan ".$diff->d." Hari ";
            }
            if($diff->m === 0 && $diff->d <= 7) {
                $this->status = 'Tercapai';
            }
            else {
                $this->status = 'Tidak Tercapai';
            }
        }

        return true;
    }

}
