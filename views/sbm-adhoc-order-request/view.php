<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SbmAdhocOrderRequest */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sbm Adhoc Order Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sbm-adhoc-order-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            'cust_ref_no',
            'term_of_payment',
            'scope_of_work:ntext',
            'attention_id',
            'sales_man_id',
            'term_condition:ntext',
            'name',
            'customer_site_id',
            'cust_ref_type',
            'state',
            'sale_group_id',
            'customer_id',
            'notes:ntext',
        ],
    ]) ?>

</div>
