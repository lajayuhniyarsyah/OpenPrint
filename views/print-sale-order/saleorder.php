
<html>
	<head>
	
		<title><?=$model->name?></title>
		<script src="js/jquery.js"></script>
		<style type="text/css">
		/*.page-ctn{
			height: 400px;
		}*/
		body {
	background: #cccccc;
	}

	page[size="A4"] {
		background: white;
		width: 22cm;
		height: 29.7cm;
		display: block;
		margin: 0 auto;
		margin-bottom: 0.5cm;
		
	}
		page .header{
			margin: auto;
			width: 780px;
			height:126mm;
			
		} 
		page .content{
			margin: auto;
			width: 780px;
			max-height: 1000px;
			
		} 
		page .footer{
			margin: auto;
			width: 780px;
			max-height: 1000px;
			/*background-color: green;*/
		} 

		

		
		</style>
	</head>
	<body>
		<div id="dokument">
			<page size="A4">
				<div class="header">
					<table width="100%">
					<td width="50%">
					<?php 
						// var_dump($model);
					   
					 ?>
						<p>
							<b>PT. SUPRABAKTI MANDIRI</b> <br/>
							Jl. Danau Sunter Utara Blok A No. 9 <br/>
							Jakarta Utara - 14350 14350, Indonesia<br/>
							Phone 021-658 33666 Fax 021-65831666 <br/>
							www.belcare.com email: info@belcare.com
						</p>
					   
					</td>
					<td width="50%" style="text-align:right"> <img src="logo.jpg" alt="Logo Supra"> 
					</td>
				</table>
				
				<center><b>Sales Order</b></center>
			<center><b><?=$model->name?></b></center>
			<table width="100%">
				<td witdh="50%" valign="top">
					<table width="100%">
						<tr>
							<td>Company</td>
							<td>:</td>
							<td>
								<?=$model->partner->name?>
							</td>
						</tr>
						<tr>
							<td>Attn</td>
							<td>:</td>
							<td><?=$AttentionName?></td>
						</tr>

						<tr valign="top">
							<td width="30%">Delivery Address</td>
							<td>:</td>
							<td height="54"><?=$street_shipping." "?><?=$street_shipping_2." "?><?=$city_shipping." "?><?=$state_shipping." "?><?=$country_shipping." "?></td>
						</tr>
						<tr valign="top">
							<td width="30%">Invoice Address</td>
							<td>:</td>
							<td height="54"><?=$street_invoice." "?><?=$street_invoice_2." "?><?=$city_invoice." "?><?=$state_invoice." "?><?=$country_invoice." "?></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td><?= $AttentionPhone?></td>
						</tr>
						<tr>
							<td>Fax</td>
							<td>:</td>
							<td><?=$fax ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?= $email?></td>
						</tr>
					   
			
		   
					</table>

				</td>
				<td width="50%" valign="top">
					<table width="100%" >
						<tr>
							<td>Quotation#</td>
							<td>:</td>
							<td><?=$model->quotation_no?></td>
						</tr>
						<tr>
							<td>Customer Reference#</td>
							<td>:</td>
							<td><?=$model->client_order_ref?></td>
						</tr>
						<tr>
							<td>Date</td>
							<td>:</td>
							<td><?=date("d/m/Y", strtotime($model->date_order));?></td>
						</tr>
						<tr>
							<td>Sales Contact</td>
							<td>:</td>
							<td><?=$model->user->name ?></td>
						</tr>
						<tr>
							<td>Sales Group</td>
							<td>:</td>
							<td><?=strtoupper($model->group->name);?></td>
						</tr>
						
						<tr>
							<td>Fax</td>
							<td>:</td>
							<td><?=$model->user->partner->fax?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?=$model->user->partner->email?></td>
						</tr>

					</table>
				</td>
			</table>
			
			<p contenteditable='true'>We would like to offer our product as your requirement as following :</p>
			
	  
				</div>
				<div class="content">
					
				</div>
				<div class="footer">
					
				</div>
			</page>
		</div>
		
	</body>
	<script type="text/javascript">
		jQuery(function(){
			
			var data = <?php echo json_encode($dataContent); ?>;
			var cursor = 1;
			var template = jQuery('#dokument').html();
			jQuery('page').attr('id','page-'+cursor);

			// console.log(data[0].name_product);
			noMaterial = 1
			jQuery.each(data,function(index,value){

				var contentElement = jQuery('page#page-'+cursor+' .content');
			

				var tinggiContent = contentElement.height();
				// console.log(value.material_line);


				if(tinggiContent<600){
					// console.log("no"+value.no+index+" Masuk "+value.material);
					if (tinggiContent ===0){
						contentElement.append("<table width='100%' style='border-collapse:collapse;' border='1px'><th style='text-align:center' width='30px'>No</th><th width='44px' style='text-align:center'>Qty</th><th style='text-align:center' width='30px'>Unit</th><th width='400px' style='text-align:center'>Description"+"</th><th width='130px' style='text-align:center'>Price Unit <?php echo'<br/>'.$model->pricelist->name ?></th><th style='text-align:center'>Price Sub<?php echo'<br/>'.$model->pricelist->name ?></th></table>");

					}
		// 			$dataContent[$key]['no']=$no;	
		// $dataContent[$key]['product_uom_qty']=$value->product_uom_qty;
		// $dataContent[$key]['default_code']=$value->product->default_code;
		// $dataContent[$key]['name_product']=$value->product->name_template;
		// $dataContent[$key]['unit_price']=$value->price_unit;
		// $dataContent[$key]['price_sub']=$value->product_uom_qty*$value->price_unit
		// $no++;	
					
					contentElement.append("<table width='100%' style='border-collapse:collapse; margin-top:-1px;'border='1px' >"+"<tr>"+"<td width='30px' valign='top'>"+value.no+"</td>"+"<td valign='top' width='44px'>"+value.product_uom_qty+"</td>"+"<td width='30px' valign='top'>"+value.unit+"</td>"+"<td width='400px' contenteditable='true'>"+"["+value.default_code+"]"+value.name_product+"<br/>"+value.deskription_orderline+"<div class='isi-"+noMaterial+"'></div>"+"</td>"+"<td valign='top' width='130px'>"+value.unit_price+"</td>"+"<td valign='top'>"+value.price_sub+"</td>"+"</tr></table>");
					// console.log(value.material_line.length+"<<<<<<<<<<<<<<<<")
					// console.log(value.material_line)

					if(value.material_line.length>1){
						
					
						// console.log(value.material_line)
						jQuery.each(value.material_line,function(indexMaterial,valueMaterial){
							var materialElement = jQuery('page#page-'+cursor+' .content'+' .isi-'+noMaterial);
							// console.log(materialElement+">>>>>>>>>>>>>>>"+cursor)

							if (indexMaterial==0){
								materialElement.append("Consist of:<ul style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.product_id+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
								}
							else{
								var contentElement = jQuery('page#page-'+cursor+' .content');
								var tinggiContent = contentElement.height();
								// console.log(value.name_product +"---"+valueMaterial.product_id)
								// console.log(tinggiContent +indexMaterial+"->>>>>"+value.name_product+"---"+valueMaterial.product_id)
								if (tinggiContent<500){
								console.log(indexMaterial+"->>>>>"+valueMaterial.product_id)

								// console.log('Masuk')
								materialElement.append("<ul  style='margin-top:-16px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.product_id+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
								}
								else{

									var cursorLama = cursor;
									cursor++;
									jQuery("page#page-"+cursorLama).after(template);
									jQuery("page:last").attr("id","page-"+cursor);	
									var contentElement = jQuery('page#page-'+cursor+' .content');
									// console.log(contentElement)

									jQuery('page#page-'+cursor+' .content').append("<table width='100%' border='1px' style='border-collapse:collapse';><th style='text-align:center' width='30px'>No</th><th width='44px' style='text-align:center'>Qty</th><th style='text-align:center' width='30px'>Unit</th><th width='400px' style='text-align:center'>Description"+"</th><th width='130px' style='text-align:center'>Price Unit<?php echo'<br/>'.$model->pricelist->name ?></th><th style='text-align:center'>Price Sub<?php echo'<br/>'.$model->pricelist->name ?></th></table>");
									if (indexMaterial==0){
										contentElement.append("<table border='1px' width='100%' style='border-collapse:collapse ; margin-top:-1px;' >"+"<tr>"+"<td width='30px'>"+value.no+"</td>"+"<td width='44px'>"+value.product_uom_qty+"</td>"+"<td width='30px'>"+value.unit+"</td>"+"<td width='400px' contenteditable='true'>"+"["+value.default_code+"]"+value.name_product+"Consist of:<ul style='margin-top:0px'>"+"<div class='isi-"+noMaterial+"'></div>"+"</ul>"+"</td>"+"<td width='130px'>"+value.unit_price+"</td>"+"<td>"+value.price_sub+"</td>"+"</tr></table>");

									}
									else {
										var contentElement = jQuery('page#page-'+cursor+' .content');
										var tinggiContent = contentElement.height();
										// console.log(tinggiContent+"tingggiii"+valueMaterial.product_id)
										contentElement.append("<div class=test><table border='1px' width='100%' style='border-collapse:collapse ; margin-top:-1px;'; >"+"<tr>"+"<td width='30px'>"+"</td>"+"<td width='44px'>"+"</td>"+"<td width='30px'>"+"</td>"+"<td width='400px' contenteditable='true'>"+"<div class='isi-"+noMaterial+"'></div>"+"</td>"+"<td width='130px'>"+"</td>"+"<td>"+"</td>"+"</tr></table></div>");
										var contentElement = jQuery('page#page-'+cursor+' .content');
										var tinggiContent = contentElement.height();
										var materialElement = jQuery('page#page-'+cursor+' .content'+' .isi-'+noMaterial);
										// console.log(tinggiContent+"tingggiii")
									
										if (!value.material_line[indexMaterial+1]){

											$("div").remove(" .test")
										}
										materialElement.append("<ul><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.product_id+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
										console.log(valueMaterial.product_id+"????????")
									}


								}
								// else{
								// 	// console.log("else")
								// 	contentfooter.remove();
								// 	var cursorLama = cursor;
								// 	cursor++;
								// 	jQuery("page#page-"+cursorLama).after(template);
								// 	jQuery("page:last").attr("id","page-"+cursor);
								// 	var contentElement = jQuery('page#page-'+cursor+' .content');
								// 	jQuery('page#page-'+cursor+' .content').append("<table width='100%' border='1px' style='border-collapse:collapse';><th style='text-align:center' width='30px'>No</th><th width='44px' style='text-align:center'>Qty</th><th style='text-align:center' width='30px'>Unit</th><th width='400px' style='text-align:center'>Description"+"</th><th width='130px' style='text-align:center'>Price Unit</th><th style='text-align:center'>Price Sub</th></table>");
								// 	// contentElement.append("<table border='1px' width='100%' style='border-collapse:collapse ;border-top-style: none;'; >"+"<tr>"+"<td width='30px'>"+value.no+"</td>"+"<td width='44px'>"+value.product_uom_qty+"</td>"+"<td width='30px'>"+value.unit+"</td>"+"<td width='400px' contenteditable='true'>"+"["+value.default_code+"]"+value.name_product+"<br/>Consist of:<ul>"+"<div class='isi-"+noMaterial+"'></div>"+"</ul>"+"</td>"+"<td width='130px'>"+value.unit_price+"</td>"+"<td>"+value.price_sub+"</td>"+"</tr></table>");
								// 	// materialElement.append("<li>"+valueMaterial.product_id+"</li>")

								// }
							
								}

						});
						// materialElement.append("</ul>")
						noMaterial++
					}

					else if(value.material_line.length==1){
						var materialElement = jQuery(' .isi-'+noMaterial); 	

						jQuery.each(value.material_line,function(indexMaterial,valueMaterial){ 
							// console.log(value.name_product+"==================="+valueMaterial.product_id)
							if (value.name_product!==valueMaterial.product_id){
								// console.log("sip")
								materialElement.append("Consist of:<ul style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.product_id+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")

							}
						});
						noMaterial++

					}
						
				}
				else
				{	
					// contentfooter.remove();
					// console.log(tinggiContent+" <--- else");
					var cursorLama = cursor;
					cursor++;
					jQuery("page#page-"+cursorLama).after(template);
					jQuery("page:last").attr("id","page-"+cursor);
					var contentElement = jQuery('page#page-'+cursor+' .content');


					jQuery('page#page-'+cursor+' .content').append("<table width='100%' border='1px' style='border-collapse:collapse';><th style='text-align:center' width='30px'>No</th><th width='44px' style='text-align:center'>Qty</th><th style='text-align:center' width='30px'>Unit</th><th width='400px' style='text-align:center'>Description"+"</th><th width='130px' style='text-align:center'>Price Unit <?php echo'<br/>'.$model->pricelist->name ?></th><th style='text-align:center'>Price Sub <?php echo'<br/>'.$model->pricelist->name ?></th></table>");
					
					contentElement.append("<table width='100%' style='border-collapse:collapse; margin-top:-1px;'border='1px' >"+"<tr>"+"<td width='30px' valign='top'>"+value.no+"</td>"+"<td valign='top' width='44px'>"+value.product_uom_qty+"</td>"+"<td width='30px' valign='top'>"+value.unit+"</td>"+"<td width='400px' contenteditable='true'>"+"["+value.default_code+"]"+value.name_product+"<div class='isi-"+noMaterial+"'></div>"+"</td>"+"<td valign='top' width='130px'>"+value.unit_price+"</td>"+"<td valign='top'>"+value.price_sub+"</td>"+"</tr></table>");
						
					jQuery.each(value.material_line,function(indexMaterial,valueMaterial){
					var materialElement = jQuery(' .isi-'+noMaterial);
					// console.log(valueMaterial.product_id);
					materialElement.append("<ul  style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.product_id+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li><ul>");
					// console.log(tinggiContent+" <--- else")
				});
					noMaterial++
					}

			});
			var contentfooter= jQuery('page#page-'+cursor+' .footer');
			var contentElement = jQuery('page#page-'+cursor+' .content');
			var tinggiContent = contentElement.height();
			// console.log(tinggiContent);
			if (tinggiContent<=517)	{
				contentfooter.append("<table border='1px' width='100%' style='border-collapse:collapse ; margin-top:-1px;' >"+"<tr>"+"<td style='border:none;' width='33px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Base Total"+"</td>"+"<td>"+'<?= number_format($model->base_total,2)?>'+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Discount"+"</td>"+"<td>"+"<?= number_format($model->total_amount_discount,2)?>"+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Sub Total"+"</td>"+"<td>"+"<?= number_format($model->amount_untaxed,2)?>"+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Tax"+"</td>"+"<td>"+'<?= number_format($model->amount_tax,2)?>'+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Total"+"</td>"+"<td>"+'<?= number_format($model->amount_total,2)?>'+"</td>"+"</tr>"+"</table>");
			}
			else{
				var cursorLama = cursor;
				cursor++;
				jQuery("page#page-"+cursorLama).after(template);
				jQuery("page:last").attr("id","page-"+cursor);
				var contentElement = jQuery('page#page-'+cursor+' .content');
				var contentfooter= jQuery('page#page-'+cursor+' .footer');
				jQuery('page#page-'+cursor+' .content').append("<table width='100%' border='1px' style='border-collapse:collapse';><th style='text-align:center' width='30px'>No</th><th width='44px' style='text-align:center'>Qty</th><th style='text-align:center' width='30px'>Unit</th><th width='400px' style='text-align:center'>Description"+"</th><th width='130px' style='text-align:center'>Price Unit <?php echo'<br/>'.$model->pricelist->name ?></th><th style='text-align:center'>Price Sub <?php echo'<br/>'.$model->pricelist->name ?></th></table>");
				contentfooter.append("<table border='1px' width='100%' style='border-collapse:collapse ; margin-top:-1px;' >"+"<tr>"+"<td style='border:none;' width='33px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Base Total"+"</td>"+"<td>"+'<?= number_format($model->base_total,2)?>'+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Discount"+"</td>"+"<td>"+"<?= number_format($model->total_amount_discount,2)?>"+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Sub Total"+"</td>"+"<td>"+"<?= number_format($model->amount_untaxed,2)?>"+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Tax"+"</td>"+"<td>"+'<?= number_format($model->amount_tax,2)?>'+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Total"+"</td>"+"<td>"+'<?= number_format($model->amount_total,2)?>'+"</td>"+"</tr>"+"</table>");
			}
			var contentfooter= jQuery('page#page-'+cursor+' .footer');
			var contentElement = jQuery('page#page-'+cursor+' .content');
			var tinggiContent = contentElement.height();
			if (tinggiContent<=261){
				contentfooter.append("<table width='45%'><tr><td width='40%'><b>Term Of Payment</b></td><td width='3%'><b>:</b></td><td><?php if($model->paymentTerm!==null){echo $model->paymentTerm->name;}?></td></tr><tr><td valign='top'><b>Term Condition</b></td><td valign='top'><b>:</b></td><td><?php echo '<ul>';foreach ($model->termCondition as $key_term => $value_term) {	echo '<li>'.$value_term->name.'</li>';}echo '</ul>'?></td></tr><tr><td valign='top'><b>Note</b></td><td valign='top'><b>:</b></td><td><?=preg_replace('#\R+#','<br/>',$model->note)?></td></tr></table><br/><table width='30%'><tr> <td valign='top' style='text-align:center' height='80'>Thank you and best regards</td></tr><tr><td valign='top' style='text-align:center'>"+"<?=$model->user->name ?>"+"</td></tr></table>");

			}
			else{
				var cursorLama = cursor;
				cursor++;
				
				jQuery("page#page-"+cursorLama).after(template);
				jQuery("page:last").attr("id","page-"+cursor);
				var contentfooter= jQuery('page#page-'+cursor+' .footer');
				contentfooter.append("<table width='45%'><tr><td width='40%'><b>Term Of Payment</b></td><td width='3%'><b>:</b></td><td><?php if($model->paymentTerm!==null){echo $model->paymentTerm->name;}?></td></tr><tr><td valign='top'><b>Term Condition</b></td><td valign='top'><b>:</b></td><td><?php echo '<ul>';foreach ($model->termCondition as $key_term => $value_term) {	echo '<li>'.$value_term->name.'</li>';}echo '</ul>'?></td></tr><tr><td valign='top'><b>Note</b></td><td valign='top'><b>:</b></td><td><?=preg_replace('#\R+#','<br/>',$model->note)?></td></tr></table><br/><table width='30%'><tr> <td valign='top' style='text-align:center' height='80'>Thank you and best regards</td></tr><tr><td valign='top' style='text-align:center'>"+"<?=$model->user->name ?>"+"</td></tr></table>");

			}

		});
	</script>

</html>