<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_work_order_output_picking".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $picking_id
 * @property integer $work_order_output_id
 * @property integer $move_id
 * @property integer $work_order_id
 *
 * @property SbmWorkOrderOutputMove[] $sbmWorkOrderOutputMoves
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SbmWorkOrder $workOrder
 * @property SbmWorkOrderOutput $workOrderOutput
 * @property StockMove $move
 * @property StockPicking $picking
 */
class SbmWorkOrderOutputPicking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_work_order_output_picking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'picking_id', 'work_order_output_id', 'move_id', 'work_order_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['work_order_output_id'], 'required']
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
            'picking_id' => 'Picking ID',
            'work_order_output_id' => 'Work Order Output ID',
            'move_id' => 'Move ID',
            'work_order_id' => 'Work Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSbmWorkOrderOutputMoves()
    {
        return $this->hasMany(SbmWorkOrderOutputMove::className(), ['work_order_output_picking_id' => 'id']);
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
    public function getWorkOrder()
    {
        return $this->hasOne(SbmWorkOrder::className(), ['id' => 'work_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrderOutput()
    {
        return $this->hasOne(SbmWorkOrderOutput::className(), ['id' => 'work_order_output_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMove()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'move_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicking()
    {
        return $this->hasOne(StockPicking::className(), ['id' => 'picking_id']);
    }
}
