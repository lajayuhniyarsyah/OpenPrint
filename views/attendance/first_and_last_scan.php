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
					$items[] = ['label' => $iYear, 'url' => ['','year'=>$iYear]];
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
					$items[] = ['label' => $m, 'url' => ['','month'=>$m]];
				}
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
	<?=\yii\grid\GridView::widget([
		'dataProvider'=>$dataProvider
	])?>
</div>
