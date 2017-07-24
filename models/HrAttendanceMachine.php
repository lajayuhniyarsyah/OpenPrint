<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hr_attendance_machine".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $ip
 * @property string $desc
 * @property string $port
 * @property string $key
 * @property string $name
 * @property integer $machine_id
 *
 * @property HrAttendanceLog[] $hrAttendanceLogs
 * @property ResUsers $createU
 * @property ResUsers $writeU
 */
class HrAttendanceMachine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_attendance_machine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'machine_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['ip', 'port', 'key', 'name', 'machine_id'], 'required'],
            [['ip', 'desc', 'port', 'key', 'name'], 'string'],
            [['machine_id'], 'unique']
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
            'ip' => 'Ip',
            'desc' => 'Desc',
            'port' => 'Port',
            'key' => 'Key',
            'name' => 'Name',
            'machine_id' => 'Machine ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceLogs()
    {
        return $this->hasMany(HrAttendanceLog::className(), ['machine_id' => 'id']);
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
