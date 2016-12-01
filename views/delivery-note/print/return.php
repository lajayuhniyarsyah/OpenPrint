<?php
use yii\helpers\Url;


?>
<style type="text/css">
	#pageContainer{
		width: 200mm;
		margin-left: auto; margin-right: auto;
		page-break-after: always;
		font-family: Arial, Helvetica, sans-serif;
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

	.pages{
		padding-top:5mm;
		padding-left:4mm;
		page-break-after: always;
	}

		.logo{
		
		float: left;
	}
	.logo img{
		margin-left: 10px;
		display: block;
	}
	.logo .judul{
		font-size: 24px;
		margin-top: -60px;
		margin-left: 15px;
		font-family: Geneva, Arial, Helvetica, sans-serif;
		font-weight: bold;
		float: left;
		letter-spacing: 1px;
	}
	.iso{
		margin-top:10px;
		float: right;
		width: 50mm;
	}
	.do{
		font-size: 24px;
		font-weight: bold;
		margin-top: 0px;
		display: block;
		width: 100%;
		text-decoration: underline;
		margin-left: -100px;
	}

	.no_return{
		font-size: 20px;
		margin-left: -100px;
		margin-top: 0px;
		display: block;
		width: 100%;
	}
	.yth{
		display: block;
		float: left;
		/*font-family: Times New Roman;*/
		font-size: 14px;
		margin-left: 16px;
		margin-top: 12px;
		width: 50%;
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
		height: 75px;
		display: block;
	    margin-left: 2px;
	    margin-right: 2px;
	    margin-top:5px;
	    border: none;
	    background-image: url(<?= Url::base() ?>/img/square.png);
	    background-size: 350px;
	}
	.headtable{
		border: 1px black solid;
		margin-left: 15px;
		margin-top: 5px;
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
		border-collapse: collapse
	}
	.headtablepages tr th{
		border: 1px solid black;
		/*font-family: Times New Roman;*/
		font-size: 13px;
		line-height: 30px;
		text-align: center;
	}
	.content tr td{
		border: 1px solid black;
	}
	.tablefooter{
		float:left; width:703px; border-left:1px solid black; border-right:1px solid black; height:185px;
		border-bottom:1px solid black;
	}
	.tablefooter td{
		border: medium none !important;
		/*font-family: Times New Roman;*/
		font-size: 11px;
		text-align: center;
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
		line-height: 30px;
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
		line-height: 25px;
		font-size: 12px;
		vertical-align: top;
	}
	.leftdata{
		float: left;
		width: 75%;
		margin-left: 10px;
	}
	.rightdata{
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
		width:100%; float:left;  margin-left: 15px;margin-top: -9px;
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
		margin-left: 2px;
	}
</style>
<?php 
		
		$no=1;
		foreach ($model->stockMoves as $value) {
			$data2[]=array($no, $value->product_qty. ' '.$value->productUom->name ,'['.$value->product->default_code.'] '.$value->name,'');

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
							<div class="logo">
								<img style="width:115px; float:left" src="<?= Url::base() ?>/img/logo.png">
								<div style="clear:both;"></div>
								<div class="dataiso">SMB-F-SA-04b/01<br/>
									12/09/10</div>
							</div>
							<div class="do"><center>RETURN NOTES</center></div>
							<div class="no_return"><center> <?php echo $return_no; ?></center></div>
								<div class="customer">
									<fieldset>
										<div class="isicus">
										<b>

										</b>
										<br/>

											
										</div>
									</fieldset>
								</div>

								<div style="clear:both;"></div>
								<div class="headtable">
									<table class="tablecontent">
										<tr>
											<td width="100px">No.DN</td>
											<td>:</td>
											<td width="240px">
													<?php echo $model->note0->name; ?>												
											</td>

											<td width="50px">No.Received</td>
											<td>:</td>
											<td> <?php echo $model->name; ?></td>							
										</tr>
									</table>
								</div>
								<div class="headtable" style="margin-top:-1px;">
									<table class="tablecontent">

										<tr>
											<td width="100px">Customer</td>
											<td>:</td>
											<td width="500px">
												<?php echo $model->partner->name; ?>
											</td>


										</tr>
									</table>
								</div>
								<div class="headtable" style="margin-top:-1px;">
									<table class="tablecontent">

										<tr>
											<td width="100px">Customer Ref.</td>
											<td>:</td>
											<td width="400px"><?php echo $model->note0->poc; ?></td>
		
										</tr>
									</table>
								</div>
						</td>
					</tr>
					<tr>
						<td>
							<table class="headtablepages" style="width:186mm; border:1px solid black; border-collapse: collapse; margin-left:15px;">
									<tr>
										<th width="50px">No.</th>
										<th width="80px">Qty</th>
										<th width="350px">Product</th>
										<th width="210px">Reason</th>
									</tr>
							</table>
										</td>
									</tr>
									<tr>
										<?php $maxHeight = '110mm'; ?>
										<td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
											<div class="contentArea">
												<table class="contentLines">

												</table>
											</div>
										</td>
									</tr>
									<tr>
										<td>
									<div class="tablettd">
										<table class="tablefooter">
										<tr>
											<td>
												Dibuat Oleh, <br/><br/><br/><br/><br/><br/><br/>
												(.................................)
											</td>
											<td>
												Dicek Oleh ,<br/><b>Admin HO</b><br/><br/><br/><br/><br/><br/>
												(.................................)
											</td>
											<td>
												Disetujui Oleh,<br/> <b>Sales Manager</b><br/><br/><br/><br/><br/><br/>
												(.................................)
											</td>
										</tr>
									</table>
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
$this->registerJs('
	var currPage = 1;

	// save page template to var
	var tmpl = \'<div class="break">&nbsp;</div>\'+jQuery(\'div#pageContainer\').html();
	
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
	

	// data to render
	var lines = '.\yii\helpers\Json::encode($data2).';
	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	

	var currRow = 0;

	console.log(maxLinesHeight);

	function prepareRow(rowNo,data)
	{
		console.log(data[0]);
		return "<tr class=\'cRows rows"+rowNo+"\'><td contenteditable=\'true\' style=\"width:50px; text-align:center;\">"+data[0]+"</td><td style=\"width:80px; text-align:center;\">"+data[1]+"</td><td style=\"width:350px; text-align:left;\"><div class=\"leftdata\">"+data[2]+"</div></td><td style=\"width:210px; text-align:center;\"><div class=\"rightdata\">"+data[3]+"</div></td></tr>";
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

		var currLineHeight = jQuery(\'#tdLine\'+currPage).height();
		console.log(\'Key \'+key+\' \'+currLineHeight);
		if(currLineHeight>maxLinesHeight){
			// remove last row
			jQuery(\'table#lines\'+currPage+\' tr:last\').remove();
			
			var pageHeight=jQuery(\'#lines\'+currPage).height();
			// alert(pageHeight);
			var setLineHeight=439-pageHeight;
			
			var resLine = "<tr><td style=\"width:50px; height:"+setLineHeight+"px;  text-align:center;\"></td><td style=\"width:80px; text-align:center;\"></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
			jQuery(\'#lines\'+currPage+\' tr:last\').after(resLine);

			// add new page container
			jQuery(\'div#page\'+currPage).after(tmpl);
			currPage = currPage+1;
			console.log(currPage);
			// add id to new div
			jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
			jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
			jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

			jQuery(\'table#lines\'+currPage).html(getRow);
			currLineHeight = jQuery(\'#tdLine\'+currPage).height();
			// console.log(tmpl);
		}

		
		console.log(\'Rendering Page \'+currPage+\' Row \'+currRow+\' Height => \'+currLineHeight);
		currRow=currRow+1;
	});
		var HeightTable=jQuery(\'#tdLine\'+currPage).height();
		var cektable=jQuery(\'#lines\'+currPage).height();
		var SetHeight=HeightTable-cektable+35;

		if (cektable < HeightTable){
			var res = "<tr><td style=\"width:50px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:80px; text-align:center;\"></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td><td><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
			jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
		}
	// end loop
');
?>