<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
?>
<div class="form">
	<h1>
		Attendance Log
		<span id="yearTitle" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($year)?></a>
			<?php
				$start = 2015;
				$end = date('Y');
				$items = [];
				for($iYear=$start;$iYear<=$end;$iYear++){
					$items[] = ['label' => $iYear, 'url' => ['','year'=>$iYear,'month'=>$month,'department'=>$department_active,'site'=>$site_active->id]];
				}
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
		-
		<span id="monthTitle" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($month)?></a>
			<?php
				$items = [];
				for($m=1;$m<=12;$m++){
					$items[] = ['label' => $m, 'url' => ['','year'=>$year,'month'=>$m,'department'=>$department_active,'site'=>$site_active->id]];
				}
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>

		-

		<span id="departmentTitle" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($department_active)?></a>
			<?php
				
				$items = [];
				/*for($m=1;$m<=12;$m++){
					$items[] = ['label' => $m, 'url' => ['','month'=>$m]];
				}*/
				/*var_dump($depts);
				die();*/
				$items[] = ['label'=>'All Dept','url'=>['','month'=>$month,'department'=>'All Department','site'=>$site_active->id]];
				foreach($depts as $dept):

					$items[] = ['label'=>$dept['name'],'url'=>['','year'=>$year,'month'=>$month,'department'=>$dept['name'],'site'=>$site_active->id]];
				endforeach;
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>

		- ON -
		<span id="siteSelection" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($site_active->name)?></a>
			<?php
				
				$items = [];
				/*for($m=1;$m<=12;$m++){
					$items[] = ['label' => $m, 'url' => ['','month'=>$m]];
				}*/
				/*var_dump($depts);
				die();*/
				
				foreach($sites as $site):
					$items[] = ['label'=>$site['name'],'url'=>['','year'=>$year,'month'=>$month,'department'=>$department_active,'site'=>$site['id']]];
				endforeach;

				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
	</h1>
	<!-- <div>
		<?php $form = ActiveForm::begin(['id'=>'AttendaceLogForm','layout'=>'horizontal','method'=>'post']); ?>
			
			<?= $form->field($attendanceLogForm,'employee')?>
			<?= $form->field($attendanceLogForm,'department')?>

			<?= $form->field($attendanceLogForm,'year')?>
			<?= $form->field($attendanceLogForm,'month')?>
			<?= $form->field($attendanceLogForm,'day')?>
			
			<div class="form-group">
	        	<div class="col-lg-offset-3 col-lg-11">
					<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>-->
	<?=\kartik\export\ExportMenu::widget([
		'dataProvider'=>$dataProvider,

	])?>
	<?=\kartik\grid\GridView::widget([
		'dataProvider'=>$dataProvider,
		'emptyCell'=>"&nbsp;",
		'columns'=>[
			'year',
			'month',
			'day',
			'employee',
			'hour_1',
			'minute_1',
			'hour_2',
			'minute_2',
			'Ext_Hour_1',
			'Ext_Min_1',
			'Ext_Hour_2',
			'Ext_Min_2',
			[
			'format'=>'html',  
			'value'=>'List_Time'
			],
		]
	])?>
</div>
