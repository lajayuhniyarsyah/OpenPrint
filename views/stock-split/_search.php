<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StockSplitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-split-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_uid') ?>

    <?= $form->field($model, 'create_date') ?>

    <?= $form->field($model, 'write_date') ?>

    <?= $form->field($model, 'write_uid') ?>

    <?php // echo $form->field($model, 'date_done') ?>

    <?php // echo $form->field($model, 'no') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'date_order') ?>

    <?php // echo $form->field($model, 'picking_id') ?>

    <?php // echo $form->field($model, 'stock_split_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
