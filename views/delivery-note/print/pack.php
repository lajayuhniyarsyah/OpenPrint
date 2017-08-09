<?php
use yii\helpers\Html;
use yii\helpers\Url;
// echo $printer;
if($model->state!='submited' && !$forced){
	echo 'Status == <b>'.strtoupper($model->state).'</b><br/>';
	die('Print Hanya pada saat Submit!');
}
$printer='lx300-novri';


?>

<style type="text/css">
	#container
	{
		width: 190mm;
		/*border: 1px solid black;*/
		padding-left: 13mm;
		vertical-align: top;
		font-family: Arial, Helvetica, sans-serif;

	}
	.pages
	{
		
		padding-top: 238px;
		page-break-after: always;
		height: 283mm;
		/*border-top: 1px solid green;*/
		/*border-bottom: 1px solid red;*/
	}
	<?php
	/*if($uid==173){
		echo '.pages
		{
			
			padding-top: 60mm;
			page-break-after: always;
			height: 283mm;
		}';
	}
	elseif($uid==101){
// 		if user sri perlu naik spacer footer nya agar tidak ke halaman 2 tanda tangannya
		echo '.sign {
		    margin-top: 20mm !30portant;
		    text-decoration: underline;
		}';
	}*/
	?>
	.pager
	{
		margin-top: 88mm;
		margin-left: 181mm;
	}

	.headers
	{
		
		/*border-bottom: 1px solid black;*/
		/*height: 75mm;*/
		height: 289px;
		padding-left: 25mm;
	}
	.hLine{
		height: 6mm;
	}
	.datePrint{
		margin-left: 10mm;
	}
	.attnTo
	{
		float: left;
		width: 46%;
		padding-top: 13mm;
		font-size: 11pt;
	}
	.UrgentCode{
		font-size: 50pt;
		float: right;
		margin-right: 10mm;
		margin-top: 10mm;
		font-weight: bold;
	}

	.partnerName
	{
		font-size: 12pt;
	}
	.tdLines
	{
		min-height: 432px;
		/*min-height: 120mm;*/
		
		/*border-bottom: 1px solid blue;*/
		font-size: 10pt;
	}
	.contentLines tr td{
		vertical-align: top;
	}
	.dnInfo
	{
		/*float: right;*/

	}
	.dnNo
	{
		font-size: 12pt;
		padding-top: 5%;
		padding-left: 51%;
	}
	.opNo
	{
		margin-top: 9%;
		padding-left: 61%;
		font-size: 12pt;

	}
	.poc
	{
		margin-top: 8%;
		padding-left: 49%;
		font-size: 12pt;
	}
	.pagesInfo{
		margin-left: 134mm;
		margin-top: 10mm;

	}

	.td1{
		width: 22mm;
		text-align: center;
	}
	.td2{
		padding-left: 5px;
		width: 16mm;
	}
	.td3{
		width: 87mm;
	}
	.td4{
		width: 19mm;
	}
	.td5{
		width: 40mm;
	}


	.footers .totalItem{
		width: 44mm;
		float: left;
	}
	.footers .totalBox{
		width: 84mm;
		height: 14mm;
		text-align: center;
		float: left;
	}
	.footers .totalWeight{
		float: left;
	}
	.clear{
		clear: both;
	}
	.POInfo{
		padding-left: 41mm;
		width: 86mm;
	}
	.sign{
		margin-top: 102px;
		text-decoration: underline;
		font-size: 11px;
	}
	.totalRow{
		margin-top: 5mm;
	}
	.font11{
		font-size: 11pt;
	}
	.choosePrinter{
		position: absolute;
		z-index: 9999;
		right: 0;
	}
	@media print
	{
		#container{
			border: none;
		}
		.choosePrinter{
			display: none;
		}
		
	}
	
</style>

<?php
	if($printer=='lq300-hadi'){
		?>
		<style type="text/css">
			.pages{
				height: 238mm;
				padding-top: 173px;
			}
			.pages:not(:first-child){
				padding-top: 47mm;
			}
			.headers{
				height: 66mm;
				padding-left: 24mm !important;
			}
			.hLine{
				height: 6mm;
			}
			.tdLines{
				min-height: 98mm;
			}
			.footers .totalBox{
				height: 5mm;
			}
			
			.td1{
				width: 21mm;
			}
			.td2{
				padding-left: 7px !important;
			}
			.td4{
				 width: 18mm !important;
			}

			<?php
			
			if($uid==101){
				echo '.pages
					{
						
						padding-top: 47mm;
						page-break-after: always;
						height: 250mm;
					}
					.POInfo{
						margin-top: 7mm;
					}
					.pages:not(:first-child){
						padding-top: 49mm;
					}
					.td4,.td5{text-align:center;}

					.tdLines{
						min-height: 99mm;
					}
					.footers .totalBox {
    					width: 87mm;
    				}
    				.totalRow{
    					 margin-top: 3mm;
    				}';
			}
			else{
				echo '.sign{
					text-decoration: underline;
				}';
			}
			?>
			
		</style>
		<?php
	}
?>
<div class="choosePrinter">
	<form method="get" id="formSelectPrinter">
			<input type="hidden" value="<?=Url::to('delivery-note/print-pack')?>" name="r" />
			<input type="hidden" value="<?=$model->id?>" name="id" />
			<input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
		Print To : <select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
			<!-- <option <?=(strtolower($printer)=='lq300-hadi' ? 'selected ':null)?> value="lq300-hadi">Admin Hadi (LQ 300+II)</option> -->
			<!-- selected karena printer hadi sudah tidak dipakai -->
			<option <?=(strtolower($printer)=='lx300-novri' ? 'selected ':'selected')?> value="lx300-novri">Admin Novri (LX 300+II)</option>
		</select>
	</form>
</div>

<div id="container">
	<div class="pages">
		<div class="headers">
			<div class="attnTo">
				<div class="to hLine" contenteditable="true"><?=$model->partner->name?></div>
				<div class="attn hLine" contenteditable="true"><?=(isset($model->attn0) ? $model->attn0->name:null)?></div>
				<div class="datePrint hLine">
					<?=strtoupper(date('F-Y'))?>
				</div>
				<div class="ref hLine"><?=$model->name?></div>
			</div>
			<div class="UrgentCode">
				
			</div>
			<div class="clear"></div>
			<div class="pageInfo">
				<div class="pagesInfo">
					<div class="boxInfo"></div>
					<div class="pageNo"></div>
				</div>
			</div>
		</div>
		<div class="tdLines">
			<table class="contentLines">
				
			</table>
		</div>
		<div class="footers">
			<div class="totalRow">
				<div class="total totalItem"></div>
				<div class="total totalBox"></div>
				<div class="total totalWeight"></div>
				<div class="clear"></div>
			</div>
			<div class="POInfo" >
				<div class="noteline">
				</div>
				<div class="colorCode"></div>
			</div>
			<div class="sign" contenteditable="true"><?php echo $model->signature0 ? $model->signature0->name_related:null; ?></div>
		</div>
	</div>
</div>

<?php

$scr = '
	function pad (str, max) {
		str = str.toString();
		return str.length < max ? pad("0" + str, max) : str;
	}
	var currPage = 1;
	var pagesData = '.\yii\helpers\Json::encode($pagesData).';
	// console.log(pagesData);

	// save page template to var
	var tmpl = jQuery(\'div#container\').html();
	
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	var currRow = 0;
	//console.log(maxLinesHeight);
	var rowPage = 0;

	function prepareRow(rowNo,data)
	{
		return "<tr class=\'cRows rows"+rowNo+"\'><td class=\'td1\'>"+data.no+"</td><td class=\'td2\'>"+data.qty+"</td><td class=\'td3\'>"+data.product+"<br/>"+data.desc+"</td><td class=\'td4\'>"+data.weight+"</td><td class=\'td5\'>"+data.measurement+"</td></tr>";
	}
	var totalPageBox = [];
	var packData = [];
	jQuery.each(pagesData,function(packQue,pageData){
		packData[packQue] = [];
		if(!totalPageBox[packQue])
		{
			totalPageBox[packQue] = 0;
		}
		packData[packQue][\'len\'] = pageData.lines.length;
		console.log(pageData.totalWeight);
		var pagePerbox=1;
		jQuery.each(pageData.lines,function(n,line)
		{
			var getRow = prepareRow(currRow,line);
			//console.log(\'Printting Box \'+packQue+\' in page \'+currPage+\' line \'+n+\' for \'+line.product);
			if(packQue==0)
			{
				// if first pack
				if(n==0)
				{
					// if first item on first pack
					jQuery(\'#lines\'+currPage).html(getRow);
				}
				else
				{
					jQuery(\'#lines\'+currPage+\' tr:last\').after(getRow);
				}
			}
			else{

				// put new printing page for new pack
				if(n==0){
					// if first item in next pack
					jQuery(\'div#page\'+currPage).after(tmpl);
					// console.log(\'div#page\'+currPage);
					currPage = currPage+1;
					// console.log(currPage);
					// add id to new div
					jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
					jQuery(\'.contentLines:last\').attr(\'id\',\'lines\'+currPage);
					jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
					jQuery(\'#lines\'+currPage).html(getRow);
				}else{
					jQuery(\'#lines\'+currPage+\' tr:last\').after(getRow);
				}
			}

			var currLinesHeight = jQuery(\'.tdLines:last\').height();
			// console.log(\'current height : \'+currLinesHeight);

			if(maxLinesHeight < currLinesHeight)
			{
				// remove last row
				jQuery(\'#lines\'+currPage+\' tr:last\').remove();
				// add new page container
				jQuery(\'div#page\'+currPage).after(tmpl);
				// console.log(\'div#page\'+currPage);
				currPage = currPage+1;
				pagePerbox = pagePerbox+1;
				// console.log(currPage);
				// add id to new div
				jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
				jQuery(\'.contentLines:last\').attr(\'id\',\'lines\'+currPage);
				jQuery(\'.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

				jQuery(\'#lines\'+currPage).html(getRow);
				currLineHeight = jQuery(\'#tdLine\'+currPage).height();
				// jQuery(\'.pager:last\').html(currPage);
				// console.log(tmpl);
			}
			jQuery(\'#page\'+currPage+\' .pagesInfo .boxInfo\').html(\'Box \'+pad(packQue+1,2)+\' of \'+pad(pagesData.length,2));
			jQuery(\'#page\'+currPage+\' .pagesInfo .pageNo\').html(\'P. \'+pad(pagePerbox,2)+\' of <span class="pageTotalInfo\'+packQue+\'"></span>\');
			rowPage = rowPage+1;
			currRow=currRow+1;
			totalPageBox[packQue] = pagePerbox;
			jQuery(\'.footers:last .totalRow .totalItem\').html(\'Total : \'+pageData.lines.length+\' Items\');
			jQuery(\'.footers:last .totalRow .totalBox\').html(\'TOTAL : 1 BOX\');
			jQuery(\'.footers:last .totalRow .totalWeight\').html(pageData.totalWeight+\' Kgs\');


			jQuery(\'.footers:last .totalRow .totalItem\').attr(\'class\',\'total font11 totalItem totalItem\'+packQue);
			jQuery(\'.footers:last .totalRow .totalBox\').attr(\'class\',\'total font11 totalBox totalBox\'+packQue);
			jQuery(\'.footers:last .totalRow .totalWeight\').attr(\'class\',\'total font11 totalweight totalWeight\'+packQue);
			if(pageData.color){
				jQuery(\'.colorCode:last\').html(\'COLOUR CODE : \'+pageData.color);
			}
			
			console.log(pageData.color);
			jQuery(\'.UrgentCode:last\').html(pageData.urgent);
			jQuery(\'.noteline\').html(\'PO NO. \'+pageData.poc);



			
		});
		
	});
	jQuery(\'.noteline\').attr(\'contenteditable\',\'true\');
	jQuery(\'.td3\').attr(\'contenteditable\',\'true\');
	// console.log(totalPageBox);
	jQuery.each(totalPageBox,function(i,v){
		jQuery(\'.pageTotalInfo\'+i).html(pad(v,2));
	});
	console.log(packData);
	jQuery(\'.pageTotalInfo\').html(pad(currPage,2));
	jQuery(\'.total\').attr(\'contenteditable\',\'true\');
	jQuery(\'.boxInfo\').attr(\'contenteditable\',\'true\');
	jQuery(\'.pageInfo\').attr(\'contenteditable\',\'true\');
	jQuery(\'.colorCode\').attr(\'contenteditable\',\'true\');
';

$this->registerJs($scr);

?>