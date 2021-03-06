<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

use yii\web\JsExpression;

use yii\bootstrap\Tabs;
?>
<?=Tabs::widget([
	'navType'=>'nav-pills',
	'items'=>[
		[
			'label'		=> '<span class="glyphicon glyphicon-signal"></span>',
			'encode'	=> false,
			'content'	=> $this->render('_charts_executive_summary_by_sales_man',['provider'=>$provider,'chart'=>$chart,'year'=>$year,'salesTitle'=>(isset($salesTitle) ? $salesTitle:'All Sales')]),
			'active'	=> true
		],
		[
			'label'		=> '<span class="glyphicon glyphicon-list"></span>',
			'encode'	=> false,
			'content'	=> $this->render('_grid_executive_summary_by_sales_man',['provider'=>$provider,'year'=>$year,'salesTitle'=>(isset($salesTitle) ? $salesTitle:'All Sales')])
		],
	]
])?>