<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbm_work_order_line_files".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property resource $file
 * @property string $name
 * @property integer $work_order_output_id
 *
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property SbmWorkOrderOutput $workOrderOutput
 * @property WorkOrderOutputId[] $workOrderOutputs
 */
class SbmWorkOrderLineFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbm_work_order_line_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'work_order_output_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['file', 'name'], 'string'],
            [['name'], 'required']
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
            'file' => 'File',
            'name' => 'Name',
            'work_order_output_id' => 'Work Order Output ID',
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
    public function getWorkOrderOutput()
    {
        return $this->hasOne(SbmWorkOrderOutput::className(), ['id' => 'work_order_output_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrderOutputs()
    {
        return $this->hasMany(WorkOrderOutputId::className(), ['sbm_work_order_line_files_id' => 'id']);
    }
}
