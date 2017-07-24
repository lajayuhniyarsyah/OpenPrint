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
<style type="text/css">
	.not_found{
		 border: 1px solid #ccc;
    font-weight: bold;
    margin-top: 39px;
    padding: 5px;
    text-align: center;
}
	}
</style>
<?php
	$jenisreport="out";
		$headTable="
					<tr>
						<th>No</th>
						<th>Type</th>
						<th>Date</th>
						<th>No doc</th>
						<th>No OP / LBM / PB</th>
						<th>Qty</th>
						<th>Source Loc</th>
						<th>Dest Loc</th>
						<th>Partner</th>
					</tr>
					";
		$no=1;
		$body=[];

		if(isset($_GET['location'])){
			$loc =$_GET['location'];
		}else{
			$loc = 12;
		}

		foreach ($data as $value) {
			$qty = $value['qty'];
			if($value['id_desc_location']==$loc){
				$qty=$value['qty'];
			}else{
				$qty='-'.$value['qty'];
			}

			// if ($value['jenis']=="out"){
			// 	$qty='-'.$value['qty'];
			// }else if($value['jenis']=="internal"){
			// 	if($value['id_desc_location']==$location){
			// 		$qty=$value['qty'];
			// 	}else{
			// 		$qty='-'.$value['qty'];
			// 	}

			// }else if($value['jenis']=="in"){
			// 	$qty=$value['qty'];
			// }else{
			// 	if($value['id_desc_location']!=$location){
			// 		$qty="-".$value['qty'];
			// 	}
			// }

			if(isset($value['note_id'])){
				$no_surat=substr($value['dn'], 0,7);
				if ($value['op']){
					$no_pb=$value['dn_poc'] . ', <b>No OP :</b> '. substr($value['op'], 0,7);	
				}else{
					$no_pb=$value['dn_poc'];	
				}
				
			}else if(isset($value['purchase_id'])){
				$no_surat=$value['no_po'];
				$no_pb=$value['no_pb_po'];
			}else if(isset($value['internal_move_id'])){
				$no_surat=$value['no_im'];
				$no_pb=$value['manual_pb_no'];
			}else{
				$no_surat=$value['no_int'];
				$no_pb=$value['ori'];
			}


			if($value['lbm']){
				if($no_pb==""){
					$no_pb='<strong>LBM No :</strong> '.$value['lbm'];		
				}else{
					$no_pb=$no_pb.', <strong>LBM No :</strong> '.$value['lbm'] ;
				}
			}else{
				$no_pb=$no_pb;
			}

			if($value['jenis']==""){
				$jenis='';
			}else{
				$jenis=$value['jenis'];
			}
			if($value['partner_id']){
				$cekpartner = new Query;
					$cekpartner
						->select('parent_id')
						->from('res_partner')
						->where(['id' => $value['partner_id']]);
					$res=$cekpartner->one();

				if($res['parent_id']==""){
					$partner=$value['partner'];
				}else{
					$parent = new Query;
					$parent
						->select('name')
						->from('res_partner')
						->where(['id' => $res['parent_id']]);
					$r=$parent->one();
					$partner=$r['name'];
				}
			}

			$body[]='<tr>
					<td>'.$no.'</td>
					<td>'.$jenis.'</td>
					<td>'.Yii::$app->formatter->asDatetime($value['date'], "php:d-m-Y").'</td>
					<td>'.$no_surat.'</td>
					<td>'.$no_pb.'</td>
					<td class=right>'.floatval($qty).'</td>
					<td>'.$value['location'].'</td>
					<td>'.$value['desc_location'].'</td>
					<td>'.$partner.'</td>
				 </tr>';
		$no++;
		}

	echo '<div class="judul">'.$nameproduct;
	echo '</div>';
	?>
	<h4 style="float:right;margin-top:-20px; margin-right:50px;">
		Location :
		<span id="siteSelection" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle">
				<?=Html::encode($site_active->name)?>
			</a>
			<?php
				$items = [];
				$items[] = ['label'=>'HEAD OFFICE','url'=>['','id'=>$product_id,'location'=>12]];
				foreach($location as $loc):
					$items[] = ['label'=>$loc['name'],'url'=>['','id'=>$product_id,'location'=>$loc['id']]];
				endforeach;

				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
	</h4>

	<?php
	if($status==true){
		echo "<table class='table table-striped table-bordered'>";
		echo $headTable;
		foreach ($body as $val) {
			echo $val;
		}
		echo "</table>";
	}else{
		echo '<div class="not_found">Data Tidak Ditemukan</div>';
	}

?>
