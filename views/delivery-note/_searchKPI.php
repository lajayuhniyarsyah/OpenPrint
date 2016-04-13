<?php
use yii\helpers\Html;
// use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\ResPartner;
// use kartik\select2\Select2;
// use yii\web\JsExpression;

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
        <?php /*echo $form->field($model, 'partner_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(ResPartner::find()->all(),'id','display_name'),
            'options' => ['placeholder' => 'Filter as you type ...'],
        ])->label('Address Name')*/ ?>
        <?php
        $data = ResPartner::find()
            ->select(['display_name as value', 'display_name as  label','id as id'])
            ->asArray()
            ->all();
        ?>
        <?php echo $form->field($model, 'partner_id')->widget(\yii\jui\AutoComplete::classname(), [
            'clientOptions' => [
                'source' => $data,
            ],
        ])->textInput()->label('Address Name') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'month_tanggal')->dropDownList(['1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni','7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'], ['prompt'=>''])->label('Bulan Kirim') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'year_tanggal')->textInput()->label('Tahun Kirim') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'month_po')->dropDownList(['1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni','7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'], ['prompt'=>''])->label('Bulan PO') ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'year_po')->textInput()->label('Tahun PO') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
