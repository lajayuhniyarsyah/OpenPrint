<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StockSplitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stock Splits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-split-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stock Split', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'date_done',
            // 'no',
            // 'notes:ntext',
            // 'state',
            // 'location',
            // 'date_order',
            // 'picking_id',
            // 'stock_split_no',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
