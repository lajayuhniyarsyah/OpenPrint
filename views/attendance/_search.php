<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HrAttendanceMinMaxLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hr-attendance-min-max-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dept_id') ?>

    <?= $form->field($model, 'dept_name') ?>

    <?= $form->field($model, 'employee_id') ?>

    <?= $form->field($model, 'employee_name') ?>

    <?php // echo $form->field($model, 'full_date') ?>

    <?php // echo $form->field($model, 'y_log') ?>

    <?php // echo $form->field($model, 'm_log') ?>

    <?php // echo $form->field($model, 'd_log') ?>

    <?php // echo $form->field($model, 'dow_log') ?>

    <?php // echo $form->field($model, 'scan_times_a_day') ?>

    <?php // echo $form->field($model, 'min_log') ?>

    <?php // echo $form->field($model, 'hh_min_log') ?>

    <?php // echo $form->field($model, 'mm_min_log') ?>

    <?php // echo $form->field($model, 'min_state_log') ?>

    <?php // echo $form->field($model, 'max_log') ?>

    <?php // echo $form->field($model, 'hh_max_log') ?>

    <?php // echo $form->field($model, 'mm_max_log') ?>

    <?php // echo $form->field($model, 'max_state_log') ?>

    <?php // echo $form->field($model, 'attendance_time') ?>

    <?php // echo $form->field($model, 'err_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
