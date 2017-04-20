<?php

namespace app\controllers;

use Yii;
use app\models\DeliveryNote;
use app\models\ProductProduct;
use app\models\productUom;
use app\models\StockProductionLot;
use app\models\DeliveryNoteSearch;
use app\models\SuperNotes;
use app\models\ResPartner;
use app\models\OrderPreparation;
use app\models\SaleOrder;
use app\models\StockPicking;
use app\models\StockMove;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\base\Model;

use arturoliveira\ExcelView;

use kartik\grid\GridView;

// use app\models\PackingListLine;

/**
 * DeliveryNoteController implements the CRUD actions for DeliveryNote model.
 */
class DeliveryNoteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all DeliveryNote models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeliveryNoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DeliveryNote model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DeliveryNote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DeliveryNote();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DeliveryNote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DeliveryNote model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DeliveryNote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DeliveryNote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DeliveryNote::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionPrintreturn($id){
        $this->layout = 'printout';
            

        $model = StockPicking::findOne($id);
        $query = new Query;
        $query ->select('return_no')
               ->from('delivery_note_line_material_return')
               ->where(['stock_picking_id'=>$model->id]);

        $data = $query->one();
        $return_no ='';
        foreach ($data as $val) {
            $return_no = $val;
        }
        $model = StockPicking::findOne($id);
        return $this->render('print/return',['model'=>$model,'return_no'=>$return_no]);
    }

    // action print
    public function actionPrint($id,$test=0){
        $this->layout = 'printout';
        
        $model = $this->findModel($id);

        // PREPARE LINE DATA FOR PRINT
        
        $sets = [];
        
        $prepLines = $this->prepareLineData($model->deliveryNoteLines); 
        // echo '<pre>';
        // var_dump($prepLines);
        // echo '</pre>';
        $linesData = $this->renderLinesPrint($prepLines);

        if(!$test):
            return $this->render('print/dn_batch',['model'=>$model,'linesData'=>$linesData]);
        else:
            return $this->render('print/test/dn_batch_test',['model'=>$model,'linesData'=>$linesData]);
        endif;
    }


    public function actionPrintnew($id,$test=0){
        $this->layout = 'printout';
        
        $model = $this->findModel($id);

        // PREPARE LINE DATA FOR PRINT
        
        $sets = [];

        $prepLines = $this->prepareLineDataNew($model->deliveryNoteLines);

        $linesData = $this->renderLinesPrintNew($prepLines);

        if(!$test):
            return $this->render('print/print_dn_new',['model'=>$model,'linesData'=>$linesData]);
        else:
            return $this->render('print/print_dn_new',['model'=>$model,'linesData'=>$linesData]);
        endif;
    }

    /**
     * Print Action For Packing List
    **/
    public function actionPrintPack($id,$printer=null,$uid=null,$forced=0)
    {
        $this->layout = 'printout';
        
        $model = $this->findModel($id);
        // var_dump($model->packingListLines->id);
        $linesData = [];
        foreach($model->packingListLines as $k=>$listLine):
            $linesData[$k]=[
                'name'=>$listLine->name,
                'color'=>$listLine->color,
                'urgent'=>$listLine->urgent,
                'to'=>$model->partner->name,
                'attn'=>$model->partnerShipping->name,
                'date'=>$model->tanggal,
                'poc'=>$model->poc,
            ];
            $totalWeight=0;
            foreach($listLine->productListLines as $n=>$pLine):
                // echo floatval($pLine->product_uom);
                // echo ' = '.(isset($pLine->productUom->name) ? 'ada<br/>':'no<br/>');
                $linesData[$k]['lines'][] = [
                    'no'=>$pLine->no,
                    'desc'=>nl2br($pLine->name),
                    'product'=>'['.$pLine->product->default_code.']'.$pLine->product->name_template,
                    'qty'=>floatval($pLine->product_qty).' '.($pLine->product_uom ? $pLine->productUom->name:null),
                    'weight'=>($pLine->weight ? $pLine->weight:'-'),
                    'measurement'=>($pLine->measurement ? $pLine->measurement:'-'),
                ];
                $totalWeight+=floatval(str_replace(',', '', $pLine->weight));
            endforeach;
            $linesData[$k]['totalWeight'] = str_replace('.00', '', Yii::$app->numericLib->westStyle($totalWeight));
        endforeach;
        
        // $printer = ($printer ? $printer:($uid==173 ? 'lq300-hadi':'lx300-novri'));
        if(!$printer){
            if($uid==173 || $uid == 23){
                $printer = 'lq300-hadi';
                // echo 'aaaaa';

            }else{
                $printer = 'lx300-novri';

            }
        }
        
        // echo $printer;
        return $this->render('print/pack',['model'=>$model,'pagesData'=>$linesData,'printer'=>$printer,'uid'=>$uid,'forced'=>$forced]);
    }


    private function renderLinesPrint($preparedLines)
    {
        $res = [];
        // var_dump($preparedLines);
        $no = 0;
        foreach($preparedLines as $k=>$l):
            $res[$no]=[
                'qty'=>'<div style="float:left;width:12mm;" contenteditable="true">'.($l['no'] ? $l['no']:'&nbsp;').'</div>
                    <div>'.floatval($l['qty']).' '.$l['uom'].'</div><div style="clear:both;"></div>',
                
                'part_no'=>$l['part_no']
            ];
            // var_dump($l);
            if(isset($l['name2'])){
                if(array_key_exists('set', $l) && count($l['set']) && isset($l['name'])){
                    $res[$no]['name'] = $l['name'];
                }else{
                    $res[$no]['name'] = $l['name2'];
                }
                
            }else{

                $res[$no]['name'] = $l['name'];
            }

            // if PRODUCT IS SET TYPE
            if(array_key_exists('set', $l)){
                $res[$no]['name'].='<br/>Consist Of : <ul style="margin:0;">';
                foreach($l['set'] as $set){
                    $res[$no]['name'] .= '<li>'.nl2br($set['name']).'</li>';
                    if(array_key_exists('batches', $set) && count($set['batches'])>=1):
                        $res[$no]['name'].=$this->prepareBathesRender($set);
                    endif;
                }

                $res[$no]['name'].='</ul>';
            }


            if(array_key_exists('batches', $l) && count($l['batches'])>=1)
            {
                $res[$no]['name'].='<br/>'.$this->prepareBathesRender($l);
            }
            $no++;
        endforeach;
        /*echo '----------';
        var_dump($res);*/

        return $res;
    }



    private function renderLinesPrintNew($preparedLines)
    {
        $res = [];
        // var_dump($preparedLines);
        $no = 0;    
        foreach($preparedLines as $k=>$l):
            $res[$no]=[
                'qty'=>'<div contenteditable="true" style="float:left;width:10mm;">'.($l['no'] ? $l['no']:'&nbsp;').'</div>
                    <div>'.floatval($l['qty']).' '.$l['uom'].'</div><div style="clear:both;"></div>',
                
                'part_no'=>$l['part_no']
            ];
            // var_dump($l);
            if(isset($l['name2'])){
                if(array_key_exists('set', $l) && count($l['set']) && isset($l['name'])){
                    $res[$no]['name'] = $l['name'];
                }else{
                    $res[$no]['name'] = $l['name2'];
                }
            }else{
                $prod = ProductProduct::findOne($l['product_id']);

                $res[$no]['name'] = '['.$prod['default_code'].'] ' .$prod['name_template'].'<br/>'.$l['name'];
            }
            if (isset($l['note_line_material'])){
                $prod = ProductProduct::findOne($l['product_id']);
                
                if (count($l['note_line_material']) == 1){

                    foreach ($l['note_line_material'] as $line_material) {
                        if ($l['product_id'] <> $line_material['product_id']){
                            $modelprod = ProductProduct::findOne($line_material['product_id']);
                            $uom = ProductUom::findOne($line_material['product_uom']);

                            $res[$no]['name'].='<br/>Consist Of : <ul style="margin:0;">';
                            $printSp_note = '';
                            foreach ($modelprod->superNoteProductRels as $spnotes){
                                $superNotes = SuperNotes::findOne($spnotes['super_note_id']);
                                $printSp_note .= '<br/>'.$superNotes['template_note'];
                            }
                            $res[$no]['name'] .= '<li>['.$modelprod['default_code'].'] ' .$modelprod['name_template'].' <strong>('.$line_material['qty'].' '.$uom['name'].'</strong>)<br/>'.nl2br($line_material['desc']).nl2br($printSp_note).'</li>';
                        }
                        else{
                            $modelprod = ProductProduct::findOne($line_material['product_id']);
                            $printSp_note = '';
                            foreach ($modelprod->superNoteProductRels as $spnotes){
                                $superNotes = SuperNotes::findOne($spnotes['super_note_id']);
                                $printSp_note .= '<br/>'.$superNotes['template_note'];
                            }
                            $res[$no]['name'] =  '['.$prod['default_code'].'] ' .$prod['name_template'].'<br/>'.nl2br($line_material['desc'].$printSp_note);
                        }
                    }

                }else if (count($l['note_line_material']) > 1) {
                    $res[$no]['name'].='<br/>Consist Of : <ul style="margin:0;">';
                    $batch = "";

                    foreach ($l['note_line_material'] as $line_material) {

                        if ($line_material['prodlot_id']){
                            $prodlot = StockProductionLot::findOne($line_material['prodlot_id']);
                            $batch = '<strong>SN:</strong> '.$prodlot['name'].' '. $line_material['desc'];
                        }

                        $modelprod = ProductProduct::findOne($line_material['product_id']);
                        $uom = ProductUom::findOne($line_material['product_uom']);

                        $printSp_note = '';
                      
                        foreach ($modelprod->superNoteProductRels as $spnotes){
                            $superNotes = SuperNotes::findOne($spnotes['super_note_id']);
                            $printSp_note .=$superNotes['template_note'];
                        }
                        
                        $res[$no]['name'] .= '<li>['.$modelprod['default_code'].'] ' .$modelprod['name_template'].' <strong>('.$line_material['qty'].' '.$uom['name'].'</strong>) <br/>'.nl2br($line_material['desc']).$batch.nl2br($printSp_note).'</li>';
                    }
                }
            }            

            
            // if PRODUCT IS SET TYPE
            if(array_key_exists('set', $l)){
                $res[$no]['name'].='<br/>Consist Of : <ul style="margin:0;">';
                foreach($l['set'] as $set){
                    $res[$no]['name'] .= '<li>'.$set['name'].'</li>';
                }
                $res[$no]['name'].='</ul>';
            }

            
            if(array_key_exists('batches', $l) && count($l['batches'])>=1)
            {
                $res[$no]['name'].='<br/>'.$this->prepareBathesRender($l);
            }
            $no++;
        endforeach;
        /*echo '----------';
        var_dump($res);*/

        return $res;
    }

    private function prepareBathesRender($line){
        $res ='Taken From :<ul style="margin:0;">';

        foreach($line['batches'] as $batch):
            $res .= '<li>Batch No : '.$batch['name'].' - '.$batch['qty'].' '.$line['uom'].' '.($batch['exp_date'] ? '(Exp Date '.Yii::$app->formatter->asDatetime($batch['exp_date'], "php:d/m/Y").')':null).'</li>';
        endforeach;

        $res .='</ul>';
        return $res;
    }


    private function prepareLineData($lines)
    {
        $res = [];

        foreach($lines as $k=>$line):

            // if set
            
            if(isset($line->opLine->move->move_dest_id) && $line->opLine->move->move_dest_id)
            {

                $moveDest = $line->opLine->move->moveDest;
                // before we must check if move dest id setted
                if(array_key_exists($moveDest->id, $res))
                {

                    $res[$moveDest->id]['set'][] = $this->prepareSetPrint($line);
                }
                else
                {
                    // init to be printed
                    // TOP LEVEL PRINTED
                    $res[$moveDest->id] = [
                        'no'=>$line->no,
                        'qty'=>$moveDest->product_qty,
                        // 'qty'=>$line->product_qty,
                        'uom'=>$moveDest->productUom->name,
                        'name'=>($moveDest->desc ? nl2br($moveDest->desc):nl2br($moveDest->product->name_template)),
                        'name2'=>$moveDest->name,
                        'desc'=>$moveDest->desc,
                        'set'=>[
                            $this->prepareSetPrint($line),
                        ],
                        'part_no'=>$moveDest->product->default_code,
                    ];
                    // CHECK SET QTY
                    if($moveDest->product->mrpBoms){
                        $bomId = $moveDest->product->mrpBoms[0]->id;
                        $bomObj = \app\models\MrpBom::find()->where('product_id=:prodId AND bom_id = :bomId')
                            ->addParams([':prodId'=>$line->product_id,':bomId'=>$bomId])->one();
                            $res[$moveDest->id]['qty'] = $line->product_qty/$bomObj->product_qty;
                    }

                   

                }
                /*var_dump($line->product->name_template);
                if($line->product->superNotes):
                    foreach($line->product->superNotes as $notes):
                        if($notes->show_in_do_line && isset($res[$moveDest->id]['name'])) $res[$moveDest->id]['name'].='<br/>'.$notes->template_note; #SHOW ETRA NOTES PRODUCT INTO LINE
                    endforeach;
                endif;*/
            }
            else
            {
                // not set
                
                $res[$line->id]=$this->prepareLine($line);
            }
        endforeach;

        
        return $res;
    }




    private function prepareLineDataNew($lines)
    {
        $res = [];

        foreach($lines as $k=>$line):

            // if set
            
            if(isset($line->opLine->move->move_dest_id) && $line->opLine->move->move_dest_id)
            {

                $moveDest = $line->opLine->move->moveDest;
                // before we must check if move dest id setted
                if(array_key_exists($moveDest->id, $res))
                {
                    $res[$moveDest->id]['set'][] = $this->prepareSetPrintNew($line);
                }
                else
                {
                    // init to be printed
                    // TOP LEVEL PRINTED
                    $res[$moveDest->id] = [
                        'no'=>$line->no,
                        'qty'=>$moveDest->product_qty,
                        // 'qty'=>$line->product_qty,
                        'uom'=>$moveDest->productUom->name,
                        'name'=>($moveDest->desc ? nl2br($moveDest->desc):nl2br($moveDest->product->name_template)),
                        'name2'=>$moveDest->name,
                        'desc'=>$moveDest->desc,
                        'set'=>[
                            $this->prepareSetPrintNew($line),
                        ],
                        'part_no'=>$moveDest->product->default_code,
                    ];
                    // CHECK SET QTY
                    if($moveDest->product->mrpBoms){

                        $bomId = $moveDest->product->mrpBoms[0]->id;
                        $bomObj = \app\models\MrpBom::find()->where('product_id=:prodId AND bom_id = :bomId')
                            ->addParams([':prodId'=>$line->product_id,':bomId'=>$bomId])->one();
                        $res[$moveDest->id]['qty'] = $line->product_qty/$bomObj->product_qty;
                    }

                }
                /*var_dump($line->product->name_template);
                if($line->product->superNotes):
                    foreach($line->product->superNotes as $notes):
                        if($notes->show_in_do_line && isset($res[$moveDest->id]['name'])) $res[$moveDest->id]['name'].='<br/>'.$notes->template_note; #SHOW ETRA NOTES PRODUCT INTO LINE
                    endforeach;
                endif;*/
            }
            else
            {

                // not set
                
                $res[$line->id]=$this->prepareLinenew($line);
            }
        endforeach;

        
        return $res;
    }

    private function prepareLine($line,$printHead=true)
    {
        $res = [];
        if(isset($line->opLine->orderPreparationBatches) && $line->opLine->orderPreparationBatches)
        {
            if($printHead==true):
                $res =[
                    'no'=>$line->no,
                    'qty'=>$line->product_qty,
                    'uom'=>$line->productUom->name,
                    'name'=>nl2br($line->name),
                    'part_no'=>$line->product->default_code,
                    'batches'=>[]
                ];
            endif;
            foreach($line->opLine->orderPreparationBatches as $batch):
                $res['batches'][]=['name'=>$batch->name0->name,'desc'=>$batch->desc,'qty'=>$batch->qty,'exp_date'=>$batch->exp_date];
            endforeach;
        }
        else
        {
            if($printHead==true)
                $res=[
                    'no'=>$line->no,
                    'qty'=>$line->product_qty,
                    'uom'=>(isset($line->productUom->name) ? $line->productUom->name:'-'),
                    'name'=>nl2br($line->name),
                    'part_no'=>(isset($line->product->default_code) ? $line->product->default_code:'-')
                ];
        }

        if($line->product->superNotes):
            foreach($line->product->superNotes as $notes):
                if($notes->show_in_do_line) $res['name'].='<br/>'.$notes->template_note; #SHOW ETRA NOTES PRODUCT INTO LINE
            endforeach;
        endif;

        return $res;
    }



  private function prepareLinenew($line,$printHead=true)
	{   
		$res = [];

        $qtyMat = $line->product_qty;

        // count qty
        $method = false;
        // if product line is batch
        if($line->product->track_outgoing){
            foreach($line->deliveryNoteLineMaterials as $mat){
                //
                if($mat->prodlot_id && $mat->product_id==$line->product_id){
                    $qtyMat += $mat->qty;
                }
            }
        }else{
            foreach($line->deliveryNoteLineMaterials as $mat){
                if(!$mat->prodlot_id && $mat->product_id==$line->product_id){
                    $qtyMat = $mat->qty;
                }
            }
        }
        // end of count qty


		if(isset($line->opLine->orderPreparationBatches) && $line->opLine->orderPreparationBatches)
		{
			if($printHead==true):
				$res =[
					'product_id'=>$line->product_id,
					'no'=>$line->no,
					'qty'=>$qtyMat,
					'uom'=>$line->productUom->name,
					'name'=>nl2br($line->name),
					'part_no'=>$line->product->default_code,
					'batches'=>[]
				];
			endif;
			foreach($line->opLine->orderPreparationBatches as $batch):
				$res['batches'][]=['name'=>$batch->name0->name,'desc'=>$batch->desc,'qty'=>$batch->qty,'exp_date'=>$batch->exp_date];
			endforeach;
		}
		else
		{
			if($printHead==true)
				$res=[
					'product_id'=>$line->product_id,
					'no'=>$line->no,
					'qty'=>$qtyMat,
					'uom'=>(isset($line->productUom->name) ? $line->productUom->name:'-'),
					'name'=>nl2br($line->name),
					'part_no'=>(isset($line->product->default_code) ? $line->product->default_code:'-'),
					'note_line_material'=>$line->deliveryNoteLineMaterials
				];
		}

		
		if($line->product->superNotes):
			foreach($line->product->superNotes as $notes):
				if($notes->show_in_do_line) $res['name'].='<br/>'.$notes->template_note; #SHOW ETRA NOTES PRODUCT INTO LINE
			endforeach;
		endif;

		return $res;
	}


	private function prepareBatches($line){
		$res = [];
		if($line->opLine->orderPreparationBatches)
		{
			foreach($line->opLine->orderPreparationBatches as $batch):
				$res[]=['name'=>$batch->name0->name,'desc'=>$batch->desc,'qty'=>$batch->qty,'exp_date'=>$batch->exp_date];
			endforeach;
		}
		return $res;
	}


	// METHOD TO PRINT SET PRODUCT
	// IT A CONSIST OF PART
	private function prepareSetPrint($line){
		$res =  [
			'qty'=>$line->product_qty,
			'uom'=>$line->productUom->name,
			'name'=>($line->name ? nl2br('['.$line->product->default_code.'] '.$line->name):'['.$line->product->default_code.']'.$line->product->name),
			'batches'=>$this->prepareBatches($line),
			'part_no'=>$line->product->default_code,
		];

		if($line->product->superNotes):
			foreach($line->product->superNotes as $note):
				$res['name'].='<br/>'.$note->template_note;
			endforeach;
		endif;

		return $res;
	}


	// METHOD TO PRINT SET PRODUCT
	// IT A CONSIST OF PART
	private function prepareSetPrintNew($line){
		$res =  [
			'qty'=>$line->product_qty,
			'uom'=>$line->productUom->name,
			'name'=>($line->name ? nl2br('['.$line->product->default_code.'] '.$line->name):'['.$line->product->default_code.']'.$line->product->name),
			'batches'=>$this->prepareBatches($line),
			'part_no'=>$line->product->default_code,
		];

		if($line->product->superNotes):
			foreach($line->product->superNotes as $note):
				$res['name'].='<br/>'.$note->template_note;
			endforeach;
		endif;

		return $res;
	}
	

	#show delivery note kpi report
	public function actionReportkpi()
	{
		#here report of kpi process
		$searchModel = new DeliveryNoteSearch();
		$dataProvider = $searchModel->searchKPI(Yii::$app->request->queryParams);

		$dataProviderExport = $searchModel->searchKPI(Yii::$app->request->queryParams,0);
		
		return $this->render('reportkpi', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
			'dataProviderExport'=>$dataProviderExport,
		]);
	}


	#show summary kpi
	public function actionYearSummaryKpi($tahun_create=null)
	{
		if(!$tahun_create){
            $tahun_create = date('Y');
        }

        $dataToRender = [];
        $where = [
            'tahun_create'=>"%%",
        ];
        $dataToRender['deliveryNote'] = new \app\models\DeliveryNote;

        if($dataToRender['deliveryNote']->load(Yii::$app->request->post())){
            $where['tahun_create'] = $dataToRender['deliveryNote']['tahun_create'];
        }

		$query = <<<query
SELECT
	COUNT(DISTINCT no_po) AS po_total
	, COUNT(CASE WHEN status = 'Tercapai' THEN status END) AS tercapai
	, COUNT(CASE WHEN status = 'Tidak Tercapai' THEN status END) AS tdk_tercapai
	, COUNT(CASE WHEN status = 'Belum Terkirim' THEN status END) AS blm_terkirim
	--, COUNT(status) AS total
	, ROUND((COUNT(CASE WHEN status = 'Tercapai' THEN status END) * 100)::NUMERIC / COUNT(status), 2) AS tercapai_persen
	, ROUND((COUNT(CASE WHEN status = 'Tidak Tercapai' THEN status END) * 100)::NUMERIC / COUNT(status), 2) AS tdk_tercapai_persen
	, ROUND((COUNT(CASE WHEN status = 'Belum Terkirim' THEN status END) * 100)::NUMERIC / COUNT(status), 2) AS blm_terkirim_persen
	, ROUND((COUNT(CASE WHEN status = 'Tercapai' THEN status END) * 100)::NUMERIC / COUNT(status)
		+ (COUNT(CASE WHEN status = 'Tidak Tercapai' THEN status END) * 100)::NUMERIC / COUNT(status)
		+ (COUNT(CASE WHEN status = 'Belum Terkirim' THEN status END) * 100)::NUMERIC / COUNT(status), 2) AS total_persen
	, EXTRACT(YEAR FROM dn_kpi.create_date) AS tahun_create
	, EXTRACT(MONTH FROM dn_kpi.create_date) AS bulan_create
FROM
(
	SELECT
		dn.create_date,
		dn.name AS "dn_note",
		sp.date_done AS "sj_date",
		rp.display_name AS "add_name",
		so.name AS "no_po",
		so.date_order AS "tgl_po",
		dn.tanggal AS "tgl_kirim",
		CASE 
			WHEN
				DATE_PART('month', dn.tanggal::date) - DATE_PART('month', so.date_order::date) = 0
				AND DATE_PART('days', dn.tanggal::date) - DATE_PART('days', so.date_order::date) <= 7
				THEN DATE_PART('days', dn.tanggal::date) - DATE_PART('days', so.date_order::date)
			ELSE NULL
		END AS "selisih",
		CASE 
			WHEN sp.date_done IS NULL THEN 'Belum Terkirim'
			WHEN
				DATE_PART('month', dn.tanggal::date) - DATE_PART('month', so.date_order::date) = 0
				AND DATE_PART('days', dn.tanggal::date) - DATE_PART('days', so.date_order::date) <= 7
				AND sp.date_done IS NOT NULL
				THEN 'Tercapai'
			ELSE 'Tidak Tercapai'
		END AS "status"
	FROM
		delivery_note dn

	LEFT JOIN
		res_partner rp ON rp.id = dn.partner_id
	LEFT JOIN 
		stock_picking sp on sp.note_id = dn.id
	LEFT JOIN 
		order_preparation op ON op.id = dn.prepare_id
	LEFT JOIN 
		sale_order so ON so.id = op.sale_id

	WHERE 
		dn.state NOT IN ('draft','cancel')
		AND EXTRACT(YEAR FROM dn.create_date) = '$tahun_create'
) AS dn_kpi
GROUP BY EXTRACT(YEAR FROM dn_kpi.create_date),EXTRACT(MONTH FROM dn_kpi.create_date)
query;
		
		$connection = Yii::$app->db;
        $model = $connection->createCommand($query)->queryAll();

        $dataToRender['dataProvider'] = new \yii\data\ArrayDataProvider([
            'allModels'=>$model,
            'pagination'=>[
                'pageSize'=>-1
            ]
        ]);

        $series = [];
        $categories = [];
        $data = [];

        foreach($model as $key => $value){
            $categories[] = $value['bulan_create'];
            $data[$value['tahun_create']][$value['bulan_create']] = [
                'reached'=>$value['tercapai_persen'],
                'notreached'=>$value['tdk_tercapai_persen']
            ];
        }
        // var_dump($data);

        $a = 0;
        foreach ($data as $i => $d) {
            $series[$a] = [
                'name'=>'Tercapai',
                'data'=>[]          
            ];

            $res = ['reached'=>[],'notreached'=>[]];
            foreach ($d as $bln) {
                $res['reached'][] = floatval($bln['reached']);
                $res['notreached'][] = floatval($bln['notreached']);
            }

            $series[$a]['data'] = $res['reached'];
            $a++;

            $series[$a] = [
                'name'=>'Tidak Tercapai',
                'data'=>[]          
            ];

            $series[$a]['data'] = $res['notreached'];
            $a++;
        }
        // var_dump($data);

        $dataToRender['tahun_create'] = $tahun_create;
        $dataToRender['series'] = $series;
        $dataToRender['categories'] = $categories;

		return $this->render('year_summary_kpi',$dataToRender);
	}


}
