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
	<span id="tahunCreateTitle" class="dropdown">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($year)?></a>
		<?php
			$start = 2015;
			$end = date('Y');
			$items = [];
			for($iYear=$start;$iYear<=$end;$iYear++){
				$items[] = ['label' => $iYear, 'url' => ['','year'=>$iYear,'group'=>$group_active]];
			}
			echo Dropdown::widget([
				'items' => $items,
			]);
		?>
	</span>
	-
	<span id="groupTitle" class="dropdown">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle"><?php echo Html::encode($group_active); ?></a>
		<?php
			$items = [];
			foreach ($modelGroup as $sales) {
				$items[] = ['label'=>$sales['name'],'url'=>['','year'=>$year,'group'=>$sales['name']]];
			}
			echo Dropdown::widget([
				'items' => $items,
			]);
		?>
	</span>
</h3>

<?= GridView::widget([
	'dataProvider'=>$dataProvider,
	'emptyCell'=>"&nbsp;",
	'columns'=>[
		'currency',
		'status',
		[
			'attribute' => 'total',
			'value'=>function($model){
				return Yii::$app->numericLib->indoStyle($model['total']);
			}
		]
	]
])?>

<?php
foreach($series as $serie):
echo "<div class='col-md-12' style='padding-bottom:15px;'>";
echo Highcharts::widget([
	'scripts' => [
		'highcharts-more',
		'modules/exporting',
		'highcharts-3d',
		'themes/grid'        // applies global 'grid' theme to all charts
	],
	'options' => [
		'chart' => [
			'type' => 'pie',
			'options3d' => [
				'enabled' => true,
                'alpha' => 45,
			]
		],
		'title' => ['text' => 'Quotation By Group'],
		'subtitle' => ['text' => 'On Chart'],
		'plotOptions' => [
			'pie' => [
				'innerSize' => 200,
				'depth' => 45
			]
		],
		'series' => [
			[
				'name' => 'Detail Quotation Composition',
				'data' => $serie,
			]
		]
		/*'series' => [[
            'name' => 'Delivered amount',
            'data' => [
                ['Bananas', 8],
                ['Kiwi', 3],
                ['Mixed nuts', 1],
                ['Oranges', 6],
                ['Apples', 8],
                ['Pears', 4],
                ['Clementines', 4],
                ['Reddish (bag)', 1],
                ['Grapes (bunch)', 1]
            ]
        ]]*/
	],
]);
echo "</div>";
endforeach;
?>