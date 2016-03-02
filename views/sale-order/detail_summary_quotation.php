<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
use miloschuman\highcharts\Highcharts;
?>

<h3 class="page-header">
	<span class="page-header">Detail Quotation Report :</span>
</h3>

<?= GridView::widget([
	'dataProvider'=>$dataProvider,
	'emptyCell'=>"&nbsp;",
	'columns'=>[
		'currency',
		'status',
		'value',
	]
])?>