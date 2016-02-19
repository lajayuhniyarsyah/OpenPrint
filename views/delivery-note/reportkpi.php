<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>

<div>


<h3>Rekap KPI</h3>

	<?php echo $this->render('_search', [
	    'model' => $searchModel,
	]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		// 'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'name',
				'header'=>'Delivery Note',
			],
			[
				'attribute' => 'stockPicking0.date_done',
				'header' => 'DN/SJ Date',
			],
			[
				'attribute' => 'partner.display_name',
				'header' => 'Address',
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
			],

			// ['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
