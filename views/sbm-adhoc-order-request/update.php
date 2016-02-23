<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SbmAdhocOrderRequest */

$this->title = 'Update Sbm Adhoc Order Request: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sbm Adhoc Order Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sbm-adhoc-order-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
