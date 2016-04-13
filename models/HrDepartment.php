<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hr_department".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property integer $company_id
 * @property string $note
 * @property integer $parent_id
 * @property integer $manager_id
 *
 * @property HrApplicant[] $hrApplicants
 * @property HrDepartment $parent
 * @property HrDepartment[] $hrDepartments
 * @property HrEmployee $manager
 * @property ResCompany $company
 * @property ResUsers $createU
 * @property ResUsers $writeU
 * @property HrEmployee[] $hrEmployees
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis
 * @property HrEmployeeMutasi[] $hrEmployeeMutasis0
 * @property HrEmployeePermission[] $hrEmployeePermissions
 * @property HrExpenseExpense[] $hrExpenseExpenses
 * @property HrJob[] $hrJobs
 * @property HrRecruitmentStage[] $hrRecruitmentStages
 * @property PembelianBarang[] $pembelianBarangs
 * @property RentRequisition[] $rentRequisitions
 * @property SummaryDeptRel[] $summaryDeptRels
 */
class HrDepartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'company_id', 'parent_id', 'manager_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['name'], 'required'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 64]
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
            'name' => 'Department Name',
            'company_id' => 'Company',
            'note' => 'Note',
            'parent_id' => 'Parent Department',
            'manager_id' => 'Manager',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrApplicants()
    {
        return $this->hasMany(HrApplicant::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(HrDepartment::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrDepartments()
    {
        return $this->hasMany(HrDepartment::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(HrEmployee::className(), ['id' => 'manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
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
    public function getHrEmployees()
    {
        return $this->hasMany(HrEmployee::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['source_department' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeeMutasis0()
    {
        return $this->hasMany(HrEmployeeMutasi::className(), ['destination_department' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployeePermissions()
    {
        return $this->hasMany(HrEmployeePermission::className(), ['dept_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrJobs()
    {
        return $this->hasMany(HrJob::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrRecruitmentStages()
    {
        return $this->hasMany(HrRecruitmentStage::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPembelianBarangs()
    {
        return $this->hasMany(PembelianBarang::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitions()
    {
        return $this->hasMany(RentRequisition::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSummaryDeptRels()
    {
        return $this->hasMany(SummaryDeptRel::className(), ['dept_id' => 'id']);
    }
}
