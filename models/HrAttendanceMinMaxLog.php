<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hr_attendance_min_max_log".
 *
 * @property string $id
 * @property integer $dept_id
 * @property string $dept_name
 * @property integer $employee_id
 * @property string $employee_name
 * @property string $full_date
 * @property double $y_log
 * @property double $m_log
 * @property double $d_log
 * @property double $dow_log
 * @property string $scan_times_a_day
 * @property string $min_log
 * @property string $hh_min_log
 * @property string $mm_min_log
 * @property string $min_state_log
 * @property string $max_log
 * @property string $hh_max_log
 * @property string $mm_max_log
 * @property string $max_state_log
 * @property string $attendance_time
 * @property integer $err_code
 */
class HrAttendanceMinMaxLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_attendance_min_max_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'],'unique'],
            [['id', 'dept_id', 'employee_id', 'scan_times_a_day', 'err_code'], 'integer'],
            [['employee_name', 'min_log', 'hh_min_log', 'mm_min_log', 'min_state_log', 'max_log', 'hh_max_log', 'mm_max_log', 'max_state_log', 'attendance_time'], 'string'],
            [['full_date'], 'safe'],
            [['y_log', 'm_log', 'd_log', 'dow_log'], 'number'],
            [['dept_name'], 'string', 'max' => 64]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dept_id' => 'Dept ID',
            'dept_name' => 'Dept Name',
            'employee_id' => 'Employee ID',
            'employee_name' => 'Employee Name',
            'full_date' => 'Full Date',
            'y_log' => 'Y Log',
            'm_log' => 'M Log',
            'd_log' => 'D Log',
            'dow_log' => 'Dow Log',
            'scan_times_a_day' => 'Scan Times A Day',
            'min_log' => 'Min Log',
            'hh_min_log' => 'Hh Min Log',
            'mm_min_log' => 'Mm Min Log',
            'min_state_log' => 'Min State Log',
            'max_log' => 'Max Log',
            'hh_max_log' => 'Hh Max Log',
            'mm_max_log' => 'Mm Max Log',
            'max_state_log' => 'Max State Log',
            'attendance_time' => 'Attendance Time',
            'err_code' => 'Err Code',
        ];
    }


    public static function primaryKey(){
        return ['id'];
    }

}
