<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeliveryNoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delivery-note-search">

    <?php $form = ActiveForm::begin([
        'action' => ['reportkpi'],
        'method' => 'get',
    ]); ?>

    <div class="col-md-12">
        <?php echo $form->field($model, 'partner_id')->textInput()->label('Address Name') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'year_tanggal')->textInput()->label('Tahun Kirim') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'month_tanggal')->textInput()->label('Bulan Kirim') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
