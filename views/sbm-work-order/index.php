<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SbmWorkOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sbm Work Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sbm-work-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sbm Work Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            // 'adhoc_order_request_id',
            // 'due_date',
            // 'approver',
            // 'sale_order_id',
            // 'state',
            // 'repeat_ref_id',
            // 'order_date',
            // 'location_id',
            // 'work_location',
            // 'source_type',
            // 'customer_site_id',
            // 'wo_no',
            // 'approver2',
            // 'approver3',
            // 'request_no',
            // 'customer_id',
            // 'notes:ntext',
            // 'seq_wo_no',
            // 'seq_req_no',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
