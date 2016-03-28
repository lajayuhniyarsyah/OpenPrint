<?php

namespace app\controllers;

use Yii;
use app\models\AccountInvoice;
use app\models\AccountInvoiceSearch;

use app\models\OrderInvoiceReportForm;
use app\models\ResUsers;
use app\models\ResGroups;
use app\models\ResGroupsUsersRel;
use app\models\GroupSales;
use app\models\GroupSalesLine;
use app\models\ExecutiveSummarySales;
use app\models\ExecutiveSummaryGroup;
use app\models\ExecutiveSummaryGroupSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PrinOutController implements the CRUD actions for AccountInvoice model.
 */
class PrintOutController extends Controller
{
	public function actionPrintInvoice($id,$uid=null,$printer="refa")
	{
		$oe = Yii::$app->openERPLib;
		$login = $oe->login("admin","admin");

		# account invoice
		$modelAccInvoice = $oe->read([$id],[],"account.invoice");
		foreach ($modelAccInvoice as $keyAccInvoice => $valueAccInvoice) { }
		
		# res partner
		$queryPartner = <<<query
SELECT rp.id FROM account_invoice ai LEFT JOIN res_partner rp on rp.id = ai.partner_id WHERE ai.id = $id
query;
		$connection = Yii::$app->db;
		$resPartner = $connection->createCommand($queryPartner)->queryAll();
		$idPartner = null;
		foreach ($resPartner as $resKeyPartner => $resValuePartner) {
			$idPartner = $resValuePartner['id'];
		}
		$modelPartner = $oe->read([$idPartner],[],"res.partner");
		foreach ($modelPartner as $keyPartner => $valuePartner) { }
		var_dump($valuePartner);

		return $this->render('account-invoice/invoice',[
			'model'=>$valueAccInvoice,
			'modelPartner'=>$valuePartner,
			'printer'=>$printer,
			'uid'=>$uid
		]);
	}
}