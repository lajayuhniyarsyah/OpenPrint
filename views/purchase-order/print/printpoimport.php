<?php
use yii\helpers\Url;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<META http-equiv="X-UA-Compatible" content="IE=8"/>
<TITLE>Print Out Purchase Order Import</TITLE>
<STYLE type="text/css">
body {margin-top: 0px;margin-left: 0px;}
#content{margin-left: auto; margin-right: auto;}
#page_1 {position:relative; overflow: hidden;margin: 0px 0px 34px 35px;padding: 0px;border: none;width: 759px;}
#page_1 #id_1 {border:none;margin: 0px 0px 0px 0px;padding: 0px;border:none;width: 759px;overflow: hidden;}

.ft0{font: 12pt 'Arial';text-decoration: underline;line-height: 22px;}
.ft1{font: 10pt 'Arial';line-height: 16px; text-align: left;}
.ft2{font: 1px 'Arial';line-height: 1px;}
.ft3{font: bold 10pt 'Arial';line-height: 15px;}
.ft4{font: 10pt 'Arial';line-height: 15px;}
.ft5{font: 1px 'Arial';line-height: 6px;}
.ft6{font: bold 10pt 'Arial';line-height: 16px;}
.ft7{font: 1px 'Arial';line-height: 5px;}
.ft8{font: 10pt 'Arial';line-height: 14px;}
.ft9{font: 10pt 'Arial';line-height: 15px;}
.ft10{font: 10pt 'Arial';line-height: 17px;}
.ft11{font: 10pt 'Arial';text-decoration: underline;line-height: 16px;}
.ft12{font: 9px 'Helvetica';line-height: 12px;}


.p0{text-align: left;padding-left: 3px;margin-top: 0px;margin-bottom: 0px;}
.p1{text-align: left;padding-left: 3px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p2{text-align: left;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p3{text-align: left;padding-left: 20px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p4{text-align: left;padding-left: 4px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p5{text-align: left;padding-left: 30px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p6{text-align: left;padding-left: 165px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p7{text-align: center;padding-right: 33px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p8{text-align: center;padding-right: 30px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p9{text-align: left;padding-left: 0px;margin-top: 0px;margin-bottom: 0px;}
/*.p9{text-align: left;padding-left: 5px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}*/
.p10{text-align: center;padding-right: 15px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p11{text-align: center;padding-right: 19px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p12{text-align: center;padding-right: 31px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p13{text-align: center;padding-right: 14px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p14{text-align: left;padding-left: 99px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p15{text-align: center;padding-right: 25px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p16{text-align: left;padding-left: 108px;margin-top: 0px;margin-bottom: 0px;}
.p17{text-align: left;padding-left: 3px;margin-top: 7px;margin-bottom: 0px;}
.p18{text-align: center;padding-right: 132px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p19{text-align: center;padding-left: 1px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p20{text-align: center;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p21{text-align: left;padding-left: 122px;margin-top: 61px;margin-bottom: 0px;}
.p22{text-align: left;padding-left: 115px;margin-top: 2px;margin-bottom: 0px;}
.p23{text-align: left;margin-top: 0px;margin-bottom: 0px;}

.td0{padding: 0px;margin: 0px;width: 470px;vertical-align: bottom;}
.td1{padding: 0px;margin: 0px;width: 271px;vertical-align: bottom;}
.td2{padding: 0px;margin: 0px;width: 37px;vertical-align: bottom;}
.td3{padding: 0px;margin: 0px;width: 433px;vertical-align: bottom;}
.td4{padding: 0px;margin: 0px;width: 47px;vertical-align: bottom;}
.td5{padding: 0px;margin: 0px;width: 102px;vertical-align: bottom;}
.td6{padding: 0px;margin: 0px;width: 14px;vertical-align: bottom;}
.td7{padding: 0px;margin: 0px;width: 108px;vertical-align: bottom;}
.td8{padding: 0px;margin: 0px;width: 362px;vertical-align: bottom;}
.td9{padding: 0px;margin: 0px;width: 163px;vertical-align: bottom;}
.td10{padding: 0px;margin: 0px;width: 71px;vertical-align: bottom;}
.td11{padding: 0px;margin: 0px;width: 116px;vertical-align: bottom;}
.td12{padding: 0px;margin: 0px;width: 409px;vertical-align: bottom;}
/*.td13{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 14px;vertical-align: bottom;}
.td14{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 108px;vertical-align: bottom;}
.td15{border-left: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 13px;vertical-align: bottom;}
.td16{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 107px;vertical-align: bottom;}*/
.td13{border-bottom:none;padding: 0px;margin: 0px;width: 14px;vertical-align: bottom;}
.td14{border-bottom: none;padding: 0px;margin: 0px;width: 108px;vertical-align: bottom;}
.td15{border-left: none;border-bottom: none;padding: 0px;margin: 0px;width: 13px;vertical-align: bottom;}
.td16{border-right: none;border-bottom: none;padding: 0px;margin: 0px;width: 107px;vertical-align: bottom;}
.td17{padding: 0px;margin: 0px;width: 319px;vertical-align: bottom;}
.td18{padding: 0px;margin: 0px;width: 282px;vertical-align: bottom;}

.tr0{height: 27px;}
.tr1{height: 24px;}
.tr2{height: 18px;}
.tr3{height: 17px;}
.tr4{height: 20px;vertical-align: top; font-size: 14px; padding-bottom: 5px;}
.tr5{height: 23px;}
.tr6{height: 21px;}
.tr7{height: 6px;}
.tr8{height: 29px;}
.tr9{height: 5px;}
.tr10{height: 22px;}
.tr11{height: 26px; vertical-align: top;}
.tr12{height: 25px;}

.t0{width: 741px;font: 13px 'Arial';}
.t1{width: 601px;margin-left: 85px;margin-top: 13px;font: 15px 'Arial';}
.square{border:1px solid black;}
footer{
	height: 150px;
}
.thead{
    height: 190px;
}
.kotak{
	border:1px solid #000;
	padding-left: 20px;
    padding-right: 20px;
}
@media print {
    .thead{
    	page-break-before: always;
    	height: 190px;
    }
    .breakfooter{
    	page-break-before: always;
    }
    tfoot{
    	height: 0px;
    }
}
</STYLE>

<?php 
	$no=1;
	$diskon=0;
	$subtotal=0;
	foreach ($model->purchaseOrderLines as $value){

			if($value->part_number==""){
				$pn="";
			}else{
				$pn=$value->part_number;
			}

			if(!floatval($value->discount_nominal)){
				if(!floatval($value->discount)){
					$setdiscount[]=array($value->discount);
					$diskon=$diskon;
					}else{
					$setdiscount[]=array($value->discount);
					$hitungdiscount=(($value->price_unit*$value->product_qty)*$value->discount)/100;
					$diskon=$diskon+$hitungdiscount;
				}
			}else{
				$setdiscount[]=array($value->discount);
				$diskon=$diskon+$value->discount_nominal;
			}
            if($value->note_line){
            	$noteline=$value->note_line;
            	if($noteline=='-' OR $noteline==false){}else{
                	$data2[]=array('',''.nl2br($noteline).'','','','','','');	
            	}
            }
	        if($value->variants==false){
				$desc=nl2br($value->name);
			}else{
				$desc=$value->variants0->name;
			}

			
			$subtotal=$subtotal+($value->price_unit*$value->product_qty);
    		

    		if ($model->pricelist_id==2){
    			$product_qty=app\components\NumericLib::westStyle($value->product_qty,1,',','.');
    			$price_unit=app\components\NumericLib::westStyle($value->price_unit,2,',','.');
    			$subtotal1=app\components\NumericLib::westStyle($value->price_unit*$value->product_qty,2,',','.');
    		}else{
				$product_qty=app\components\NumericLib::westStyle($value->product_qty,1,',','.');
    			$price_unit=app\components\NumericLib::westStyle($value->price_unit,2,',','.');
    			$subtotal1=app\components\NumericLib::westStyle($value->price_unit*$value->product_qty,2,',','.');
    		}

			$data2[]=array(
							$no,
                            $desc,
							$pn,
							$product_qty,
							$value->productUom->name,
							$price_unit,
							$subtotal1);
					$no++;
			}
		

    if($model->pricelist_id==11){
        $pricelist="USD";
    }else if($model->pricelist_id==12){
        $pricelist="AUD";
    }else if($model->pricelist_id==8){
        $pricelist="EUR";
    }else if($model->pricelist_id==2){
        $pricelist="IDR";
    }else if($model->pricelist_id==13){
        $pricelist="JPY";
    }else if($model->pricelist_id==9){
        $pricelist="SGD";
    }

    $perdis=0;
    foreach ($setdiscount as $disc) {
    	if ($disc[0] <> 0.000){
    		$perdis=$disc[0];
    	}
    }

    $amount_total=app\components\NumericLib::indoStyle($model->amount_total,2,',','.');

    if(!strpos($amount_total, ".")){
    	$amount_total = $amount_total.'.00';
    }
?>
<BODY>
	<DIV id="page_1">
		<TABLE cellpadding=0 cellspacing=0 class="t0">
			<THEAD class="thead">
			  <TR>
			     <TH colspan=7></TH>
			  </TR>
			 </thead>
			 <tfoot>
			  <TR>
			     <TH colspan=7></TH>
			  </TR>
			 </tfoot>
			 <TBODY>
			<!-- Start Header -->
			<TR><TD colspan=7><P class="p0 ft0">PURCHASE ORDER</P></TD></TR>
			<TR>
				<TD colspan=3 class="tr0 td0"><P class="p1 ft1">No. : <?php  echo $model->name; ?> </P></TD>
				<TD colspan=4 class="tr0 td1"><P class="p2 ft1">Form : <NOBR>No.SBM-F-adm-07a/00</NOBR></P></TD>
			</TR>
			<TR>
				<TD colspan=3 class="tr0 td0"><P class="p1 ft1">To. : <?php  echo $model->partner->name; ?> </P></TD>
				<TD colspan=4 class="tr0 td1">
					<P class="p2 ft1">Fax : 
						<?php 
						if($model->attention0==""){
							echo $model->partner->fax; 
						}else{
							if($model->attention0->fax==""){
								echo $model->partner->fax; 	
							}else{
								echo $model->attention0->fax;
							}
						} ?>
					</P>
				</TD>
			</TR>
			<TR>
				<TD colspan=3 class="tr0 td0">
					<P class="p1 ft1">Attn. : 
						<?php 
						if($model->attention0){
							echo $model->attention0->name; 	
						} 
						?>
					</P></TD>
				<TD colspan=4 class="tr0 td1"><P class="p2 ft1">Date : <?php echo Yii::$app->formatter->asDatetime($model->date_order, "php:F d,Y")?></P></TD>
			</TR>
			<TR>
				<TD colspan=7 class="tr1 td0"><P class="p1 ft1">Gentlemen, we are pleased to confirm the following order :</P></TD>
			</TR>
			<TR>
				<TD colspan=7 class="tr1 td0"><P class="p1 ft1"></P></TD>
			</TR>
			<!-- End Header -->


			<!-- Header Table -->
			<TR>
				<TD class="tr2 td2"><P class="p4 ft3">No.</P></TD>
				<TD class="tr2 td10"><P class="p5 ft3">Qty</P></TD>
				<TD class="tr2 td8"><P class="p6 ft3">Description</P></TD>
				<TD class="tr2 td4"><P class="p2 ft2">&nbsp;</P></TD>
				<TD colspan=2 class="tr2 td11"><P class="p7 ft3">Unit Price</P></TD>
				<TD class="tr2 td7"><P class="p8 ft3">Total Price</P></TD>
			</TR>
			<TR>
				<TD class="tr3 td2"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr3 td10"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr3 td8"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr3 td4"><P class="p2 ft2">&nbsp;</P></TD>
				<TD colspan=2 class="tr3 td11"><P class="p7 ft3"><?=$pricelist?></P></TD>
				<TD class="tr3 td7"><P class="p8 ft3"><?=$pricelist?></P></TD>
			</TR>

			<!--Content -->

			<?php foreach ($data2 as $value) { ?>
			<TR class="content_table">
				<TD class="tr4 td2"><P class="p9 ft4"><?php echo $value[0] ?></P></TD>
				<TD class="tr4 td10"><P class="p10 ft4"><?php echo $value[3].' '.$value[4] ?></P></TD>
				<TD class="tr4 td8" colspan="2"><P class="p9 ft1"><?php echo $value[1] ?></P></TD>
				<TD class="tr4 td5"><P class="p11 ft4"><?php echo $value[5] ?></P></TD>
				<TD class="tr4 td6"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr4 td7"><P class="p12 ft4"><?php echo $value[6] ?></P></TD>
			</TR>
				<?php } ?>
			<?php if($diskon){ ?>
			<TR class="set-break">
				<TD class="tr7 td2"><P class="p2 ft5">&nbsp;</P></TD>
				<TD class="tr7 td10"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td8"><P class="p14 ft6"><br/>DISCOUNT  <?=app\components\NumericLib::indoStyle($perdis,0,',','.')?>%</P></TD>
				<TD class="tr7 td4"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td5"><P class="p11 ft6"></P></TD>
				<TD class="tr9"><P class="p2 ft7">&nbsp;</P></TD>
				<TD class="tr9"><P class="p15 ft6">&nbsp;</P></TD>
			</TR>

			<TR>
				<TD class="tr5 td2"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr5 td10"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr5 td4"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr10"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr10"><P class="p15 ft6"><?php echo app\components\NumericLib::indoStyle($diskon,2,',','.'); ?></P></TD>
			</TR>
			<TR>
				<TD class="tr7 td2"><P class="p2 ft5">&nbsp;</P></TD>
				<TD class="tr7 td10"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td8"><P class="p14 ft6"><?php echo $model->total_price; ?></P></TD>
				<TD class="tr7 td4"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td5"><P class="p11 ft6"><?=$pricelist?></P></TD>
				<TD class="tr7 td13"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td5"><P class="p11 ft6"><span class="kotak"><?=$amount_total?></span></P></TD>
			</TR>

			<TR>
				<TD class="tr5 td2"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr5 td10"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr5 td4"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr10 td15"><P class="p2 ft2">&nbsp;</P></TD>
			</TR>

			<?php }else{ ?>
			<TR>
				<TD class="tr7 td2"><P class="p2 ft5">&nbsp;</P></TD>
				<TD class="tr7 td10"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td8"><P class="p14 ft6"><?php echo $model->total_price; ?></P></TD>
				<TD class="tr7 td4"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td5"><P class="p11 ft6"><?=$pricelist?></P></TD>
				<TD class="tr7 td13"><P class="p2 ft5">&nbsp;</P></TD>
				<TD rowspan=2 class="tr8 td5"><P class="p11 ft6"><span class="kotak"><?=$amount_total?></span></P></TD>
			</TR>

			<TR>
				<TD class="tr5 td2"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr5 td10"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr5 td4"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr10 td15"><P class="p2 ft2">&nbsp;</P></TD>
			</TR>
			
			<?php } ?>
			<TR class="set-footer-break">
				<TD colspan=7 class="tr11 td7"><P class="p2 ft1">&nbsp;</P></TD>
			<TR>
			<!-- Footer -->
			<TR class="set-footer-break">
				<TD colspan=2 class="tr11 td7"><P class="p2 ft1">Your Ref</P></TD>
				<TD colspan=5 class="tr11 td8"><P class="p9 ft1">: <?php echo nl2br($model->yourref); ?> </P></TD>
			<TR>
				<TD colspan=2 class="tr11 td7"><P class="p2 ft1">Note</P></TD>
				<TD colspan=5 class="tr11 td8"><P class="p9 ft1">: <?php echo nl2br($model->note); ?></P></TD>
			</TR>
			<TR>
				<TD colspan=2 class="tr11 td7"><P class="p2 ft1">Delivery</P></TD>
				<TD colspan=5 class="tr11 td8"><P class="p9 ft1">: <?php echo nl2br($model->delivery); ?></P></TD>
			</TR>
			<TR>
				<TD colspan=2 class="tr11 td7"><P class="p2 ft1">Payment</P></TD>
				<TD colspan=5 class="tr11 td8"><P class="p9 ft1">: <?php echo nl2br($model->term_of_payment); ?></P></TD>
			</TR>
			<TR>
				<TD colspan=2 class="tr11 td7"><P class="p2 ft1">Shipment to</P></TD>
				<TD colspan=5 class="tr11 td8"><P class="p9 ft1">: <?php echo nl2br($model->shipment_to); ?></P></TD>
			</TR>

			<TR>
				<TD class="tr1 td2"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr1 td10"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr1 td8"><P class="p9 ft1">Consignee name &amp; address :</P></TD>
				<TD class="tr1 td4"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr1 td5"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr1 td6"><P class="p2 ft2">&nbsp;</P></TD>
				<TD class="tr1 td7"><P class="p2 ft2">&nbsp;</P></TD>
			</TR>
			<TR>
				<TD colspan="7">
					<P class="p16 ft8">PT. SUPRABAKTI MANDIRI</P>
					<P class="p16 ft9">Jl. Danau Sunter Utara Blok A No. 9</P>
					<P class="p16 ft9">Jakarta Utara - 14350</P>
					<P class="p16 ft1">Phone : <NOBR>021-658</NOBR> 33666</P><br/>
					
					<div class=" breakfooter">
						<P class="p0 ft1"><?php echo $model->after_shipment; ?></P>
						<P class="p17 ft1">Kindly acknowledge the receipt of this order and send us your Proforma Invoice and estimation of Delivery<br/><br/></P>	
						<TABLE cellpadding=0 cellspacing=0 class="t1">
							<TR>
								<TD class="tr11 td17"><P class="p18 ft10">Yours faithfully,<br/>PT. SUPRABAKTI MANDIRI<br/><br/><br/><br/><br/><br/>JIMMY HADINATA</P></TD>
								<TD class="tr11 td18"><P class="p19 ft10">Acknowledgment by :<br/><?php echo $model->partner->name; ?><br/><br/><br/><br/><br/><br/>----------------------------------</P></TD>
							</TR>
						</TABLE>
					</div>
				</TD>
			</TR>
			</TBODY>
		</TABLE>


				
	</DIV>
</BODY>
</HEAD>
</HTML>

<?php
	$this->registerJs('
		var tbody=jQuery(\'tbody\').height();
		var discount=jQuery(\'.discount\').height();
		var sum = 0;
		$(\'.content_table\').each(function(){
			    sum += jQuery(this).height();
		});
		if(sum > 680 && tbody > 850){
			jQuery(".set-break").addClass( "breakfooter" );
		}

		// var x =sum+121;	
		// if(x > 680){
		// 	jQuery(".set-footer-break").addClass( "breakfooter" );	
		// }
		// 17 + 23 + 23

	');
?>

