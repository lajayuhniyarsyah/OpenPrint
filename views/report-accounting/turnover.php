	<?php
	use yii\db\Query;
?>
<?php
	$jenisreport="out";
	
		/* ============================= Print out Untuk Surat Jalan  ===========================================  */
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
		foreach ($data as $value) {

			if ($value['jenis']=="out"){
				$qty='-'.$value['qty'];
			}else if($value['jenis']=="internal"){
				if($value['id_desc_location']==12){
					$qty=$value['qty'];
				}else{
					$qty='-'.$value['qty'];
				}

			}else if($value['jenis']=="in"){
				$qty=$value['qty'];
			}

			// Jika Product Des Location di Head Office
			else if($value['jenis']=="" && $value['id_desc_location']==12){
				$qty=$value['qty'];
			}
			// Jika Product Potongan, Head Office ke Scrapped
			else if($value['jenis']=="" && $value['id_desc_location']==4){
				$qty='-'.$value['qty'];
			}
			// Jika Product Potongan, Head Office ke Potongan OUT
			else if($value['jenis']=="" && $value['id_desc_location']==47){
				$qty='-'.$value['qty'];
			}
			// Jika Ada Ajustment, dimana barang dari HO ke Inventory Lost
			else if($value['jenis']=="" && $value['id_desc_location']==5){
				$qty='-'.$value['qty'];
			}
			// Jika Potongan IN ke Warehouse 
			else if($value['jenis']=="" && $value['id_desc_location']==5){
				$qty='-'.$value['qty'];
			}


			if ($value['jenis']=="internal"){
				$no_surat=$value['no_int'];
				$no_pb=$value['ori'];
			}else if($value['jenis']=="in"){
				$no_surat=$value['ref_cus'];
				$no_pb='LBM No '.$value['lbm'];
			}else{
				$no_surat=substr($value['dn'], 0,7);
				$no_pb=substr($value['op'], 0,7);
			}

			if($value['jenis']==""){
				$jenis=$value['product_name'];
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

	echo '<div class="judul">'.$nameproduct.'</div>';

	echo "<table class='table table-striped table-bordered'>";
	echo $headTable;
	foreach ($body as $val) {
		echo $val;
	}
	echo "</table>";

?>
