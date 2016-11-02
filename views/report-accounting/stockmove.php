<?php
namespace app\controllers;
use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
use app\models\StockLocation;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

$location = StockLocation::find()->where(['location_id' =>49])->all();;
?>
<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}
th, td {
    border: none;
    text-align: left;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2}
.header{
	display: block;
	width: 100%;
	margin-top: -10px;
	padding: 5px;
	padding-top: 10px;
}
.judul{
	text-transform: uppercase;
}
.periode{
	text-transform: uppercase;
	font-weight: bold;
}
.ReportTable{
	width: 98% !important;
	margin-left: auto;
	margin-right:auto;
}
.head_table{
	text-align: center;
	background-color: #C5EFF7;
	font-weight: bold !important;
}
.head_table td{
	font-weight: bold !important;	
	text-align: center;
}
</style>
<div class="header">
	<h4>
		LOCATION :
		<span id="siteSelection" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle">
				<?=Html::encode($loc_active->name)?>
			</a>
			<?php
				$items = [];
				$items[] = ['label'=>'HEAD OFFICE','url'=>['','jenis'=>$jenis,'from'=>$from,'to'=>$to,'location'=>12]];
				foreach($location as $loc):
					$items[] = ['label'=>$loc['name'],'url'=>['','jenis'=>$jenis,'from'=>$from,'to'=>$to,'location'=>$loc['id']]];
				endforeach;
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
	</h4>
</div>
<?php
	$jenisreport="out";
	if($jenis=="del"){

		$judul= "<div class='judul'>Report Delivery Note ".Html::encode($loc_active->name)."</div> <div class='periode'> ".Yii::$app->formatter->asDatetime($from, "php:d-m-Y")." s/d ".Yii::$app->formatter->asDatetime($to, "php:d-m-Y")."</div>";	
		$headTable="
					<tr class='head_table'>
						<td>No</td>
						<td>Date</td>
						<td>DN</td>
						<td>OP</td>
						<td>Category</td>
						<td>Part Number</td>
						<td>Product Name</td>
						<td>Product Desc</td>
						<td>Qty</td>
						<td>UOM</td>
						<td>Batch</td>
						<td>Price</td>
						<td>Currency</td>
						<td>SO</td>
						<td>PO</td>
						<td>Source Location</td>
						<td>Desc Location</td>
						<td>Status</td>
					</tr>
					";
		$no=1;
		foreach ($data as $value) {
			$body[]='<tr>
					<td>'.$no.'</td>
					<td>'.Yii::$app->formatter->asDatetime($value['tanggal'], "php:d-m-Y").'</td>
					<td>'.substr($value['dn_no'], 0,6).'</td>
					<td>'.substr($value['no_op'], 0,6).'</td>
					<td>'.$value['category_name'].'</td>
					<td>'.$value['part_number'].'</td>
					<td>'.$value['name_template'].'</td>
					<td>'.$value['name_input'].'</td>
					<td>'.$value['qty'].'</td>
					<td>'.$value['uom'].'</td>
					<td>'.$value['batch'].'</td>
					<td>'.Yii::$app->numericLib->indoStyle($value['price']).'</td>
					<td>'.$value['pricelist'].'</td>
					<td>'.substr($value['so_no'], 9,5).'</td>
					<td>'.$value['poc'].'</td>
					<td>'.$value['s_location'].'</td>
					<td>'.$value['partner'].'</td>
					<td>'.$value['state'].'</td>
				 </tr>';
		$no++;
		}
	}else if($jenis=="inc"){
		$judul= "<div class='judul'>Report Incoming Shipment ".Html::encode($loc_active->name)."</div> <div class='periode'>  ".Yii::$app->formatter->asDatetime($from, "php:d-m-Y")." s/d ".Yii::$app->formatter->asDatetime($to, "php:d-m-Y")."</div>";
		$headTable="
			<tr class='head_table'>
				<td>Type</td>
				<td>Date</td>
				<td>LBM No</td>
				<td>Category</td>
				<td>Part Number</td>
				<td>Product Name</td>
				<td>Product Desc</td>
				<td>Qty</td>
				<td>UOM</td>
				<td>Batch</td>
				<td>Price</td>
				<td>Currency</td>
				<td>Location</td>
				<td>Dest Location</td>
				<td>Partner</td>
				<td>Type</td>
				<td>NO PO</td>
				<td>Origin</td>
				<td>Status</td>
			</tr>
			";
		foreach ($data as $value) {
			$body[]='<tr>
					<td>'.$value['jenis'].'</td>
					<td>'.Yii::$app->formatter->asDatetime($value['date_done'], "php:d-m-Y").'</td>
					<td>'.$value['lbm'].'</td>
					<td>'.$value['category_name'].'</td>
					<td>'.$value['part_number'].'</td>
					<td>'.$value['name_template'].'</td>
					<td>'.$value['name_input'].'</td>
					<td>'.$value['qty'].'</td>
					<td>'.$value['uom'].'</td>
					<td>'.$value['batch'].'</td>
					<td>'.Yii::$app->numericLib->indoStyle($value['price']).'</td>
					<td>'.$value['pricelist'].'</td>
					<td>'.$value['location'].'</td>
					<td>'.$value['desc_location'].'</td>
					<td>'.$value['partner'].'</td>
					<td>'.$value['type'].'</td>
					<td>'.$value['po'].'</td>
					<td>'.$value['origin'].'</td>
					<td>'.$value['state'].'</td>
				 </tr>';
		}
	}else{
		$judul= "<div class='judul'>Report Internal Move ".Html::encode($loc_active->name)."</div> <div class='periode'>  ".Yii::$app->formatter->asDatetime($from, "php:d-m-Y")." s/d ".Yii::$app->formatter->asDatetime($to, "php:d-m-Y")."</div>";
		$headTable="
			<tr class='head_table'>
				<td><center>Type</center></td>
				<td><center>Date</center></td>
				<td><center>LBM</center></td>
				<td><center>Category</center></td>
				<td><center>Part Number</center></td>
				<td><center>Product Name</center></td>
				<td><center>Product Desc</center></td>
				<td><center>Qty</center></td>
				<td><center>UOM</center></td>
				<td><center>Batch</center></td>
				<td><center>Location</center></td>
				<td><center>Dest Location</center></td>
				<td><center>Type</center></td>
				<td><center>Origin</center></td>
				<td><center>Status</center></td>
			</tr>
			";
		foreach ($data as $value) {
			if ($value['jenis'] == 'internal' or $value['jenis'] == null){
				if($value['date_done']){
					$datemove=$value['date_done'];
				}else{
					$datemove=$value['date_move'];
				}
				$body[]='<tr>
						<td>internal</td>
						<td>'.Yii::$app->formatter->asDatetime($datemove, "php:d-m-Y").'</td>
						<td>'.$value['lbm'].'</td>
						<td>'.$value['category_name'].'</td>
						<td>'.$value['part_number'].'</td>
						<td>'.$value['name_template'].'</td>
						<td>'.$value['name_input'].'</td>
						<td>'.$value['qty'].'</td>
						<td>'.$value['uom'].'</td>
						<td>'.$value['batch'].'</td>
						<td>'.$value['location'].'</td>
						<td>'.$value['desc_location'].'</td>
						<td>'.$value['type'].'</td>
						<td>'.$value['origin'].'</td>
						<td>'.$value['state'].'</td>
					 </tr>';
			}
		}
	}
	
	if(isset($body)){
		echo $judul;
		echo "<table class='ReportTable'>";
		echo $headTable;
		foreach ($body as $val) {
			echo $val;
		}	
		echo "</table>";
	}else{
		echo $judul.'<br/>';
		echo '<center>Stock Move di Location '.$loc['name'].' Tidak Ditemukan</center>';
	}
	
	

?>