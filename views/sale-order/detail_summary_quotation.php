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
		'total',
	]
])?>

<?php
echo Highcharts::widget([
	'scripts' => [
		'highcharts-more',
		'modules/exporting',
	],
	'options' => [
		'chart' => [
			'type' => 'pie',
			'options3d' => [
				'enabled' => true,
                'alpha' => 45
			]
		],
		'title' => ['text' => 'Quotation By Group'],
		'plotOptions' => [
			'pie' => [
				'innerSize' => 200,
				'depth' => 45
			]
		],
		'series' => [
			[
				'name' => 'Detail Quotation Composition',
				'data' => $series,
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
?>