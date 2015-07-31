<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HrAttendanceMinMaxLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hr Attendance Min Max Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-attendance-min-max-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'dept_id',
            
            // 'employee_id',
            
            // 'full_date',
            'y_log',
            'm_log',
            'd_log',
            'dept_name',
            'employee_name',
            // 'dow_log',
            // 'scan_times_a_day',
            // 'min_log:ntext',
            'hh_min_log:ntext',
            'mm_min_log:ntext',
            // 'min_state_log',
            // 'max_log:ntext',
            'hh_max_log:ntext',
            'mm_max_log:ntext',
            // 'max_state_log',
            // 'attendance_time:ntext',
            // 'err_code',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
