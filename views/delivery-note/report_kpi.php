<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>

<h3 class="page-header">Report KPI</h3>

	<?php echo $this->render('_searchKPI', [
	    'model' => $searchModel,
	]); ?>

	<?php 
	$gridColumns = [
		['class' => 'yii\grid\SerialColumn'],
		'name',
		'stockPicking0.date_done',
		'partner.display_name',
		'saleOrder.date_order',
		'tanggal',
		'selisih_hari',
		'status',
	];

	echo ExportMenu::widget([
	    'dataProvider' => $dataProviderExport,
	    // 'target' => ExportMenu::TARGET_SELF,
	    'asDropdown' => false,
	    // 'showColumnSelector' => true,
	    // 'columnSelectorMenuOptions' => [],
	    'exportConfig' => [
			ExportMenu::FORMAT_HTML => false,
			ExportMenu::FORMAT_CSV => false,
			ExportMenu::FORMAT_TEXT => false,
			ExportMenu::FORMAT_PDF => false,
			ExportMenu::FORMAT_EXCEL => false,
			ExportMenu::FORMAT_EXCEL_X  => ['label' => 'Export to Excel'],
		],
	    'columns' => $gridColumns
	]);

	echo GridView::widget([
		'dataProvider' => $dataProvider,
		// 'filterModel' => $searchModel,
		// 'pjax'=>true,
		'toolbar'=>[
			'{export}'
		],
		'exportConfig' => [
            GridView::EXCEL => ['label' => 'Export to Excel'],
        ],
		'export'=>[
			'label'=>'Export',
			'target'=>GridView::TARGET_SELF
		],
		'panel'=>[
			'before'=>'Report KPI',
			// 'type' => GridView::TYPE_PRIMARY,
		],
		'columns' => $gridColumns
	]);
	?>
