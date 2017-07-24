<?php
use yii\helpers\Url;
?>
<style type="text/css">
	/*body{
		background-color: #ccc;
	}*/
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
		margin-top: -85px;
		float: left;
	}
	.logo img{
		margin-top:-40px;
		margin-left: 10px;
		display: block;
	}
	.judul{
		font-size: 27px;
		margin-top: -35px;
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
	.headtable{
		/*border: 1px black solid;*/
		margin-left: 15px;
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
		font-size: 12px;
		line-height: 15px;
		text-align: center;
	}
	.content tr td{
		border: 1px solid black;
	}
	.tablefooter{
		float:left; width:100%; border-left:1px solid black; border-right:1px solid black; height:185px;
		border-bottom:1px solid black;
		/*margin-top: 90px;*/
		clear: both;
	}
	.tablefooter td{
		border: medium none !important;
		/*font-family: Times New Roman;*/
		font-size: 16px;
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
		line-height: 30px;
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
		/*line-height: 30px;*/
		font-size: 12px;
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
		margin-left: 15px;
		width: 186mm;
		margin-top: -9px;
		border-bottom:  1px solid black;
	}
	.contentLines tbody tr td {
		border-left:  1px solid black;
		border-right:  1px solid black;
		border-collapse: collapse;
		line-height: 20px;
		font-size: 13px;
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
	.leftdata li{

		margin-left: 10px !important;
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
		line-height: 30px;
		margin-left: 15px;
		margin-top: -1px;
	}
	.dataiso{
		text-align: center;
		width: 100px;
		float: left;
		font-size: 9px;
		margin-left: 17px;
	}
	.rigthheadtable{
		float: right;
		width: 48%;
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
	tr.tdHead td{
		text-align: left;
		vertical-align: top;
	}
</style>
	<?php 
		$no=1;
		foreach ($model->sbmAdhocOrderRequestOutputs as $value){

			if ($value->desc==null){
				$desc='';
			}else{
				$desc = $value->desc;
			}

			$noData = ' ';

			$data2[]=array(
				$no,
                '['.$value->item->default_code.'] '. $value->item->name_template,
				nl2br($desc),
				$value->qty,
				$value->uom->name);

			if ($value->sbmAdhocOrderRequestOutputMaterials){
				$data2[]=array(
					$noData,
					$noData,
					'<strong>Consist Of :</strong>',
					$noData,
					$noData,
				);
			}

			foreach ($value->sbmAdhocOrderRequestOutputMaterials as $detail) {
				$data2[]=array(
					$noData,
					$noData,
					'<li>['.$detail->item->default_code.'] '. $detail->item->name_template.'<br/>'.$detail->desc.' <strong>('.$detail->qty.' '.$detail->uom->name.')</strong></li>',
					$noData,
					$noData,
				);
			}

			$no++;
		}
		
	?>
<div id="pageContainer">
<div class="pages">
	<table>
		<tr style="vertical-align:top;">
			<td>
				<table style="width:100%;" cellpadding="3" cellspacing="2">
					<tr>
						<td>
							<div class="judul"><strong><h5><center>ADHOC ORDER REQUEST</center></h5></strong></div>
							<div class="judul"><strong><h6><center>#<?php echo $model->name; ?></center></h6></strong></div>
							<div class="logo">
								<img style="width:115px; float:left" src="<?= Url::base() ?>/img/logo.png">
								<div style="clear:both;"></div>
								<div class="dataiso">SBM-F-PCH-02/01<br/>
									12/01/30</div>
							</div>
							<div class="headtable" style="line-height:22px;">
									<table class="tablecontent leftheadtable">
										<tr class="tdHead">
											<td>Customer</td>
											<td>:</td>
											<td><?php echo $model->customer->name; ?></td>
										</tr>
										<tr class="tdHead">
											<td>Attention</td>
											<td>:</td>
											<td><?php echo $model->attention->name; ?></td>
										</tr>
										<tr class="tdHead">
											<td>Site Address</td>
											<td>:</td>
											<td>
												<?php
													if(isset($model->customerSite)){
														// print site Contact Name
														echo $model->customerSite->name;
														// print address
														echo '<br/>'.nl2br($model->customerSite->street);
														echo ($model->customerSite->street2 ? '<br/>'.$model->customerSite->street2:null);
														echo ($model->customerSite->city ? '<br/>'.$model->customerSite->city:null);
														if($model->customerSite->city and isset($model->customerSite->state)):
															echo ' - ';
														endif;

														echo (isset($model->customerSite->state) ? $model->customerSite->state->name:null);

														echo (isset($model->customerSite->country) ? '<br/>'.$model->customerSite->country->name:null);

													}else{
														echo '-';
													}
													
												?>
												
											</td>
										</tr>
									</table>
									<table class="tablecontent rigthheadtable">
										<tr class="tdHead">
											<td><b>Ref No (<?=strtoupper($model->cust_ref_type)?>)</b></td>
											<td>:</td>
											<td><b><?=$model->cust_ref_no?></b></td>
										</tr>
										<tr class="tdHead">
											<td>Due Date</td>
											<td>:</td>
											<td><?php echo Yii::$app->formatter->asDatetime($model->due_date, "php:d-M-Y")?></td>
										</tr>
										<tr class="tdHead">
											<td>Sales Man / Group</td>
											<td>:</td>
											<td><?php echo $model->salesMan->login; ?> / <span style="text-transform: uppercase;"><?php echo $model->saleGroup->name; ?> </span></td>
										</tr>
										<tr class="tdHead">
											<td>Term Of Payment</td>
											<td>:</td>
											<td><?php echo $model->termOfPayment->name; ?></td>
										</tr>
									</table>
								<div style="clear:both;"></div>
								</div>
						</td>
					</tr>
					<tr>
						<td>
						<?php $maxHeight = '170mm'; ?>
							<div class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
								<div class="contentArea">
									<table class="headtablepages contentLines">
											
											
									</table>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
</div>

<?php

$scope_of_work = preg_replace('#\R+#', '<br/>', str_replace('"','', $model->scope_of_work));
$term_condition = preg_replace('#\R+#', '<br/>', str_replace('"','', $model->term_condition));
$notes = preg_replace('#\R+#', '<br/>', str_replace('"','`', $model->notes));
$sales =$model->salesMan->login;

$footer ='"<tr><td colspan=5><table class=\"contentFooter\"><tr><td><p class=\"judulfooter\">Scope Of Work</p></td></tr><tr><td><p class=\"isi\">'.$scope_of_work.'</p></td></tr><tr><td><p class=\"judulfooter\">Term Condition</p></td></tr><tr><td><p class=\"isi\">'.$term_condition.'</p></td></tr><tr><td><p class=\"judulfooter\">Notes</p></td></tr><tr><td><p class=\"isi\">'.$notes.'</p></td></tr><tr><td><div class=\"leftheadtablefooter\"><span class=\"isi\" style=\"margin-left:-10px;\"><center>Product / Regional Manager</center></span><br/><br/><span class=\"isi\"><center>'.strtoupper($sales).'</center></span></div><div class=\"rigthheadtablefooter\"><span class=\"isi\"><center>General Manager/Director</center></span><br/><br/><span class=\"isi\"><center>(........................)</center></span></div></td></tr></table></td></tr>"';


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
		return "<tr class=\'cRows rows"+rowNo+"\'><td width=\'30px\' style=\"text-align:center;\">"+data[0]+"</td><td style=\"text-align:left;\" width=\'255px\'>"+data[1]+"</td><td width=\'276px\'><div class=\"leftdata\">"+data[2]+"</div></td><td width=\'60px\' style=\"text-align:center;\"><div class=\"center\">"+data[3]+"</div></td><td style=\"text-align:center;\" width=\'50px\'>"+data[4]+"</td></tr>";
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
			
			var resLine1 = "<tr><th width=30px height=25px>No.</th><th width=255px>ITEM / PN</th><th width=276px>Description</th><th width=60px>Qty</th><th width=50px>UNIT</th></tr>";
			var resLine = "<tr><td style=\"width:30px; height:"+setLineHeight+"px;  text-align:center;\"></td><td style=\"width:255px; text-align:center;\"></td><td style=\"width:276px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td style=\"width:60px; text-align:right;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td style=\"width:50px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
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
				var footer ='.$footer.';
				var res1 = "<tr><th width=30px height=25px>No.</th><th width=255px>ITEM / PN</th><th width=89px>DESCRIPTION</th><th width=60px>QTY</th><th width=50px>UNIT</th></tr>";
				var res = "<tr><td style=\"width:30px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:255px; text-align:center;\"></td><td style=\"width:89px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td style=\"width:60px; text-align:right;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td style=\"width:50px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
				jQuery(\'#lines\'+currPage+\' tr:first\').before(res1);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(footer);
				jQuery(\'#page\'+currPage+\' .hideprint\').show();
			}else{
				var footer ='.$footer.';
				var res1 = "<tr><th width=30px height=25px>No.</th><th width=255px>ITEM / PN</th><th width=89px>DESCRIPTION</th><th width=60px>QTY</th><th width=50px>UNIT</th></tr>";
				var res = "<tr><td style=\"width:30px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:255px; text-align:center;\"></td><td style=\"width:89px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td style=\"width:60px; text-align:right;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td style=\"width:50px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
				jQuery(\'#lines\'+currPage+\' tr:first\').before(res1);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(footer);
				jQuery(\'#page\'+currPage+\' .hideprint\').show();
			}			
		}

	// end loop
');
?>