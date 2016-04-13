<?php
use yii\helpers\Url;
?>
<head>
<title>Print Out Product Split</title>	
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
		margin-left: 0px;
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
		width: 30%;
	}
	.centertablefooter{
		float: left;
		width: 30%;
	}
	.leftheadtablefooter{
		float: left;
		width: 30%;
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
    .contentLines th{
    	text-transform: uppercase;
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
</style>

</head>
	<?php 
		$no=1;
		foreach ($model->stockSplitItems as $value){

			foreach ($value->stockSplitItems0 as $detail) {
				$data2[]=array(
					$no,
					'[ '.$value->productSplit->itemToSplit->default_code.' ] '.$value->productSplit->itemToSplit->name_template.'<br/><strong>('.$value->qty.' '.$value->uom->name.')</strong>',
					'[ '.$detail->productSplit0->itemSplitedTo->default_code.' ] '.$detail->productSplit0->itemSplitedTo->name_template.'<br/><strong>('.$detail->qty.' '.$detail->uom->name.')</strong>',
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
							<div class="judul"><strong><h5><center><u>STOCK SPLIT ORDER</u></center></h5></strong></div>
							<div class="judul"><strong><h6><center>#<?php echo $model->stock_split_no; ?></center></h6></strong></div>
							<div class="logo">
								<img style="width:115px; float:left" src="<?= Url::base() ?>/img/logo.png">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<table style="width:50%; float:left">
								<tr>
									<td>Warehouse</td><td>:</td><td><?php echo $model->location0->name ?></td>
								</tr>
							</table>
							<table style="width:50%;float:left">
								<tr>
									<td>Date</td><td>:</td><td><?php echo Yii::$app->formatter->asDatetime($model->date_order	, "php:d-M-Y") ?></td>
								</tr>
							</table>
							<br/>
							<br/>
							<br/>
						</td>
					</tr>
					<tr>
						<td>
							<table>
								<tr>
									<td>Order to Split stock Item with Detail :</td>
								</tr>
							</table>
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
$notes = preg_replace('#\R+#', '<br/>', str_replace('"','', $model->notes));
$user=$model->createU->name;
$footer ='"<tr><td colspan=5><table class=\"contentFooter\"><tr><td><p class=\"judulfooter\">Notes :</p></td></tr><tr><td><p class=\"isi\">'.$notes.'</p></td></tr><tr><td><div class=\"leftheadtablefooter\"><span class=\"isi\" style=\"margin-left:-10px;\"><center>Yang Membuat</center></span><br/><br/><span class=\"isi\"><center>'.$user.'</center></span></div><div class=\"centertablefooter\"><span class=\"isi\" style=\"margin-left:-10px;\"><center>Approval</center></span><br/><br/><span class=\"isi\"><center>(SPV/Admin Manager)</center></span></div><div class=\"rigthheadtablefooter\"><span class=\"isi\"><center>Mengetahui</center></span><br/><br/><span class=\"isi\"><center>(Warehouse Manager)</center></span></div></td></tr></table></td></tr>"';


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
		return "<tr class=\'cRows rows"+rowNo+"\'><td width=\'30px\' style=\"text-align:center;\">"+data[0]+"</td><td style=\"text-align:left;\" width=\'255px\'>"+data[1]+"</td><td width=\'276px\'><div class=\"leftdata\">"+data[2]+"</div></td></tr>";
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

			var setLineHeight=439-pageHeight;
			
			var resLine1 = "<tr><th width=30px height=25px>No.</th><th width=255px>Item To Split</th><th width=276px>Splited To</th></tr>";
			var resLine = "<tr><td style=\"width:30px; height:"+setLineHeight+"px;  text-align:center;\"></td><td style=\"width:255px; text-align:center;\"></td><td style=\"width:276px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></tr>";
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
				var res1 = "<tr><th width=30px height=25px>No.</th><th width=255px>Item To Split</th><th width=89px>Splited To</th></tr>";
				var res = "<tr><td style=\"width:30px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:255px; text-align:center;\"></td><td style=\"width:89px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
				jQuery(\'#lines\'+currPage+\' tr:first\').before(res1);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(footer);
				jQuery(\'#page\'+currPage+\' .hideprint\').show();
			}else{
				var footer ='.$footer.';
				var res1 = "<tr><th width=30px height=25px>No.</th><th width=255px>Item To Split</th><th width=89px>Splited To</th></tr>";
				var res = "<tr><td style=\"width:30px; height:"+SetHeight+"px;  text-align:center;\"></td><td style=\"width:255px; text-align:center;\"></td><td style=\"width:89px; text-align:center;\"><div class=\"leftdata\"></div><div class=\"rightdata\"></div></td></tr>";
				jQuery(\'#lines\'+currPage+\' tr:first\').before(res1);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(res);
				jQuery(\'#lines\'+currPage+\' tr:last\').after(footer);
				jQuery(\'#page\'+currPage+\' .hideprint\').show();
			}			
		}

	// end loop
');
?>