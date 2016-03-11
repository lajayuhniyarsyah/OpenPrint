<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

   
?>


<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'method'=>'get'
]);
?>
   <!--  <?=Html::input('char','year')?> -->

    <?=$form->field($formModel,'year')?>

    <?=Html::submitButton('Search')?>

    <!-- input -->


<?php ActiveForm::end() ?>


		 <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'kategory',
            'january',
            'february',
            'maret',
            'april',
            'mei',
            'juni',
            'juli',
            'agustus',
            'sepetember',
            'oktober',
            'november',
            'desember',
           
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>