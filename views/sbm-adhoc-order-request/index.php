<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SbmAdhocOrderRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sbm Adhoc Order Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sbm-adhoc-order-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sbm Adhoc Order Request', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'cust_ref_no',
            // 'term_of_payment',
            // 'scope_of_work:ntext',
            // 'attention_id',
            // 'sales_man_id',
            // 'term_condition:ntext',
            // 'name',
            // 'customer_site_id',
            // 'cust_ref_type',
            // 'state',
            // 'sale_group_id',
            // 'customer_id',
            // 'notes:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
