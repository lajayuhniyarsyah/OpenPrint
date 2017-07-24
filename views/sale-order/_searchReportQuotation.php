<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ProductPricelist;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\GroupSales;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
?>

<?php $form = ActiveForm::begin([
	'action' => ['report-quotation'],
	'method' => 'get',
]); ?>

<div class="col-md-6">
	<?php /*echo $form->field($model, 'tanggal_awal')->label('Start Date')*/ ?>
</div>

<div class="col-md-6">
	<?php /*echo $form->field($model, 'tanggal_akhir')->label('End Date')*/ ?>
</div>

<div class="col-md-12">
	<?=DatePicker::widget([
		'model' => $model,
		'attribute' => 'tanggal_awal',
		'attribute2' => 'tanggal_akhir',
		'options' => ['placeholder' => 'Start date'],
		'options2' => ['placeholder' => 'End date'],
		'type' => DatePicker::TYPE_RANGE,
		'form' => $form,
		'pluginOptions' => [
			'format' => 'yyyy-MM-dd',
			'autoclose' => true,
			'startDate'=>'01/07/2014',
		],
		'convertFormat'=>true,
	]);?>
</div>

<div class="col-md-12">
	<?php echo $form->field($model, 'pricelist_id')
		->dropDownList(ArrayHelper::map(ProductPricelist::find()
			->where(['type'=>'sale','active'=>true])
			->orderBy(['name'=>'ASC'])
			->all(), 'name', 'name'), ['prompt'=>''])
		->label('Currency');
	?> 
</div>

<div class="col-md-12">
	<?php /*$data = GroupSales::find()
		->select(['name as value', 'name as label', 'id as id'])
		->asArray()
		->all();
	echo $form->field($model, 'kelompok_id')->widget(\yii\jui\AutoComplete::classname(), [
		'clientOptions' => [
			'source' => $data,
		],
	])->textInput()->label('Group')*/ ?>
	<?php 
	if($model['tag_group']){
		$model['tag_group']=[];
	}

	// $data = ArrayHelper::getColumn(GroupSales::find()->select('name')->distinct()->all(),'name');
	echo $form->field($model, 'tag_group')->widget(Select2::classname(),[
	    'name' => 'tag_group',
	    'data' => ArrayHelper::map(GroupSales::find()->select('name')->distinct()->all(), 'name', 'name'),
	    'options' => [
	    	'placeholder' => 'Cari Group...', 
	    	'class' => 'form-controler',
	    	'multiple' => true
	    ],
	    /*'pluginOptions' => [
	    	'tags' => $data,
	    ]*/
	])->label('Group');
	?>
</div>

<div class="col-md-12">
	<?php /*$data = ResUsers::find()
		->select(['login as value', 'login as label', 'id as id'])
		->asArray()
		->all();
	echo $form->field($model, 'user_id')->widget(\yii\jui\AutoComplete::classname(), [
		'clientOptions' => [
			'source' => $data,
		],
	])->textInput()->label('Group')*/ ?>
	<?php 
	// $data = ArrayHelper::getColumn(ResUsers::find()->select('login')->distinct()->all(),'login');
	if(!$model['tag_user']){
		$model['tag_user']=[];
	}

	echo $form->field($model, 'tag_user')->widget(Select2::classname(),[
	    'name' => 'tag_user',
	    'data' => ArrayHelper::map(ResUsers::find()->select('login')->distinct()->all(), 'login', 'login'),
	    'options' => [
	    	'placeholder' => 'Cari Sales...', 
	    	'class' => 'form-controler',
	    	'multiple' => true
	    ],
	    /*'pluginOptions' => [
	    	'tags' => $data,
	    ]*/
	])->label('Sales Man');
	?>
</div>

<div class="col-md-12">
	<?php 
	/*$data = ResPartner::find()
		->select(['display_name as value', 'display_name as label', 'id as id'])
		->asArray()
		->all();
	echo $form->field($model, 'partner_id')->widget(\yii\jui\AutoComplete::classname(), [
		'clientOptions' => [
			'source' => $data,
		],
	])->textInput()->label('Costumer') */
	?>
	<?php 
	if(!$model['tag_partner']){
		$model['tag_partner']=[];
	}

	// $data = ArrayHelper::getColumn(ResPartner::find()->select('display_name')->distinct()->all(),'display_name');
	echo $form->field($model, 'tag_partner')->widget(Select2::classname(),[
	    'name' => 'tag_partner',
	    'data' => ArrayHelper::map(ResPartner::find()->select('display_name')->distinct()->all(), 'display_name', 'display_name'),
	    'options' => [
	    	'placeholder' => 'Cari Costumer...', 
	    	'class' => 'form-controler',
	    	'multiple' => true
	    ],
	    /*'pluginOptions' => [
	    	'tags' => $data,
	    ]*/
	])->label('Costumer');
	?>
</div>

<div class="form-group">
	<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
	<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
</div>

<?php ActiveForm::end(); ?>

