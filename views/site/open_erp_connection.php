<p><strong>Test connection</strong></p>

<?php

// $res = Yii::$app->openERPLib->getCommon("novri","novri");
// var_dump($res);

$rpc = new Yii::$app->openERPLib;
$x = $rpc->login("novri", "novri", "LIVE_2016_01_17", "http://10.36.15.13:8069/xmlrpc/");
print ($x);

?>