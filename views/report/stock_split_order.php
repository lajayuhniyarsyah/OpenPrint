<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	@page {
		size: auto; /* auto is the initial value */
		/* this affects the margin in the printer settings */
		margin-bottom: 25mm;
		margin-top: 5mm;
	}
	body {
		/* this affects the margin on the content before sending to printer */
		margin: 0px;
	}
</style>
<body>
	<table style="width:700px;" border="0" align="center" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td colspan="4">
					<div>
						<?= Html::img('logo.jpg', ['alt'=>'Logo Supra','style'=>'height:80px;']);?> 
					</div>
					<div style="text-align: center;margin-bottom: 30px;">
						<strong>
							<u>STOCK SPLIT ORDER</u>
							<br>#HO/WHS/SPL/16/0001
						</strong>
					</div>
				</td>
			</tr>
			<tr>
				<td>Warehouse</td>
				<td>: Head Office</td>
				<td>Date</td>
				<td>: 10/02/2016</td>
			</tr>
			<tr>
				<td colspan="4">
					<div style="margin-top: 30px;margin-bottom: 10px;">
						Order to Split stock Item with Detail :
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<table style="width:700px;border: 1px solid black;" border="0" align="center" cellspacing="0" cellpadding="5">
						<tr>
							<th width="6%" style="border-right: 1px solid #000000;">No</th>
							<th width="47%" style="border-right: 1px solid #000000;">Item To Split</th>
							<th width="47%">Splited To</th>
						</tr>
					</table>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="4">
					<table style="width:700px;border: 1px solid black;border-top: 0;" border="0" align="center" cellspacing="0" cellpadding="5">
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">1</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">SC 2000 (1 Drum)</td>
							<td width="47%" valign="top">SC 2000 Can <br> Qty based on converting result<br> Qty based on converting result<br> Qty based on converting result</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">2</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">[SS65] SS 65 Super Screw Belt (1 Roll)</td>
							<td width="47%" valign="top">[SS65PS] SS 65 (1200mm) <br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">1</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">SC 2000 (1 Drum)</td>
							<td width="47%" valign="top">SC 2000 Can <br> Qty based on converting result<br> Qty based on converting result<br> Qty based on converting result</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">2</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">[SS65] SS 65 Super Screw Belt (1 Roll)</td>
							<td width="47%" valign="top">[SS65PS] SS 65 (1200mm) <br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">1</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">SC 2000 (1 Drum)</td>
							<td width="47%" valign="top">SC 2000 Can <br> Qty based on converting result<br> Qty based on converting result<br> Qty based on converting result</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">2</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">[SS65] SS 65 Super Screw Belt (1 Roll)</td>
							<td width="47%" valign="top">[SS65PS] SS 65 (1200mm) <br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">1</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">SC 2000 (1 Drum)</td>
							<td width="47%" valign="top">SC 2000 Can <br> Qty based on converting result<br> Qty based on converting result<br> Qty based on converting result</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">2</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">[SS65] SS 65 Super Screw Belt (1 Roll)</td>
							<td width="47%" valign="top">[SS65PS] SS 65 (1200mm) <br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">1</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">SC 2000 (1 Drum)</td>
							<td width="47%" valign="top">SC 2000 Can <br> Qty based on converting result<br> Qty based on converting result<br> Qty based on converting result</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">2</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">[SS65] SS 65 Super Screw Belt (1 Roll)</td>
							<td width="47%" valign="top">[SS65PS] SS 65 (1200mm) <br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">1</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">SC 2000 (1 Drum)</td>
							<td width="47%" valign="top">SC 2000 Can <br> Qty based on converting result<br> Qty based on converting result<br> Qty based on converting result</td>
						</tr>
						<tr>
							<td width="6%" style="border-right: 1px solid #000000;" valign="top">2</td>
							<td width="47%" style="border-right: 1px solid #000000;" valign="top">[SS65] SS 65 Super Screw Belt (1 Roll)</td>
							<td width="47%" valign="top">[SS65PS] SS 65 (1200mm) <br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm<br> Menjadi 2 pcsx600x500 mm</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<div style="margin-top: 10px;" contenteditable='true'>
						Notes : - Lorem ipsum dolor sit amet
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<table style="width:700px;text-align: center;margin-top: 100px;" border="0" align="center" cellspacing="0" cellpadding="0">
						<tr>
							<td>Yang Membuat</td>
							<td>Approval</td>
							<td>Mengetahui</td>
						</tr>
						<tr style="height: 100px;vertical-align: bottom;">
							<td>( Novri )</td>
							<td>( SPV/Admin Manager )</td>
							<td>( Warehouse Manager )</td>
						</tr>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>