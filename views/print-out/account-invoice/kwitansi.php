<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style type="text/css">

#kwitansiContainer{
	margin-top:0px;
	margin-left: 234px;
	width: 600px;
	height: 450px;
	/*border: 1px solid black;*/
	padding-top: 110px;
	font-size: 18px;
}
#invNo{
	text-align: right;
}
.widPO{
	width: 376px;
	float: left;
}
.clearBoth{
	clear: both;
}
.absPos
{
	position: absolute;
}
#custName{
	font-weight: bold;
	margin-top:68px;
	font-size: 17px;
}
#address{
	margin-top: 95px;
	font-size: 13px;
	font-size: 16px;
}
#words
{
	font-style: italic;
	line-height: 38px;
	margin-top: 142px;	
}
#paymentOf1{
	margin-top: 258px;
}
#paymentOf2{
	margin-top: 300px;
}
#paymentOf3{
	margin-top: 340px;
}
.widPO{
	float: left;
	width: 455px;
}
.widPOCurr{
	width: 50px;
	float: left;
}
.widPOVal{
	float: left;
	width: 94px;
	text-align: right;
}
.plusSign{
	float: left;
	margin-top: 10px;
	margin-left: 7px;
}
#subtotal{
	margin-top: 470px
}
#date{
	margin-top: 424px;
	margin-left: 450px;
}
#sign{
	margin-top: 613px;
	margin-left: 380px;
	font-weight: bold;
	font-size: 16px;
}
#hrTotal{
	width: 603px;
	margin-top: 320px;
}
#hrTotal hr{
	border-color: black;
}
.big{
	font-size: 21px;
	font-weight: bold;
}
.choosePrinter{
	position: absolute;
	z-index: 9999;
	right: 0;
}

<?php
if($printer=='sri'):;
?>
#kwitansiContainer{
	margin-top:0px;
	margin-left: 234px;
	width: 600px;
	height: 450px;
	/*border: 1px solid black;*/
	padding-top: 82px;
	font-size: 18px;
}
<?php
endif;
?>

@media print{
	.choosePrinter{
		display: none;
	}
}
</style>

<?php
$this->registerAssetBUndle('\yii\web\JqueryAsset');
$formated = function($value) use ($modelInvoice){
	if($modelInvoice['currency_id'][0]==13){
		return Yii::$app->numericLib->indoStyle(floatval($value));
	}else{
		return Yii::$app->numericLib->westStyle(floatval($value));
	}
};
?>

<div class="choosePrinter">
	<form method="get" id="formSelectPrinter">
		<input type="hidden" value="<?=Url::to('print-out/test-faktur')?>" name="r" />
		<input type="hidden" value="<?=$modelInvoice['id']?>" name="id" />
		<input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
		Print To : 
		<select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
			<option <?=($printer=='refa' ? 'selected ':null)?> value="refa">Refa</option>
			<option <?=($printer=='sri' ? 'selected ':null)?> value="sri">Sri</option>
		</select>
	</form>
</div>
<div id="kwitansiContainer">
	<div id="invNo">
		<?php
			$invNo = explode('/', $modelInvoice['kwitansi']);
			$kwNo = '';
			foreach($invNo as $k=>$no):
				$kwNo .= $no;
				if($k==0) $kwNo .= 'A';
				if($no!=end($invNo)) $kwNo .= '/';
			endforeach;
		?>
		<?=$kwNo?>
	</div>
	<div id="custName" class="absPos">
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
	<div id="address" class="absPos" contenteditable="true">
		<?php
		$iAddr = $modelPartner['street'].', '.$modelPartner['street2'].' '.$modelPartner['city'].', '.(isset($modelPartner['state_id'][1]) ? $modelPartner['state_id'][1]:'').($modelPartner['zip'] ? ' - '.$modelPartner['zip']:"");
		?>
		<?php echo $iAddr; ?>
	</div>
	<div id="words" class="absPos" contenteditable="true">
		<?php
		switch (trim($modelInvoice['currency_id'][1])) {
			case 'USD':
				# code...
				$preCur = '# United State Dollar ';
				$subCur = "#";
				break;
			case 'SGD':
				$preCur = '# Singapore Dollar ';
				$subCur = "#";
				break;
			case 'EUR':
				$preCur = '# EURO';
				$subCur = "#";
				break;
			case 'IDR':
				$preCur = '#';
				$subCur = " Rupiah#";
				break;
			default:
				# code...
				$preCur='#';
				$subCur = "#";
				break;
		}
		?>
		<?=$preCur?><?=ucwords(Yii::$app->numericLib->convertToWords($modelInvoice['amount_total'],$modelInvoice['currency_id'][1]))?><?=$subCur?>
	</div>
	<div id="paymentOf1" class="absPos">
		<div class="widPO" contenteditable="true">Sesuai Faktur Pajak No. <?=$modelInvoice['faktur_pajak_no']?></div>
		<div class="widPOCurr"><?=$modelInvoice['currency_id'][1]?></div>
		<div class="widPOVal"><?=$formated($modelInvoice['amount_untaxed'])?></div>
		<div class="clearBoth"></div>
	</div>
	<div id="paymentOf2" class="absPos" contenteditable="true">
		<div class="widPO"><?=$modelTax['name']?></div>
		<div class="widPOCurr"><?=$modelInvoice['currency_id'][1]?></div>
		<div class="widPOVal"><?=$formated($modelTax['amount'])?></div>
	</div>
	<div id="paymentOf3" class="absPos">
		<div class="widPO">Jumlah</div>
		<div class="widPOCurr"><?=$modelInvoice['currency_id'][1]?></div>
		<div class="widPOVal" contenteditable="true"><?=$formated($modelInvoice['amount_total'])?></div>
	</div>
	<div id="hrTotal" class="absPos" >
		<hr size="3" noshade="1" />
	</div>
	<div id="subtotal" class="absPos">
		<div class="big widPOCurr">
			<?=$modelInvoice['currency_id'][1]?>
		</div>
		<div class="big widPOVal" style="width:140px;">
			<?=$formated($modelInvoice['amount_total'])?>
		</div>
	</div>
	<div id="date" class="absPos">
		<?=date('d-m-Y',strtotime($modelInvoice['date_invoice']))?>
	</div>
	<div id="sign" class="absPos">
		<?=strtoupper($modelPartner['name'])?>
	</div>
</div>