<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "term_condition_rel".
 *
 * @property integer $term_id
 * @property integer $order_id
 *
 * @property SaleOrder $term
 * @property TermCondition $order
 */
class TermConditionRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'term_condition_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['term_id', 'order_id'], 'required'],
            [['term_id', 'order_id'], 'integer'],
            [['term_id', 'order_id'], 'unique', 'targetAttribute' => ['term_id', 'order_id'], 'message' => 'The combination of Term ID and Order ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'term_id' => 'Term ID',
            'order_id' => 'Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTerm()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'term_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(TermCondition::className(), ['id' => 'order_id']);
    }
}
