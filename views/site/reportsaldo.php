<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ProductProduct;
use app\models\StockLocation;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use yii\web\JsExpression;
?>


<?php

$url = \yii\helpers\Url::to(['service/product-list']);
$initScript = <<< SCRIPT
    function (element, callback) {
        var id=\$(element).val();
        if (id !== "") {
            \$.ajax("{$url}&id=" + id, {
            dataType: "json"
        }).done(function(data) { callback(data.results);});
        }
    }
SCRIPT;

$form = ActiveForm::begin([
    'id' => 'saldostockbarang-form',
    'options' => ['class' => 'form-horizontal'],
    'method'=>'get'
]);
?>

    <?php 


    // auto complete pakai select

    echo $form->field($formModel, 'product_id')->widget(Select2::classname(), [
        'options' => ['placeholder' => 'Select Product'],
        'pluginOptions' => [
            'tags'=>true,
            'allowClear' => true,
            'minimumInputLength' => 2,
            'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(term,page) { return {search:term.term}; }'),
                'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
            ],
            'initSelection' => new JsExpression($initScript)
        ],
    ]);

    ?>

  
    <?php 
    $stock=StockLocation::find()->all();
    $listData=ArrayHelper::map($stock,'id','complete_name');
    echo $form->field($formModel, 'warelct')->dropDownList($listData,['prompt'=>'Select...']);
    ?>

    <?=Html::submitButton('Search')?>

    <!-- input -->


<?php ActiveForm::end() ?>


         <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'product_name',
            'referensi',
            'source',
            'shipping_type',
            'product',
            'unit_of_measure',
            'serial',
            'source_location',
            'destination_location',
            'date',
            'schedule_date',
            'status',
            'move_status',
            'quantity',
            'saldo',
            'lbm_no',
            'cust_doc_ref',
            'purchase_name',
            'stock_name',
            'internal_move_name',
            'origin',
            'partner_name'


            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>