<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php
	$css = '
	body{
		font-family: Tahoma, Geneva, sans-serif;
		padding-top: 0px;
	}
	.signName{
		padding-left:127mm;
		margin-top: 3mm;
	}
	
	#container
	{
		width: 190mm;
		/*border: 1px solid black;*/
		padding-left: 8mm;
		vertical-align: top;
	}
	.clear
	{
		clear: both;
	}
	.headers
	{
		padding-top:58mm;
		height: 33mm;
	}
	.leftInfo
	{
		background: red;
		float: left;
		margin-top: -5mm;
		width: 130mm;
		max-height: 36mm;
	}
	.rightInfo
	{
		float: right;
	}
	.kwNo{
		height: 10mm;
		padding-right: 10mm;
		line-height: 4mm;
	}
	.dateInv{
		height: 10mm;
		line-height: 4mm;
	}
	.pages
	{
		/*border-top: 1px solid lime;
		border-bottom: 1px solid red;*/
		page-break-after: always;
		height: 330mm;
		background: grey;
	}
	#container .pages:not(:first-child){
		padding-top: 4mm;
		padding-top: 5px;
	}


	.containerLines{
		min-height: 117mm;
		overflow: hidden;
		/*max-height: 117mm;*/
		/*height: 117mm;*/
		background: lime;
		font-size: 11pt;
		/*border-bottom: 1px solid black;*/
		/*color: white;*/

	}

	
	.containerLines table tr td{
		vertical-align: top;
	}
	.amounts{
		float: right;
		font-size: 11pt;
		
	}
	.amounts div.am{
		text-align: right;
		height: 24px;
		width: 130px;
		padding-right: 5mm;
		/*background: lime;*/
	}
	.amounts .currSymbol{
		width: 30px;
		float: left;
		
	}
	.amounts .amountNumber{
		float: left;
		text-align: right;
		width: 86px;
	}
	.amLine2{
		/*border: 1px solid black;*/
	}
	.am2Words{
		border: 1px solid black;
		float: left;
		width: 150px;
		height: 100%;
		margin-left: -171px;

	}
	.kursAm2{
		border: 1px solid black;
		float: left;
		width: 35px;
		height: 100%;
		margin-left: -6px;

	}
	.valAm2{
		border: 1px solid black;
		height: 100%;
		padding-right: 10px;
		width: 80px;
		float: right;
	}
	.amLine3{
		margin-top: 6mm;
	}
	.notes{
		clear: both;
	}
	.terb{
		padding-top:13mm;
		padding-left:5mm;
		font-size: 11pt;
		font-weight: bold;
		background: yellow;
		height: 20mm;
		width: 433px;
		vertical-align: top;
		line-height: 18px;
	}
	.dueDate{
		margin-left: 50mm;
		/*padding-top:0mm;*/
		font-size: 11pt;
	}


	.td1{
		width: 6mm;
	}
	.td2{
		width: 24mm;
	}
	.td3{
		width: 82mm;
	}
	.td4{
		/*width:36mm;*/
		width: 120px;
	}
	.td5{
		width: 120px;
		padding-left: 11px;
	}

	.invFootNotes{
		margin-left: -2mm;
		padding-top: 16mm;
		font-size:10pt;
		font-weight: bold;
		letter-spacing: 0px;
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
		.containerLines{
			/*border-bottom: 1px solid black;*/

		}
		.choosePrinter{
			display: none;
		}

		.amLine2{
			border: none;
		}

		.am2Words{
			border: none;

		}
		.kursAm2{
			border: none;
		}
		.valAm2{
			border: none;
		}
	}';
	// var_dump($printer);
	if($printer == 'sri')
	{
		$css .= '.headers{padding-top:56mm;height: 32mm;}.kwNo{line-height: 2mm;}.terb{padding-top: 11mm;line-height: 35px;}';
	}
	elseif($printer == 'refa'){
		$css .= '
		.amLine3{
			margin-top: 5mm;
		}
		.td1{
			width: 6mm;
		}
		.td2{
			width: 24mm;
		}
		.td3{
			width: 315px;
		}
		.td4{
			/*width:36mm;*/
			width: 120px;
		}
		.td5{
			width: 120px;
			padding-left: 11px;
		}
		.dateInv{
			height: 10mm;
			line-height: 32px;
		}
		
		
		.terb {
		    padding-top: 11mm;
		    line-height: 35px;
		}';

		$css .= ($uid == 100 ? '.footers{ padding-top: 6px; }':'.footers{ padding-top: 9px; }');
	}
	
	$this->registerCss($css);
	$formated = function($value) use ($model){
		if($model->currency_id==13){
			return Yii::$app->numericLib->indoStyle(floatval($value));
		}else{
			return Yii::$app->numericLib->westStyle(floatval($value));
		}
	};
?>
<div class="choosePrinter">
	<form method="get" id="formSelectPrinter">
		<input type="hidden" value="<?=Url::to('account-invoice/print-invoice')?>" name="r" />
		<input type="hidden" value="<?=$model['id']?>" name="id" />
		<input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
		Print To : 
		<select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
			<option <?=($printer=='refa' ? 'selected ':null)?> value="refa">Refa</option>
			<option <?=($printer=='sri' ? 'selected ':null)?> value="sri">Sri</option>
		</select>
	</form>
</div>
<div id="container">
	<div class="pages">
		<div class="headers">
			<div class="leftInfo">
				<div class="partnerName"><?=$modelPartner['name']?></div>
				<div class="partnerAddr" contenteditable="true"><?=$modelPartner['street']?></div>
				<div class="partnerAddr2" contenteditable="true"><?=$modelPartner['street2']?></div>
				<div class="partnerAddr2" contenteditable="true"><?=$modelPartner['city']?></div>
			</div>
		</div>
	</div>
</div>