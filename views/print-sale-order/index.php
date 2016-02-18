<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8">
		<title>A4 CSS page template</title>
		
		
		
		
				<style>
			/* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
			body {
	background: #cccccc;
}

page[size="A4"] {
	background: white;
	width: 21cm;
	height: 29.7cm;
	display: block;
	margin: 0 auto;
	margin-bottom: 0.5cm;
	
}

@media print {
	body, page[size="A4"] {
		margin: 0;
		box-shadow: 0;
	}
}

		</style>

		
				<script src="js/prefixfree.min.js"></script>

		
	</head>

	<body>

		<page size="A4">
      
            <header>
                <table width="100%">
                    <td width="50%">
                    <?php 
                        // var_dump($model);
                       
                     ?>
                        <p><br><br> 
                            <b>PT. SUPRABAKTI MANDIRI</b> <br/>
                            Jl. Danau Sunter Utara Blok A No. 9 <br/>
                            Jakarta Utara - 14350 14350, Indonesia<br/>
                            Phone 021-658 33666 Fax 021-65831666 <br/>
                            www.belcare.com email: info@belcare.com
                        </p>
                        <?php var_dump($model->user); ?>
                    </td>
                    <td width="50%" style="text-align:right"> <img src="logo.jpg" alt="Logo Supra"> 
                    </td>
                </table>
            </header>
           
            <center><b>Quotation</b></center>
            <center><b><?=$model->name?></b></center>
            <table width="100%">
                <td witdh="50%" valign="top">
                    <table width="100%">
                        <tr>
                            <td>To</td>
                            <td>:</td>
                            <td><?=$model->attention0->name?></td>
                        </tr>
                        <tr valign="top">
                            <td>Company</td>
                            <td>:</td>
                            <td height="54">
                                <?=$model->partner->name?><br/>
                                <?=$model->partner->street?>
                                <?=$model->partner->street2?>
                                <?=$model->partner->city?>
                                <?=$state?>
                                <?=$model->partner->zip?>
                                <?=$country?>

                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?= $model->attention0->phone?></td>
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
                            <td>Date</td>
                            <td>:</td>
                            <td><?=$model->date_order ?></td>
                        </tr>
                        <tr>
                            <td>Sales Contact</td>
                            <td>:</td>
                            <td><?=$model->user->name ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?=$model->user->partner->phone?></td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>:</td>
                            <td><?=$model->user->partner->mobile?></td>
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
            
            <p>We would like to offer our product as your requirement as following</p>
            
      
			
            <table width="100%" border="1px" style="border-collapse:collapse;">
                <th style="text-align:center">No</th>
                <th style="text-align:center">Qty</th>
                <th style="text-align:center">Unit</th>
                <th style="text-align:center">Description</th>
                <th style="text-align:center">Price Unit</th>
                <th style="text-align:center">Price Sub</th>
                
                <tr>
                    <td style="text-align:center">
                        1
                    </td>
                    <td style="text-align:center">
                        2
                    </td>
                    <td style="text-align:center">
                        5
                    </td>
                    <td style="text-align:center">
                        test
                    </td>
                    <td style="text-align:center">
                        1000
                    </td>
                    <td style="text-align:center">
                        1500
                    </td>
                </tr>
                <tr>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td>Base Total</td>
                    <td style="text-align:center">12223</td>
                </tr>
                 <tr>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td>Sub Total</td>
                    <td style="text-align:center">12223</td>
                </tr>
                 <tr>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td>Tax</td>
                    <td style="text-align:center">12223</td>
                </tr>
                 <tr>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td>Total</td>
                    <td style="text-align:center">12223</td>
                </tr>
                
            
            </table>
        

		</page>
		<page size="A4"></page>
		<page size="A4"></page>
		<page size="A4"></page>
		<page size="A4"></page>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

		
		
		
		
	</body>
</html>
