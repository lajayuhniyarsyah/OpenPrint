<?php

namespace app\controllers;

use Yii;
use app\models\HrAttendanceMinMaxLog;
use app\models\HrAttendanceMinMaxLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttendanceController implements the CRUD actions for HrAttendanceMinMaxLog model.
 */
class PrintOutController extends Controller
{
	public function actionPrintInvoice($id,$uid=null,$printer="refa")
	{
		$oe = Yii::$app->openERPLib;

		$login = $oe->login("admin","admin");
		$model = $oe->read([16687],[],"account.invoice");
		var_dump($model);

		// return $this->render('account-invoice/invoice',['model'=>$model]);
	}
}