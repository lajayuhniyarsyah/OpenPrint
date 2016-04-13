<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_order_revision_history".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $currency
 * @property string $revision_reason
 * @property double $total
 * @property string $revised_on
 * @property integer $sale_order_id
 *
 * @property ResCurrency $currency0
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SaleOrder $saleOrder
 */
class SaleOrderRevisionHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_order_revision_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'currency', 'sale_order_id'], 'integer'],
            [['create_date', 'write_date', 'revised_on'], 'safe'],
            [['revision_reason', 'total', 'revised_on', 'sale_order_id'], 'required'],
            [['revision_reason'], 'string'],
            [['total'], 'number']
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
            'currency' => 'Currency',
            'revision_reason' => 'Revision Reason',
            'total' => 'Total',
            'revised_on' => 'Revised On',
            'sale_order_id' => 'Sale Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency0()
    {
        return $this->hasOne(ResCurrency::className(), ['id' => 'currency']);
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
    public function getSaleOrder()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'sale_order_id']);
    }
}
