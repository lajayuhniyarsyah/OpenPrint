<?php
use yii\helpers\Url;
use yii\db\connection;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\jui;
use yii\web\View;
use yii\db\Command;
use yii\db\Query;
use app\models\PurchaseOrderLine;
use app\models\ResPartner;
use kartik\widgets\Select2;
use kartik\widgets\DatePicker;
use miloschuman\highcharts\Highcharts;

use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\bootstrap\Dropdown;
use nirvana\infinitescroll\InfiniteScrollPager;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>

<?php
$this->registerJs(
	"
	$('#formactivity').hide();
	$('#hideform').hide();
	$('.detailactivity').hide();

	$('#allshow').click(function(){
		$('.detailactivity').toggle();
	});
	$('#showform').click(function(){
		$('#formactivity').fadeIn();
		$('#showform').hide();
		$('#hideform').show();
	});

	$('#hideform').click(function(){
		$('#formactivity').fadeOut();
		$('#showform').show();
		$('#hideform').hide();
	});
	
	$('.headactivity').click(function(){
		 val=$(this).attr('id');

		 nilai='detail_'+val;
		 $('.'+nilai).toggle();

	});

	"
	);

$url = \yii\helpers\Url::to(['supplierlist']);
$initScript = <<< SCRIPT
	function (element, callback) {
		var id=\$(element).val();
		if (id !== "") {
			$.ajax("'.Url::to(['supplierlist']).'&id=" + id, {
			dataType: "json"
		}).done(function(data) { callback(data.results);});
		}
	}
SCRIPT;

$urlproduct = \yii\helpers\Url::to(['productlist']);
$initScriptProduct = <<< SCRIPT
	function (element, callback) {
		var id=\$(element).val();
		if (id !== "") {
			\$.ajax("{$url}?id=" + id, {
			dataType: "json"
		}).done(function(data) { callback(data.results);});
		}
	}
SCRIPT;

?> 
<div class="oe_view_manager oe_view_manager_current">
	<div class="oe_view_manager_header">
		<h3 class="judul">
			Purchase Report
		</h3>
		<div class="oe_form">
			<header></header>
		</div>
		<div class="oe_form_sheetbg">
			<div class="oe_form_sheet oe_form_sheet_width">
				<div style="width:100%; float:left;">
					<div class="subjudul">PURCHASE REPORT</div>
					<br/>
					<br/>
					<div class="dropdown">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
						Group Data
						<span class="caret"></span>
					  </button>
					  <?php
							$currQParam = Yii::$app->request->getQueryParams();
							$action = $currQParam['r'];
							unset($currQParam['r']);
							$base = [$action];
							$baseQ = array_merge($base,$currQParam);
							$toCustomer = array_merge($baseQ,['groupBy'=>'partner']);
						?>
					  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo \yii\helpers\Url::to(array_merge($baseQ,['groupBy'=>'partner'])); ?>">Group By Partner</a></li>
					  </ul>
					</div> 
					<a href="#" class="btn btn-primary right" id="showform">Show Form</a>
					<a href="#" class="btn btn-primary right" id="hideform">Hide Form</a>
					<a data-pjax="0" title="Reset Purchase Report" href="<?php echo \yii\helpers\Url::to(['purchase-order/purchasereport']); ?>" class="btn btn-default right" style="margin-right:10px;"><i class="glyphicon glyphicon-repeat"></i></a>

					<br/>
					<br/>
					<div id="formactivity" class="row">
					<?php
						if($groupBy=='nogroup'){
							$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['purchase-order/purchasereport'], 
									'enableClientValidation'=>false
								]); 
						}else{
							$form = ActiveForm::begin([
									'method'=>'get',
									'action'=>['purchase-order/purchasereport','groupBy'=>'partner'],
									'enableClientValidation'=>false
								]); 
						}
					?>
					<div class="col-md-6">
						<?php
							if(!$model->partner_id){
								$model->partner_id = [];
							}
							else if($model->partner_id){
								foreach ($model->partner_id as $value) {
										if(is_int($value)==true){
											
										}else{

										}

										$data[]=ResPartner::find()->where(['id' => $value])->one()->name;
								}
								
								$model->partner_id=$data;
								var_dump($model->partner_id);
							}

							echo $form->field($model, 'partner_id')->widget(Select2::classname(), [
								'name'=>'partner_id',
								'pluginOptions'=>[
									'tags'=>true,
									'ajax'=>[
										'url'=>Url::to(['supplierlist']),
										'dataType'=>'json',
										'data'=>new JsExpression('function(params,page){return {search:params.term}; }'),
										'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
									],
									'allowClear'=>true,
									'initSelection' => new JsExpression('function (element, callback) {
										var id=$(element).val();

										console.log("CONSOLLLLLLLE ID"+id);
										if (id !== "") {
											$.ajax("'.Url::to(['supplierlist']).'&id=" + id, {
												dataType: "json"
												}).done(function(data) { 
													callback(data.results);
												}
											);
										}
									}'),
								],
								'value'=>Yii::$app->request->get('partner_id'),
								'options' => [
									'placeholder' => 'All Supplier ...', 
									'multiple' => true
								],
							]);
						?>

						<?php
							echo $form->field($modelline,'name');
						?>
					</div>
					<div class="col-md-6">
						<?php
							if(!$modelline['product_id']){
								$modelline['product_id'] = [];
							}
							echo $form->field($modelline, 'product_id')->widget(Select2::className(), [
								'name'=>'product_id',
								'pluginOptions'=>[
									'tags'=>true,
									'ajax'=>[
										'url'=>Url::to(['productlist']),
										'dataType'=>'json',
										'data'=>new JsExpression('function(params,page){return {search:params.term}; }'),
										'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
									],
									'allowClear'=>true,
									'initSelection' => new JsExpression('function (element, callback) {
										var id=$(element).val();
										console.log("CONSOLLLLLLLE ID"+id);
										if (id !== "") {
											$.ajax("'.Url::to(['productlist']).'&id=" + id, {
												dataType: "json"
												}).done(function(data) { 
													callback(data.results);
												}
											);
										}
									}'),
								],
								'value'=>Yii::$app->request->get('product_id'),
								'options' => [
									'placeholder' => 'All Product ...', 
									'multiple' => true
								],
							]);
						?>

						<?php
							echo $form->field($model, 'state')->widget(Select2::classname(), [
								'name' => 'state', 
								'options' => ['placeholder' => 'Select a State ...'],
								'pluginOptions' => [
									// 'tags' => ["draft", "confirmed", "approved", "done", "cancel"],
									'tags' => ["purchased","cancel","draft"],
									'maximumInputLength' => 10
								],
							]);
						?>
					</div>
					
					<div class="col-md-12">
						<div style="float:left; width:45%;">
								<?=DatePicker::widget([
									'model' => $model,
									'attribute' => 'date_order',
									'attribute2' => 'duedate',
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
					</div>

					<div class="col-md-6">
						<br/>
						 <?= Html::submitButton('View Report', ['class' => 'btn btn-primary', 'name' => 'report-activity']) ?>
						 <br/>
						 <br/>
					</div>
					<?php ActiveForm::end(); ?>
					</div>
				</div>

			<div style="clear:both"></div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Purchase Product</h3>
					</div>
				<div class="panel-body">
				<?php  
					if($groupBy=='nogroup'){
							// die();
							echo ExportMenu::widget([
								'dataProvider'=>$dataProvider,
							]);
							echo GridView::widget([
								'id'=>'prospectGrid',
								'dataProvider'=>$dataProvider,
								'showPageSummary'=>true,
								'toolbar'=>[
									'{exportss}',
									'{toggleData}'
								],
								'export'=>[
									'fontAwesome'=>true
								],
								'columns'=>[
									[
										'class'=>'kartik\grid\ExpandRowColumn',
										'width'=>'50px',
										'value'=>function ($model, $key, $index, $column) {
											return GridView::ROW_COLLAPSED;
										},
										'detailUrl'=>\yii\helpers\Url::to(['#']),
										'headerOptions'=>['class'=>'kartik-sheet-style'] 
									],
									'partner',
									'no_po',
									[
										'attribute'=>'date_order',
										'header'=>'Date',
										'value'=>function($model,$key,$index,$grid){
											return Yii::$app->formatter->asDatetime($model['date_order'], "php:d-m-Y");
										}
									],
									[
										'attribute'=>'product_code',
										'header'=>'PN',
									],
									'product',

									[
										'attribute'=>'pol_desc',
										'header'=>'Description',
									],
									[
										'attribute'=>'product_qty',
										'header'=>'Qty',
										'value'=>function($model,$key,$index,$grid){
											return app\components\NumericLib::indoStyle($model['product_qty'],2,',','.');
										}
									],
									'uom',
									[
										'attribute'=>'price_unit',
										'header'=>'Currency',
										'value'=>function($model,$key,$index,$grid){
											return app\components\NumericLib::indoStyle($model['price_unit'],2,',','.');
										}
									],
									 [
										'attribute'=>'total',
										'header'=>'Total',
										'value'=>function($model,$key,$index,$grid){
											return app\components\NumericLib::indoStyle($model['total'],2,',','.');
										}
									],
									
									'pricelist',
									'state',
								]
							]);
					}else{

						echo GridView::widget([
								'id'=>'prospectGrid',
								'dataProvider'=>$dataProvider,
								'showPageSummary'=>true,
								'columns'=>[
									[
										'class'=>'kartik\grid\ExpandRowColumn',
										'width'=>'50px',
										'value'=>function ($model, $key, $index, $column) {
											return GridView::ROW_COLLAPSED;
										},
										'detailUrl'=>\yii\helpers\Url::to(['purchase-order/detail-purchase']),
										'headerOptions'=>['class'=>'kartik-sheet-style'] 
									],
									'partner',
									'pricelist',
									[
										'attribute'=>'cout',
										'header'=>'Count',
										'value'=>function($model,$key,$index,$grid){
											return app\components\NumericLib::indoStyle($model['total'],2,',','.');
										}
									]
								]
							]);
					} 
				?>
				</div>
			<div style="clear:both"></div>
		</div>

	</div>
</div>