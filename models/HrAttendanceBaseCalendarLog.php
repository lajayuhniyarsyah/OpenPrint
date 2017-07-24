<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hr_attendance_base_calendar_log".
 *
 * @property string $id
 * @property string $ym_g
 * @property string $i
 * @property double $i_year
 * @property double $i_month
 * @property double $i_day
 * @property string $month_name
 * @property string $day_name
 * @property integer $employee_id
 * @property string $employee_name
 * @property string $dept_name
 * @property integer $hh_min_log
 * @property integer $mm_min_log
 * @property integer $hh_max_log
 * @property integer $mm_max_log
 * @property string $attendance_time
 */
class HrAttendanceBaseCalendarLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_attendance_base_calendar_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'hh_min_log', 'mm_min_log', 'hh_max_log', 'mm_max_log'], 'integer'],
            [['ym_g', 'month_name', 'day_name', 'employee_name', 'attendance_time'], 'string'],
            [['i'], 'safe'],
            [['i_year', 'i_month', 'i_day'], 'number'],
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
            'ym_g' => 'Ym G',
            'i' => 'I',
            'i_year' => 'I Year',
            'i_month' => 'I Month',
            'i_day' => 'I Day',
            'month_name' => 'Month Name',
            'day_name' => 'Day Name',
            'employee_id' => 'Employee ID',
            'employee_name' => 'Employee Name',
            'dept_name' => 'Dept Name',
            'hh_min_log' => 'Hh Min Log',
            'mm_min_log' => 'Mm Min Log',
            'hh_max_log' => 'Hh Max Log',
            'mm_max_log' => 'Mm Max Log',
            'attendance_time' => 'Attendance Time',
        ];
    }
}
