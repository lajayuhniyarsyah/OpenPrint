<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SbmWorkOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sbm Work Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sbm-work-order-view">

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
            'adhoc_order_request_id',
            'due_date',
            'approver',
            'sale_order_id',
            'state',
            'repeat_ref_id',
            'order_date',
            'location_id',
            'work_location',
            'source_type',
            'customer_site_id',
            'wo_no',
            'approver2',
            'approver3',
            'request_no',
            'customer_id',
            'notes:ntext',
            'seq_wo_no',
            'seq_req_no',
        ],
    ]) ?>

</div>
