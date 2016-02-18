<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>

<div>

<h3>Rekap KPI</h3>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		// 'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'Delivery Note',
				'value' => 'name',
			],
			[
				'attribute' => 'DN / SJ Date',
				'value' => 'stockPicking0.date_done',
			],
			[
				'attribute' => 'Address Name',
				'value' => 'partner.display_name',
			],
			[
				'attribute' => 'Tgl PO / Barang Masuk',
				'value' => 'saleOrder.date_order',
			],
			[
				'attribute' => 'Tanggal Kirim',
				'value' => 'tanggal',
			],
			// [
			// 	'attribute' => 'Selisih Hari',
			// 	'value' => '',
			// ],

			// ['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
