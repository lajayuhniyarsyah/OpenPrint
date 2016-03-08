<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

    $url= Url::to(['site/recordbulan','year']);
?>




         <!-- <form action="index.php?r=site/recordbulan" method='get'>
              Tahun :
              <input type="hidden" name="r" value="site/recordbulan" />
              <input type="year" name="year" />

              <input type="submit">
         </form>    -->

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
    'method'=>'get'
]);
?>
    <?=Html::input('char','year')?>

    <?=$form->field($formModel,'year')?>

    <?=Html::submitButton('Search')?>

    <!-- input -->


<?php ActiveForm::end() ?>
	<?php 
		// use yii\grid\GridView;

		// var_dump($dataProvider)
		?>


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