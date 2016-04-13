<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SbmAdhocOrderRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sbm-adhoc-order-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'write_date') ?>

    <?= $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'cust_ref_no') ?>

    <?php // echo $form->field($model, 'term_of_payment') ?>

    <?php // echo $form->field($model, 'scope_of_work') ?>

    <?php // echo $form->field($model, 'attention_id') ?>

    <?php // echo $form->field($model, 'sales_man_id') ?>

    <?php // echo $form->field($model, 'term_condition') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'customer_site_id') ?>

    <?php // echo $form->field($model, 'cust_ref_type') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'sale_group_id') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
