<?php

namespace app\controllers;

use Yii;
use app\models\PurchaseOrder;
use app\models\PurchaseOrderLine;
use app\models\PurchaseOrderSearch;
use app\models\ProductSaleReportForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

use yii\grid\GridView;

use app\models\SaleOrder;
use app\models\SaleOrderSearch;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\SaleOrderLine;
use app\models\ProductProduct;

use app\models\SaleAnnualReportForm;
use app\models\ResGroups;
use app\models\ResGroupsUsersRel;
use app\models\GroupSales;
use app\models\GroupSalesLine;
use app\models\ProductCategory;
use app\models\ProductPricelist;
use kartik\mpdf\Pdf;
/**
 * PurchaseOrderController implements the CRUD actions for PurchaseOrder model.
 */
class PurchaseOrderController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PurchaseOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPrintpo($id){
        $this->layout = 'printout';
        $model = $this->findModel($id);
        return $this->render('print/printpo',['model'=>$model]);
    }

    public function actionPrintpoimport($id){
        $this->layout = 'printout';
        $model = $this->findModel($id);
        return $this->render('print/printpoimport',['model'=>$model]);
    }

    public function actionPrintpdf($id) {
    	$model = $this->findModel($id);
$css='
	#pageContainer{
		width: 198mm;
		margin-left: auto; margin-right: auto;
		position:absolute;
    	z-index:9999;
	}
	#background{
	    background: none !important;
	    display: block;
	    margin-left: 235px;
	    margin-top: 332px;
	    position: absolute;
	    z-index: 0;
	}
	#background_approved{
	    background: none !important;
	    display: block;
	    margin-left: 142px;
   		margin-top: 399px;
	    position: absolute;
	    z-index: 0;
	}
	#bg-text
	{
	    color:lightgrey;
	    background: none !important;
	    font-size:60px;
	    opacity: 0.2;
	    color: BLACK;
	    letter-spacing: 30px;
	    transform:rotate(316deg);
	    -webkit-transform:rotate(316deg);
	}
	.contener{
		border: 1px solid black;
		margin-left: auto; margin-right: auto;
	}
	.header{
		height: 10%;
	}
	.content{
		height: 80%;
	}

	.hideprint{
		display: none;
	}
	.pages{
		padding-top:5mm;
		padding-left:4mm;
	}
	.logo{
		margin-top: 0px;
		float: left;
	}
	.logo img{
		margin-top:0px;
		margin-left: 10px;
		display: block;
	}
	.judul{
		font-size: 27px;
		margin-top: -35px;
		margin-left: 15px;
		font-weight: bold;
		float: center;
		letter-spacing: 1px;
		margin-right: 3em;
		text-align: center;
	}
	.iso{
		margin-top:10px;
		float: right;
		width: 50mm;
	}
	.noborder{
		border-left: none !important;
	}
	.do{
		font-size: 22px;
		font-weight: bold;
		margin-left: 15px;
		margin-top: 10px;
		float: left;
	}
	.yth{
		display: block;
		float: left;
		font-size: 12px;
		margin-left: 15px;
		width: 98%;
		line-height: 17px;
	}
	.customer{
		float: right;
		width: 40%;
		display: block;
		margin-right: 10px;
		margin-top: -23px;
	}
	fieldset{
		width: 271px;
		height: 95px;
		display: block;
	    margin-left: 2px;
	    margin-right: 2px;
	    margin-top:5px;
	    border: none;
	    background-size: 350px;
	}
	.headtable{
		border: 1px black solid;
		margin-left: 15px;
		margin-top: 5px;
		margin-bottom: 10px;
		margin-right: 1px;
	}		
	.isicus{
		display: block;
		font-size: 12px;
		margin-left: 10px;
		margin-top: 22px;
	}
	.content{
		margin-left: 15px;
		margin-top: 15px;
		 margin-right:20px;
	}
	.content table .headtable{
		border-collapse: collapse
	}
	.headtablepages tr th{
		border: 1px solid black;
		font-size: 15px;
		line-height: 15px;
		text-align: center;
	}
	.content tr td{
		border: 1px solid black;
	}
	.tablefooter{
		float:left; width:100%; border-left:1px solid black; border-right:1px solid black; height:185px;
		border-bottom:1px solid black;
		clear: both;
	}
	.tablefooter td{
		border: medium none !important;
		font-size: 16px;
		padding-left: 10px;
		line-height: 19px;
	}
	.isigudang{
		margin-top:35px;
		margin-left: 40px;
		text-align: left;
		font-weight: bold;
	}
	.gudang{
		margin-left: 40px;
		border: none;
	}
	.gudang td{
		line-height: 30px;
		border: none !important;
		font-size: 12px;

	}
	.data{
		position: absolute;
		border-collapse: collapse;
		border: none !important; 
		max-height: 300px;
	}
	.data td{
		border: none !important; 
		font-size: 18px;

	}
	.tablecontent{
		font-size: 18px;
	}
	@media all {
		.page-break	{ display: none; }
	}
	@media print {
		.break{
			height:1mm !important;
		}
		.tglkirim{
			width: 203px !important;
		}
		#background{
			background-color: none !important;
			background:transparent !important;
		}

	}
	.pages{
		height: 245mm;
		padding-left:4mm;
	}
	.contentLines{
		border-collapse: collapse;
		margin-left: 15px;
		width: 186mm;
		margin-top: -9px;
		border-bottom:  1px solid black;
	}
	.contentLines tbody tr td {
		border-left:  1px solid black;
		border-right:  1px solid black;
		border-collapse: collapse;
		line-height: 20px;
		font-size: 16px;
		vertical-align: top;
	}
	.lineTable{
		border: 1px solid black;
	}
	.leftdata{
		float: left;
		width: 75%;
		margin-left: 10px;
	}
	.rightdata{
		width: 18%;
		float: right;
		margin-right: 10px;
		text-align: right;
	}
	.tglkirim{
		width: 203px;
	}
	.break{
		height:100mm;
	}
	.tablettd{
		width:98%; float:left;  margin-left: 15px;margin-top: -9px;
	}
	.tblkirim{
		border-collapse: collapse;
		float: left;
		font-size: 12px;
		line-height: 30px;
		margin-left: 15px;
		margin-top: -1px;
	}
	.dataiso{
		text-align: center;
		width: 100px;
		float: left;
		font-size: 9px;
		margin-left: 17px;
	}
	.rigthheadtable{
		float: right;
		width: 338px;
	}
	.leftheadtable{
		float: left;
		width: 359px;
		border-right: 1px solid black;
	}
	.cus{
		font-size: 22px;
		font-weight: bold;
	}
	.almt{
		font-size: 15px;
	}
    .space{
        line-height: 25px;
    }
	.dtlcus{
		font-size: 14px;
        margin-top: -15px;
		margin-left: 5px;
	}
	.total{
		 width:186mm; border:1px solid black; border-collapse: collapse; margin-left:15px;margin-top:-9px;
	}
	.total td{
		border:1px solid black;
		font-size: 16px;
	}

';
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'content' => $this->renderPartial('print/printpopdf',['model'=>$model]),
            // 'cssFile' => '@web/css/printpopdf.css',
            'cssInline' => $css,
            'options' => [
                'title' => 'Privacy Policy - Krajee.com',
                'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
            ],
            'methods' => [
                'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
                'SetFooter' => ['|Page {PAGENO}|'],
            ]
        ]);
        return $pdf->render();
    }

    public function actionSupplierlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $command = new Query;
            $lowerchr=strtolower($search);
            $command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM res_partner WHERE lower(name) LIKE '%".$lowerchr."%' AND supplier=true AND is_company=true LIMIT 20");
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }

        elseif ($id > 0) {

            $ids=explode(',', $id);
            foreach ($ids as $value) {
                $data[] = ['id' => $value, 'text' => ResPartner::find()->where(['id' => $value])->one()->name];
            }

            $out['results'] = $data;
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }

        echo \yii\helpers\Json::encode($out);
    }


    public function actionProductlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $lowerchr=strtolower($search);
            $command = Yii::$app->db->createCommand("SELECT DISTINCT id, '[' || default_code || '] ' || name_template as text FROM product_product WHERE lower(name_template) LIKE '%".$lowerchr."%' OR lower(default_code) LIKE '%".$lowerchr."%' LIMIT 20");
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {

            $ids=explode(',', $id);
            foreach ($ids as $value) {
                $data[] = ['id' => $value, 'text' => '['.ProductProduct::find()->where(['id' => $value])->one()->default_code.'] '.ProductProduct::find()->where(['id' => $value])->one()->name_template];
            }
            
            $out['results'] = $data;
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }

    public function actionPurchasereport($groupBy=null)
    {
        $connection = \Yii::$app->db;
        $this->layout = 'dashboard';
        $query = new Query;
        $model = new PurchaseOrder();
        $modelLine = new PurchaseOrderLine();
        $model->load(Yii::$app->request->get());
        $modelLine->load(Yii::$app->request->get());
        $submited = false;

        $query = $this->getPOLineRelatedQuery($model,$modelLine,$groupBy);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key'=>'id',
            'pagination' => [
                'pageSize' => 500,
            ],
        ]);


        if($groupBy){
            return $this->render('purchasereport_form', ['type'=>'search','model'=>$model,'modelline'=>$modelLine,'dataProvider'=>$dataProvider,'groupBy'=>$groupBy]);
        }else{
            return $this->render('purchasereport_form', ['type'=>'search','model'=>$model,'modelline'=>$modelLine,'dataProvider'=>$dataProvider,'groupBy'=>'nogroup']);      
        }
    }

    public function getPOLineRelatedQuery($params = [], $modelline = [], $groupBy = null)
    {

        $query = new Query;
        if($params['partner_id']){
            $partner_id=$params['partner_id'];    
        }else{
            $partner_id='0';   
        }
        if($modelline){
            if($modelline['product_id']){
                $product=$modelline['product_id'];
            }else{
                $product='0';
            }    
        }else{
            $product=$params['product_id'];
        }
        if($params['state']){
            $state=$params['state'];
        }else{
            $state='0';
        }

        if($params['date_order']){
            $dattefrom=$params['date_order'];
            $dateto=$params['duedate'];
        }else{
            $dattefrom='0';
            $dateto='0';
        }
        // if($params['pricelist']){
        //     if(is_array($params['pricelist'])){
        //         $pricelist=implode(",", $params['pricelist']);  
        //     }else{
        //         $pricelist=$params['pricelist'];
        //     }
            
        // }else{
        //     $pricelist='0';
        // }

        if($groupBy){
            if(is_array($params['pricelist'])){
                $pricelist=implode(",", $params['pricelist']);  
            }else{
                $pricelist=$params['pricelist'];
            }
        }
        if($groupBy){

            if($groupBy=='partner'){
                $query->select(['CONCAT("pol"."partner_id", \'/\',"pid"."id",\'/\',\''.$product.'\',\'/\',\''.$state.'\',\'/\',\''.$dattefrom.'\',\'/\',\''.$dateto.'\') as id,
                    rp.name as partner,
                    SUM(pol.price_unit*pol.product_qty) as total,
                    pid.name as pricelist']);
            }
        }else{
            $query
                ->select ('
                            pol.id as id,
                            pol.partner_id as partner_id,
                            po.date_order as date_order,
                            po.name as no_po,
                            pol.name as pol_desc,
                            rp.name as partner,
                            pol.product_id as product_id,
                            pp.name_template as product,
                            pp.default_code as product_code,
                            pol.price_unit as price_unit,
                            pol.state as state,
                            pol.product_qty as product_qty,
                            pu.name as uom,
                            pid.name as pricelist,
                            (pol.product_qty*pol.price_unit) as total,
                        ');
            }
        $query->from('purchase_order_line as pol')
                ->join('LEFT JOIN','purchase_order as po','po.id=pol.order_id')
                ->join('LEFT JOIN','product_pricelist as pid','pid.id=po.pricelist_id')
                ->join('LEFT JOIN','product_product as pp','pp.id=pol.product_id')
                ->join('LEFT JOIN', 'product_uom as pu','pu.id=pol.product_uom')
                ->join('LEFT JOIN','res_partner as rp','rp.id=pol.partner_id');

        if($groupBy){
            if($groupBy=='partner'){
                $query->groupBy(['pol.partner_id','rp.name', 'pid.id']);
                $query->orderBy('rp.name ASC');
            }
        }

        if(isset($params['partner_id']) && $params['partner_id']){
            if($params['partner_id']!='0')
                {
                    /*var_dump($params['partner_id']);
                    die();*/
                    $query->andWhere(['pol.partner_id'=>$params['partner_id']]);
                    // $query->andWhere(['pol.partner_id'=>1996]);
                }
        }

        if(isset($modelline['name']) && $modelline['name']){
            
                
            $query->andWhere(['ilike','pol.name',$modelline['name']]); 
            // die();
                
        }
       if(isset($modelline['product_id']) && $modelline['product_id']){
                if($modelline['product_id']!='0')
                    {
                        //var_dump($modelline['product_id']);
                        // die();
                        $query->andWhere(['pol.product_id'=>$modelline['product_id']]);
                        // $query->andWhere(['pol.product_id'=>879]);
                    }
            }

        if(isset($params['state']) && $params['state']){
            
            if ($params['state']=="purchased"){
                $cekstate = 'confirmed, approved, done';
                if($params['state']!='0')
                {
                    $query->andWhere(['pol.state'=>explode(',', $cekstate)]); 
                }

            }else{
                if($params['state']!='0')
                {
                    $to_state = [];

                    $exps = explode(',',urldecode($params['state']));

                    foreach($exps as $exp){
                        if($exp=='purchased'){
                            $to_state[] = 'confirmed';
                            $to_state[] = 'approved';
                            $to_state[] = 'done';
                        }else{
                            $to_state[] = $exp;
                        }
                        
                    }
                    $query->andWhere(['pol.state'=>$to_state]); 
                }
            }
            

        }else{
            $query->andWhere(['in', 'pol.state', ['confirmed', 'approved', 'done']]); 
        }


        if(isset($params['date_order']) && $params['date_order']){
            if($params['date_order']!='0')
                {

                    $query->andWhere(['>=','po.date_order',$params['date_order']]);
                    $query->andWhere(['<=','po.date_order',$params['duedate']]);
                }
        }
        if (isset($params['pricelist'])){
            $query->andWhere(['po.pricelist_id'=>$params['pricelist']]);  
        }

        if(!$groupBy){
            $query->addOrderBy(['po.date_order' => SORT_DESC]);    
        }
        return $query;
    }


    public function actionDetailPurchase($expandRowKey=null) {
        $this->layout = 'dashboard';
        if(isset($_POST['expandRowKey'])) $expandRowKey = $_POST['expandRowKey'];
        if ($expandRowKey) {

            $exp = explode('/', $expandRowKey);
            $partner_id = (int)$exp[0];
            $pricelist = $exp[1];
            $product_id = $exp[2];
            $state = $exp[3];
            $date_order=$exp[4];
            $dateto=$exp[5];
            $query = $this->getPOLineRelatedQuery([
                                        'partner_id'=>$partner_id,
                                        'pricelist'=>$pricelist,
                                        'state'=>$state,
                                        'date_order'=>$date_order,
                                        'duedate'=>$dateto,
                                        ], 
                                        [
                                        'product_id'=>$product_id
                                        ]);
            
            $dataProvider = new ArrayDataProvider([
                'allModels'=>$query->all(),
                'key'=>'id',
                'pagination'=>[
                    'params'=>array_merge($_GET,['expandRowKey'=>$expandRowKey,]),
                    'pageSize' => 100,
                ]
                
            ]);
            return $this->renderPartial('_ajax_grid_detail',['dataProvider'=>$dataProvider,'pricelist'=>$pricelist]);
        }
        else
        {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

    /**
     * Displays a single PurchaseOrder model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PurchaseOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurchaseOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PurchaseOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PurchaseOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PurchaseOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
