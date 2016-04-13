<?php
    $customer[]=Array("LT",
			        "NPWP",
			        "NAMA",
			        "JALAN",
			        "BLOK",
			        "NOMOR",
			        "RT",
			        "RW",
			        "KECAMATAN",
			        "KELURAHAN",
			        "KABUPATEN",
			        "PROPINSI",
			        "KODE_POS",
			        "NOMOR_TELEPON",
			    );

    foreach ($model as $value) {
    	$npwp=str_replace('-','', str_replace('.','', $value['npwp']));
        $name=str_replace('"', '', strtoupper($value['name']));
        $street=str_replace('"', '', $value['street']);
        $phone=str_replace('"', '', $value['phone']);
        $zip=str_replace('"', '', $value['zip']);

        $blok=str_replace('"', '', $model->blok);
		$nomor=str_replace('"', '', $model->nomor);
		$rt=str_replace('"', '', $model->rt);
		$rw=str_replace('"', '', $model->rw);
		$kecamatan=str_replace('"', '', $model->kecamatan);
		$kelurahan=str_replace('"', '', $model->kelurahan);
		$kabupaten=str_replace('"', '', $model->kabupaten);
		$propinsi=str_replace('"', '', $model->propinsi);

        $customer[]=Array("LT",
			        "$npwp",
			        "$name",
			        "$street",
			        "$blok",
			        "$nomor",
			        "$rt",
			        "$rw",
			        "$kecamatan",
			        "$kelurahan",
			        "$kabupaten",
			        "$propinsi",
			        "$zip",
			        "$phone",
			);
    }

$array_to_csv =$customer;
app\components\ExportCSV::convert_to_csv($array_to_csv, 'customertree.csv', ',');