<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SbmWorkOrder */

$this->title = 'Create Sbm Work Order';
$this->params['breadcrumbs'][] = ['label' => 'Sbm Work Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sbm-work-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
