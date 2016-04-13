<?php
use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap\Dropdown;
use nirvana\infinitescroll\InfiniteScrollPager;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\bootstrap\BootstrapAsset;
?>

<h3 class="page-header">
    <span class="page-header">Sales Activity : </span>
    <span id="groupTitle" class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
        <?php if($group_active == ''){
            echo "All Groups";
        } else { 
            echo Html::encode($group_active);
        } ?>
        </a>
        <?php
            $items = [];
            $items[] = ['label'=>'All Groups','url'=>['','group'=>'','year'=>$year]];
            foreach ($modelGroup as $groupSales) {
                $items[] = ['label'=>$groupSales['name'],'url'=>['','group'=>$groupSales['id'],'year'=>$year]];
            }
            echo Dropdown::widget([
                'items' => $items,
            ]);
        ?>
    </span>
     IN 
    <span id="tahunCreateTitle" class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($year)?></a>
        <?php
            $start = 2014;
            $end = date('Y');
            $items = [];
            for($iYear=$start;$iYear<=$end;$iYear++){
                $items[] = ['label' => $iYear, 'url' => ['','group'=>$group_active,'year'=>$iYear]];
            }
            echo Dropdown::widget([
                'items' => $items,
            ]);
        ?>
    </span>
</h3>

<?php
// View::registerCssFile('@web/css/bootsnip-timeline.css');
View::registerCssFile('@web/css/moTimeline.css',['depends'=>[BootstrapAsset::className()]]);


echo Tabs::widget([
	// 'renderTabContent'=>false,
    'items' => [
        [
            'label'		=> '<span class="glyphicon glyphicon-tasks"></span>',
            'encode'	=> false,
            // 'content'   => $this->render('timeline',['dataProvider'=>$dataProvider]),
            'content'   => $this->render('timeline2',['dataProvider'=>$dataProvider]),
            'active'    => true
        ],
        [
            'label'		=> '<span class="glyphicon glyphicon-stats"></span>',
            'encode'	=> false,
            'content'	=> $this->render('charts',['charts'=>$charts,'series'=>$series]),
            // 'active'	=> true
        ],
        [
            'label'		=> '<span class="glyphicon glyphicon-search"></span>',
            'encode'	=> false,
            'content'	=> $this->render('_search',['model'=>$salesActivityForm])
        ],
    ],
]);




?>

