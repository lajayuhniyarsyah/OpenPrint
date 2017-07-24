<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HrAttendanceMinMaxLog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hr Attendance Min Max Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-attendance-min-max-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dept_id',
            'dept_name',
            'employee_id',
            'employee_name',
            'full_date',
            'y_log',
            'm_log',
            'd_log',
            'dow_log',
            'scan_times_a_day',
            'min_log:ntext',
            'hh_min_log:ntext',
            'mm_min_log:ntext',
            'min_state_log',
            'max_log:ntext',
            'hh_max_log:ntext',
            'mm_max_log:ntext',
            'max_state_log',
            'attendance_time:ntext',
            'err_code',
        ],
    ]) ?>

</div>
