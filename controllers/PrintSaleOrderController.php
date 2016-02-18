<?php
namespace app\controllers;

use Yii;
use app\models\SaleOrder;
use app\models\ResPartner;
use yii\web\Controller;
use yii\web\NotFoundHttpException;




class PrintSaleOrderController extends Controller
{
	public function actionTest($id)
	{
		$this->layout=False;
		$model = SaleOrder::findOne($id);
		if ($model===null){
			throw new NotFoundHttpException;
		}

		if ($model->partner->state===null){
			$state="";
		}
		else{
			$state=$model->partner->state->name;
		}

		if ($model->partner->country===null){
			$country="";
		}
		else{
			$country=$model->partner->country->name;
		}
		if ($model->attention0->fax!==null){
			$fax=$model->attention0->fax;
		}
		else if ($model->partner->fax!==null)
		{
			$fax=$model->partner->fax;

			}
		else{
			$fax="";
		}

		if ($model->attention0->email!==null){
			$email=$model->attention0->email;
		}
		else if ($model->partner->fax!==null)
		 {
			$email=$model->partner->email;

			}
		else{
			$email="";
		}

		return $this->render('index',
			[
			'model'=>$model,
			'state'=>$state,
			'country'=>$country,
			'fax'=>$fax,
			'email'=>$email
			]
			);
	
	}
}