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

		$login = $oe->login("admin","admin","LIVE_2016_01_17","http://10.36.15.13:8069/xmlrpc/");
		$model = $oe->read([16687],[],"account.invoice");


		





		return $this->render('account-invoice/invoice',['model'=>$model]);
	}
}