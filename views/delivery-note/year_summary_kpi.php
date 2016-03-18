<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
use miloschuman\highcharts\Highcharts;
?>

<h3 class="page-header">
	<span class="page-header">Year Summary KPI : </span>
	<span id="tahunCreateTitle" class="dropdown">
		<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($tahun_create)?></a>
		<?php
			$start = 2015;
			$end = date('Y');
			$items = [];
			for($iTahunCreate=$start;$iTahunCreate<=$end;$iTahunCreate++){
				$items[] = ['label' => $iTahunCreate, 'url' => ['','tahun_create'=>$iTahunCreate]];
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
			'header'=>'Bulan',
			'attribute'=>'bulan_create',
		],
		[
			'header'=>'PO Total',
			'attribute'=>'po_total',
		],
		[
			'header'=>'Tercapai %',
			'attribute'=>'tercapai_persen',	
		],
		[
			'header'=>'Tidak Tercapai %',
			'attribute'=>'tdk_tercapai_persen',
		],
		[
			'header'=>'Belum Terkirim %',
			'attribute'=>'blm_terkirim_persen',
		],
		[
			'header'=>'Total %',
			'attribute'=>'total_persen',
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
		'chart' => ['type' => 'column'],
		'title' => ['text' => 'Year Summary KPI'],
		'xAxis' => [
			'categories' => $categories,
			'title' => ['text' => 'Bulan']
		],
		'yAxis' => [
			'title' => ['text' => 'Value Dalam Persen']
		],
		'series' => $series,

	],
]);
?>