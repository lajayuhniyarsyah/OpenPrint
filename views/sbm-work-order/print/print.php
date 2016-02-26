<?php
use yii\helpers\Url;
?>
<style type="text/css">
	body{
		background-color: #ccc;
	}
	#pageContainer{
		background-color: #fff;
		width: 198mm;
		margin-left: auto; margin-right: auto;
		page-break-after: always;
		font-family: Arial, Helvetica, sans-serif;
		margin-top: -8px;
	}
	table{
		/* border-top: 1px solid black;
		border-bottom: 1px solid black; */
	}
	.contener{
		border: 1px solid black;
		margin-left: auto; margin-right: auto;
		page-break-after: always;
		font-family: Arial, Helvetica, sans-serif;
	}
	.header{
		height: 10%;
	}
	.content{
		height: 80%;
	}

	.hideprint{
		display: none;
	}
	.pages{
		padding-top:5mm;
		padding-left:4mm;
		page-break-after: always;
	}
	.logo{
		width: 140mm;
		float: left;
	}
	.logo img{
		display: block;
	}
	.judul{
		font-size: 27px;
		margin-top: -70px;
		margin-left: 15px;
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-weight: bold;
		float: center;
		letter-spacing: 1px;
	}
	.iso{
		margin-top:10px;
		float: right;
		width: 50mm;
	}
	.noborder{
		border-left: none !important;
	}
	.do{
		font-size: 22px;
		font-weight: bold;
		margin-left: 15px;
		margin-top: 10px;
		/*position: absolute;*/
		/*font-family: Times New Roman;*/
		float: left;
	}
	.yth{
		display: block;
		float: left;
		/*font-family: Times New Roman;*/
		font-size: 12px;
		margin-left: 15px;
		width: 98%;
		line-height: 17px;
	}
	.customer{
		float: right;
		width: 40%;
		display: block;
		margin-right: 10px;
		margin-top: -23px;
	}
	fieldset{
		width: 271px;
		height: 95px;
		display: block;
	    margin-left: 2px;
	    margin-right: 2px;
	    margin-top:5px;
	    border: none;
	    background-image: url(<?= Url::base() ?>/img/square.png);
	    background-size: 350px;
	}
	.headtable td{
		vertical-align: top;
	}
	.headtable{
		/*border: 1px black solid;*/
		margin-top: 5px;
		margin-bottom: 10px;
		margin-right: 1px;
		line-height: :22px !important;
	}		
	.isicus{
		display: block;
		font-size: 12px;
		margin-left: 10px;
		margin-top: 22px;
	}
	.content{
		margin-left: 15px;
		margin-top: 15px;
		 margin-right:20px;
	}
	.content table .headtable{
		border-collapse: collapse;
	}
	.headtablepages tr th{
		border: 1px solid black;
		/*font-family: Times New Roman;*/
		font-size: 13pt;
		line-height: 15px;
		text-align: center;
	}
	.content tr td{
		border: 1px solid black;
	}
	.tablefooter{
		float:left; width:100%; border-left:1px solid black; border-right:1px solid black; height:100px;
		border-bottom:1px solid black;
		/*margin-top: 90px;*/
		clear: both;
	}
	.tablefooter td{
		border: medium none !important;
		/*font-family: Times New Roman;*/
		vertical-align: top;
		font-size: 12px;
		padding-left: 10px;
		line-height: 19px;
	}
	.isigudang{
		margin-top:35px;
		margin-left: 40px;
		text-align: left;
		font-weight: bold;
		/*font-family: Times New Roman;*/
	}
	.gudang{
		margin-left: 40px;
		border: none;
		/*font-family: Times New Roman;*/
	}
	.gudang td{
		line-height: 50px;
		border: none !important;
		font-size: 12px;

	}
	.data{
		position: absolute;
		border-collapse: collapse;
		border: none !important; 
		max-height: 300px;
	}
	.data td{
		border: none !important; 
		font-size: 18px;

	}
	.tablecontent{
		/*line-height: 50px;*/
		font-size: 14px;
		/*font-family: Times New Roman;*/
	}
	@media all {
		.page-break	{ display: none; }
	}
	@media print {
		.page-break	{ display: block; page-break-before: always; }
		.break{
			height:1mm !important;
		}
		.tglkirim{
			width: 203px !important;
		}

	}
	.pages{
		height: 245mm;
		padding-left:4mm;
		page-break-after: always;
	}
	.contentFooter{
	 	border-top: 1px solid black;
	    border-collapse: collapse;
	    margin-left: 0px;
	    margin-top: 0;
	    width: 186mm;
	    text-align: justify;
	}

.contentFooter tbody tr td {
  border-collapse: collapse;
  border-left: 0px solid black !important;
  border-right: 0px solid black !important;
  font-size: 14px;
  line-height: 20px;
  vertical-align: top;
}

	.contentLines{
		border-collapse: collapse;
		width: 186mm;
		margin-top: -9px;
		border-bottom:  1px solid black;
		font-size: 12pt;
	}
	.contentLines tbody tr td {
		border-left:  1px solid black;
		border-right:  1px solid black;
		border-collapse: collapse;
		line-height: 20px;
		font-size: 13pt;
		vertical-align: top;
	}
	.lineTable{
		border: 1px solid black;
	}
	.leftdata{
		float: left;
		width: 95%;
		text-align: justify;
		margin-left: 10px;
	}
	.rightdata{
		width: 18%;
		float: right;
		margin-right: 10px;
		text-align: right;
	}
	.tglkirim{
		width: 203px;
	}
	.break{
		height:100mm;
	}
	.tablettd{
		width:98%; float:left;  margin-left: 15px;margin-top: -9px;
	}
	.tblkirim{
		border-collapse: collapse;
		float: left;
		/*font-family: Times New Roman;*/
		font-size: 12px;
		line-height: 50px;
		margin-left: 15px;
		margin-top: -1px;
	}
	.dataiso{
		text-align: center;
		width: 100px;
		float: left;
		font-size: 9px;
	}
	.rigthheadtable{
		float: right;
		width: 48%;
		margin-top: -60px;
	}
	.leftheadtable{
		float: left;
		width: 52%;
		/*border-right: 1px solid black;*/
	}

	.rigthheadtablefooter{
		float: right;
		width: 38%;
	}
	.leftheadtablefooter{
		float: left;
		width: 32%;
		/*border-right: 1px solid black;*/
	}
	.cus{
		font-size: 22px;
		font-weight: bold;
	}
	.almt{
		font-size: 15px;
	}
    .space{
        line-height: 25px;
    }
	.dtlcus{
		font-size: 14px;
        margin-top: -15px;
		margin-left: 5px;
	}
	.total{
		 width:186mm; border:1px solid black; border-collapse: collapse; margin-left:15px;margin-top:-9px;
	}
	.total td{
		border:1px solid black;
		font-size: 16px;
	}
	.isi{
		font-size: 11px;
		margin-top: -3px;
		padding: 5px;
	}
	.judulfooter{
		font-size: 12px;
		text-transform: uppercase;
		font-weight: bold;
		padding-left: 5px;	
		line-height: 0px;
	}
	.headkordinator{
		clear: both;
	    font-size: 12px;
	    margin-left: 5px;
	}
	.name{
		font-size: 15pt;
		margin-top:5px;

	}
	.material{
		font-size: 11pt;
		margin-left: 25px;
		font-weight: bold;
	}
	ul{
		margin-top: -2px;
	}
</style>
	<?php 
		$no=1;
		foreach ($model->sbmWorkOrderOutputs as $value){

		if($value->sbmWorkOrderOutputRawMaterials){
			$detail='';

			foreach ($value->sbmWorkOrderOutputRawMaterials as $material) {
				$detail.='<li>'.'['.$material->item->default_code.'] '.$material->item->name_template.' ('.$material->qty.' '.$material->uom->name.')<br/>'.$material->desc.'</li>';
			}
			$pekerjaan ='['.$value->item->default_code.'] '.$material->item->name_template.'<br/>'.$value->desc.'
						<br/><span class=material>Material Detail</span>:<ul>'.$detail.'</ul>';
		}else{
			$pekerjaan ='['.$value->item->default_code.'] '.$value->item->name_template.'<br/>'.$value->desc;
		}

		$data2[]=array(
			$no,
            $value->qty.' '.$value->uom->name,
			$pekerjaan);
		$no++;
	}
		
	  if($model->adhoc_order_request_id){
	  	$nokontrak=$model->adhocOrderRequest->name;
	  }else if($model->sale_order_id){
	  	$nokontrak=$model->saleOrder->name;
	  }

	  $alamat='';
	  if($model->customer_site_id){
	  	$alamat=$model->customerSite->street;
	  }

	  if($model->work_location=='customersite'){
	  	$loc ='CS';
	  }else{
	  	$loc ='WS';
	  }

	  $no_spk=$model->wo_no;
	?>
<div id="pageContainer">
<div class="pages">
	<table style="margin-top:50px;">
		<tr style="vertical-align:top;">
			<td>
				<table style="width:100%;" cellpadding="3" cellspacing="2">
					<thead>
						<tr>
							<td>
								<div class="logo">
									<img style="width:115px; float:left" src="<?= Url::base() ?>/img/logo.png">
									<div style="clear:both;"></div>
									<div class="dataiso">SBM-F-PCH-02/01<br/>12/01/30</div>
									<div class="judul"><strong><h5>PT.SUPRABAKTI MANDIRI</h5></strong></div>
								</div>
								<div class="headkordinator">
								Kepada Yth <br/>
								Sdr. Kordinator <br/>
								Di Tempat
								</div>
								<div class="name"><strong>SURAT PERINTAH KERJA</strong></div>

								<div class="headtable" style="line-height:22px;">
										<table class="tablecontent leftheadtable" border="1">
											<tr style="height:50px;">
												<td width="108px;">Untuk Customer</td>
												<td width="6px;">:</td>
												<td width="237px;">
												<?php 
												echo $model->customer->name.'<br/>'.$alamat; 
												?></td>
											</tr>
											
											<tr>
												<td>Dikerjaka Di</td>
												<td>:</td>
												<td><?php 
												echo $model->location->name; ?></td>
											</tr>
										</table>
										<table class="tablecontent rigthheadtable" border="1">
											<tr>
												<td width="110px;">Nomor SPK</td>
												<td width="6px;">:</td>
												<td>
												<?php 
												echo $no_spk;
												?>
												</td>
											</tr>
											<tr>
												<td>Tanggal SPK</td>
												<td>:</td>
												<td><?php 
												echo Yii::$app->formatter->asDatetime(date("d-M-Y"), "php:d-M-Y") ?></td>
											</tr>
											<tr>
												<td>No. Kontrak</td>
												<td>:</td>
												<td><?php 
												echo $nokontrak; ?></td>
											</tr>
											<tr>
												<td>Tgl.Kontrak</td>
												<td>:</td>
												<td>
												<?php 
												echo Yii::$app->formatter->asDatetime($model->order_date, "php:d-M-Y")
												?>
												</td>
											</tr>
											<tr>
												<td>Delivery Time</td>
												<td>:</td>
												<td><?php 
												// echo $model->salesMan->name; ?> / <span style="text-transform: uppercase;"><?php 
												// 	echo $model->saleGroup->name; ?> </span></td>
											</tr>
										</table>
									<div style="clear:both;"></div>
									</div>
							</td>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td>
								<table border="1" class="tablefooter">
									<tr>
										<td>
											<center>Dibuat Oleh</center>
										</td>
										<td>
											<center>Diperiksa Oleh</center>
										</td>
										<td>
											<center>Disetujui Oleh, <br/> General Manager</center>
											<br/>
											<br/>
										</td>
									</tr>
									<tr>
										<td>
											<center>(........................)</center>
										</td>
										<td>
											<center>(........................)</center>
										</td>
										<td>
											<center>(........................)</center>
										</td>
									</tr>
								</table>
							</td>
						</tr>

					</tfoot>
					<tbody>
						<tr>
							<td>
							<?php $maxHeight = '150mm'; ?>
								<div class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
									<div class="contentArea">
										<table class="headtablepages contentLines">
												
												
										</table>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</div>
</div>

<?php


$this->registerJs('
	var currPage = 1;

	// save page template to var
	var tmpl = \'<div class="break">&nbsp;</div>\'+jQuery(\'div#pageContainer\').html();
	
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'div.tdLines\').attr(\'id\',\'tdLine\'+currPage);
	jQuery(\'tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
	

	// data to render
	var lines = '.\yii\helpers\Json::encode($data2).';
	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	
	
	var currRow = 0;

	console.log(maxLinesHeight);
	
	function prepareRow(rowNo,data)
	{
		console.log(data[0]);
		return "<tr class=\'cRows rows"+rowNo+"\'><td width=\'50px\' style=\"text-align:center;\">"+data[0]+"</td><td style=\"text-align:center;\" width=\'170px\'>"+data[1]+"</td><td width=\'451px\'><div class=\"leftdata\">"+data[2]+"</div></td></tr>";
	}

	var rowPage = 0;
	jQuery.each(lines,function(key,line){
		var getRow = prepareRow(currRow,line);
		if(key==0)
		{
			jQuery(\'table#lines\'+currPage).html(getRow);
		}
		else
		{
			jQuery(\'table#lines\'+currPage+\' tr:last\').after(getRow);
		}
		rowPage = rowPage+1;

		var currLineHeight = jQuery(\'#lines\'+currPage).height();
		// var currLineHeight = jQuery(\'#tdLine\'+currPage).height();
		console.log(\'Key \'+key+\' \'+currLineHeight);

		if(currLineHeight>maxLinesHeight){
			// remove last row
			jQuery(\'table#lines\'+currPage+\' tr:last\').remove();
			
			var pageHeight=jQuery(\'#lines\'+currPage).height();
			// alert(pageHeight);
			var setLineHeight=439-pageHeight;
			
			var resLine1 = "<tr><th width=50px height=25px>No.</th><th width=170px>Jumlah</th><th width=451px>Uraian Pekerjaan</th></tr>";
			var resLine = "<tr><td style=\"width:50px; height:"+setLineHeight+"px;  text-align:center;\"></td><td style=\"width:170px; text-align:center;\"></td><td style=\"width:451px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
			jQuery(\'#lines\'+currPage+\' tr:first\').before(resLine1);
			jQuery(\'#lines\'+currPage+\' tr:last\').after(resLine);

			// add new page container
			jQuery(\'div#page\'+currPage).after(tmpl);
			currPage = currPage+1;
			console.log(currPage);
			// add id to new div
			jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
			jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
			jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);


			jQuery(\'table#lines\'+currPage).html(getRow);
			currLineHeight = jQuery(\'#tdLine\'+currPage).height();
			// console.log(tmpl);
		}

		
		console.log(\'Rendering Page \'+currPage+\' Row \'+currRow+\' Height => \'+currLineHeight);
		currRow=currRow+1;
	});
		var HeightTable=jQuery(\'#tdLine\'+currPage).height();
		var cektable=jQuery(\'#lines\'+currPage).height();
		var SetHeight=(HeightTable-cektable)-23;
		var MinHeight=(HeightTable-cektable)-23;
		

		if(currPage){
			if (cektable < HeightTable){
				var res1 = "<tr><th width=50px height=25px>No.</th><th width=170px>Jumlah</th><th width=451px>Uraian Pekerjaan</th></tr>";
				var res = "<tr><td style=\"width:50px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:170px; text-align:center;\"></td><td style=\"width:451px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
				jQuery(\'#lines\'+currPage+\' tr:first\').before(res1);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
				jQuery(\'#page\'+currPage+\' .hideprint\').show();
			}else{
				var res1 = "<tr><th width=50px height=25px>No.</th><th width=170px>ITEM / PN</th><th width=451px>DESCRIPTION</th></tr>";
				var res = "<tr><td style=\"width:50px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:170px; text-align:center;\"></td><td style=\"width:451px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
				jQuery(\'#lines\'+currPage+\' tr:first\').before(res1);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
				jQuery(\'#page\'+currPage+\' .hideprint\').show();
			}			
		}

	// end loop
');
?>