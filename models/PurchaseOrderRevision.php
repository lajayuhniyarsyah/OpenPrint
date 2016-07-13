<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_order_revision".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $new_po
 * @property string $state
 * @property integer $po_source
 * @property string $reason
 * @property boolean $revise_w_new_no
 * @property integer $rev_counter
 *
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseOrder $newPo
 * @property PurchaseOrder $poSource
 * @property ResUsers $createU
 * @property ResUsers $writeU
 */
class PurchaseOrderRevision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_revision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'new_po', 'po_source', 'rev_counter'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['state', 'reason'], 'string'],
            [['revise_w_new_no'], 'boolean']
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
            'new_po' => 'New Po',
            'state' => 'State',
            'po_source' => 'Po Source',
            'reason' => 'Reason',
            'revise_w_new_no' => 'Revise W New No',
            'rev_counter' => 'Rev Counter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['po_revision_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewPo()
    {
        return $this->hasOne(PurchaseOrder::className(), ['id' => 'new_po']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoSource()
    {
        return $this->hasOne(PurchaseOrder::className(), ['id' => 'po_source']);
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
}
