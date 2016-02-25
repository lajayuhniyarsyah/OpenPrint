<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
?>

<h3 class="page-header">Year Summary KPI</h3>

<?= GridView::widget([
	'dataProvider'=>$dataProvider,
	'emptyCell'=>"&nbsp;",
	'columns'=>[
		'po_total',
		'tercapai_persen',
		'tdk_tercapai_persen',
		'blm_terkirim_persen',
		'total_persen',
	]
])?>