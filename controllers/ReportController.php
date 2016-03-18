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
class ReportController extends Controller
{
	 public function actionReportsaldostockbarang()
	 {
	 	$dataTorender = [];
	 	$formModel= new \app\models\ReportBalanceOfItemStock;

	 	$param = Yii::$app->request->get();

	 	if ($formModel->load($param)) 
	 	{

	 	}

	 	$dataTorender['dataProvider'] = new \yii\data\SqlDataProvider ([
	 		'sql'=>"with r_c(id,pn,rf,src,st,pr,uom,srl,slc,dlc,dd,scdd,sts,mst,qty,qty1) as
					(
					select 
							 stv.id 
							,stv.name  
							,sp.name 
							,stv.origin 
							,spt.type
							,pp.name_template 
							,po.name 
							,spl.company_id 
							,sls.complete_name 
							,sld.complete_name 
							,stv.date 
							,stv.create_date 
							,stv.state
							,case when sls.complete_name = (select complete_name from stock_location as sl where sl.id = 12) then 'keluar' else 'masuk' end as move_status
							,case when sls.complete_name = (select complete_name from stock_location as sl where sl.id = 12) then -(stv.product_qty) else stv.product_qty end
							,sum(stv.product_qty) 

					from 
					stock_move as stv
					JOIN stock_picking sp ON sp.id = stv.picking_id
					JOIN stock_picking spt ON spt.id = stv.picking_id
					JOIN product_product pp ON pp.id = stv.product_id
					JOIN product_uom po ON po.id = stv.product_uom
					JOIN stock_production_lot spl on spl.id = stv.prodlot_id
					JOIN stock_location sls on sls.id = stv.location_id
					JOIN stock_location sld on sld.id = stv.location_dest_id

					where stv.state in('done') group by stv.id,sp.id,spt.id,pp.id,po.id,spl.id,sls.id,sld.id order by date
					)

					SELECT

					 pn as product_name
					,rf as referensi
					,src as source
					,st as shipping_type
					,pr as product
					,uom as unit_of_measure
					,srl as serial
					,slc as source_location
					,dlc as destination_location
					,dd as date
					,scdd as schedule_date
					,sts as status
					,mst as move_status
					,qty as quantity
					,sum(qty) over (order by id asc) as saldo
					from r_c",
					'params'=>[':warelct'=>$formModel->warelct] 
					]);

			 $dataToRender['warelct'] = $formModel->warelct;

       		 $dataToRender['formModel'] = $formModel;

    // var_dump($dataProvider);

  		 	 return $this->render('reportsaldostockbarang', $dataToRender);
	 }

}