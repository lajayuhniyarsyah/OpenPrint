<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
use miloschuman\highcharts\Highcharts;
?>

<h3 class="page-header">
	<span class="page-header">Sales Amount Status : </span>
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
			$items[] = ['label'=>'All','url'=>['','year'=>$year,'group'=>'All']];
			foreach ($modelGroup as $groupSales) {
				$items[] = ['label'=>$groupSales['name'],'url'=>['','year'=>$year,'group'=>$groupSales['name']]];
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
		'group_name',
		'doc_year',
		'doc_month',
		[
			'attribute'=>'order',
			'value'=>function($model){
				return Yii::$app->numericLib->indoStyle($model['order']);
			}
		],
		[
			'attribute'=>'invoice',
			'value'=>function($model){
				return Yii::$app->numericLib->indoStyle($model['invoice']);
			}
		],
	]
])?>

<?php
// var_dump($categories);
echo Highcharts::widget([
	'scripts' => [
		'highcharts-more',
		'modules/exporting',
		'highcharts-3d',
	],
	'options' => [
		'chart' => [
			'type' => 'column',
			'options3d' => [
				'enabled' => true,
                'alpha' => 15,
                'beta' => 15,
                'viewDistance' => 45,
                'depth' => 40
			]
		],
		'title' => ['text' => 'Sales Amount Status'],
		'xAxis' => [
			'categories' => $categories,
			'title' => [
                'text' => 'Months'
            ]
		],
		/*'xAxis' => [
			'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sept', 'Okt', 'Nov', 'Des']
		],*/
		'yAxis' => [
            'allowDecimals' => false,
            'min' => 0,
            'title' => [
                'text' => 'Value'
            ]
        ],
		'plotOptions' => [
			'column' => [
				'stacking' => 'normal',
                'depth' => 40
			]
		],
		'series' => $series,
		/*'series' => [
			[
				'name' => 'PO-G1',
				'data' => [5, 3, 4, 7, 2, 1],
				'stack' => 'PO'
			],
			[
				'name' => 'PO-G2',
				'data' => [2, 3, 3, 1, 2, 1],
				'stack' => 'PO'
			],
			[
				'name' => 'Inv-G1',
				'data' => [2, 3, 3, 1, 2, 1],
				'stack' => 'Inv'
			],
			[
				'name' => 'Inv-G2',
				'data' => [7, 3, 1, 4, 6, 1],
				'stack' => 'Inv'
			],
		]*/
	],
]);
?>