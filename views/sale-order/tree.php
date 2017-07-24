<?php
use yii\grid\GridView;
use yii\helpers\Html;
?>
<div class="sale-order-tree">
	<h1><?= Html::encode($this->title) ?></h1>
	<?=
		GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],
				'name',
				'client_order_ref',
				[
					'attribute'=>'user_id',
					'header'=>'Sales Man',
					
					'value'=>function($model,$Key,$index,$column){
						return $model['user']['partner']['name'];
					}
				],
				'date_order:date',
				[
					'attribute'=>'partner.name',
					'header'=>'Customer'
				],
				[
					'attribute'=>'amount_total',
					'value'=>function($model,$key,$index,$column){
						return Yii::$app->numericLib->indoStyle($model['amount_total']);
					}
				],
				[
					'attribute'=>'pricelist_id',
					'label'=>'SO Currency',
					'value'=>function($model,$key,$index,$column){
						return $model['pricelist']['name'];
					},
					'filter'=>\yii\helpers\ArrayHelper::map(app\models\ProductPricelist::find()->all(),'id','name')
				],

			],
		])
	?>
</div>