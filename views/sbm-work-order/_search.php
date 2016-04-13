<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SbmWorkOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sbm-work-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'write_date') ?>

    <?= $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'adhoc_order_request_id') ?>

    <?php // echo $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'approver') ?>

    <?php // echo $form->field($model, 'sale_order_id') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'repeat_ref_id') ?>

    <?php // echo $form->field($model, 'order_date') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'work_location') ?>

    <?php // echo $form->field($model, 'source_type') ?>

    <?php // echo $form->field($model, 'customer_site_id') ?>

    <?php // echo $form->field($model, 'wo_no') ?>

    <?php // echo $form->field($model, 'approver2') ?>

    <?php // echo $form->field($model, 'approver3') ?>

    <?php // echo $form->field($model, 'request_no') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'seq_wo_no') ?>

    <?php // echo $form->field($model, 'seq_req_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
