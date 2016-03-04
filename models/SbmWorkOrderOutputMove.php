<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_work_order_output_move".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $work_order_output_picking_id
 * @property integer $wo_raw_material_id
 * @property integer $move_id
 *
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SbmWorkOrderOutputPicking $workOrderOutputPicking
 * @property SbmWorkOrderOutputRawMaterial $woRawMaterial
 * @property StockMove $move
 */
class SbmWorkOrderOutputMove extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_work_order_output_move';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'work_order_output_picking_id', 'wo_raw_material_id', 'move_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['work_order_output_picking_id', 'wo_raw_material_id'], 'required']
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
            'work_order_output_picking_id' => 'Work Order Output Picking ID',
            'wo_raw_material_id' => 'Wo Raw Material ID',
            'move_id' => 'Move ID',
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
    public function getWorkOrderOutputPicking()
    {
        return $this->hasOne(SbmWorkOrderOutputPicking::className(), ['id' => 'work_order_output_picking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWoRawMaterial()
    {
        return $this->hasOne(SbmWorkOrderOutputRawMaterial::className(), ['id' => 'wo_raw_material_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMove()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'move_id']);
    }
}
