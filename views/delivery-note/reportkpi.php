<?php
use yii\helpers\Html;
use \kartik\grid\GridView;
?>

<h3 class="page-header">Report KPI</h3>

	<?php echo $this->render('_searchKPI', [
	    'model' => $searchModel,
	]); ?>

	<?php /*echo \kartik\export\ExportMenu::widget([
		'dataProvider'=>$dataProvider,
		// 'stream' => false,
		// 'streamAfterSave' => true, // this by default is `false` and this will generate a link to the saved file
	    // 'afterSaveView' => '_view', // this view file can be overwritten with your own that displays the generated file link
	    // 'folder' => '@webroot/tmp', // this is default save folder on server
	    // 'linkPath' => '/tmp', // the web accessible location to the above folder
	])*/ ?>

	<?php 
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		// 'filterModel' => $searchModel,
		// 'pjax'=>true,
		'toolbar'=>[
			'{export}'
		],
		'exportConfig' => [
                \kartik\grid\GridView::EXCEL => ['label' => 'Export to Excel'],
        ],
		'export'=>[
			'label'=>'Export',
			'target'=>GridView::TARGET_SELF
		],
		'panel'=>[
			'before'=>'Report KPI',
			// 'type' => GridView::TYPE_PRIMARY,
		],
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			/*[
				'attribute' => 'name',
				'header'=>'Delivery Note',
			],
			[
				'attribute' => 'stockPicking0.date_done',
				'header' => 'DN/SJ Date',
			],
			[
				'attribute' => 'partner.display_name',
				'header' => 'Address Name',
			],
			[
				'attribute' => 'saleOrder.date_order',
				'header' => 'Tgl PO/Barang Masuk',
			],
			[
				'attribute' => 'tanggal',
				'header' => 'Tanggal Kirim',
			],
			[
				'attribute' => 'selisih_hari',
			],
			[
				'attribute' => 'status',
			],*/
			
			'name',
			'stockPicking0.date_done',
			'partner.display_name',
			'saleOrder.date_order',
			'tanggal',
			'selisih_hari',
			'status',

			// ['class' => 'yii\grid\ActionColumn'],
		],
	]);
	?>
