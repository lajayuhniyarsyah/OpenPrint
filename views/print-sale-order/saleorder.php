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
		padding: 11px;
		
	}
		page .header{
			margin: auto;
			
			
		} 
		page .content{
			margin: auto;
			width: 21cm	;
			max-height: 1000px;
			
		} 
		page .footer{
			margin: auto;
			width: 780px;
			max-height: 1000px;
			/*background-color: green;*/
		} 
		.content table tr td {
			padding: 10px;


		}
		.number{
			float: right;
		}
		.tableHeader tr td{
			vertical-align: top;
		}
		 @media print{
            .hideOnPrint{
                display: none;
                position: absolute;
    			right: 0px;

            }
        }
	

		
		</style>
	</head>
	<body>
		<div id="dokument">
			<page size="A4">
				<div class="header">

					<table width="100%" class="tableHeader">
					<td width="50%">
					<?php 
						// var_dump($model);
					   
					 ?>
						<p>
							<b>PT. SUPRABAKTI MANDIRI</b> <br/>
							Jl. Danau Sunter Utara Blok A No. 9 <br/>
							Jakarta Utara - 14350 14350, Indonesia<br/>
							Phone 021-658 33666 Fax 021-65831666 <br/>
							www.beltcare.com email: info@beltcare.com
						</p>
					   
					</td>
					<td width="50%" style="text-align:right"> <img src="logo.jpg" alt="Logo Supra"> 
					</td>
				</table>
				
				<center><b>SALES ORDER</b></center>
				<center><b><?=$model->name?></b></center>
				<br/>
			
	  
				</div>
				<div class="contentHeader"></div>
				<div class="content">
					<p contenteditable='true'>We would like to offer our product as your requirement as following :</p>	<div class="number"><span class="no"></span> <span class = "noTotal"></span></div>
					<table id="TableSo" width="100%" border='1px' style='border-collapse:collapse;'>
						<tr><td width='5%''><center><b>No</b></center></td><td width='10%''><center><b>Qty</b></center></td><td width='5%'><center><b>Unit</b></center></td><td width='45%'><center><b>Description</b></center></td><td width='15%'><center><b>Price Unit
						<br/>
						<?php echo $model->pricelist->name; ?></b></center></td><td width='20%'><center><b>Price Sub<br/><?php echo $model->pricelist->name; ?></b></center></td></tr>
					</table>
				</div>
				<div class="footer">
					
				</div>
			
			</page>
		</div>
		
	</body>

	<?php
		if($model->attention0){
			$alamat =   $model->attention0->street.' 
					  '.$model->attention0->street2.' 

					  '.$model->attention0->city.'
					  '.$model->attention0->zip;
		}
		else{
			$alamat =   $model->partner->street.' 
					  '.$model->partner->street2.' 
					  '.$model->partner->city.' 
					  '.$state.'
					  '.$model->partner->zip.'
					  '.$country;			
		}
		$alamat =preg_replace( "/\r|\n/", "", $alamat);

	?>
	<script type="text/javascript">
		jQuery(function(){
			
			var data = <?php echo json_encode($dataContent); ?>;
			var cursor = 1;
			var template = jQuery('#dokument').html();
			
			var footerTable = "<tr>"+"<td style='border:none;' width='33px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Base Total"+"</td>"+"<td align='right'>"+'<?= number_format($model->base_total,2)?>'+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Discount"+"</td>"+"<td align='right'>"+"<?= number_format($model->total_amount_discount,2)?>"+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Sub Total"+"</td>"+"<td align='right'>"+"<?= number_format($model->amount_untaxed,2)?>"+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Tax"+"</td>"+"<td align='right'>"+'<?= number_format($model->amount_tax,2)?>'+"</td>"+"</tr>"+"<tr>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='44px'>"+"</td>"+"<td style='border:none;' width='30px'>"+"</td>"+"<td style='border:none;' width='400px' >"+"</td>"+"<td width='130px'>"+"Total"+"</td>"+"<td align='right'>"+'<?= number_format($model->amount_total,2)?>'+"</td>"+"</tr>";
			jQuery('page').attr('id','page-'+cursor);

			noMaterial = 1
			headerElement = jQuery('page#page-'+cursor+' .header');
			contentheader = jQuery('page#page-'+cursor+' .contentHeader');
			number = jQuery('page#page-'+cursor+' .number .no');
			number.append("Page "+cursor)
			var contentHeader ="<table width=100% class=tableHeader><td valign=top witdh=50%><table width=100%><tr><td width=119>Company<td width=5>:<td width=275><?=$model->partner->name?><tr><td>Attn<td>:<td><?=$AttentionName?><tr valign=top><td>Delivery Address<td>:<td height=54><?=$street_shipping.' '?><?=$street_shipping_2.' '?><?=$city_shipping.' '?><?=$state_shipping.' '?><?=$country_shipping.' '?><tr valign=top><td>Invoice Address<td>:<td height=54><?=$street_invoice.' '?><?=$street_invoice_2.' '?><?=$city_invoice.' '?><?=$state_invoice.' '?><?=$country_invoice.' '?><tr><td>Phone<td>:<td><?= $AttentionPhone?><tr><td>Fax<td>:<td><?=$fax ?><tr><td>Email<td>:<td><?= $email?></table><td width=50% valign=top><table width=100%><tr><td width=140>Quotation#<td width=5>:<td width=253><?=$model->quotation_no?><tr><td>Customer Reference#<td>:<td><?=$model->client_order_ref?><tr><td>Date<td>:<td><?=date('d/m/Y', strtotime($model->date_order));?><tr><td>Sales Contact<td>:<td><?=$sales ?><tr><td>Sales Group<td>:<td><?=strtoupper($model->group->name);?><tr><td>Fax<td>:<td><?=$model->user->partner->fax?><tr><td>Email<td>:<td><?=$model->user->partner->email?></table></table>"

			contentheader.append(contentHeader)
			// headerElement.append(headerTable)
			jQuery.each(data,function(index,value){

				var contentElement = jQuery('page#page-'+cursor+' .content');
				var isi_table = jQuery('page#page-'+cursor+' .content table');
				var tinggiContent = contentElement.height();
				var elTable = "<tr><td valign='top' width='5%' align='center'>"+value.no +"</td>"+"<td valign='top' width='10%' align='center'>"+value.product_uom_qty +"</td>"+"<td valign='top' width='5%'>"+value.unit +"</td>"+"<td width=45%>"+"["+value.default_code+"]"+value.name_product+"<br/>"+ value.deskription_orderline+"<div class='isi-"+noMaterial+"'></div>"+"</td>"+"<td width='15%' valign='top' align='right'>"+value.unit_price +"</td>"+"<td width='20%' valign='top' align='right'>"+value.price_sub +"<div class='hideOnPrint'><img class='buttonAddRowBefore' src='up.png' alt='upRow' height='20px'width='20px' style='cursor:pointer;position: absolute; right:248px'><br/><img class='buttonAddRowAfter' src='down.png' alt='downRow' height='20px'width='20px' style='cursor:pointer;position: absolute; right:248px'></div> </td>"+"</tr>";
				
				if (tinggiContent<500){
					isi_table.append(elTable)
					if(value.material_line.length>1){
						jQuery.each(value.material_line,function(indexMaterial,valueMaterial){

							var materialElement = jQuery('page#page-'+cursor+' .content'+' .isi-'+noMaterial);
							if (indexMaterial==0){
								var contentElement = jQuery('page#page-'+cursor+' .content');
								var tinggiContent = contentElement.height();
								if (tinggiContent<460){
										materialElement.append("Consist of:<ul style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.ProductName+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
								}
								else{
									var cursorLama = cursor
									cursor++
									jQuery('page#page-'+cursorLama).after(template);
									jQuery('page:last').attr('id','page-'+cursor);
									
									number = jQuery('page#page-'+cursor+' .number .no');
									number.append("Page "+cursor)
									var contentElement = jQuery('page#page-'+cursor+' .content');
									var isi_table = jQuery('page#page-'+cursor+' .content table');
									isi_table.append("<tr><td valign='top' width='5%'>"+"</td>"+"<td valign='top' width='10%' >"+"</td>"+"<td valign='top' width='5%'>"+"</td>"+"<td contenteditable='True' width=45%>"+"<div class='isi-"+noMaterial+"'></div>"+"</td>"+"<td width='15%' valign='top'>"+"</td>"+"<td width='20%' valign='top'>"+"</td>"+"</tr>")
									var materialElement = jQuery('page#page-'+cursor+' .content'+' .isi-'+noMaterial);
									materialElement.append("Consist of:<ul style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.ProductName+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
								}
							}
							else{
								var contentElement = jQuery('page#page-'+cursor+' .content');
								var tinggiContent = contentElement.height();
								if (tinggiContent<490){
									materialElement.append("<ul  style='margin-top:-16px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.ProductName+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
								}
								else{
									var cursorLama = cursor
									cursor++
									jQuery('page#page-'+cursorLama).after(template);
									jQuery('page:last').attr('id','page-'+cursor);

									
									var contentElement = jQuery('page#page-'+cursor+' .content');
									var isi_table = jQuery('page#page-'+cursor+' .content table');
									number = jQuery('page#page-'+cursor+' .number .no');
									number.append("Page "+cursor)
									isi_table.append("<tr><td valign='top' width='5%'>"+"</td>"+"<td valign='top' width='10%' >"+"</td>"+"<td valign='top' width='5%'>"+"</td>"+"<td contenteditable='True' width=45%>"+"<div class='isi-"+noMaterial+"'></div>"+"</td>"+"<td width='15%' valign='top'>"+"</td>"+"<td width='20%' valign='top'>"+"</td>"+"</tr>")
									if (indexMaterial==0){
										materialElement.append("Consist of:<ul style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.ProductName+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
									}
									else{
										var contentElement = jQuery('page#page-'+cursor+' .content');
										var tinggiContent = contentElement.height();
									
										materialElement.append("<ul  style='margin-top:-16px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.ProductName+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")

									}

								}
							}

							
						})
						noMaterial++
					}
						else if(value.material_line.length==1){
							var materialElement = jQuery(' .isi-'+noMaterial); 	

							jQuery.each(value.material_line,function(indexMaterial,valueMaterial){

								if (value.product_id==valueMaterial.product_id)
								{
									if (value.product_uom_id != valueMaterial.product_uom_id || value.product_uom_qty != valueMaterial.qty){
											materialElement.append("<b>Detail Product: </b><ul style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.ProductName+"<br/>"+valueMaterial.descriptionMaterial+"<b> ("+valueMaterial.qty+" "+valueMaterial.uom+")</b></li></ul>")
									}else{
										materialElement.append(valueMaterial.descriptionMaterial)
									}

								}else{
									materialElement.append("Consist of:<ul style='margin-top:0px'><li>"+"["+valueMaterial.partNumber+"]"+valueMaterial.ProductName+"("+valueMaterial.qty+" "+valueMaterial.uom+")"+"<br/>"+valueMaterial.descriptionMaterial+"</li></ul>")
								}
							});
							noMaterial++

						
					}
				}
				else{
					var cursorLama = cursor
					cursor++
					jQuery('page#page-'+cursorLama).after(template);
					jQuery('page:last').attr('id','page-'+cursor);

					var isi_table = jQuery('page#page-'+cursor+' .content table');

					isi_table.append(elTable);
					number = jQuery('page#page-'+cursor+' .number .no');
					number.append("Page "+cursor)
				
				}

			
				});
			var contentElement = jQuery('page#page-'+cursor+' .content');
			var tinggiContent = contentElement.height();

			// console.log(tinggiContent)
			if (tinggiContent <=400){
				var isi_table = jQuery('page#page-'+cursor+' .content table');
				isi_table.append(footerTable);
			}
			else{
					var cursorLama = cursor
					cursor++
					jQuery('page#page-'+cursorLama).after(template);
					jQuery('page:last').attr('id','page-'+cursor);

					var isi_table = jQuery('page#page-'+cursor+' .content table');
					headerElement = jQuery('page#page-'+cursor+' .header');
					// headerElement.append(headerTable)
					isi_table.append(footerTable);
					number = jQuery('page#page-'+cursor+' .number .no');
					number.append("Page "+cursor)

			}
			// console.log(tinggiContent)
			var contentElement = jQuery('page#page-'+cursor+' .content');
			var tinggiContent = contentElement.height();
			var contentfooter= jQuery('page#page-'+cursor+' .footer');
			// console.log(tinggiContent)
			if (tinggiContent<500){
				
				contentfooter.append("<table width='100%'><tr><td width='18%'><b>Term Of Payment</b></td><td width='3%'><b>:</b></td><td><?php if($model->paymentTerm!==null){echo ucfirst($model->paymentTerm->name).' - '.$model->getPolicyCaption();}?></td></tr><tr><td valign='top'><b>Term Condition</b></td><td valign='top'><b>:</b></td><td><div id='term_condition-"+cursor+"'></div></tr><tr id='note-"+cursor+"'><td valign='top' ><b>Note</b></td><td valign='top'><b>:</b></td><td id='isi_note-"+cursor+"'></td></tr><tr><td valign='top'><b>Scope of Work PT.Suprabakti Mandiri</b></td><td valign='top'><b>:</b></td><td valign='top'><?= preg_replace('#\R+#','<br/>',$model->scope_work_supra_text)?></td></tr><tr><td valign='top'><b>Scope of Work Customer</b></td><td valign='top'><b>:</b></td><td valign='top'><?= preg_replace('#\R+#','<br/>',$model->scope_work_customer_text)?></td></tr></table><br/>");
				
				// di mulai dari sini pengkondisian untuk mengatur enter term of payment
				jQuery.each(data[0]['TermCondition'],function(index,value){
					var contentElement = jQuery('page#page-'+cursor+' .content');
				
					var contentfooter= jQuery('page#page-'+cursor+' .footer');
					var tinggiContentFooter = contentfooter.height()+contentElement.height();
					if (tinggiContentFooter<850){
						jQuery("#term_condition-"+cursor).append(value+"<br/>")
					}
					else{

						jQuery("#note-"+cursor).remove();
						var cursorLama = cursor;
						cursor++;
						jQuery('page#page-'+cursorLama).after(template);
						jQuery('page:last').attr('id','page-'+cursor);
						jQuery("page#page-"+cursor+' .content p').remove()
						jQuery("page#page-"+cursor+' .content table').remove()
						number = jQuery('page#page-'+cursor+' .number .no');
						number.append("Page "+cursor)
						var tinggiContent = contentElement.height();
						var contentfooter= jQuery('page#page-'+cursor+' .footer');
						contentfooter.append("<table width='100%'><tr><td valign='top'><b>Term Condition</b></td><td valign='top'><b>:</b></td><td><div id='term_condition-"+cursor+"'></div></tr><tr id='note-"+cursor+"'><td valign='top' ><b>Note</b></td><td valign='top'><b>:</b></td><td id='isi_note-"+cursor+"'></td></tr></table><br/>");
						jQuery("#term_condition-"+cursor).append(value+"<br/>")
					}
				});
				// di akhiri dari sini pengkondisian untuk mengatur enter term of payment


				// di mulai dari sini pengkondisian untuk mengatur enter note
				jQuery.each(data[0]['Note'],function(index,value){
					var contentElement = jQuery('page#page-'+cursor+' .content');
				
					var contentfooter= jQuery('page#page-'+cursor+' .footer');
					var tinggiContentFooter = contentfooter.height()+contentElement.height();
					if (tinggiContentFooter<850){
						jQuery('#isi_note-'+cursor).append(value+"<br/>")
					}
					else{

						

						var cursorLama = cursor
						cursor++

						jQuery('page#page-'+cursorLama).after(template);
						jQuery('page:last').attr('id','page-'+cursor);
						jQuery("page#page-"+cursor+' .content p').remove()
						jQuery("page#page-"+cursor+' .content table').remove()
						number = jQuery('page#page-'+cursor+' .number .no');
						number.append("Page "+cursor)
						var tinggiContent = contentElement.height();
						var contentfooter= jQuery('page#page-'+cursor+' .footer');
						contentfooter.append("<table width='100%'><tr id='note-"+cursor+"'><td valign='top' ><b>Note</b></td><td valign='top'><b>:</b></td><td id='isi_note-"+cursor+"'></td></tr></table><br/>");
						jQuery("#isi_note-"+cursor).append(value+"<br/>")
					}
				});
			}
			else{
				var cursorLama = cursor
				cursor++
				jQuery('page#page-'+cursorLama).after(template);
				jQuery('page:last').attr('id','page-'+cursor);
				number = jQuery('page#page-'+cursor+' .number .no');
				number.append("Page "+	cursor)
				var contentfooter= jQuery('page#page-'+cursor+' .footer');
				var isi_table = jQuery('page#page-'+cursor+' .content table');
				isi_table.remove()
				contentfooter.append("<table width='100%'><tr><td width='18%'><b>Term Of Payment</b></td><td width='3%'><b>:</b></td><td><?php if($model->paymentTerm!==null){echo $model->paymentTerm->name;}?></td></tr><tr><td valign='top'><b>Term Condition</b></td><td valign='top'><b>:</b></td><td><?php echo preg_replace('#\R+#','<br/>',$model->internal_notes)?></td></tr><tr><td valign='top'><b>Note</b></td><td valign='top'><b>:</b></td><td></td></tr>");


			}
			
			jQuery('.buttonAddRowAfter').click(function(){
				// console.log($(this)[0].parentElement)
				console.log($(this).closest('tr'))
				jQuery($(this).closest('tr')).after("<tr><td colspan='6'><div contenteditable='True' >Tambahkan Data di sini</div><div class='hideOnPrint'><img class='buttonRemove' src='remove.png' alt='remove' height='20px'width='20px' style='cursor:pointer; position: absolute; right:248px'></div></td></tr>")

				jQuery('.buttonRemove').click(function(){
				
					jQuery($(this).closest('tr')).remove()
					})
			})
			jQuery('.buttonAddRowBefore').click(function(){
				// console.log($(this)[0].parentElement)
				console.log($(this).closest('tr'))
				jQuery($(this).closest('tr')).before("<tr><td colspan='6' ><div contenteditable='True' >Tambahkan Data di sini</div><div class='hideOnPrint'><img class='buttonRemove' src='remove.png' alt='remove' height='20px'width='20px' style='cursor:pointer;position: absolute; right:248px'></div> <div class='hideOnPrint'></td></tr>")
				jQuery('.buttonRemove').click(function(){
					
					jQuery($(this).closest('tr')).remove()
					})
	
			})
			var contentfooter= jQuery('page#page-'+cursor+' .footer');
			contentfooter.append("<table width='30%'><tr> <td valign='top' style='text-align:center' height='80'>Thank you and best regards</td></tr><tr><td valign='top' style='text-align:center'>"+"<?=$sales ?>"+"</td></tr></table>")
		  jQuery(".number .noTotal").html(" of "+cursor);
		});
	</script>
</html>