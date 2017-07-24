<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SbmAdhocOrderRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sbm-adhoc-order-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'create_uid')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'write_date')->textInput() ?>

    <?= $form->field($model, 'write_uid')->textInput() ?>

    <?= $form->field($model, 'cust_ref_no')->textInput() ?>

    <?= $form->field($model, 'term_of_payment')->textInput() ?>

    <?= $form->field($model, 'scope_of_work')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attention_id')->textInput() ?>

    <?= $form->field($model, 'sales_man_id')->textInput() ?>

    <?= $form->field($model, 'term_condition')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'customer_site_id')->textInput() ?>

    <?= $form->field($model, 'cust_ref_type')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'sale_group_id')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
