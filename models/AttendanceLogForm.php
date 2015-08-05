<?php
namespace app\models;
use Yii;
use yii\base\Model;

class AttendanceLogForm extends Model{
	public $employee,$department,$year,$month,$day;

	public function rules(){
		return [
			[['employee','department','year','month','day'],'safe'],
		];
	}

	public function attributeLabels(){
		return [
			'verifyCode'=>'Verification Code',
		];
	}
}