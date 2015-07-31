<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hr_employee".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $address_id
 * @property integer $coach_id
 * @property integer $resource_id
 * @property integer $color
 * @property resource $image
 * @property string $marital
 * @property string $identification_id
 * @property integer $bank_account_id
 * @property integer $job_id
 * @property string $work_phone
 * @property integer $country_id
 * @property integer $parent_id
 * @property string $notes
 * @property integer $department_id
 * @property string $otherid
 * @property string $mobile_phone
 * @property string $birthday
 * @property string $sinid
 * @property string $work_email
 * @property string $work_location
 * @property resource $image_medium
 * @property string $name_related
 * @property string $ssnid
 * @property resource $image_small
 * @property integer $address_home_id
 * @property string $gender
 * @property string $passport_id
 * @property string $evaluation_date
 * @property integer $evaluation_plan_id
 * @property string $birth_place
 * @property string $employee_code
 * @property string $employment_status
 * @property string $blood_type
 * @property string $home_phone
 * @property resource $identity_card_image
 * @property string $private_mobile_no
 * @property string $identity_card_expire_date
 * @property integer $carrier_level_id
 * @property integer $religion_id
 * @property integer $att_pin
 * @property string $join_on
 * @property integer $attendance_type_id
 *
 * @property EmployeeCategoryRel[] $employeeCategoryRels
 * @property HrApplicant[] $hrApplicants
 * @property HrAttendanceLog[] $hrAttendanceLogs
 * @property HrDepartment[] $hrDepartments
 * @property HrAttendanceType $attendanceType
 * @property HrCarrierLevel $carrierLevel
 * @property HrDepartment $department
 * @property HrEmployee $coach
 * @property HrEmployee[] $hrEmployees
 * @property HrEmployee $parent
 * @property HrEmployee[] $hrEmployees0
 * @property HrEmployeeReligion $religion
 * @property HrEvaluationPlan $evaluationPlan
 * @property HrJob $job
 * @property ResCountry $country
 * @property ResPartner $address
 * @property ResPartner $addressHome
 * @property ResPartnerBank $bankAccount
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property ResourceResource $resource
 * @property HrEmployeeIdentityAttachmentRel[] $hrEmployeeIdentityAttachmentRels
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis0
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis1
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis2
 * @property HrEmployeePermission[] $hrEmployeePermissions
 * @property HrEvaluationEvaluation[] $hrEvaluationEvaluations
 * @property HrEvaluationInterview[] $hrEvaluationInterviews
 * @property HrExpenseExpense[] $hrExpenseExpenses
 * @property HrHolidays[] $hrHolidays
 * @property HrHolidays[] $hrHolidays0
 * @property HrHolidays[] $hrHolidays1
 * @property PembelianBarang[] $pembelianBarangs
 * @property RentRequisition[] $rentRequisitions
 * @property SummaryEmpRel[] $summaryEmpRels
 */
class HrEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'address_id', 'coach_id', 'resource_id', 'color', 'bank_account_id', 'job_id', 'country_id', 'parent_id', 'department_id', 'address_home_id', 'evaluation_plan_id', 'carrier_level_id', 'religion_id', 'att_pin', 'attendance_type_id'], 'integer'],
            [['create_date', 'write_date', 'birthday', 'evaluation_date', 'identity_card_expire_date', 'join_on'], 'safe'],
            [['resource_id'], 'required'],
            [['image', 'marital', 'notes', 'image_medium', 'name_related', 'image_small', 'gender', 'employment_status', 'blood_type', 'home_phone', 'identity_card_image', 'private_mobile_no'], 'string'],
            [['identification_id', 'work_phone', 'mobile_phone', 'sinid', 'work_location', 'ssnid'], 'string', 'max' => 32],
            [['otherid', 'passport_id'], 'string', 'max' => 64],
            [['work_email'], 'string', 'max' => 240],
            [['birth_place'], 'string', 'max' => 100],
            [['employee_code'], 'string', 'max' => 20]
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
            'address_id' => 'Address ID',
            'coach_id' => 'Coach ID',
            'resource_id' => 'Resource ID',
            'color' => 'Color',
            'image' => 'Image',
            'marital' => 'Marital',
            'identification_id' => 'Identification ID',
            'bank_account_id' => 'Bank Account ID',
            'job_id' => 'Job ID',
            'work_phone' => 'Work Phone',
            'country_id' => 'Country ID',
            'parent_id' => 'Parent ID',
            'notes' => 'Notes',
            'department_id' => 'Department ID',
            'otherid' => 'Otherid',
            'mobile_phone' => 'Mobile Phone',
            'birthday' => 'Birthday',
            'sinid' => 'Sinid',
            'work_email' => 'Work Email',
            'work_location' => 'Work Location',
            'image_medium' => 'Image Medium',
            'name_related' => 'Name Related',
            'ssnid' => 'Ssnid',
            'image_small' => 'Image Small',
            'address_home_id' => 'Address Home ID',
            'gender' => 'Gender',
            'passport_id' => 'Passport ID',
            'evaluation_date' => 'Evaluation Date',
            'evaluation_plan_id' => 'Evaluation Plan ID',
            'birth_place' => 'Birth Place',
            'employee_code' => 'Employee Code',
            'employment_status' => 'Employment Status',
            'blood_type' => 'Blood Type',
            'home_phone' => 'Home Phone',
            'identity_card_image' => 'Identity Card Image',
            'private_mobile_no' => 'Private Mobile No',
            'identity_card_expire_date' => 'Identity Card Expire Date',
            'carrier_level_id' => 'Carrier Level ID',
            'religion_id' => 'Religion ID',
            'att_pin' => 'Att Pin',
            'join_on' => 'Join On',
            'attendance_type_id' => 'Attendance Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeCategoryRels()
    {
        return $this->hasMany(EmployeeCategoryRel::className(), ['emp_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrApplicants()
    {
        return $this->hasMany(HrApplicant::className(), ['emp_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrAttendanceLogs()
    {
        return $this->hasMany(HrAttendanceLog::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartments()
    {
        return $this->hasMany(HrDepartment::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendanceType()
    {
        return $this->hasOne(HrAttendanceType::className(), ['id' => 'attendance_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrierLevel()
    {
        return $this->hasOne(HrCarrierLevel::className(), ['id' => 'carrier_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(HrDepartment::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoach()
    {
        return $this->hasOne(HrEmployee::className(), ['id' => 'coach_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployees()
    {
        return $this->hasMany(HrEmployee::className(), ['coach_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(HrEmployee::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployees0()
    {
        return $this->hasMany(HrEmployee::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReligion()
    {
        return $this->hasOne(HrEmployeeReligion::className(), ['id' => 'religion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluationPlan()
    {
        return $this->hasOne(HrEvaluationPlan::className(), ['id' => 'evaluation_plan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(HrJob::className(), ['id' => 'job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(ResCountry::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressHome()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'address_home_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankAccount()
    {
        return $this->hasOne(ResPartnerBank::className(), ['id' => 'bank_account_id']);
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
    public function getResource()
    {
        return $this->hasOne(ResourceResource::className(), ['id' => 'resource_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeIdentityAttachmentRels()
    {
        return $this->hasMany(HrEmployeeIdentityAttachmentRel::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['submitted_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis0()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis1()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['approval_2_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis2()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['approval_1_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeePermissions()
    {
        return $this->hasMany(HrEmployeePermission::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationEvaluations()
    {
        return $this->hasMany(HrEvaluationEvaluation::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEvaluationInterviews()
    {
        return $this->hasMany(HrEvaluationInterview::className(), ['user_to_review_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidays()
    {
        return $this->hasMany(HrHolidays::className(), ['manager_id2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidays0()
    {
        return $this->hasMany(HrHolidays::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrHolidays1()
    {
        return $this->hasMany(HrHolidays::className(), ['manager_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelianBarangs()
    {
        return $this->hasMany(PembelianBarang::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitions()
    {
        return $this->hasMany(RentRequisition::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryEmpRels()
    {
        return $this->hasMany(SummaryEmpRel::className(), ['emp_id' => 'id']);
    }
}
