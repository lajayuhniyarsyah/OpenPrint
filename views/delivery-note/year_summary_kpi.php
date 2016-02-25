<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
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
				$items[] = ['label' => $iTahunCreate, 'url' => ['','tahun_create'=>$iTahunCreate,'bulan_create'=>$bulan_create]];
			}
			echo Dropdown::widget([
				'items' => $items,
			]);
		?>
	</span>
	-
	<span id="bulanCreateTitle" class="dropdown">
		<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($bulan_create)?></a>
		<?php
			$items = [];
			for($m=1;$m<=12;$m++){
				$items[] = ['label' => $m, 'url' => ['','tahun_create'=>$tahun_create,'bulan_create'=>$m]];
			}
			echo Dropdown::widget([
				'items' => $items,
			]);
		?>
	</span>
</h3>

<?= GridView::widget([
	'dataProvider'=>$dataProvider,
	'emptyCell'=>"&nbsp;",
	'columns'=>[
		'po_total',
		'tercapai_persen',
		'tdk_tercapai_persen',
		'blm_terkirim_persen',
		'tahun_create',
		'bulan_create',
		'total_persen',
	]
])?>