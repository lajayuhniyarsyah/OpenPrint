<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "term_condition".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property boolean $active
 *
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property TermConditionRel[] $termConditionRels
 */
class TermCondition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'term_condition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['name'], 'required'],
            [['active'], 'boolean'],
            [['name'], 'string', 'max' => 256]
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
            'active' => 'Active',
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
    public function getTermConditionRels()
    {
        return $this->hasMany(TermConditionRel::className(), ['order_id' => 'id']);
    }
}
