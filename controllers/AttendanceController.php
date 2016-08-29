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
        $dataToRender['sites'] = \app\models\ResPartner::find()->where(['id'=>[1792,2788,1417,5732,6332]])->orderBy('name ASC')->asArray()->all();
        $depts = \app\models\HrDepartment::find()->select('name')->orderBy('name ASC');
        if($department){
            // $depts->where('name = :name',[':name'=>$department]);
        }
        $dataToRender['depts'] = $depts->asArray()->all();
        // var_dump($dataToRender['depts']);
        return $this->render('first_and_last_scan',$dataToRender);
    }


    public function actionFirstAndLastScanSite($site=6332,$year=null,$month=null,$department=null){
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
        $dbTarget = "LIVE_2014";
        $ipTarget = Yii::$app->request->serverName.':10001';

        $query = <<<query
    SELECT 
        date_series.i
        , r_p.name work_site
        , h_emp.name_related employee
        , (
            CASE 
                WHEN 
                    att_log_min_max_pure.y IS NULL 
                THEN 
                    date_series.year_series 
                ELSE 
                    att_log_min_max_pure.y 
            END
          ) "year"
        , (
            CASE 
                WHEN 
                    att_log_min_max_pure.m IS NULL 
                THEN 
                    date_series.month_series 
                ELSE 
                    att_log_min_max_pure.m 
            END
          ) "month"
        , (
            CASE 
                WHEN 
                    att_log_min_max_pure.d IS NULL 
                THEN 
                    date_series.day_series 
                ELSE 
                    att_log_min_max_pure.d 
            END
           ) "day"
        , (
            CASE
                WHEN
                    att_log_min_max_pure.status_before_lunch = 'NORMAL'
                THEN
                    EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.min_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                ELSE
                    (
                        CASE
                            WHEN
                                att_log_min_max_pure.diff_min_before < att_log_min_max_pure.diff_max_before
                            THEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.min_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            WHEN
                                att_log_min_max_pure.diff_min_before > att_log_min_max_pure.diff_max_before
                            THEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            ELSE
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.min_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        END
                    )
            END 
        ) AS "hour_1"
        ,(
            CASE
                WHEN
                    att_log_min_max_pure.status_before_lunch = 'NORMAL'
                THEN
                    EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.min_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                ELSE
                    (
                        CASE
                            WHEN
                                att_log_min_max_pure.diff_min_before < att_log_min_max_pure.diff_max_before
                            THEN
                                EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.min_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            WHEN
                                att_log_min_max_pure.diff_min_before > att_log_min_max_pure.diff_max_before
                            THEN
                                EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.max_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            ELSE
                                EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.min_before_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        END
                    )
            END 
        ) AS "minute_1"
        ,(
            CASE
                WHEN
                    att_log_min_max_pure.status_after_lunch = 'NORMAL'
                THEN
                    EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                ELSE
                    (
                        CASE
                            WHEN
                                att_log_min_max_pure.diff_min_after = att_log_min_max_pure.diff_max_after
                            THEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            WHEN
                                att_log_min_max_pure.diff_min_after < att_log_min_max_pure.diff_max_after
                            THEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.min_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            WHEN
                                att_log_min_max_pure.diff_min_after > att_log_min_max_pure.diff_max_after
                            THEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            ELSE
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        END
                    )                
            END
        ) AS "hour_2"
        ,(
            CASE
                WHEN
                    att_log_min_max_pure.status_after_lunch = 'NORMAL'
                THEN
                    EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                ELSE
                    (
                        CASE
                            WHEN
                                att_log_min_max_pure.diff_min_after = att_log_min_max_pure.diff_max_after
                            THEN
                                EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            WHEN
                                att_log_min_max_pure.diff_min_after < att_log_min_max_pure.diff_max_after
                            THEN
                                EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.min_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            WHEN
                                att_log_min_max_pure.diff_min_after > att_log_min_max_pure.diff_max_after
                            THEN
                                EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            ELSE
                                EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        END
                    )                
            END
        ) AS "minute_2"
        ,(
            SELECT EXTRACT(HOUR FROM TO_TIMESTAMP(MIN(datetime_log))::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            FROM hr_attendance_log
            WHERE
            EXTRACT(YEAR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            = 
            att_log_min_max_pure.y 
            AND
            EXTRACT(MONTH FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            =
            att_log_min_max_pure.m 
            AND
            EXTRACT(DAY FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            =
            att_log_min_max_pure.d 
            AND
            att_log_min_max_pure.set_att_pin = hr_attendance_log.att_pin
            AND
            datetime_log
            >
            (CASE
                WHEN
                    att_log_min_max_pure.status_after_lunch = 'NORMAL'
                THEN
                    att_log_min_max_pure.max_after_lunch_group
                ELSE
                    (
                        CASE
                            WHEN
                                att_log_min_max_pure.diff_min_after = att_log_min_max_pure.diff_max_after
                            THEN
                                att_log_min_max_pure.max_after_lunch_group
                            WHEN
                                att_log_min_max_pure.diff_min_after < att_log_min_max_pure.diff_max_after
                            THEN
                                att_log_min_max_pure.min_after_lunch_group
                            WHEN
                                att_log_min_max_pure.diff_min_after > att_log_min_max_pure.diff_max_after
                            THEN
                                att_log_min_max_pure.max_after_lunch_group
                            ELSE
                                att_log_min_max_pure.max_after_lunch_group
                        END
                    )                
            END)
        ) AS "Ext_Hour_1"
        ,(
            SELECT EXTRACT(MINUTE FROM TO_TIMESTAMP(MIN(datetime_log))::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            FROM hr_attendance_log
            WHERE
            EXTRACT(YEAR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            = 
            att_log_min_max_pure.y 
            AND
            EXTRACT(MONTH FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            =
            att_log_min_max_pure.m 
            AND
            EXTRACT(DAY FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            =
            att_log_min_max_pure.d 
            AND
            att_log_min_max_pure.set_att_pin = hr_attendance_log.att_pin
            AND
            datetime_log
            >
            (CASE
                WHEN
                    att_log_min_max_pure.status_after_lunch = 'NORMAL'
                THEN
                    att_log_min_max_pure.max_after_lunch_group
                ELSE
                    (
                        CASE
                            WHEN
                                att_log_min_max_pure.diff_min_after = att_log_min_max_pure.diff_max_after
                            THEN
                                att_log_min_max_pure.max_after_lunch_group
                            WHEN
                                att_log_min_max_pure.diff_min_after < att_log_min_max_pure.diff_max_after
                            THEN
                                att_log_min_max_pure.min_after_lunch_group
                            WHEN
                                att_log_min_max_pure.diff_min_after > att_log_min_max_pure.diff_max_after
                            THEN
                                att_log_min_max_pure.max_after_lunch_group
                            ELSE
                                att_log_min_max_pure.max_after_lunch_group
                        END
                    )                
            END)
        ) AS "Ext_Min_1"
        , (
            CASE
                WHEN
                    att_log_min_max_pure.extra_out_next_day IS NULL
                THEN
                       (
                        CASE
                            WHEN
                                att_log_min_max_pure.check_ext_hour IS NULL
                            THEN
                                (
                                    CASE
                                        WHEN
                                            to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.set_max_ext_hour_group_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                            =
                                            (
                                                CASE
                                                    WHEN
                                                        att_log_min_max_pure.status_after_lunch = 'NORMAL'
                                                    THEN
                                                        to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                    ELSE
                                                        (
                                                            CASE
                                                                WHEN
                                                                    att_log_min_max_pure.diff_min_after = att_log_min_max_pure.diff_max_after
                                                                THEN
                                                                    to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                                WHEN
                                                                    att_log_min_max_pure.diff_min_after < att_log_min_max_pure.diff_max_after
                                                                THEN
                                                                    to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.min_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                                WHEN
                                                                    att_log_min_max_pure.diff_min_after > att_log_min_max_pure.diff_max_after
                                                                THEN
                                                                    to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                                ELSE
                                                                    to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                            END
                                                        )                
                                                END
                                            )
                                        THEN
                                            NULL
                                        ELSE
                                            to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.set_max_ext_hour_group_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                    END
                                )
                            ELSE
                                NULL
                        END
                        )
                ELSE
                    to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.extra_out_next_day)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
            END
        ) AS "Ext_Hour_2"
        , (
            CASE
                WHEN
                    att_log_min_max_pure.extra_out_next_day IS NULL
                THEN
                        (
                            CASE
                                WHEN
                                    att_log_min_max_pure.check_ext_hour IS NULL
                                THEN
                                    (
                                        CASE
                                            WHEN
                                                to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.set_max_ext_hour_group_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                =
                                                (
                                                    CASE
                                                        WHEN
                                                            att_log_min_max_pure.status_after_lunch = 'NORMAL'
                                                        THEN
                                                            to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                        ELSE
                                                            (
                                                                CASE
                                                                    WHEN
                                                                        att_log_min_max_pure.diff_min_after = att_log_min_max_pure.diff_max_after
                                                                    THEN
                                                                        to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                                    WHEN
                                                                        att_log_min_max_pure.diff_min_after < att_log_min_max_pure.diff_max_after
                                                                    THEN
                                                                        to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.min_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                                    WHEN
                                                                        att_log_min_max_pure.diff_min_after > att_log_min_max_pure.diff_max_after
                                                                    THEN
                                                                        to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                                    ELSE
                                                                        to_char(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_min_max_pure.max_after_lunch_group)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                                                END
                                                            )                
                                                    END
                                                )
                                            THEN
                                                NULL
                                            ELSE
                                                to_char(EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.set_max_ext_hour_group_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
                                        END
                                    )
                                ELSE
                                    NULL
                            END
                        )
                ELSE
                    to_char(EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_min_max_pure.extra_out_next_day)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0'),'999')
            END
        ) AS "Ext_Min_2"
        , (
            SELECT 
                array_to_string(
                    array_agg(
                        '<a href=http://{$ipTarget}/?db={$dbTarget}#id='
                        || 
                        id
                        ||
                        '&view_type=form&model=hr.attendance.log&menu_id=682&action=812 target=_blank>' 
                        || 
                        to_char(log_time, 'HH24:MI') 
                        || 
                        '</a>'),',')
            FROM hr_attendance_log
            WHERE
            EXTRACT(YEAR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            = 
            att_log_min_max_pure.y 
            AND
            EXTRACT(MONTH FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            =
            att_log_min_max_pure.m 
            AND
            EXTRACT(DAY FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
            =
            att_log_min_max_pure.d 
            AND
            att_log_min_max_pure.set_att_pin = hr_attendance_log.att_pin
        ) AS "List_Time"     
    FROM
    (
        SELECT
              att_log_grouped2.employee_id
            , att_log_grouped2.y
            , att_log_grouped2.m
            , att_log_grouped2.d
            , att_log_grouped2.set_att_pin
            , att_log_grouped2.min_date_time_log
            , att_log_grouped2.max_date_time_log
            , att_log_grouped2.c_count_before AS total_before_lunch_group
            , att_log_grouped2.c_count_after AS total_after_lunch_group
            , att_log_grouped2.min_before_lunch AS min_before_lunch_group
            , att_log_grouped2.max_before_lunch AS max_before_lunch_group
            , att_log_grouped2.min_after_lunch AS min_after_lunch_group
            , att_log_grouped2.max_after_lunch AS max_after_lunch_group
            , EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')  AS max_after_lunch_hour_group
            , att_log_grouped2.set_min_ext_hour             AS set_min_ext_hour_group
            , att_log_grouped2.set_max_ext_hour             AS set_max_ext_hour_group_log
            , (
                CASE
                    WHEN
                        EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        =
                        EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.set_max_ext_hour)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                    THEN
                        NULL
                    ELSE
                        att_log_grouped2.set_max_ext_hour
                END
                ) AS check_ext_hour
            , EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.set_max_ext_hour)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')  AS set_max_ext_hour_group
            , EXTRACT(MINUTE FROM TO_TIMESTAMP(att_log_grouped2.set_max_ext_hour)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') AS set_max_ext_minute_group
            , att_log_grouped2.c_count_after                AS total_after_lunch
            , att_log_grouped2.c_count_after                AS total_after_lunch
            , att_log_grouped2.c_count_before               AS total_before_lunch
            , att_log_grouped2.c_count_after                AS total_after_lunch
            , (
                CASE
                    WHEN
                        att_log_grouped2.c_count_before = 1
                    THEN
                        'NORMAL'
                    WHEN
                        att_log_grouped2.c_count_before = 2
                    THEN
                        'NEED CHECK'
                    ELSE
                        'NEED CHECK ABNORMAL'
                END
            ) AS status_before_lunch
            , (
                CASE
                    WHEN
                        att_log_grouped2.c_count_after = 1
                    THEN
                        'NORMAL'
                    WHEN
                        att_log_grouped2.c_count_after = 2
                    THEN
                        'NEED CHECK'
                    ELSE
                        'NEED CHECK ABNORMAL'
                END
            ) AS status_after_lunch
            , EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
              -
              EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
              AS check_diff_before_lunch
            , (
                CASE
                    WHEN
                        (
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            -
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        ) > 0
                    THEN
                        ABS(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')-8)
                    ELSE
                        0
                END
            ) AS diff_min_before
            , (
                CASE
                    WHEN
                        (
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            -
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        ) > 0
                    THEN
                        ABS(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_before_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')-8)
                    ELSE
                        0
                END
            ) AS diff_max_before
            , EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') 
              -
              EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
              AS check_diff_after_lunch
            , (
                CASE
                    WHEN
                        (
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            -
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        ) > 0
                    THEN
                        ABS(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')-17)
                    ELSE
                        0
                END
            ) AS diff_min_after
            , (
                CASE
                    WHEN
                        (
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            - 
                            EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.min_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                        ) > 0
                    THEN
                        ABS(EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped2.max_after_lunch)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')-17)
                    ELSE
                        0
                END
            ) AS diff_max_after
            ,(
                SELECT MIN(datetime_log) FROM hr_attendance_log
                WHERE
                    (to_char(date_extra_out,'YYYY'))::INT
                    =
                    att_log_grouped2.y
                    AND
                    (to_char(date_extra_out,'MM'))::INT
                    =
                    att_log_grouped2.m
                    AND
                    to_char(date_extra_out,'DD')::INT
                    =
                    att_log_grouped2.d
                    AND
                    att_log_grouped2.set_att_pin = hr_attendance_log.att_pin
        ) AS "extra_out_next_day"
        FROM (
            SELECT 
                att_log_grouped.employee_id     AS employee_id
                , att_log_grouped.att_pin_a     AS set_att_pin
                , att_log_grouped.y             AS y
                , att_log_grouped.m             AS m
                , att_log_grouped.d             AS d
                , MIN(att_log_grouped.hours)    AS min_date_time_log
                , MAX(att_log_grouped.hours)    AS max_date_time_log
                , COUNT(att_log_grouped.hours)  AS count_same_day
                ,(
                    SELECT 
                        COUNT(hr_attendance_log.att_pin)
                            FROM 
                              hr_attendance_log 
                            WHERE
                                att_log_grouped.y = EXTRACT(YEAR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            AND
                                att_log_grouped.m = EXTRACT(MONTH FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            AND
                                att_log_grouped.d = EXTRACT(DAY FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            AND
                                EXTRACT(HOUR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') <= 12
                            AND
                                att_log_grouped.employee_id = hr_attendance_log.employee_id
                    ) AS c_count_before
                ,(
                    SELECT 
                        COUNT(hr_attendance_log.att_pin)
                            FROM 
                               hr_attendance_log
                            WHERE
                               att_log_grouped.y = EXTRACT(YEAR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            AND
                               att_log_grouped.m = EXTRACT(MONTH FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                                AND
                               att_log_grouped.d = EXTRACT(DAY FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0')
                            AND
                               EXTRACT(HOUR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') > 12
                            AND
                               att_log_grouped.employee_id = hr_attendance_log.employee_id
                    ) AS c_count_after
                , MIN(
                        CASE 
                            WHEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped.datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') <= 12 
                            THEN
                                att_log_grouped.datetime_log
                            ELSE
                                NULL
                        END
                    ) AS min_before_lunch
                , MAX(
                        CASE 
                            WHEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped.datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') <= 12 
                            THEN
                                att_log_grouped.datetime_log
                            ELSE
                                NULL
                        END
                    ) AS max_before_lunch
                , MIN(
                        CASE 
                            WHEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped.datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') > 12 
                            THEN
                                att_log_grouped.datetime_log
                            ELSE
                                NULL
                        END
                    ) AS min_after_lunch
                , MAX(
                        CASE 
                            WHEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped.datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') > 12 
                            THEN
                                att_log_grouped.datetime_log
                            ELSE
                                NULL
                        END
                    ) AS max_after_lunch
                , MIN(
                        CASE 
                            WHEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped.datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') >= 17
                            THEN
                                att_log_grouped.datetime_log
                            ELSE
                                NULL
                        END
                    ) as set_min_ext_hour
                , MAX(
                        CASE 
                            WHEN
                                EXTRACT(HOUR FROM TO_TIMESTAMP(att_log_grouped.datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') >= 17
                            THEN
                                att_log_grouped.datetime_log
                            ELSE
                                NULL
                        END
                    ) as set_max_ext_hour
                FROM (
                    SELECT
                        att_log.employee_id
                        , att_log.att_pin as att_pin_a
                        , att_log.log_time as log_time
                        , datetime_log
                        , TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0' AS timestamp_log
                        , EXTRACT(YEAR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as y
                        , EXTRACT(MONTH FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as m
                        , EXTRACT(DAY FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as d
                        , EXTRACT(HOUR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as hours
                        , EXTRACT(MINUTE FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') as minutes
                        , (
                            CASE
                                WHEN
                                    EXTRACT(HOUR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') < 12
                                THEN
                                    'BEFORE'
                                ELSE
                                    'AFTER'
                            END
                        ) AS "BeforeAfter"
                        , (
                            CASE 
                            WHEN 
                               EXTRACT(HOUR FROM TO_TIMESTAMP(datetime_log)::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'gmt+0') >= 17
                            THEN
                               'TRUE'
                            ELSE
                               'FALSE'
                            END
                         ) AS "over_out_normal"
                        ,att_log.date_extra_out
                    FROM hr_attendance_log att_log 
                    WHERE
                        att_log.log_time BETWEEN '{$first}' AND '{$last}'
                    AND
                        att_log.employee_id IN (SELECT id FROM hr_employee WHERE address_id={$site})
                    ) AS att_log_grouped
                WHERE
                    att_log_grouped.log_time BETWEEN '{$first}' AND '{$last}'
                GROUP BY
                    att_log_grouped.employee_id, 
                    att_log_grouped.y, 
                    att_log_grouped.m, 
                    att_log_grouped.d, 
                    att_log_grouped.att_pin_a
            ) AS att_log_grouped2
        ) AS att_log_min_max_pure
    FULL JOIN
        (
            SELECT 
                date_series.*
                , EXTRACT(YEAR FROM i)  AS year_series
                , EXTRACT(MONTH FROM i) AS month_series
                , EXTRACT(DAY FROM i)   AS day_series
                , eids.eid              AS emp_id
            FROM(
                SELECT i::DATE FROM generate_series('{$first}','{$last}', '1 day'::INTERVAL) AS i
            ) AS date_series
            JOIN (
                SELECT DISTINCT(employee_id) AS eid, 
                    hrd.name AS dept_name 
                FROM hr_attendance_log hrl
                JOIN hr_employee hre ON hre.id                  = hrl.employee_id
                JOIN hr_department hrd ON hrd.id                = hre.department_id
                JOIN resource_resource rs_rs ON hre.resource_id = rs_rs.id
                WHERE 
                    hrd.name like '%%' 
                AND 
                    hre.address_id = {$site} 
                AND 
                    hrl.log_time BETWEEN '{$first}' AND '{$last}'
            ) AS eids ON eids.eid > 0
        ) AS date_series ON date_series.emp_id = att_log_min_max_pure.employee_id 
        AND 
            date_series.year_series  = att_log_min_max_pure.y 
        AND 
            date_series.month_series = att_log_min_max_pure.m 
        AND
            date_series.day_series   = att_log_min_max_pure.d
        JOIN hr_employee AS h_emp ON h_emp.id   = date_series.emp_id
        LEFT JOIN res_partner r_p ON r_p.id     = h_emp.address_id
        ORDER BY 
            h_emp.name_related ASC, 
            date_series.i ASC, 
            att_log_min_max_pure.y ASC, 
            att_log_min_max_pure.m ASC, 
            att_log_min_max_pure.d ASC
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
        $dataToRender['sites'] = \app\models\ResPartner::find()->where(['id'=>[1792,2788,1417,5732,6332]])->orderBy('name ASC')->asArray()->all();
        $depts = \app\models\HrDepartment::find()->select('name')->orderBy('name ASC');
        if($department){
            // $depts->where('name = :name',[':name'=>$department]);
        }
        $dataToRender['depts'] = $depts->asArray()->all();
        // var_dump($dataToRender['depts']);
        return $this->render('first_and_last_scan_site',$dataToRender);
    }
}
