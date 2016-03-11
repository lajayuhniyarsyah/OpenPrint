<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\db\QueryBuilder;
use yii\web\Controller;
use yii\helpers\Json;
use yii\db\Command;
use yii\db\Query;
use app\models\SalesActivityForm;
use app\models\WeeklyStatusForm;
use app\models\ContactForm;
use app\models\ResPartner;
use app\models\LoginForm;
use app\models\ResGroups;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionUserlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $query->select('id, login AS text')
                ->from('res_users')
                ->where(['like','login',$search])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ResGroups::find($id)->login];
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }


    public function actionPartnerlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {

            $query = new Query;
            $query->select('id, name AS text')
                ->from('res_partner')
                ->where(['like','name',$search])
                ->andWhere(['customer'=>true])
                ->andWhere(['is_company'=>true])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ResPartner::find($id)->name];
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }
    public function actionDashboard()
    {
        $this->layout = 'dashboard';
        return $this->render('dashboard');      
    }
    public function actionActivity()
    {   
        $model = new salesActivityForm();
        $model->load(Yii::$app->request->get());
        
        $activities = [];
        $this->layout = 'dashboard';
        $date=date("Y-m-d");
        $time=array('before','after');
        $day=date('w',strtotime($date));
        if($day=="1"){ $day="senin"; }else if($day=="2"){ $day="selasa"; }else if($day=="3"){ $day="rabu"; }else if($day=="4"){ $day="kamis"; }else if($day=="5"){ $day="jumat"; }else if($day=="6"){ $day="sabtu"; }

        $alldays=array('senin','selasa','rabu','kamis','jumat');
        $query = new Query;
        $actual= new Query;
        // Penyesuaian Data Form 
        if ($model->load(Yii::$app->request->get())) { 
            $alldays=array('senin','selasa','rabu','kamis','jumat');
            $from=date("Y-m-d", strtotime($model->from));
            $to=date("Y-m-d", strtotime($model->to));
            if($model->sales=="") // Jika Seluruh Sales
            {   
                $query
                    ->select('s.user_id as user, r.login, s.id as act_id, s.begin as begin, s.end as end')
                    ->from('sales_activity as s')
                    ->join('JOIN', 'res_users as r', 'r.id=s.user_id')
                    ->where(['>=','s.begin',$from])
                    ->andWhere(['<=','s.end',$to])
                    ->addOrderBy(['s.begin' => SORT_DESC]);
                
                $dataplan = [];
                $datactual = [];
            $unsetIdxs = [];
            foreach($query->all() as $idx=>$value):
                $apus = false;
                $activities[$idx] = [
                    'act_id'=>$value['act_id'],
                    'sales_name'=>$value['login'],
                    'date'=>$value['begin'],
                    'activities'=>[
                        'plan'=>[],
                        'actual'=>[],  
                    ],
                ];
                // Semua Sales Harus memilih Satu Customer (Jika Tidak Data yang ditampilkan terlalu banyak)
                $dataplan = [];
                    $plan= new Query;  
                    $actual = new Query;
                    foreach ($alldays as $day) {
                        $plan->from('before_plan_'.$day)
                             ->union('select * from after_plan_'.$day.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                             ->where(['activity_id'=>$value['act_id']])
                             ->andWhere(['partner_id'=>$model->customer]);
                        if (count($plan->all())) {
                            $activities[$idx]['activities']['plan'] = $plan->all();    
                        }
                        
                        $actual->from('before_actual_'.$day)
                            ->union('select * from after_actual_'.$day.' WHERE  partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                            ->where(['activity_id'=>$value['act_id']])
                            ->andWhere(['partner_id'=>$model->customer]);
                        if (count($actual->all())) {
                            $activities[$idx]['activities']['actual'] = $actual->all();
                            $apus = false;
                        }
                    }
                    
                $datactual[$value['user']] = [
                    'name'=>$value['login'],
                    'data'=>[]
                ];

            endforeach;
            }
            else{
                // Satu Sales 
                if($model->to==""){ // Satu Sales Dalam 1 Hari Saja
                    $datenow=date("Y-m-d", strtotime($model->from));
                    $day=date('w',strtotime($datenow));
                    if($day=="1"){ $days="senin"; }else if($day=="2"){ $days="selasa"; }else if($day=="3"){ $days="rabu"; }else if($day=="4"){ $days="kamis"; }else if($day=="5"){ $days="jumat"; }else if($day=="6"){ $days="sabtu"; }
                    $query
                        ->select('s.user_id as user, ru.login, s.id as act_id, s.begin as begin')
                        ->from('sales_activity as s')
                        ->join('JOIN', 'res_users as ru', 'ru.id=s.user_id')
                        ->where("begin = date_trunc('week', DATE '".$datenow."')")
                        ->andWhere(['s.user_id'=>$model->sales])
                        ->addOrderBy(['ru.login' => SORT_ASC]);
                    $dataplan = [];
                $datactual = [];

                foreach($query->all() as $idx=>$value):
                    $activities[$idx] = [
                        'act_id'=>$value['act_id'],
                        'sales_name'=>$value['login'],
                        'date'=>$model->from,
                        'activities'=>[
                            'plan'=>[],
                            'actual'=>[],  
                        ],
                    ];
         
                        $dataplan = [];
                        $plan= new Query;  
                        $actual = new Query;
                       
                        if($model->customer==""){
                            $plan->from('before_plan_'.$days)
                                ->union('select * from after_plan_'.$days.' WHERE activity_id='.$value['act_id'])
                                ->where(['activity_id'=>$value['act_id']]);
                            $actual->from('before_actual_'.$days)
                                ->union('select * from after_actual_'.$days.' WHERE activity_id='.$value['act_id'])
                                ->where(['activity_id'=>$value['act_id']]);   
                        }else{
                            $plan->from('before_plan_'.$days)
                                    ->union('select * from after_plan_'.$days.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                                    ->where(['activity_id'=>$value['act_id']])
                                    ->andWhere(['partner_id'=>$model->customer]);    
                            $actual->from('before_actual_'.$days)
                                    ->union('select * from after_actual_'.$days.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                                    ->where(['activity_id'=>$value['act_id']])
                                    ->andWhere(['partner_id'=>$model->customer]);
                        }
                        $activities[$idx]['activities']['plan'] = $plan->all();
                        $activities[$idx]['activities']['actual'] = $actual->all();

                endforeach;
                }else{
                    // Satu Sales Range Waktu From & To
                    $query
                        ->select('s.user_id as user, r.login, s.id as act_id, s.begin as begin, s.end as end')
                        ->from('sales_activity as s')
                        ->join('JOIN', 'res_users as r', 'r.id=s.user_id')
                        ->where(['>=','s.begin',$from])
                        ->andWhere(['<=','s.end',$to])
                        ->andWhere(['s.user_id'=>$model->sales])
                        ->addOrderBy(['s.begin' => SORT_DESC]);
                            
                    $dataplan = [];
                    $datactual = [];

                    foreach($query->all() as $idx=>$value):
                        $activities[$idx] = [
                            'act_id'=>$value['act_id'],
                            'sales_name'=>$value['login'],
                            'date'=>$value['begin'],
                            'activities'=>[
                                'plan'=>[],
                                'actual'=>[],  
                            ],
                        ];
             
                            $dataplan = [];
                            $plan= new Query;  
                            $actual = new Query;
                           
                            if($model->customer==""){ // satu Sales Seluruh Customer Dengan Range 
                                foreach ($alldays as $day) {
                                    $plan->from('before_plan_'.$day)
                                        ->union('select * from after_plan_'.$day.' WHERE activity_id='.$value['act_id'])
                                        ->where(['activity_id'=>$value['act_id']]);

                                    $actual->from('before_actual_'.$day)
                                        ->union('select * from after_actual_'.$day.' WHERE activity_id='.$value['act_id'])
                                        ->where(['activity_id'=>$value['act_id']]);
                                }
                                
                            }else{ // satu Sales satu Customer
                                foreach ($alldays as $day) {
                                    $plan->from('before_plan_'.$day)
                                            ->union('select * from after_plan_'.$day.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                                            ->where(['activity_id'=>$value['act_id']])
                                            ->andWhere(['partner_id'=>$model->customer]);    
                                    $actual->from('before_actual_'.$day)
                                            ->union('select * from after_actual_'.$day.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                                            ->where(['activity_id'=>$value['act_id']])
                                            ->andWhere(['partner_id'=>$model->customer]);
                                }
                            }
                            $activities[$idx]['activities']['plan'] = $plan->all();
                            $activities[$idx]['activities']['actual'] = $actual->all();
                    endforeach;
                }

            }
            // Jika sales & Customer Kosong, 1 Hari untuk Seluruh Sales (Tgl Activity Yang dipilih) 
            if($model->sales=="" && $model->customer==""){ 
                $datenow=date("Y-m-d", strtotime($model->from));
                $day=date('w',strtotime($datenow));
                if($day=="1"){ $days="senin"; }else if($day=="2"){ $days="selasa"; }else if($day=="3"){ $days="rabu"; }else if($day=="4"){ $days="kamis"; }else if($day=="5"){ $days="jumat"; }else if($day=="6"){ $days="sabtu"; }

                $query
                    ->select('s.user_id as user, ru.login, s.id as act_id')
                    ->from('sales_activity as s')
                    ->join('JOIN', 'res_users as ru', 'ru.id=s.user_id')
                    ->where("begin = date_trunc('week', DATE '".$datenow."')")
                    ->addOrderBy(['ru.login' => SORT_ASC]);

                $dataplan = [];
                $datactual = [];
                // Data Plan Activity
                foreach($query->all() as $idx=>$value):
                    $activities[$idx] = [
                        'act_id'=>$value['act_id'],
                        'sales_name'=>$value['login'],
                        'date'=>$datenow,
                        'activities'=>[
                            'plan'=>[],
                            'actual'=>[],  
                        ],
                    ];
         
                    $dataplan = [];
                        $plan= new Query;  
                        $actual = new Query;
                        $plan->from('before_plan_'.$days)->union('select * from after_plan_'.$days.' WHERE activity_id='.$value['act_id'])->where(['activity_id'=>$value['act_id']]);
                        $activities[$idx]['activities']['plan'] = $plan->all();
                        $actual->from('before_actual_'.$days)->union('select * from after_actual_'.$days.' WHERE activity_id='.$value['act_id'])->where(['activity_id'=>$value['act_id']]);
                        $activities[$idx]['activities']['actual']= $actual->all();

                    $datactual[$value['user']] = [
                        'name'=>$value['login'],
                        'data'=>[]
                    ];

                endforeach;
            }
            return $this->render('/report-sales/activityform',['activities'=>$activities,'model'=>$model]);

        }else{

            $query
                ->select('s.user_id as user, r.login, s.id as act_id')
                ->from('sales_activity as s')
                ->join('JOIN', 'res_users as r', 'r.id=s.user_id')
                ->where("begin = date_trunc('week', DATE '".$date."')")
                ->addOrderBy(['r.login' => SORT_ASC]);

            $dataplan = [];
            $datactual = [];
            // Data Plan Activity
            foreach($query->all() as $idx=>$value):
                $activities[$idx] = [
                    'act_id'=>$value['act_id'],
                    'sales_name'=>$value['login'],
                    'date'=>$date,
                    'activities'=>[
                        'plan'=>[],
                        'actual'=>[],  
                    ],
                ];
     
                $dataplan = [];
                    $plan= new Query;  
                    $actual = new Query;
                    $plan->from('before_plan_'.$day)->union('select * from after_plan_'.$day.' WHERE activity_id='.$value['act_id'])->where(['activity_id'=>$value['act_id']]);
                    $activities[$idx]['activities']['plan'] = $plan->all();

                    $actual->from('before_actual_'.$day)->union('select * from after_actual_'.$day.' WHERE activity_id='.$value['act_id'])->where(['activity_id'=>$value['act_id']]);
                    $activities[$idx]['activities']['actual']= $actual->all();

            endforeach;
            return $this->render('/report-sales/activityform',['activities'=>$activities,'model'=>$model]);

        }
    }


    public function actionWeeklystatus()
    {
       $this->layout = 'dashboard';
       $model = new weeklyStatusForm();
       $model->load(Yii::$app->request->get());
       $activities = [];

       if ($model->load(Yii::$app->request->get())) {
            $weekstatus= new Query;

            if($model->sales=="" && $model->productgroup=="all" && $model->customer==""){ 
                // Seluruh Sales & Seluruh Product & Seluruh Customer 1 Status
                $weekstatus
                    ->select('ws.user_id as user_id, ws.type as type, ws.id as id')
                    ->from('week_status as ws');

                $data = $weekstatus->all();
                foreach($data as $idx=>$value):
                    $activities[$idx] = [
                        'sales_name'=>$value['user_id'],
                        'liststatus'=>[
                            'project'=>[],
                        ],
                    ];

                    $weekstatusline= new Query;
                    $weekstatusline
                        ->select('
                                rp.name as customer, 
                                so.name as sales_order,
                                ws.product_group as productgorup,
                                ws.project as project,
                                rc.name as currency,
                                ws.amount as total,
                                ws.status as status,
                                ws.state as state,
                                r.id as iduser
                                ')
                        ->from('week_status_line as ws')
                        ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                        ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                        ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                        ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                        ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                        ->where(['ws.state'=>$model->status])
                        ->andWhere(['ws.status_id'=>$value['id']])
                        ->addOrderBy(['ws.create_date' => SORT_DESC]);

                    $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                endforeach;

            }else if ($model->customer=="" && $model->sales=="" && $model->status=="all") {
                // Jika Customer All & Sales Semua & Status Semua & 1 Product 
                $weekstatus
                    ->select('ws.user_id as user_id, ws.type as type, ws.id as id')
                    ->from('week_status as ws');

                $data = $weekstatus->all();
                foreach($data as $idx=>$value):
                    $activities[$idx] = [
                        'sales_name'=>$value['user_id'],
                        'liststatus'=>[
                            'project'=>[],
                        ],
                    ];

                    $weekstatusline= new Query;
                    $weekstatusline
                        ->select('
                                rp.name as customer, 
                                so.name as sales_order,
                                ws.product_group as productgorup,
                                ws.project as project,
                                rc.name as currency,
                                ws.amount as total,
                                ws.status as status,
                                ws.state as state,
                                r.id as iduser
                                ')
                        ->from('week_status_line as ws')
                        ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                        ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                        ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                        ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                        ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                        ->where(['ws.product_group'=>$model->productgroup])
                        ->andWhere(['ws.status_id'=>$value['id']])
                        ->addOrderBy(['ws.create_date' => SORT_DESC]);

                    $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                endforeach;
            }else if($model->sales){ // Pilih satu Sales
               
                $weekstatus // Query Filter 1 Sales
                    ->select('ws.user_id as user_id, ws.type as type, ws.id as id')
                    ->from('week_status as ws')
                    ->where(['ws.user_id'=>$model->sales]);
                    
                $data = $weekstatus->all();

                    foreach($data as $idx=>$value):
                        $activities[$idx] = [
                            'sales_name'=>$value['user_id'],
                            'liststatus'=>[
                                'project'=>[],
                            ],
                        ];
                        
                        $weekstatusline= new Query;
                        if($model->customer){ 
                            if($model->status){ 
                                
                                if($model->productgorup){ 
                                    // Satu Sales & Satu Customer & Satu Status & Satu Product 
                                    $weekstatusline
                                        ->select('
                                                rp.name as customer, 
                                                so.name as sales_order,
                                                ws.product_group as productgorup,
                                                ws.project as project,
                                                rc.name as currency,
                                                ws.amount as total,
                                                ws.status as status,
                                                ws.state as state,
                                                r.id as iduser
                                                ')
                                        ->from('week_status_line as ws')
                                        ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                        ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                        ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                        ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                        ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                        ->where(['ws.status_id'=>$value['id']])
                                        ->andWhere(['ws.name'=>$model->customer])
                                        ->andWhere(['ws.product_group'=>$model->productgorup])
                                        ->andWhere(['ws.state'=>$model->status])
                                        ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                        $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                                }else{
                                    // Satu Sales & Satu Customer & Satu Status & Seluruh  Product 
                                    $weekstatusline
                                        ->select('
                                                rp.name as customer, 
                                                so.name as sales_order,
                                                ws.product_group as productgorup,
                                                ws.project as project,
                                                rc.name as currency,
                                                ws.amount as total,
                                                ws.status as status,
                                                ws.state as state,
                                                r.id as iduser
                                                ')
                                        ->from('week_status_line as ws')
                                        ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                        ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                        ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                        ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                        ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                        ->where(['ws.status_id'=>$value['id']])
                                        ->andWhere(['ws.name'=>$model->customer])
                                        ->andWhere(['ws.state'=>$model->status])
                                        ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                        $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                                }
                                

                            }else if($model->productgorup){ 
                                if($model->status){
                                     // Satu Sales & Satu Customer & Satu product & Satu Status
                                    $weekstatusline
                                        ->select('
                                                rp.name as customer, 
                                                so.name as sales_order,
                                                ws.product_group as productgorup,
                                                ws.project as project,
                                                rc.name as currency,
                                                ws.amount as total,
                                                ws.status as status,
                                                ws.state as state,
                                                r.id as iduser
                                                ')
                                        ->from('week_status_line as ws')
                                        ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                        ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                        ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                        ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                        ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                        ->where(['ws.status_id'=>$value['id']])
                                        ->andWhere(['ws.name'=>$model->customer])
                                        ->andWhere(['ws.state'=>$model->status])
                                        ->andWhere(['ws.product_group'=>$model->productgorup])
                                        ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                        $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                                }else{
                                    // Satu Sales & Satu Customer & Satu product & All Status
                                    $weekstatusline
                                        ->select('
                                                rp.name as customer, 
                                                so.name as sales_order,
                                                ws.product_group as productgorup,
                                                ws.project as project,
                                                rc.name as currency,
                                                ws.amount as total,
                                                ws.status as status,
                                                ws.state as state,
                                                r.id as iduser
                                                ')
                                        ->from('week_status_line as ws')
                                        ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                        ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                        ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                        ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                        ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                        ->where(['ws.status_id'=>$value['id']])
                                        ->andWhere(['ws.name'=>$model->customer])
                                        ->andWhere(['ws.product_group'=>$model->productgorup])
                                        ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                        $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                                }
                                

                            }else if($model->status=="all" && $model->productgorup=="all"){ 
                                    // Satu Sales & Satu Customer & Seluruh Product & Seluruh Status
                                $weekstatusline
                                    ->select('
                                            rp.name as customer, 
                                            so.name as sales_order,
                                            ws.product_group as productgorup,
                                            ws.project as project,
                                            rc.name as currency,
                                            ws.amount as total,
                                            ws.status as status,
                                            ws.state as state,
                                            r.id as iduser
                                            ')
                                    ->from('week_status_line as ws')
                                    ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                    ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                    ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                    ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                    ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                    ->where(['ws.status_id'=>$value['id']])
                                    ->andWhere(['ws.name'=>$model->customer])
                                    ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                    $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                            }
                        }else{
                            // Satu Sales All Customer 

                            $weekstatus // Query Filter 1 Sales
                                ->select('ws.user_id as user_id, ws.type as type, ws.id as id')
                                ->from('week_status as ws')
                                ->where(['ws.user_id'=>$model->sales]);
                                
                                $data = $weekstatus->all();

                                foreach($data as $idx=>$value):
                                    $activities[$idx] = [
                                        'sales_name'=>$value['user_id'],
                                        'liststatus'=>[
                                            'project'=>[],
                                        ],
                                    ];

                                    $weekstatusline= new Query;
                                    if($model->status!="all"){
                                        $weekstatusline
                                            ->select('
                                                    rp.name as customer, 
                                                    so.name as sales_order,
                                                    ws.product_group as productgorup,
                                                    ws.project as project,
                                                    rc.name as currency,
                                                    ws.amount as total,
                                                    ws.status as status,
                                                    ws.state as state,
                                                    r.id as iduser
                                                    ')
                                            ->from('week_status_line as ws')
                                            ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                            ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                            ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                            ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                            ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                            ->where(['ws.status_id'=>$value['id']])
                                            ->andWhere(['ws.state'=>$model->status])
                                            ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                            $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                                    }else if($model->productgroup!="all"){
                                        $weekstatusline
                                            ->select('
                                                    rp.name as customer, 
                                                    so.name as sales_order,
                                                    ws.product_group as productgorup,
                                                    ws.project as project,
                                                    rc.name as currency,
                                                    ws.amount as total,
                                                    ws.status as status,
                                                    ws.state as state,
                                                    r.id as iduser
                                                    ')
                                            ->from('week_status_line as ws')
                                            ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                            ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                            ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                            ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                            ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                            ->where(['ws.status_id'=>$value['id']])
                                            ->andWhere(['ws.product_group'=>$model->productgorup])
                                            ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                            $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                                    }else if($model->customer=="" && $model->productgroup=="all" && $model->status=="all"){
                                        
                                        $weekstatusline
                                            ->select('
                                                    rp.name as customer, 
                                                    so.name as sales_order,
                                                    ws.product_group as productgorup,
                                                    ws.project as project,
                                                    rc.name as currency,
                                                    ws.amount as total,
                                                    ws.status as status,
                                                    ws.state as state,
                                                    r.id as iduser
                                                    ')
                                            ->from('week_status_line as ws')
                                            ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                                            ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                                            ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                                            ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                                            ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                                            ->where(['ws.status_id'=>$value['id']])
                                            ->addOrderBy(['ws.create_date' => SORT_DESC]);

                                            $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                                    }
                                endforeach;
                        }
                        
                    endforeach;
            }
            else if($model->customer){ 
                    // Satu Customer
                    if($model->sales==""){
                         $weekstatus // Query Filter 1 Sales
                            ->select('ws.user_id as user_id, ws.type as type, ws.id as id')
                            ->from('week_status as ws');
                        $data = $weekstatus->all();

                        foreach($data as $idx=>$value):
                            $activities[$idx] = [
                                'sales_name'=>$value['user_id'],
                                'liststatus'=>[
                                    'project'=>[],
                                ],
                            ];

                        $weekstatusline= new Query;

                        $weekstatusline
                            ->select('
                                    rp.name as customer, 
                                    so.name as sales_order,
                                    ws.product_group as productgorup,
                                    ws.project as project,
                                    rc.name as currency,
                                    ws.amount as total,
                                    ws.status as status,
                                    ws.state as state,
                                    r.id as iduser
                                    ')
                            ->from('week_status_line as ws')
                            ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                            ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                            ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                            ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                            ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                            ->where(['ws.status_id'=>$value['id']])
                            ->andWhere(['ws.name'=>$model->customer])
                            ->addOrderBy(['ws.create_date' => SORT_DESC]);

                            $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                        endforeach;
                    }
                
            }
            return $this->render('/report-sales/weeklystatus',['model'=>$model,'data' =>$activities]);
       }else{
            $weekstatus= new Query;
            $weekstatus
                ->select('ws.user_id as user_id, ws.type as type, ws.id as id')
                ->from('week_status as ws');

                $data = $weekstatus->all();
                foreach($data as $idx=>$value):
                    $activities[$idx] = [
                        'sales_name'=>$value['user_id'],
                        'liststatus'=>[
                            'project'=>[],
                        ],
                    ];

                    $weekstatusline= new Query;
                    $weekstatusline
                        ->select('
                                rp.name as customer, 
                                so.name as sales_order,
                                ws.product_group as productgorup,
                                ws.project as project,
                                rc.name as currency,
                                ws.amount as total,
                                ws.status as status,
                                ws.state as state,
                                r.id as iduser
                                ')
                        ->from('week_status_line as ws')
                        ->join('LEFT JOIN','res_partner as rp','rp.id=ws.name')
                        ->join('LEFT JOIN','sale_order as so','so.id=ws.order_id')
                        ->join('LEFT JOIN','res_currency as rc','rc.id = ws.currency_id')
                        ->join('LEFT JOIN','week_status as wst','wst.id = ws.status_id')
                        ->join('JOIN', 'res_users as r', 'r.id=wst.user_id')
                        ->where(['ws.state'=>'nego'])
                        ->andWhere(['ws.status_id'=>$value['id']])
                        ->addOrderBy(['ws.create_date' => SORT_DESC]);
                    
                    $activities[$idx]['liststatus']['project']= $weekstatusline->all();
                endforeach;
            return $this->render('/report-sales/weeklystatus',['model'=>$model,'data' =>$activities]);
       }
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTes(){
        
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

     public function actionRecordBulan(){

        $dataToRender = [];
        $formModel = new \app\models\ReportYearSummaryProductSalesByCategoryForm;
        
        $param = Yii::$app->request->get();
        
        
        if($formModel->load($param)){

        }

        $dataToRender['dataProvider'] = new \yii\data\SqlDataProvider([
            'sql'=>"select 
            kategori
            ,sum(case when doc_month = 1 then total_idr else 0 end) as januari
            ,sum(case when doc_month = 2 then total_idr else 0 end) as februari
            ,sum(case when doc_month = 3 then total_idr else 0 end) as maret
            ,sum(case when doc_month = 4 then total_idr else 0 end) as april
            ,sum(case when doc_month = 5 then total_idr else 0 end) as mei
            ,sum(case when doc_month = 6 then total_idr else 0 end) as juni
            ,sum(case when doc_month = 7 then total_idr else 0 end) as juli
            ,sum(case when doc_month = 8 then total_idr else 0 end) as agustus
            ,sum(case when doc_month = 9 then total_idr else 0 end) as september
            ,sum(case when doc_month = 10 then total_idr else 0 end) as oktober
            ,sum(case when doc_month = 11 then total_idr else 0 end) as november
            ,sum(case when doc_month = 12 then total_idr else 0 end) as desember
            from
            (SELECT
                    so.name as No_So 
                    ,so.date_order
                    , EXTRACT(MONTH FROM date_order) as doc_month
                    , sol.name as product
                    ,prod_cat.name as kategori
                    , sol.product_uom_qty as qty
                    , sol.product_uom as Uom
                    , rc.name as currency
                    , sol.price_unit as price_unit
                    , (sol.price_unit * sol.product_uom_qty) AS total
                    ,(
                        select rating from res_currency_rate where currency_id = rc.id and name<=so.date_order order by name desc limit 1
                        
                    ) as Kurs
                    
                    ,((sol.price_unit * sol.product_uom_qty) * (select rating from res_currency_rate where currency_id = rc.id and name<=so.date_order order by name desc limit 1)) as total_idr
                    
                FROM sale_order_line AS sol
                JOIN sale_order so ON so.id = sol.order_id
                join product_product prod on prod.id = sol.product_id
                join product_template prod_tem on prod_tem.id = prod.product_tmpl_id
                join product_category prod_cat on prod_cat.id = prod_tem.categ_id
                JOIN product_pricelist as ppr ON ppr.id = so.pricelist_id
                JOIN res_currency AS rc ON rc.id = ppr.currency_id
                
                WHERE 
                    so.state not in ('cancel', 'draft')
                    AND
                    EXTRACT(YEAR FROM so.date_order) = :year)
                    as so_line 
                    group by kategori order by kategori",
            'params'=>[':year'=>$formModel->year]
        ]);
        // var_dump($sqlDp);

        $models = $dataToRender['dataProvider']->getModels();
        // var_dump($models);

        $series = [];

        foreach ($models as $key => $value) {
            // var_dump($value);
            $series[] = [
                'name'=>$value['kategori'],
                'data'=>[
                    floatval($value['januari'])
                    ,floatval($value['februari'])
                    ,floatval($value['maret'])
                    ,floatval($value['april'])
                    ,floatval($value['mei'])
                    ,floatval($value['juni'])
                    ,floatval($value['juli'])
                    ,floatval($value['agustus'])
                    ,floatval($value['september'])
                    ,floatval($value['oktober'])
                    ,floatval($value['november'])
                    ,floatval($value['desember'])
                ]          
            ];
        }
        // $kategori = array_values($kategori);

        $dataToRender['year'] = $formModel->year;
        $dataToRender['formModel'] = $formModel;
        $dataToRender['series'] = $series;

    // var_dump($dataProvider);

    return $this->render('record_bulan', $dataToRender);
    }
}
