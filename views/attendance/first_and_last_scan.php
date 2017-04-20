<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Dropdown;
?>

<div class="form">
	<h1>
		Attendance Log
		<span id="yearTitle" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($year)?></a>
			<?php
				$start = 2015;
				$end = date('Y');
				$items = [];
				for($iYear=$start;$iYear<=$end;$iYear++){
					$items[] = ['label' => $iYear, 'url' => ['','year'=>$iYear,'month'=>$month,'department'=>$department_active,'site'=>$site_active->id]];
				}
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
		-
		<span id="monthTitle" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($month)?></a>
			<?php
				$items = [];
				for($m=1;$m<=12;$m++){
					$items[] = ['label' => $m, 'url' => ['','year'=>$year,'month'=>$m,'department'=>$department_active,'site'=>$site_active->id]];
				}
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>

		-

		<span id="departmentTitle" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($department_active)?></a>
			<?php
				
				$items = [];
				/*for($m=1;$m<=12;$m++){
					$items[] = ['label' => $m, 'url' => ['','month'=>$m]];
				}*/
				/*var_dump($depts);
				die();*/
				$items[] = ['label'=>'All Dept','url'=>['','month'=>$month,'department'=>'All Department','site'=>$site_active->id]];
				foreach($depts as $dept):

					$items[] = ['label'=>$dept['name'],'url'=>['','year'=>$year,'month'=>$month,'department'=>$dept['name'],'site'=>$site_active->id]];
				endforeach;
				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>

		- ON -
		<span id="siteSelection" class="dropdown">
			<a href="#"  data-toggle="dropdown" class="dropdown-toggle"><?=Html::encode($site_active->name)?></a>
			<?php
				
				$items = [];
				/*for($m=1;$m<=12;$m++){
					$items[] = ['label' => $m, 'url' => ['','month'=>$m]];
				}*/
				/*var_dump($depts);
				die();*/
				
				foreach($sites as $site):
					$items[] = ['label'=>$site['name'],'url'=>['','year'=>$year,'month'=>$month,'department'=>$department_active,'site'=>$site['id']]];
				endforeach;

				echo Dropdown::widget([
					'items' => $items,
				]);
			?>
		</span>
	</h1>
	<!-- <div>
		<?php $form = ActiveForm::begin(['id'=>'AttendaceLogForm','layout'=>'horizontal','method'=>'post']); ?>
			
			<?= $form->field($attendanceLogForm,'employee')?>
			<?= $form->field($attendanceLogForm,'department')?>

			<?= $form->field($attendanceLogForm,'year')?>
			<?= $form->field($attendanceLogForm,'month')?>
			<?= $form->field($attendanceLogForm,'day')?>
			
			<div class="form-group">
	        	<div class="col-lg-offset-3 col-lg-11">
					<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>-->
	
	<?=\kartik\export\ExportMenu::widget([
		'dataProvider'=>$dataProvider,

	])?>
	<?php
	 // preg_match("/site/", strtolower(Html::encode($site_active->name)), $matches, PREG_OFFSET_CAPTURE);
	 // if($matches){
	 	echo '<button id="extra_hours" class="btn">With Extra Hours</button>';
	 // }
	?>
	
	<script type="text/javascript">
		
	</script>
	<?=\kartik\grid\GridView::widget([
		'id' => 'attendanceTable',
		'dataProvider'=>$dataProvider,
		'emptyCell'=>"&nbsp;",
		'columns'=>[
			
			'year',
			'month',
			'day',
			'employee',
			['attribute' => 'hour_1',    
            // 'label' => 'your_label',             
            'contentOptions' => ['class'=>'hour_1',],
       		 ],
       		 ['attribute' => 'minute_1',    
            // 'label' => 'your_label',             
            'contentOptions' => ['class'=>'minute_1',],
       		 ],
       		 ['attribute' => 'hour_2',    
            // 'label' => 'your_label',             
            'contentOptions' => ['class'=>'hour_2',],
       		 ],
       		 ['attribute' => 'minute_2',    
            // 'label' => 'your_label',             
            'contentOptions' => ['class'=>'minute_2',],
       		 ],
			
			
		],
		'rowOptions'=>function($model){
          
     	  
	         return [
	         			'data-year' => $model['year'],
	         			'data-month' => $model['month'],
	         			'data-day' => $model['day'],
	         			'data-employee' => $model['employee_id'],
	         		];
	           
	    },
	])?>
</div>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih</h4>
        </div>
        <div class="modal-body">
	        <form id="#myForm">
	          <input type="radio" name="pilih_aksi" class="pilih_aksi" value="date_in"> Hours In <br/>
			  <input type="radio" name="pilih_aksi" class="pilih_aksi" value="date_out"> Hours Out <br/>
			  <input type="radio" name="pilih_aksi" class="pilih_aksi" value="date_extra_in"> Hours Ext In <br/>
			  <input type="radio" name="pilih_aksi" class="pilih_aksi" value="date_extra_out"> Hours Ext Out
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default" id="save_modal">Save</button>
        </div>
      </div>
    </div>
 </div>
 <?php
 	 $this->registerCssFile("@web/css/tableexport.min.css");
 	 $this->registerJsFile(
	    '@web/js/FileSaver.min.js',
	    ['depends' => [\yii\web\JqueryAsset::className()]]
	);
	 $this->registerJsFile(
	    '@web/js/tableexport.min.js',
	    ['depends' => [\yii\web\JqueryAsset::className()]]
	);
 	$token = Yii::$app->request->getCsrfToken();
 	$url = Yii::$app->request->baseUrl. '/index.php?r=attendance/extra-hours';
 	$urlUpdate = Yii::$app->request->baseUrl. '/index.php?r=attendance/update-extra-hours';
 	$loader = Yii::$app->request->baseUrl. '/ajax-load.gif';
 	$default_td = '<td class="ext_hour_1"></td><td class="ext_min_1"></td><td class="ext_hour_2"></td><td class="ext_min_2"></td><td class="log_list"></td>';
 	$img_loader = '<img src="'.$loader.'"" />';
    $this->registerJs(new \yii\web\JsExpression("
    var tables = $('table').tableExport({headings: true, footers: true, formats: ['xls', 'csv', 'txt'], fileName: 'Attendance-log', bootstrap: true, position: 'top',ignoreRows: null, ignoreCols: null, ignoreCSS: '.tableexport-ignore'});

	var tr_selector;
    function editExtraHour(selector){

    		
    		$('#myModal').modal('show')
			tr_selector = selector;
    		// function hideModal(){
    		// 	 $('#myModal').modal('hide')
    		// 	 alert('aaaaaaaaa')
    		// }
			// $('#save_modal').click(function(){
			// 	// updateExtraHours(selector)
			   

			    
			// });
			// var x;
		 //    if (confirm('apakah anda yakin mengubah ke ext hour out tanggal sebelumnya!') == true) {
		 //       updateExtraHours(selector)
		 //    } else {
		 //        x = 'You pressed Cancel!';
		 //    }
		}

	  $('#save_modal').on('click', function(){
		$('#myModal').modal('hide')
		aksi = $('.pilih_aksi:checked').val()
		
		updateExtraHours(tr_selector,aksi)
	  })
      function updateExtraHours(selector, aksi){
      		var id_att = $(selector).data('id')
      		tr =  $(selector).closest('tr')
      		prev_tr = tr.prev()
      		var date = tr.data('year')+'-'+tr.data('month')+'-'+tr.data('day')
		
			$.ajax({
				       url: '$urlUpdate',
				       type: 'get',
				       // Async:false,
				       data: {	
				       			id : id_att,
				       			date : date,
				       			aksi : aksi,
				                _csrf : '$token'
				             },

				        'beforeSend':function(){

				        },

				       success: function (data) {
				       getAtt(prev_tr, true);
				       getAtt(tr, true);
				       	
				          
				  		
				       
				          
				       },
				        error: function (request, status, error) {
					       console.log(error)
					    }
				   })
      }
     
      $('#extra_hours').on('click', function(){
      	var baris_thead = $('#attendanceTable').find('table thead th')
      	if(baris_thead.length == 8){
      		$('#attendanceTable table thead tr').append('<th>Ext Hour 1</th><th>Ext Min 1</th><th>Ext Hour 2</th><th>Ext Min 2</th><th>Summary Log Time</th>')

      		var baris_tabel = $('#attendanceTable').find('table tbody tr')
			$.each(baris_tabel, function( k, v ) {
				
				getAtt(this);
				
				
		 	});
			

			

		 
      	}
     
      })


	function getAtt(data, update=false){
		 		var tr = $(data)
				$.ajax({
			       url: '$url',
			       type: 'get',
			       // Async:false,
			       data: {	
			       			employee_id : $(data).data('employee'),
			       			day : $(data).data('day'),
			       			month : $(data).data('month'),
			       			year : $(data).data('year'),
			                _csrf : '$token'
			             },

			        'beforeSend':function(){
			        	if(!update){
			        	  tr.append('$default_td')
			        	}
						
						tr.find('.hour_1').html('$img_loader')
						tr.find('.hour_2').html(' ')
						tr.find('.minute_1').html(' ')
						tr.find('.minute_2').html(' ')

			        },

			       success: function (data) {
			      	tables.reset();
			       	tr.find('.hour_1').html(data['hour_1'])
					tr.find('.hour_2').html(data['hour_2'])
					tr.find('.minute_1').html(data['minute_1'])
					tr.find('.minute_2').html(data['minute_2'])
					tr.find('.ext_hour_1').html(data['ext_hour_1'])
					tr.find('.ext_hour_2').html(data['ext_hour_2'])
					tr.find('.ext_min_1').html(data['ext_min_1'])
					tr.find('.ext_min_2').html(data['ext_min_2'])
					tr.find('.log_list').html(data['log_list'])
			        
			  		
			       
			          
			       },
			        error: function (request, status, error) {
				       	tr.find('.hour_1').html('error')
				    }
			   })
		 	}


 

    "),yii\web\View::POS_END)


  ?>