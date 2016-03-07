<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
use miloschuman\highcharts\Highcharts;
?>

<h3 class="page-header">
	<span class="page-header">Quotation By Group : </span>
	<span id="tahunCreateTitle" class="dropdown">
		<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($year)?></a>
		<?php
			$start = 2015;
			$end = date('Y');
			$items = [];
			for($iYear=$start;$iYear<=$end;$iYear++){
				$items[] = ['label' => $iYear, 'url' => ['','year'=>$iYear]];
			}
			echo Dropdown::widget([
				'items' => $items,
			]);
		?>
	</span>
</h3>

<?php /*echo ExportMenu::widget([
	'dataProvider'=>$dataProvider,
]);*/ ?>

<?= GridView::widget([
	'dataProvider'=>$dataProvider,
	'emptyCell'=>"&nbsp;",
	'columns'=>[
		[
			'header'=>'Group',
			'attribute'=>'group',
			'format'=>'html',
			'value'=>function($data) use ($year){
				return Html::a($data['group'],['sale-order/detail-summary-quotation','group'=>$data['group'],'year'=>$year]);
			},
		],
		[
			'header'=>'Win',
			'attribute'=>'win',
		],
		[
			'header'=>'Lost',
			'attribute'=>'lost',	
		],
		[
			'header'=>'On Process',
			'attribute'=>'on_process',
		],	
	]
])?>

<?php
echo Highcharts::widget([
	'scripts' => [
		'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
		'modules/exporting', // adds Exporting button/menu to chart
		// 'themes/grid'        // applies global 'grid' theme to all charts
	],
	'options' => [
		'chart' => ['type' => 'bar'],
		'title' => ['text' => 'Quotation By Group'],
		'xAxis' => [
			'categories' => ['Win', 'Lost', 'On Process'],
		],
		'yAxis' => [
			'title' => ['text' => 'Value']
		],
		'series' => $series,

	],
]);
?>