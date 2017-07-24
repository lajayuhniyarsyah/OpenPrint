<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<style type="text/css">
table{
	/* border-top: 1px solid black;
	border-bottom: 1px solid black; */
}
.header{
	height: 10%;
}
.content{
	height: 80%;
}
.pages{
	height: 245mm;
	padding-top:17mm;
	padding-left:4mm;
	page-break-after: always;
}
.amount{
	margin-left:76%;
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
	margin-top: 29%;
	margin-left: 9%;
}
.contentLines{
	font-size: 11pt;
}
.cRows{
	vertical-align: top;
}
.xxx{
	position: absolute;
	margin-left: -143mm;
	margin-top: -1mm;
	font-weight: bold;
}
.choosePrinter{
	position: absolute;
	z-index: 9999;
	right: 0;
}
.amVal{
	text-align: right;
	padding-right: 	20px;
}
.pbkp{
	margin-top: 41px;
	margin-left: 36mm;
	height: 88px;
}
.lineVal{
	text-align: right;
	padding-right: 20px;
}
table td{
	vertical-align: top;
}

<?php
if($printer=='sri'):
	echo '.pages{padding-top: 11mm;}';
elseif($printer=='refa-semen'):
?>
	.pages {
		padding-top: 21mm;
	}
<?php endif; ?>

.xxx{
	margin-left: -147mm !important;
}
.spacerTd{
	height: 8mm;
}
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
											if($modelInvoice['faktur_address']){
	                                            $prtName = $modelPartner['name'];
	                                        }
	                                        else
	                                        {
	                                            $prtName = $modelInvoice['commercial_partner_id'][1];
	                                        }

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
							<?php $maxHeight = '103mm'; ?>
							<?php
							if($printer=='refa'){
								$maxHeight='101mm';
							}elseif($printer=='refa-semen'){
								$maxHeight = '102mm';
							}
							?>
							<td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
								<div class="contentArea">
									<table class="contentLines" style="width:100%;margin-top:16mm;">
										
									</table>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="amount">
									<div class="xxx">
										<table border="1px solid black" cellpadding="0">
											<tr>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
												<td style="width:18mm;" contenteditable="true">XXXXXX</td>
											</tr>
										</table>
									</div>
									<div class="amVal">
										<?php echo Yii::$app->numericLib->indoStyle($modelInvoice['total']); ?>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="spacerTd">
								<div class="amount">
									<div style="position:absolute;margin-left:-148px;">
										<?php 
											if($modelInvoice['total_discount']){
												// jika ada discount maka echo "Discount";
												echo 'DISCOUNT';
												echo '</div><div class="amVal">-'.Yii::$app->numericLib->indoStyle($modelInvoice['total_discount']);
											}
										?>
									</div>
									
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="amount">
									<div class="amVal">
										<?php echo Yii::$app->numericLib->indoStyle($modelInvoice['amount_untaxed']); ?>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="amount">
									<div class="amVal">
										<?php echo Yii::$app->numericLib->indoStyle($modelInvoice['amount_tax']); ?>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="sign">
									<div class="tgl">Jakarta <span style="margin-left:30%;"><?php echo Yii::$app->formatter->asDatetime($modelInvoice['date_invoice'], "php:d-m-Y"); ?></span></div>
									<div class="signName" contenteditable="true"><?php echo strtoupper($modelInvoice['approver'][1])?></div>
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
// var_dump($data);
$this->registerJs('
	var currPage = 1;

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
		console.log(\'NO = \'+data.no);
		return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:38px;\">"+data.no+"</td><td style=\"width:440px;\">"+data.name+"</td><td class=\"lineVal\">"+data.subTotalMain+"</td></tr>";
	}

	function prepareNoteRow(rowNo,data)
	{
		comment = data.comment
		console.log(comment)
		if(comment==false){
			var comment = "&nbsp;";
		}
		return "<tr class=\'cRows rows"+rowNo+"\'><td>&nbsp;</td><td colspan=\"\" contenteditable=\"true\">"+data.name+"<br/>"+comment+"</td><td></td></tr>";
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

	var noteRow = prepareNoteRow(currRow,{name:\'PO No : \'+poNo, comment:invData.comment});
	jQuery(\'table#lines\'+currPage+\' tr:last\').after(noteRow);
	if(jQuery(\'#tdLine\'+currPage).height()>maxLinesHeight){
		jQuery(\'table#lines\'+currPage+\' tr:last\').remove();
		// add new page container
		jQuery(\'div#page\'+currPage).after(tmpl);
		currPage = currPage+1;
		console.log(currPage);
		jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
		jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
		jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
		jQuery(\'table#lines\'+currPage).html(noteRow);
	}else{
		jQuery(\'table#lines\'+currPage+\' tr:last\').after(noteRow);
	}

	
	// end loop




	var currIndex = 0;
	function refreshActButton(currIndex){
		jQuery(\'.btnActLine\').remove();
		jQuery(\'table.contentLines td:last-child\').each(function(ro,v){
			jQuery(this).append(\'<div class="btnActLine hideOnPrint" style="margin-left: 264px;margin-top: -18px;position: absolute;"><input type="checkbox" class="chkBoxRow" value="\'+ro+\'" /><a href="#" class="btnCutRow" data="\'+ro+\'">Cut</a><a href="#" data="\'+ro+\'" class="btnPaste btnPasteBefore hidden"> | Paste Before</a><a href="#" class="btnPaste btnPasteAfter hidden" data="\'+ro+\'"> | Paste After</a></div>\');
			currIndex = currIndex+1;
			return currIndex;
		});
	}

	currIndex = refreshActButton();

	var trCopy = "";
	var trCopyIdx;
	

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
		console.log(trCopy);
		return false;
	});
');
?>

<button class="hideOnPrint" id="btnCutRows">Cut Selected Row</button>