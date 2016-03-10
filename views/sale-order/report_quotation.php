<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>

<h3 class="page-header">Report Quotation</h3>

<?php echo $this->render('_searchReportQuotation', [
    'model' => $searchModel,
]); ?>

<?php 
	$gridColumns = [
		['class' => 'yii\grid\SerialColumn'],
		
		[
			'attribute'=>'quotation_no',
			'header'=>'NO',
		],
		[
			'attribute'=>'create_date',
			'header'=>'Date',
		],
		[
			'attribute'=>'revisi',
			'value'=>function($n){
				return count($n->saleOrderRevisionHistories);
			}
		],
		[
			'attribute'=>'pricelist.name',
			'header'=>'Currency',
		],
		[
			'attribute'=>'group.name',
			'header'=>'Group',
		],
		[
			'attribute'=>'user.login',
			'header'=>'Sales Man',
		],
		[
			'attribute'=>'partner.display_name',
			'header'=>'Costumer',
		],
		[
			'attribute'=>'amount_untaxed',
			'header'=>'Total TAX',
			'value'=>function($model){
				return Yii::$app->numericLib->indoStyle($model['amount_untaxed']);
			}
		],
		[
			'attribute'=>'quotation_state',
			'header'=>'Status',
		],
	];

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
			'before'=>'Report Quotation',
			// 'type' => GridView::TYPE_PRIMARY,
		],
		'columns' => $gridColumns
	]);
	?>