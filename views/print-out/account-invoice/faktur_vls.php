<?php
use yii\helpers\Html;
use yii\helpers\Url;

/*foreach($model->accountInvoiceLines as $ll){
var_dump($ll);
}*/
?>
<style type="text/css">
table{
/* border-top: 1px solid black;
border-bottom: 1px solid black; */
}
.pages{
	height: 282mm;
	padding-top:18mm;
	padding-left:4mm;
	page-break-after: always;
}
.amount{
	margin-left:61%;
}
.lineFoot{
	padding-left: 74%;
}
.mrgBtm1{
	margin-bottom: 1%;
}
.sign{
	margin-top: 15mm;
	padding-left: 58%;
}
.sign .signName{
	margin-top: 86px;
	margin-left: 9%;
}
.cRows{
	vertical-align: top;
}
.contentLines{
	font-size: 11pt;
}

.xxx{
	position: absolute;
	margin-left: -118mm;
	margin-top: -1mm;
	font-weight: bold;
}
.fontAddr{
	font-size: 13px;
}
.choosePrinter{
	position: absolute;
	z-index: 9999;
	right: 0;
}

.pkp{
/*background: lime;*/
	height: 80px;
}
.pbkp{
	margin-top:10mm;margin-left:36mm;
}
.partnerStreet{
	height: 37px;
	vertical-align: middle;
}
.ptSupra{
	margin-bottom:1mm;padding-top:8px;
}
.tdPartner{
	height:129px;vertical-align:top;
}
.partnerName{
	margin-bottom:2mm;padding-top:4px;
}
.productDescTd{
	padding-right: 10px;
}
table td{
	vertical-align: top;
}
.wid1{
	width: 127px;
	padding-right: 10px;
	text-align: right;
}
.spaceSymVal{
	width:127px;
	text-align:left;
	float: left;
}
.idrCols{
	position: absolute;
	margin-left: 185px;
}

<?php
if($printer=='sri'):
echo '
.pages{padding-top: 12mm;}
.spaceSymVal{
	width:117px;text-align:right;
}
';
echo '
.wid1{
	width: 117px;
	padding-right: 10px;
	text-align: right;
}
';
endif;

if($printer=='refa'){
	echo '.xxx table{margin-top:10px;}';
}
?>

@media print{
	.xxx table, .xxx table tr, .xxx table tr td{
		border: 0px;
	}
	.choosePrinter{
		display: none;
	}
}
</style>

<div class="choosePrinter">
	<form method="get" id="formSelectPrinter">
		<input type="hidden" value="<?=Url::to('print-out/test-faktur')?>" name="r" />
		<input type="hidden" value="<?=$modelInvoice['id']?>" name="id" />
		<input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
		Print To : 
		<select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
			<option <?=($printer=='refa' ? 'selected ':null)?> value="refa">Refa</option>
			<option <?=($printer=='sri' ? 'selected ':null)?> value="sri">Sri</option>
			<option <?=($printer=='refa-semen' ? 'selected ':null)?> value="refa-semen">Refa-Semen</option>
		</select>
	</form>
</div>
<div id="pageContainer">
	<div class="pages">
		<table style="width:190mm;height:100%;border-right:0px solid black;">
			<tr style="vertical-align:top;">
				<td>
					<table style="width:100%;" cellpadding="3" cellspacing="2">
						<tr>
							<td>
								<div>Inv. <?=$modelInvoice['kwitansi']?></div>
							</td>
						</tr>
						<tr>
							<td>
								<div style="margin-left:50mm;margin-top:2mm;"><?=$modelInvoice['faktur_pajak_no']?></div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="pkp" style="margin-top:8mm;margin-left:36mm;">
									<div style="margin-bottom:1mm;" contenteditable='true'>PT. SUPRABAKTI MANDIRI</div>
									<div style="height:10mm;"><span>Jl. Danau Sunter Utara Blok. A No. 9 Tanjung Priok - Jakarta Utara 14350</span></div>
									<div>01.327.742.1-038.000</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="pbkp">
									<div style="margin-bottom:2mm;" contenteditable="true">
										<?php
											$prtName = $modelPartner['name'];
											$expPartnerName = explode(',',$prtName );
											if(is_array($expPartnerName) && isset($expPartnerName[1])){

												$count = count($expPartnerName);
												if($count>2){
													$partnerName = $expPartnerName[$count-1];

													unset($expPartnerName[$count-1]);

													$sPartnerName = implode(",", $expPartnerName);

													$partnerName .= ". ".$sPartnerName;
												}else{
													$partnerName = $expPartnerName[1].'. '.$expPartnerName[0];
												}
												
											}else{
												$partnerName = $partnerName;
											}
											
											echo $partnerName;
										?>
									</div>
									<div style="height:10mm;" contenteditable="true">
										<span>
											<?php
												$iAddr = $modelPartner['street'].'<br/>'.$modelPartner['street2'].' '.$modelPartner['city'].', '.(isset($modelPartner['state_id'][1]) ? $modelPartner['state_id'][1]:'').($modelPartner['zip'] ? ' - '.$modelPartner['zip']:"");
												?>
											<?php echo $iAddr; ?>
										</span>
									</div>
									<div><span><?php echo ($modelPartner['npwp'] ? $modelPartner['npwp']:'-'); ?></span></div>
								</div>
							</td>
						</tr>
						<tr>
							<?php
								$maxHeight = '102mm'; 
								if($printer=='sri'){
									$maxHeight = '105mm';
								}
							?>
							<td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
								<div class="contentArea">
									<table class="contentLines" style="width:100%;margin-top:18mm;">
										
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="amount">
									<div class="xxx">
										<table border="1px solid black">
											<tr>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
											</tr>
										</table>
									</div>
									<table style="width:100%;" cellpadding="0" cellspacing="0">
										<tr>
											<td style="width:61%;">
												<?='<div style="width:auto;float:left;">'.  $modelInvoice['currency_id'][1].'</div><div class="wid1">'.Yii::$app->numericLib->westStyle($modelInvoiceLine['amount_bruto']).'</div>'?>
											</td>
											<td style="text-align:right;">
												<?php echo Yii::$app->numericLib->indoStyle($modelInvoiceLine['amount_bruto_main']); ?>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="amount">
									<table style="width:100%;" cellpadding="0" cellspacing="0">
										<tr>
											<td style="width:61%;">
											<?php 
												echo '<div style="position:absolute;margin-left:-131px;">'.($modelInvoice['total_discount'] ? 'DISCOUNT ':null).'</div>';
												if(isset($data['dp']['dpp']))
												{
													echo '<div style="width:auto;float:left;">'.($modelInvoice['total_discount'] != '' ? $modelInvoice['currency_id'][1]:'&nbsp;').'</div><div class="wid1">0.00</div>';
												}
												else
												{
													echo '<div style="width:auto;float:left;">'.($modelInvoice['total_discount'] != '' ? $modelInvoice['currency_id'][1]:'&nbsp;').'</div><div class="wid1">'.($modelInvoice['total_discount']  ? Yii::$app->numericLib->westStyle(-$modelInvoice['total_discount']):null).'</div>';
												}
											?>
											</td>
											<td style="text-align:right;">
												<?php 
													if(isset($data['dp']['dpp']))
													{
														echo '0.00'; 
													}
													else
													{
														echo ($modelInvoice['total_discount_main'] ? Yii::$app->numericLib->indoStyle(round($modelInvoice['total_discount_main'])):'&nbsp;'); 
													}
												?>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
						<!-- EMPTY -->
						<tr>
							<td>
								<div class="amount">
									<table style="width:100%;" cellpadding="0" cellspacing="0">
										<tr>
											<td style="width:61%;height:12px;"></td>
											<td style="text-align:right;"></td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="amount">
									<table style="width:100%;" cellpadding="0" cellspacing="0">
										<tr>
											<td style="width:61%;">
												<?='<div style="width:auto;float:left;">'.  $modelInvoice['currency_id'][1].'</div><div class="wid1">'.Yii::$app->numericLib->westStyle($modelInvoice['amount_untaxed']).'</div>'?>
											</td>
											<td style="text-align:right;">
												<?php
													if(isset($data['dp']['dpp']))
													{
														echo Yii::$app->numericLib->indoStyle($data['dp']['dpp']);
													}
													else
													{
														echo Yii::$app->numericLib->indoStyle($modelInvoice['amount_untaxed_main']);
													}
													
												?>
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="amount" style="margin-top:-3px;">
									<div style="width:auto;float:left;">
										<?= (isset($modelInvoice['amount_tax']) ? '<div style="float:left;width:auto;">'.$modelInvoice['currency_id'][1].'</div><div class="wid1">'.Yii::$app->numericLib->westStyle($modelInvoice['amount_tax']).'</div><div style="clear:both;"></div>':''); ?></div>
									<div style="text-align:right;">
										<?php 
											if(isset($data['dp']['ppn']))
											{
												echo Yii::$app->numericLib->indoStyle($data['dp']['ppn']);
											}
											else
											{
												echo Yii::$app->numericLib->indoStyle($modelInvoice['amount_tax_main']);
											}
											
										?>
									</div>
									<div class="clear:both;"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="sign">
									<div class="tgl">Jakarta <span style="margin-left:30%;"><?= Yii::$app->formatter->asDatetime($modelInvoice['date_invoice'], "php:d-m-Y"); ?></span></div>
									<div class="signName"><?=strtoupper($modelInvoice['approver'][1])?></div>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<div class="rateInfo" style="margin-top:8px;">
						<div>
							<div style="width:37mm;float:left;margin-left:29mm;"><?=Yii::$app->numericLib->westStyle(floatval($modelInvoice['pajak']))?></div><div><?='1 '.$modelInvoice['currency_id'][1]?></div>
							<div style="clear:both;"></div>
						</div>
						<div>
							<div style="float:left;margin-left:34mm;margin-top:3mm;"><?=$modelInvoice['kmk']?></div>
							<div style="clear:both;"></div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<?php
$this->registerJs('
	var currPage = 1;
	var rateSymbol = "'.$modelInvoice['currency_id'][1].'";
	// save page template to var
	var tmpl = \'<div style="height:2mm;">&nbsp;</div>\'+jQuery(\'div#pageContainer\').html();
	var poNo = "'.$modelInvoice['name'].'";
	// add id to container
	jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
	jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
	jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
	

	// data to render
	var invData = '.\yii\helpers\Json::encode($modelInvoice).';
	var lines = '.\yii\helpers\Json::encode($lines).';
	var maxLinesHeight = jQuery(\'.tdLines:last\').height();
	

	var currRow = 0;

	console.log(maxLinesHeight);

	function prepareRow(rowNo,data)
	{
		console.log(data.currency);
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:6%;\">"+data.no+"</td><td style=\"width:368px;padding-right:10px;\">"+data.name+"</td><td><div style=\"float:left;width:13mm;\">"+data.currency+"</div><div class=\"spaceSymVal\">"+data.amountBruto+"</div><div class=\"idrCols\">"+data.amountBrutoMain+"</div><div style=\"clear:both;\"></div></td><td>&nbsp;</td></tr>";
	}

	function prepareNoteRow(rowNo,data)
	{
		return "<tr class=\'cRows rows"+rowNo+"\' contenteditable=\'true\'><td style=\"width:6%;\">&nbsp;</td><td style=\"width:374px\">"+data.name+"<br/>"+(data.comment ? data.comment:\'\')+"</td><td><div style=\"float:left;width:13mm;\">&nbsp;</div><div>&nbsp;</div><div style=\"clear:both;\"></div></td><td>&nbsp;</td></tr>";
	}
	var rowPage = 0;
	jQuery.each(lines,function(key,line){

		var getRow = prepareRow(currRow,line);

		if(key==0)
		{
			jQuery(\'table#lines\'+currPage).html(getRow);
			console.log(getRow);
		}
		else
		{
			jQuery(\'table#lines\'+currPage+\' tr:last\').after(getRow);
		}
		rowPage = rowPage+1;

		var currLineHeight = jQuery(\'#tdLine\'+currPage).height();
		if(currLineHeight>maxLinesHeight){
			// remove last row
			jQuery(\'table#lines\'+currPage+\' tr:last\').remove();
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
	
	var noteRow = prepareNoteRow(currRow,{name:\'PO No : \'+poNo});
	jQuery(\'table#lines\'+currPage+\' tr:last\').after(noteRow);
	// end loop


	var currIndex = 0;
	function refreshActButton(currIndex){
		jQuery(\'.btnActLine\').remove();
		jQuery(\'table.contentLines td:last-child\').each(function(ro,v){
			jQuery(this).append(\'<div class="btnActLine hideOnPrint" style="margin-left: 150px;position: absolute;"><input type="checkbox" class="chkBoxRow" value="\'+ro+\'" /><a href="#" class="btnCutRow" data="\'+ro+\'">Cut</a><a href="#" data="\'+ro+\'" class="btnPaste btnPasteBefore hidden"> | Paste Before</a><a href="#" class="btnPaste btnPasteAfter hidden" data="\'+ro+\'"> | Paste After</a></div>\');
			currIndex = currIndex+1;
			return currIndex;
		});
	}

	currIndex = refreshActButton();

	var trCopy = "";
	var trCopyIdx;
	/*jQuery(\'.btnCutRow\').click(function(){
		trCopy = jQuery(this).parents("tr").html();
		trCopyIdx = jQuery(this).attr(\'data\');
		console.log(trCopy);
		jQuery(\'.btnPaste\').show();
		return false;
	});

	jQuery(\'.btnPasteAfter\').click(function(){
		var roNo = jQuery(this).attr(\'data\');
		jQuery("<tr>"+trCopy+"</tr>").insertAfter(\'tr:eq(\'+roNo+\')\');
		jQuery("tr:eq("+trCopyIdx+")").remove();
		trCopy = "";
		trCopyIdx = "";
		jQuery(\'.btnPaste\').hide();
		return false;
	});*/

	jQuery(\'#pageContainer\').on(\'click\',\'.btnCutRow\',function(e){
		e.preventDefault();

		var target = jQuery(this).parents("tr");
		jQuery(this).parent().remove();
		trCopy = target.html();
		trCopyIdx = jQuery(this).attr(\'data\');
		console.log("THtml = "+trCopy+". Index = "+trCopyIdx);
		jQuery(\'.btnPaste\').show();
		console.log("Removing TR "+trCopyIdx);
		jQuery("tr.rows"+trCopyIdx).remove();
		return false;
	});

	jQuery(\'#pageContainer\').on(\'click\',\'.btnPasteAfter\',function(e){
		e.preventDefault();
		var roNo = jQuery(this).attr(\'data\');
		
		
		console.log("inserting after "+roNo);
		currIndex = currIndex+1;
		jQuery(\'<tr class="cRows rows\'+currIndex+\'"></tr>\'+trCopy+"</tr>").insertAfter(\'tr.rows\'+roNo);
		console.log(jQuery(\'tr.rows\'+currIndex+\' .btnCutRow\').attr(\'class\'));
		trCopy = "";
		trCopyIdx = "";
		jQuery(\'.btnPaste\').hide();
		return false;
	});

	jQuery(\'#pageContainer\').on(\'click\',\'.btnPasteBefore\',function(e){
		e.preventDefault();
		var roNo = jQuery(this).attr(\'data\');
		console.log("inserting before "+roNo);
		currIndex = currIndex+1;
		jQuery(\'<tr class="cRows rows\'+currIndex+\'"></tr>\'+trCopy+"</tr>").insertBefore(\'tr.rows\'+roNo);
		console.log(jQuery(\'tr.rows\'+currIndex+\' .btnCutRow\').attr(\'class\'));
		trCopy = "";
		trCopyIdx = "";
		jQuery(\'.btnPaste\').hide();
		return false;
	});
	jQuery("#btnCutRows").click(function(){

		trCopy = "";
		jQuery.each(jQuery("input.chkBoxRow:checked"),function(idx,v){
			var target = jQuery(v).parents("tr");
			jQuery(v).parent().remove();
			currIndex = currIndex+1;
			trCopy += \'<tr class="cRows rows\'+currIndex+\'"></tr>\'+target.html()+"</tr>";
			trCopyIdx = jQuery(v).val();
			console.log("THtml = "+trCopy+". Index = "+trCopyIdx);
			jQuery(\'.btnPaste\').show();
			console.log("Removing TR "+trCopyIdx);
			jQuery("tr.rows"+trCopyIdx).remove();
		});
		// console.log(trCopy);
		return false;
	});
');
?>
<button class="hideOnPrint" id="btnCutRows">Cut Selected Row</button>