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
class AttendanceController extends Controller
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
     * Lists all HrAttendanceMinMaxLog models.
     * @return mixed
     */
    public function actionIndex()
    {

        $toRender = [];
        $toRender['searchModel'] = new HrAttendanceMinMaxLogSearch();
        $toRender['dataProvider'] = $toRender['searchModel']->search(Yii::$app->request->queryParams);
        // die('aaa');
        return $this->render('index', $toRender);
    }

    /**
     * Displays a single HrAttendanceMinMaxLog model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HrAttendanceMinMaxLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HrAttendanceMinMaxLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HrAttendanceMinMaxLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing HrAttendanceMinMaxLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HrAttendanceMinMaxLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HrAttendanceMinMaxLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HrAttendanceMinMaxLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionFirstAndLastScan($site=1792,$year=null,$month=null,$department=null){
        if(!$year){
            $year = date('Y');
        }
        if(!$month){
            $month = date('n');
        }

        $first = date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
        $last = date('Y-m-t', mktime(0, 0, 0, $month, 1, $year));

        $dataToRender = [];
        $where = [
            'employee'=>'%%',
            'department'=>'%%',
            'year'=>"%%",
            'month'=>'%%',
            'day'=>'%%'
        ];
        $dataToRender['attendanceLogForm'] = new \app\models\AttendanceLogForm;

        if($dataToRender['attendanceLogForm']->load(Yii::$app->request->post())){
            $where['employee'] = $dataToRender['attendanceLogForm']['employee'];
            $where['department'] = $dataToRender['attendanceLogForm']['department'];
            $where['year'] = $dataToRender['attendanceLogForm']['year'];
            $where['month'] = $dataToRender['attendanceLogForm']['month'];
            $where['day'] = $dataToRender['attendanceLogForm']['day'];

        }
        if($department == 'All Department' || $department == ''){
            $department = 'All Department';
            $department_query = '%%';
        }else{
            $department_query = $department;
        }
        
        $query = <<<query
SELECT 
    date_series.i
    , r_p.name work_site
    , h_emp.name_related employee
    --, att_log_min_max_pure.employee_id
    , (CASE WHEN att_log_min_max_pure.y IS NULL THEN date_series.year_series ELSE att_log_min_max_pure.y END) "year"
    , (CASE WHEN att_log_min_max_pure.m IS NULL THEN date_series.month_series ELSE att_log_min_max_pure.m END) "month"
    , (CASE WHEN att_log_min_max_pure.d IS NULL THEN date_series.day_series ELSE att_log_min_max_pure.d END) "day"
    , att_log_min_max_pure.min_hour AS "hour_1"
    , att_log_min_max_pure.min_minutes AS "minute_1"
    , (
        CASE 
            WHEN 
                att_log_min_max_pure.min_date_time_log = att_log_min_max_pure.max_date_time_log
            THEN
                NULL
            ELSE
                att_log_min_max_pure.max_hour
        END
        
    ) AS "hour_2"
    , (
        CASE 
            WHEN 
                att_log_min_max_pure.min_date_time_log = att_log_min_max_pure.max_date_time_log
            THEN
                NULL
            ELSE
                att_log_min_max_pure.max_minutes
        END
        
    ) AS "minute_2"
    
    
FROM
(
    SELECT
        att_log_grouped2.employee_id,
        att_log_grouped2.y,
        att_log_grouped2.m,
        att_log_grouped2.d,
        att_log_grouped2.min_date_time_log,
        att_log_grouped2.max_date_time_log
        , EXTRACT(HOUR FROM TO_TIMESTAMP(min_date_time_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as min_hour
        , EXTRACT(MINUTE FROM TO_TIMESTAMP(min_date_time_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as min_minutes
        
        , EXTRACT(HOUR FROM TO_TIMESTAMP(max_date_time_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as max_hour
        , EXTRACT(MINUTE FROM TO_TIMESTAMP(max_date_time_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as max_minutes
        
    FROM (
        SELECT 
            att_log_grouped.employee_id,
            att_log_grouped.y,
            att_log_grouped.m,
            att_log_grouped.d
            , MIN(att_log_grouped.datetime_log) as min_date_time_log
            , MAX(att_log_grouped.datetime_log) as max_date_time_log
            
        FROM
        (
            SELECT
                att_log.employee_id, att_log.att_pin
                , datetime_log
                , TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0' AS timestamp_log
                , EXTRACT(YEAR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as y
                , EXTRACT(MONTH FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as m
                , EXTRACT(DAY FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as d
                , EXTRACT(HOUR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as hours
                , EXTRACT(MINUTE FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as minutes
                
            FROM hr_attendance_log att_log
            -- WHERE h_emp.name_related ilike '%{$where['employee']}%'
            ) AS att_log_grouped
            GROUP BY
            att_log_grouped.employee_id, att_log_grouped.y, att_log_grouped.m, att_log_grouped.d
        ) AS att_log_grouped2
    ) AS att_log_min_max_pure

FULL JOIN
    (
        SELECT 
            date_series.*
            , EXTRACT(YEAR FROM i) as year_series
            , EXTRACT(MONTH FROM i) as month_series
            , EXTRACT(DAY FROM i) as day_series
            , eids.eid as emp_id
        FROM(
            SELECT i::DATE FROM generate_series('{$first}','{$last}', '1 day'::INTERVAL) AS i
        ) AS date_series
        JOIN (
            SELECT DISTINCT(employee_id) as eid, hrd.name as dept_name FROM hr_attendance_log hrl
            JOIN hr_employee hre ON hre.id = hrl.employee_id
            JOIN hr_department hrd ON hrd.id = hre.department_id
            JOIN resource_resource rs_rs ON hre.resource_id = rs_rs.id
            WHERE hrd.name like '$department_query'
                AND hre.address_id = {$site}
                AND rs_rs.active is True
        ) AS eids ON eids.eid > 0
        -- WHERE h_emp.eid ilike '%{$where['employee']}%'
        -- order by eids.eid asc, date_series.i asc
    ) AS date_series ON date_series.emp_id = att_log_min_max_pure.employee_id and date_series.year_series = att_log_min_max_pure.y and date_series.month_series = att_log_min_max_pure.m and date_series.day_series = att_log_min_max_pure.d
JOIN hr_employee AS h_emp ON h_emp.id = date_series.emp_id
LEFT JOIN res_partner r_p ON r_p.id = h_emp.address_id
ORDER BY h_emp.name_related ASC, date_series.i ASC, att_log_min_max_pure.y ASC, att_log_min_max_pure.m ASC, att_log_min_max_pure.d ASC
query;
        
        $connection = Yii::$app->db;
        $res = $connection->createCommand($query)->queryAll();
        
        $dataToRender['dataProvider'] = new \yii\data\ArrayDataProvider([
            'allModels'=>$res,
            'pagination'=>false

        ]);
        $dataToRender['year'] = $year;
        $dataToRender['month'] = $month;
        $dataToRender['department_active'] = $department;





        $site_active = \app\models\ResPartner::findOne($site);
        $dataToRender['site_active'] = $site_active;
        $dataToRender['sites'] = \app\models\ResPartner::find()->where(['id'=>[1792,2788,1417,5732]])->orderBy('name ASC')->asArray()->all();

        $depts = \app\models\HrDepartment::find()->select('name')->orderBy('name ASC');

        if($department){
            // $depts->where('name = :name',[':name'=>$department]);
        }
        $dataToRender['depts'] = $depts->asArray()->all();
        // var_dump($dataToRender['depts']);
        return $this->render('first_and_last_scan',$dataToRender);
    }
}
