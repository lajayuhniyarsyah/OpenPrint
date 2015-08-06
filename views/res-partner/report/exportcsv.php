<?php

$npwp=str_replace('-','', str_replace('.','', $model->npwp));
$name=str_replace('"', '', strtoupper($model->name));
$street=str_replace('"', '', $model->street);
$phone=str_replace('"', '', $model->phone);
$zip=str_replace('"', '', $model->zip);

$blok=str_replace('"', '', $model->blok);
$nomor=str_replace('"', '', $model->nomor);
$rt=str_replace('"', '', $model->rt);
$rw=str_replace('"', '', $model->rw);
$kecamatan=str_replace('"', '', $model->kecamatan);
$kelurahan=str_replace('"', '', $model->kelurahan);
$kabupaten=str_replace('"', '', $model->kabupaten);
$propinsi=str_replace('"', '', $model->propinsi);
$array_to_csv = Array(
	Array("LT",
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
    ),
    Array("LT",
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
    ),

);


// $array_to_csv = Array(
//     Array("\"LT\"",
//         "\"NPWP\"",
//         "\"NAMA\"",
//         "\"JALAN\"",
//         "\"BLOK\"",
//         "\"NOMOR\"",
//         "\"RT\"",
//         "\"RW\"",
//         "\"KECAMATAN\"",
//         "\"KELURAHAN\"",
//         "\"KABUPATEN\"",
//         "\"PROPINSI\"",
//         "\"KODE_POS\"",
//         "\"NOMOR_TELEPON\"",
//     ),
//     Array("\"LT\"",
//         "\"$npwp\"",
//         "\"$name\"",
//         "\"$street\"",
//         "\"BLOK\"",
//         "\"NOMOR\"",
//         "\"RT\"",
//         "\"RW\"",
//         "\"KECAMATAN\"",
//         "\"KELURAHAN\"",
//         "\"KABUPATEN\"",
//         "\"PROPINSI\"",
//         "\"$zip\"",
//         "\"$phone\"",
//     ),

// );
app\components\ExportCSV::convert_to_csv($array_to_csv, 'customer.csv', ',');