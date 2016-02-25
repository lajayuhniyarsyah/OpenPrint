<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SbmAdhocOrderRequest */

$this->title = 'Create Sbm Adhoc Order Request';
$this->params['breadcrumbs'][] = ['label' => 'Sbm Adhoc Order Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sbm-adhoc-order-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
