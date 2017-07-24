<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SbmWorkOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sbm-work-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'adhoc_order_request_id')->textInput() ?>

    <?= $form->field($model, 'due_date')->textInput() ?>

    <?= $form->field($model, 'approver')->textInput() ?>

    <?= $form->field($model, 'sale_order_id')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'repeat_ref_id')->textInput() ?>

    <?= $form->field($model, 'order_date')->textInput() ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'work_location')->textInput() ?>

    <?= $form->field($model, 'source_type')->textInput() ?>

    <?= $form->field($model, 'customer_site_id')->textInput() ?>

    <?= $form->field($model, 'wo_no')->textInput() ?>

    <?= $form->field($model, 'approver2')->textInput() ?>

    <?= $form->field($model, 'approver3')->textInput() ?>

    <?= $form->field($model, 'request_no')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'seq_wo_no')->textInput() ?>

    <?= $form->field($model, 'seq_req_no')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
