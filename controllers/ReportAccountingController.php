<?php
namespace app\controllers;
use Yii;
use app\models\StockPicking;
use app\models\StockPickingSearch;
use app\models\StockLocation;
use app\models\StockMove;
use app\models\StockMoveSearch;
use app\models\MrpBom;
use app\models\MrpBomSearch;
use app\models\AccountAccount;
use app\models\ResPartner;
use app\models\AccountingReportForm;
use app\models\AccountInvoice;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
class ReportAccountingController extends Controller
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

    public function actionStockMove($jenis,$from,$to)
    {
    	$this->layout = 'report';
    	$jenisreport=$_GET['jenis'];
    	$query = new Query;
    	if ($jenisreport=="del"){
	    		$query
	    		->select(
	    				'
	    				 dn.create_date as cretae_date, 
	    				 sp.date_done as tanggal,
	    				 dn.name as dn_no,
	    				 op.name as no_op,
	    				 p.default_code as part_number,
	    				 p.name_template as name_template,
	    				 sm.name as name_input,
	    				 sm.product_qty as qty,
	    				 u.name as uom,
	    				 batch.name as batch,
	    				 sol.price_unit as price,
	    				 ppl.name as pricelist,          
	    				 r.name as partner,
	    				 dn.poc as poc,
	    				 so.name as so_no,
	    				 sp.state as state,
	    				')
			    ->from('stock_move as sm')
			    ->join('JOIN','stock_picking as sp','sm.picking_id=sp.id')
			    ->join('JOIN', 'order_preparation as op', 'op.picking_id=sp.id')
			    ->join('LEFT JOIN', 'delivery_note as dn', 'dn.id=sp.note_id')
			    ->join('LEFT JOIN', 'product_product as p', 'p.id=sm.product_id')
			    ->join('LEFT JOIN','sale_order_line as sol','sol.id=sm.sale_line_id')
			    ->join('LEFT JOIN', 'sale_order as so', 'so.id=op.sale_id')
			    ->join('JOIN', 'product_uom as u', 'u.id=sm.product_uom')
			    ->join('JOIN', 'res_partner as r', 'r.id=dn.partner_id')
			    ->join('LEFT JOIN', 'stock_production_lot as batch', 'batch.id=sm.prodlot_id')
			    ->join('JOIN', 'product_pricelist as ppl', 'ppl.id = so.pricelist_id')
			    ->where(['>=','sp.date_done',$from])
			    ->andWhere(['<=','sp.date_done',$to])
			    ->andWhere(['not', ['p.default_code' => 'DUMMY01']])
			    ->orderBy('sp.date_done ASC');
			    

    	}
    	else{
	    		$query
	    		->select(
	    				'
	    				 s.type as jenis,
	    				 s.date_done as date_done,
	    				 s.lbm_no as lbm,
	    				 p.default_code as part_number,
	    				 p.name_template as name_template,
	    				 m.name as name_input,
	    				 m.product_qty as qty,
	    				 u.name as uom,
	    				 batch.name as batch,
	    				 m.price_unit as price,
	    				 ppl.name as pricelist,   
	    				 l.name as location,
	    				 sl.name as desc_location,       
	    				 r.name as partner,
	    				 s.name as type,
	    				 po.name as po,
	    				 s.origin as origin,
	    				 s.state as state,
	    				')
			    ->from('stock_move as m')
			    ->join('LEFT JOIN','stock_picking as s','s.id=m.picking_id')
			    ->join('LEFT JOIN','purchase_order as po','po.id=s.purchase_id')
			    ->join('LEFT JOIN','product_product as p','p.id=m.product_id')
			    ->join('LEFT JOIN','product_template as pt','pt.id=m.product_id')
			    ->join('JOIN','product_uom as u','u.id=m.product_uom')
			    ->join('JOIN','res_partner as r','r.id=m.partner_id')
			    ->join('JOIN','stock_location as l','m.location_id=l.id')
			    ->join('JOIN','stock_location as sl','m.location_dest_id=sl.id')
			    ->join('LEFT JOIN','stock_production_lot as batch','batch.id=m.prodlot_id')
			    ->join('LEFT JOIN','product_pricelist as ppl','ppl.id = po.pricelist_id')
			    ->where(['>=','s.date_done',$from])
			    ->andWhere(['<=','s.date_done',$to])
			    ->andWhere(['like','s.name','IN' ])
			    ->andWhere(['s.state'=>'done' ])
			    ->andWhere(['pt.sale_ok'=>TRUE ])
			    ->andWhere(['not', ['p.default_code' => null]])
			    ->andWhere(['not', ['p.default_code' => 'DUMMY01']]);
    	}
    	return $this->render('stockmove',['data'=>$query->all(), 'jenis'=>$jenisreport, 'from'=>$from , 'to'=>$to]);
    }


    public function actionAccountlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $lowerchr=strtolower($search);
            $command = Yii::$app->db->createCommand("SELECT DISTINCT id, code, name as text FROM account_account WHERE lower(name) LIKE '%".$lowerchr."%' OR code LIKE '%".$lowerchr."%' LIMIT 20");
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => AccountAccount::find($id)->code.' '.AccountAccount::find($id)->name];
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }


    public function actionCustomerlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $lowerchr=strtolower($search);
            $command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM res_partner WHERE lower(name) LIKE '%".$lowerchr."%' AND customer=true AND is_company=true LIMIT 20");
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ResPartner::find($id)->name];
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }

    public function actionSupplierlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $lowerchr=strtolower($search);
            $command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM res_partner WHERE lower(name) LIKE '%".$lowerchr."%' AND supplier=true AND is_company=true LIMIT 20");
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ResPartner::find($id)->name];
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        echo Json::encode($out);
    }



     public function actionReportaccount()
     {
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();
        $account = AccountAccount::find()->where(['type' => ['view', 'other', 'receivable','payable','liquidity','consolidation','closed']])->all();
        $SelectAccount = ArrayHelper::map($account,'id','name');

		$model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->get())) { 
        	$this->layout = 'report';
        	$query = new Query;       	
        	
     		if($model->account==null){ 
	     		$query
		     		->select ('
	     					aml.account_id as account_id, 
	     					aa.code as code, 
	     					aa.name as account_name')
		     		->distinct('aml.account_id')
		     		->from('account_move_line as aml')
		     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
		     		->where(['>=','aml.date',$model->date_from])
		     		->andWhere(['<=','aml.date',$model->date_to])
					->addOrderBy(['aml.account_id' => SORT_ASC]);
			}else{
				$query
		     		->select ('
		     				aml.account_id as account_id, 
		     				aa.code as code, 
		     				aa.name as account_name')
		     		->distinct('aml.account_id')
		     		->from('account_move_line as aml')
		     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
		     		->where(['>=','aml.date',$model->date_from])
		     		->andWhere(['<=','aml.date',$model->date_to])
		     		->andWhere(['aml.account_id' =>explode(',',$model->account)])
					->addOrderBy(['aml.account_id' => SORT_ASC]);
			}

        	$queryline = new Query;
	     		$queryline
		     		->select ('
	     					aml.account_id as account_id,
	     					aa.name as account_name,
		     				aml.ref as ref, 
		     				aml.name as name,
		     				aml.date as date, 
		     				aml.debit as debit, 
		     				aml.credit as credit')
		     		->from('account_move_line aml')
		     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
		     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
		     		->where(['>=','aml.date',$model->date_from])
		     		->andWhere(['<=','aml.date',$model->date_to])
					->addOrderBy(['aml.account_id' => SORT_ASC])
					->addOrderBy(['aml.date' => SORT_ASC]);

			 return $this->render('report/transaksiaccount',['data'=>$queryline->all(),'array'=>$query->all(),'from' =>$model->date_from, 'to'=>$model->date_to]);		
			     	
        }
     	return $this->render('reportaccount',['model' => $model,'SelectAccount'=>$SelectAccount]);

     }

     public function actionJurnalar(){
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();
     	
     	$model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->get())) { 
        		$this->layout = 'report';
        		$query = new Query;
        		if($model->partner==false)
        		{
        			$query
			 			->select ('
			 					am.id as move_id,
			 					am.date as date,
			 					rp.name as partner_name
			 					')
				 		->from('account_move as am')
				 		->join('LEFT JOIN','res_partner as rp','rp.id=am.partner_id')
				 		->where(['>=','am.date',$model->date_from])
				 		->andWhere(['<=','am.date',$model->date_to])
				 		->andWhere(['am.journal_id' =>1])
						->addOrderBy(['am.date' => SORT_DESC]);

					$queryline = new Query;
		     		$queryline
						->select ('
								aml.move_id as move_id,
								ai.kwitansi as kwitansi,
								aml.ref as ref, 
								aa.code as code, 
								aa.name as account, 
								aml.name as name,
								aml.date as date, 
								aml.debit as debit, 
								aml.credit as credit
								')
			     		->from('account_move_line aml')
			     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
			     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
			     		->join('LEFT JOIN','account_invoice as ai','ai.move_id=am.id')
						->where(['>=','am.date',$model->date_from])
			 			->andWhere(['<=','am.date',$model->date_to])
						->addOrderBy(['aml.id' => SORT_ASC])
						->addOrderBy(['am.date' => SORT_ASC]);
        		}else{
        			$query
		 			->select ('
		 					am.id as move_id,
		 					am.date as date,
		 					rp.name as partner_name
		 					')
			 		->from('account_move as am')
			 		->join('LEFT JOIN','res_partner as rp','rp.id=am.partner_id')
			 		->where(['>=','am.date',$model->date_from])
			 		->andWhere(['<=','am.date',$model->date_to])
			 		->andWhere(['am.journal_id' =>1])
			 		->andWhere(['am.partner_id' =>explode(',',$model->partner)])
					->addOrderBy(['am.date' => SORT_DESC]);

					$queryline = new Query;
		     		$queryline
						->select ('
								aml.move_id as move_id,
								ai.kwitansi as kwitansi,
								aml.ref as ref, 
								aa.code as code, 
								aa.name as account, 
								aml.name as name,
								aml.date as date, 
								aml.debit as debit, 
								aml.credit as credit
								')
			     		->from('account_move_line aml')
			     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
			     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
			     		->join('LEFT JOIN','account_invoice as ai','ai.move_id=am.id')
						->where(['>=','am.date',$model->date_from])
			 			->andWhere(['<=','am.date',$model->date_to])
			 			->andWhere(['aml.partner_id' =>explode(',',$model->partner)])
						->addOrderBy(['aml.id' => SORT_ASC])
						->addOrderBy(['am.date' => SORT_ASC]);
        		}
				return $this->render('report/transaksiar',['data'=>$queryline->all(), 'array'=>$query->all(), 'from' =>$model->date_from, 'to'=>$model->date_to]);	
        	}

     	return $this->render('jurnalar',['model' => $model]);
     }


     public function actionArsummary()
     {
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();
     	$model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->get())) { 
  
        	$this->layout = 'report';
        	$query = new Query;

        	$bulan1=date('Y-m-d',strtotime('-30 day',strtotime($model->date_from)));
			$bulan2=date('Y-m-d',strtotime('-30 day',strtotime($bulan1)));
			$bulan3=date('Y-m-d',strtotime('-30 day',strtotime($bulan2)));
			$bulan4=date('Y-m-d',strtotime('-30 day',strtotime($bulan3)));

    	    if($model->partner==false){ // All Partner
    	    	$command = 
    	    		Yii::$app->db->createCommand(
    	    			"SELECT 
							datalines.partner as id_partner, 
							datalines.pname as partner, 
							datalines.total as total,
							(SELECT sum(a.debit) as debit30 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan1'
									AND 
									a.date <= '$model->date_from'
									AND
									a.account_id=56
									AND
									ai_line.state='open'
							),
							(SELECT sum(a.debit) as debit60 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan2'
									AND 
									a.date <= '$bulan1'
									AND
									a.account_id=56
									AND
									ai_line.state='open'
							),
							(SELECT sum(a9.debit) as debit90 
								FROM account_move_line as a9
								LEFT JOIN account_move as am_line9 ON am_line9.id=a9.move_id
								LEFT JOIN account_invoice as ai_line9 ON ai_line9.move_id=am_line9.id
								WHERE 
									a9.partner_id=datalines.partner 
									AND 
									a9.date >= '$bulan3'
									AND 
									a9.date <= '$bulan2'
									AND
									a9.account_id=56
									AND
									ai_line9.state='open'
							),
							(SELECT sum(a90.debit) as debit90lebih 
								FROM account_move_line as a90
								LEFT JOIN account_move as am_line90 ON am_line90.id=a90.move_id
								LEFT JOIN account_invoice as ai_line90 ON ai_line90.move_id=am_line90.id
								WHERE 
									a90.partner_id=datalines.partner 
									AND 
									a90.date <= '$bulan3'
									AND
									a90.account_id=56
									AND
									ai_line90.state='open'
							)
						FROM
						(SELECT DISTINCT 
							aml.partner_id as partner, 
							rp.name as pname,
						(sum(aml.debit)-sum(aml.credit)) as total
						FROM account_invoice as p
							LEFT JOIN account_move as am ON am.id=p.move_id
							LEFT JOIN res_partner as rp ON rp.id=am.partner_id
							LEFT JOIN account_move_line as aml ON aml.move_id=am.id
						WHERE aml.account_id=56 AND p.state='open' GROUP BY aml.partner_id,rp.name ORDER BY rp.name ASC) as datalines
						");
			}else{
				$command = 
    	    		Yii::$app->db->createCommand(
    	    			"SELECT 
							datalines.partner as id_partner, 
							datalines.pname as partner, 
							datalines.total as total,
							(SELECT sum(a.debit) as debit30 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan1'
									AND 
									a.date <= '$model->date_from'
									AND
									a.account_id=56
									AND
									ai_line.state='open'
							),
							(SELECT sum(a.debit) as debit60 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan2'
									AND 
									a.date <= '$bulan1'
									AND
									a.account_id=56
									AND
									ai_line.state='open'
							),
							(SELECT sum(a9.debit) as debit90 
								FROM account_move_line as a9
								LEFT JOIN account_move as am_line9 ON am_line9.id=a9.move_id
								LEFT JOIN account_invoice as ai_line9 ON ai_line9.move_id=am_line9.id
								WHERE 
									a9.partner_id=datalines.partner 
									AND 
									a9.date >= '$bulan3'
									AND 
									a9.date <= '$bulan2'
									AND
									a9.account_id=56
									AND
									ai_line9.state='open'
							),
							(SELECT sum(a90.debit) as debit90lebih 
								FROM account_move_line as a90
								LEFT JOIN account_move as am_line90 ON am_line90.id=a90.move_id
								LEFT JOIN account_invoice as ai_line90 ON ai_line90.move_id=am_line90.id
								WHERE 
									a90.partner_id=datalines.partner 
									AND 
									a90.date <= '$bulan3'
									AND
									a90.account_id=56
									AND
									ai_line90.state='open'
							)
						FROM
						(SELECT DISTINCT 
							aml.partner_id as partner, 
							rp.name as pname,
						(sum(aml.debit)-sum(aml.credit)) as total
						FROM account_invoice as p
							LEFT JOIN account_move as am ON am.id=p.move_id
							LEFT JOIN res_partner as rp ON rp.id=am.partner_id
							LEFT JOIN account_move_line as aml ON aml.move_id=am.id
						WHERE aml.account_id=56 AND p.state='open' AND aml.partner_id IN ($model->partner) GROUP BY aml.partner_id,rp.name ORDER BY rp.name ASC) as datalines
						");
			}

			return $this->render('report/arsummary',['data'=>$command->queryAll(),'date'=>$model->date_from]);	
        }
     	return $this->render('arsummary',['model' => $model]);
     }

     public function actionArdetail()
     {
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();
     	$model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->get())) { 
  
        	$this->layout = 'report';
        	$query = new Query;
    	    if($model->partner==false){ 
    	    	$array = 
    	    		Yii::$app->db->createCommand("SELECT 
													aml.partner_id as partner_id, 
													rp.name as partner_name,
													rp.street as street
												FROM account_invoice as p
													LEFT JOIN account_move as am ON am.id=p.move_id
													LEFT JOIN account_move_line as aml ON aml.move_id=am.id
													LEFT JOIN res_partner as rp ON rp.id=aml.partner_id
												WHERE 
													p.state='open' 
												AND
													aml.account_id=56
												GROUP BY 
													aml.partner_id,
													rp.name,
													rp.street");

	        	$command = 
	    		Yii::$app->db->createCommand("SELECT  
	    										p.partner_id as partner_id,
												rp.name as parner_name,
												rp.street as street,
												p.kwitansi AS kwitansi, 
												p.date_invoice AS date_invoice,
												aml.debit AS total,
												p.name as no_po_cus,
												rps.name as sales_name
											FROM account_invoice AS p 
												LEFT JOIN account_move AS am ON am.id=p.move_id 
												LEFT JOIN account_move_line AS aml ON aml.move_id=am.id 
												LEFT JOIN res_partner as rp ON rp.id=p.partner_id
												LEFT JOIN res_users as ru ON ru.id=p.user_id
												LEFT JOIN res_partner as rps ON rps.id=ru.partner_id
											WHERE 
												aml.account_id=56 
											AND
												p.state='open'
											ORDER BY 
												p.partner_id,
												p.date_invoice DESC");
			}else{

				$array = 
    	    		Yii::$app->db->createCommand("SELECT 
													aml.partner_id as partner_id, 
													rp.name as partner_name,
													rp.street as street
												FROM account_invoice as p
													LEFT JOIN account_move as am ON am.id=p.move_id
													LEFT JOIN account_move_line as aml ON aml.move_id=am.id
													LEFT JOIN res_partner as rp ON rp.id=aml.partner_id
												WHERE 
													p.state='open' 
												AND
													aml.account_id=56
												AND 
													p.partner_id IN ($model->partner)
												GROUP BY 
													aml.partner_id,
													rp.name,
													rp.street");
				$command = 
	    		Yii::$app->db->createCommand("SELECT  
	    										p.partner_id as partner_id,
												rp.name as parner_name,
												rp.street as street,
												p.kwitansi AS kwitansi, 
												p.date_invoice AS date_invoice,
												aml.debit AS total,
												p.name as no_po_cus,
												rps.name as sales_name
											FROM account_invoice AS p 
												LEFT JOIN account_move AS am ON am.id=p.move_id 
												LEFT JOIN account_move_line AS aml ON aml.move_id=am.id 
												LEFT JOIN res_partner as rp ON rp.id=p.partner_id
												LEFT JOIN res_users as ru ON ru.id=p.user_id
												LEFT JOIN res_partner as rps ON rps.id=ru.partner_id
											WHERE 
												aml.account_id=56 
											AND
												p.state='open'
											AND 
												p.partner_id IN ($model->partner)
											ORDER BY 
												p.partner_id,
												p.date_invoice DESC");
			}
    	  
			return $this->render('report/ardetail',['data'=>$command->queryAll(),'array'=>$array->queryAll(),'date'=>$model->date_from,'partner'=>'all']);	
        }
     	return $this->render('ardetail',['model' => $model]);
     }

     public function actionApsummary()
     {
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();
     	$model->load(Yii::$app->request->get());

     	        if ($model->load(Yii::$app->request->get())) { 
  
        	$this->layout = 'report';
        	$query = new Query;

        	$bulan1=date('Y-m-d',strtotime('-30 day',strtotime($model->date_from)));
			$bulan2=date('Y-m-d',strtotime('-30 day',strtotime($bulan1)));
			$bulan3=date('Y-m-d',strtotime('-30 day',strtotime($bulan2)));
			$bulan4=date('Y-m-d',strtotime('-30 day',strtotime($bulan3)));

    	    if($model->partner==false){ // All Partner
    	    	$command = 
    	    		Yii::$app->db->createCommand(
    	    			"SELECT 
							datalines.partner as id_partner, 
							datalines.pname as partner, 
							datalines.total as total,
							(SELECT sum(a.credit) as debit30 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan1'
									AND 
									a.date <= '$model->date_from'
									AND
									a.account_id=119
									AND
									ai_line.state='open'
							),
							(SELECT sum(a.credit) as debit60 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan2'
									AND 
									a.date <= '$bulan1'
									AND
									a.account_id=119
									AND
									ai_line.state='open'
							),
							(SELECT sum(a9.credit) as debit90 
								FROM account_move_line as a9
								LEFT JOIN account_move as am_line9 ON am_line9.id=a9.move_id
								LEFT JOIN account_invoice as ai_line9 ON ai_line9.move_id=am_line9.id
								WHERE 
									a9.partner_id=datalines.partner 
									AND 
									a9.date >= '$bulan3'
									AND 
									a9.date <= '$bulan2'
									AND
									a9.account_id=119
									AND
									ai_line9.state='open'
							),
							(SELECT sum(a90.credit) as debit90lebih 
								FROM account_move_line as a90
								LEFT JOIN account_move as am_line90 ON am_line90.id=a90.move_id
								LEFT JOIN account_invoice as ai_line90 ON ai_line90.move_id=am_line90.id
								WHERE 
									a90.partner_id=datalines.partner 
									AND 
									a90.date <= '$bulan3'
									AND
									a90.account_id=119
									AND
									ai_line90.state='open'
							)
						FROM
						(SELECT DISTINCT 
							aml.partner_id as partner, 
							rp.name as pname,
						(sum(aml.credit)-sum(aml.debit)) as total
						FROM account_invoice as p
							LEFT JOIN account_move as am ON am.id=p.move_id
							LEFT JOIN res_partner as rp ON rp.id=am.partner_id
							LEFT JOIN account_move_line as aml ON aml.move_id=am.id
						WHERE aml.account_id=119 AND p.state='open' GROUP BY aml.partner_id,rp.name ORDER BY rp.name ASC) as datalines
						");
			}else{
				$command = 
    	    		Yii::$app->db->createCommand(
    	    			"SELECT 
							datalines.partner as id_partner, 
							datalines.pname as partner, 
							datalines.total as total,
							(SELECT sum(a.credit) as debit30 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan1'
									AND 
									a.date <= '$model->date_from'
									AND
									a.account_id=119
									AND
									ai_line.state='open'
							),
							(SELECT sum(a.credit) as debit60 
								FROM account_move_line as a
								LEFT JOIN account_move as am_line ON am_line.id=a.move_id
								LEFT JOIN account_invoice as ai_line ON ai_line.move_id=am_line.id
								WHERE 
									a.partner_id=datalines.partner 
									AND 
									a.date >= '$bulan2'
									AND 
									a.date <= '$bulan1'
									AND
									a.account_id=119
									AND
									ai_line.state='open'
							),
							(SELECT sum(a9.credit) as debit90 
								FROM account_move_line as a9
								LEFT JOIN account_move as am_line9 ON am_line9.id=a9.move_id
								LEFT JOIN account_invoice as ai_line9 ON ai_line9.move_id=am_line9.id
								WHERE 
									a9.partner_id=datalines.partner 
									AND 
									a9.date >= '$bulan3'
									AND 
									a9.date <= '$bulan2'
									AND
									a9.account_id=119
									AND
									ai_line9.state='open'
							),
							(SELECT sum(a90.credit) as debit90lebih 
								FROM account_move_line as a90
								LEFT JOIN account_move as am_line90 ON am_line90.id=a90.move_id
								LEFT JOIN account_invoice as ai_line90 ON ai_line90.move_id=am_line90.id
								WHERE 
									a90.partner_id=datalines.partner 
									AND 
									a90.date <= '$bulan3'
									AND
									a90.account_id=119
									AND
									ai_line90.state='open'
							)
						FROM
						(SELECT DISTINCT 
							aml.partner_id as partner, 
							rp.name as pname,
						(sum(aml.credit)-sum(aml.debit)) as total
						FROM account_invoice as p
							LEFT JOIN account_move as am ON am.id=p.move_id
							LEFT JOIN res_partner as rp ON rp.id=am.partner_id
							LEFT JOIN account_move_line as aml ON aml.move_id=am.id
						WHERE aml.account_id=119 AND p.state='open' AND aml.partner_id IN ($model->partner) GROUP BY aml.partner_id,rp.name ORDER BY rp.name ASC) as datalines
						");
			}

			return $this->render('report/apsummary',['data'=>$command->queryAll(),'date'=>$model->date_from]);	
        }
     	return $this->render('apsummary',['model' => $model]);	
     }

     public function actionApdetail()
     {
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();
     	$model->load(Yii::$app->request->get());

     	        if ($model->load(Yii::$app->request->get())) { 
  
        	$this->layout = 'report';
        	$query = new Query;
    	    if($model->partner==false){ 
    	    	$array = 
    	    		Yii::$app->db->createCommand("SELECT 
													aml.partner_id as partner_id, 
													rp.name as partner_name,
													rp.street as street
												FROM account_invoice as p
													LEFT JOIN account_move as am ON am.id=p.move_id
													LEFT JOIN account_move_line as aml ON aml.move_id=am.id
													LEFT JOIN res_partner as rp ON rp.id=aml.partner_id
												WHERE 
													p.state='open' 
												AND
													aml.account_id=119
												GROUP BY 
													aml.partner_id,
													rp.name,
													rp.street");

	        	$command = 
	    		Yii::$app->db->createCommand("SELECT  
	    										p.partner_id as partner_id,
												rp.name as parner_name,
												rp.street as street,
												p.kwitansi AS kwitansi, 
												p.date_invoice AS date_invoice,
												aml.credit AS total,
												p.reference as no_po
											FROM account_invoice AS p 
												LEFT JOIN account_move AS am ON am.id=p.move_id 
												LEFT JOIN account_move_line AS aml ON aml.move_id=am.id 
												LEFT JOIN res_partner as rp ON rp.id=p.partner_id
											WHERE 
												aml.account_id=119 
											AND
												p.state='open'
											ORDER BY 
												p.partner_id,
												p.date_invoice DESC");
			}else{

				$array = 
    	    		Yii::$app->db->createCommand("SELECT 
													aml.partner_id as partner_id, 
													rp.name as partner_name,
													rp.street as street
												FROM account_invoice as p
													LEFT JOIN account_move as am ON am.id=p.move_id
													LEFT JOIN account_move_line as aml ON aml.move_id=am.id
													LEFT JOIN res_partner as rp ON rp.id=aml.partner_id
												WHERE 
													p.state='open' 
												AND
													aml.account_id=119
												AND 
													p.partner_id IN ($model->partner)
												GROUP BY 
													aml.partner_id,
													rp.name,
													rp.street");
				$command = 
	    		Yii::$app->db->createCommand("SELECT  
	    										p.partner_id as partner_id,
												rp.name as parner_name,
												rp.street as street,
												p.kwitansi AS kwitansi, 
												p.date_invoice AS date_invoice,
												aml.credit AS total,
												p.reference as no_po
											FROM account_invoice AS p 
												LEFT JOIN account_move AS am ON am.id=p.move_id 
												LEFT JOIN account_move_line AS aml ON aml.move_id=am.id 
												LEFT JOIN res_partner as rp ON rp.id=p.partner_id
											WHERE 
												aml.account_id=119 
											AND
												p.state='open'
											AND 
												p.partner_id IN ($model->partner)
											ORDER BY 
												p.partner_id,
												p.date_invoice DESC");
			}
    	  
			return $this->render('report/apdetail',['data'=>$command->queryAll(),'array'=>$array->queryAll(),'date'=>$model->date_from,'partner'=>'all']);	
        }
  
     	return $this->render('apdetail',['model' => $model]);
     }

     public function actionJurnalap()
     {
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();



     	$model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->get())) { 
        		$this->layout = 'report';
        		$query = new Query;
        		if($model->partner==false)
        		{
        			$query
		 			->select ('
		 					am.id as move_id,
		 					am.date as date,
		 					rp.name as partner_name
		 					')
			 		->from('account_move as am')
			 		->join('LEFT JOIN','res_partner as rp','rp.id=am.partner_id')
			 		->where(['>=','am.date',$model->date_from])
			 		->andWhere(['<=','am.date',$model->date_to])
			 		->andWhere(['am.journal_id' =>2])
					->addOrderBy(['am.date' => SORT_DESC]);

					$queryline = new Query;
		     		$queryline
						->select ('
								aml.move_id as move_id,
								ai.kwitansi as kwitansi,
								aml.ref as ref, 
								aa.code as code, 
								aa.name as account, 
								aml.name as name,
								aml.date as date, 
								aml.debit as debit, 
								aml.credit as credit
								')
			     		->from('account_move_line aml')
			     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
			     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
			     		->join('LEFT JOIN','account_invoice as ai','ai.move_id=am.id')
						->where(['>=','am.date',$model->date_from])
			 			->andWhere(['<=','am.date',$model->date_to])
						->addOrderBy(['aml.id' => SORT_ASC])
						->addOrderBy(['am.date' => SORT_ASC]);
        		}else{
        			$query
		 			->select ('
		 					am.id as move_id,
		 					am.date as date,
		 					rp.name as partner_name
		 					')
			 		->from('account_move as am')
			 		->join('LEFT JOIN','res_partner as rp','rp.id=am.partner_id')
			 		->where(['>=','am.date',$model->date_from])
			 		->andWhere(['<=','am.date',$model->date_to])
			 		->andWhere(['am.journal_id' =>2])
			 		->andWhere(['am.partner_id' =>explode(',',$model->partner)])
					->addOrderBy(['am.date' => SORT_DESC]);

					$queryline = new Query;
		     		$queryline
						->select ('
								aml.move_id as move_id,
								ai.kwitansi as kwitansi,
								aml.ref as ref, 
								aa.code as code, 
								aa.name as account, 
								aml.name as name,
								aml.date as date, 
								aml.debit as debit, 
								aml.credit as credit
								')
			     		->from('account_move_line aml')
			     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
			     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
			     		->join('LEFT JOIN','account_invoice as ai','ai.move_id=am.id')
						->where(['>=','am.date',$model->date_from])
			 			->andWhere(['<=','am.date',$model->date_to])
			 			->andWhere(['aml.partner_id' =>explode(',',$model->partner)])
						->addOrderBy(['aml.id' => SORT_ASC])
						->addOrderBy(['am.date' => SORT_ASC]);
        		}
				return $this->render('report/transaksiap',['data'=>$queryline->all(), 'array'=>$query->all(), 'from' =>$model->date_from, 'to'=>$model->date_to]);	
        	}

     	return $this->render('jurnalap',['model' => $model]);	
     }

     public function actionJurnalpengeluaran()
     {
     	$this->layout ='dashboard';
     	$model = new AccountingReportForm();

     	$model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->get())) {
        	$this->layout = 'report';
        	$query = new Query;
        	$query
	 			->select ('
	 					am.id as move_id, 
	 					am.date as date, 
	 					am.ref as ref
	 					')
		 		->from('account_move as am')
		 		->where(['>=','am.date',$model->date_from])
		 		->andWhere(['<=','am.date',$model->date_to])
		 		->andWhere(['not',['am.journal_id' =>[1,2]]])
				->addOrderBy(['am.date' => SORT_DESC]);

			$queryline = new Query;
     		$queryline
					->select ('
						aml.move_id as move_id,
						aml.ref as ref, 
						aa.code as code, 
						aa.name as account, 
						aml.name as name,
						aml.date as date, 
						aml.debit as debit, 
						aml.credit as credit
						')
		     		->from('account_move_line aml')
		     		->join('LEFT JOIN','account_account as aa','aa.id=aml.account_id')
		     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
		     		->where(['>=','aml.date',$model->date_from])
		 			->andWhere(['<=','aml.date',$model->date_to])
		 			->andWhere(['not',['am.journal_id' =>[1,2]]])
					->addOrderBy(['aml.id' => SORT_ASC]);

			return $this->render('report/jurnalpengeluaran',['data'=>$queryline->all(),'array'=>$query->all(), 'from' =>$model->date_from, 'to'=>$model->date_to, 'account'=>'all']);	
        }
     	return $this->render('jurnalpengeluaran',['model' => $model]);	
     }
     public function actionAgingArSummary()
     {
     	$this->layout = 'report';
     	$from ='2014-08-15';
     	$query = new Query;
		     		$query
		     		->select ('aml.partner_id as partner_id, partner.name as name')
		     		->distinct('aml.partner_id')
		     		->from('account_move_line as aml')
		     		->join('LEFT JOIN','res_partner as partner','partner.id=aml.partner_id')
		     		->where(['<=','aml.date',$from])
		     		->andWhere(['customer'=>TRUE]);

     	return $this->render('agingarsummary',['data'=>$query->all(), 'date'=>$from]);
     }

     public function actionTurnOver($id)
     {
     	$this->layout = 'stockmanagement';
     	
     	$query = new Query;
     			$query
				->select(
	    				'
	    				 s.type as jenis,
	    				 m.date as date,
	    				 s.lbm_no as lbm,
	    				 s.name as no_int,
	    				 p.default_code as part_number,
	    				 p.name_template as name_template,
	    				 m.product_qty as qty,
	    				 u.name as uom,
	    				 l.name as location,
	    				 sl.name as desc_location,       
	    				 r.name as partner,
	    				 s.name as type,
	    				 s.lbm_no as lbm,
	    				 m.location_id as location_id,
	    				 s.cust_doc_ref as ref_cus,
	    				 dn.name as dn,
	    				 op.name as op,
	    				 s.origin as ori,
	    				 m.origin as origin,
	    				 m.state as state,
	    				 po.name as no_po,
	    				 m.name as product_name,
	    				 m.partner_id as partner_id
	    				')
			    ->from('stock_move as m')
			    ->join('LEFT JOIN','stock_picking as s','s.id=m.picking_id')
			    ->join('LEFT JOIN','purchase_order as po','po.id=s.purchase_id')
			    ->join('LEFT JOIN','product_product as p','p.id=m.product_id')
			    ->join('LEFT JOIN','product_template as pt','pt.id=m.product_id')
			    ->join('LEFT JOIN','delivery_note as dn','dn.id=s.note_id')
			    ->join('LEFT JOIN','order_preparation as op','op.id=dn.prepare_id')
			    ->join('JOIN','product_uom as u','u.id=m.product_uom')
			    ->join('JOIN','res_partner as r','r.id=m.partner_id')
			    ->join('JOIN','stock_location as l','m.location_id=l.id')
			    ->join('JOIN','stock_location as sl','m.location_dest_id=sl.id')
			    ->join('LEFT JOIN','stock_production_lot as batch','batch.id=m.prodlot_id')
			    ->join('LEFT JOIN','product_pricelist as ppl','ppl.id = po.pricelist_id')
			    ->where(['m.product_id'=>$id])
			    ->andWhere(['m.state'=>'done'])
			    ->addOrderBy(['m.date' => SORT_DESC]);

			$data = $query->all();
		

		foreach ($data as $value) {
			$product[]=$value['name_template'];
			$PN[]=$value['part_number'];
		}

		if ($data){
			return $this->render('turnover',['data'=>$data,'nameproduct'=>'['.$PN[0].']'.$product[0]]);	
		}else{
			echo '<center>Product Tidak Memilik Move</center>';
		}
     	
     }

   

     public function actionNotaRetur($id)
     {
     	$this->layout = 'report';

     	$model = new AccountInvoice();
     	$AccountInvoice = AccountInvoice::find()->where(['id' =>$id])->one();
     	return $this->render('report/noteretur',['model'=>$AccountInvoice]);		
     }


     public function actionRevisidn()
     {
    	
     	// $command = Yii::$app->db->createCommand("
     	// 										select
						// 						   sp.id as id
						// 						   , count(op.id) total_op
						// 						from stock_picking as sp
						// 						left join order_preparation as op on op.picking_id = sp.id
						// 						group by sp.id
						// 						having count(op.id)>1
						// 						order by sp.id desc
     	// 										")->queryAll();

     	// foreach ($command as  $value) {
     	// 	echo $value['id'].'<br/>';
     	// 	$cekop = Yii::$app->db->createCommand("
     	// 										SELECT 
     	// 											id as id, 
     	// 											picking_id as picking_id 
     	// 										FROM order_preparation 
     	// 										WHERE picking_id='".$value['id']."'
     	// 										")->queryAll();

     	// }


    	$command = Yii::$app->db->
     					createCommand("
     								SELECT  op.name as no_op,
     									op.id as op_id,
										sp.name as pick_name,
										op.sale_id as so_id,
										sp.id as pick_id,
										sp.note_id as pick_note_id,
										sp.backorder_id as backorder_id,
										sp1.name as out1,
										sp1.id as id_picking,
										sp1.note_id as pick_note_id1,
										sp2.note_id as pick_note_id2,
										dn.name as dn_name,
										dn.state as dnstate,
										dn.id as dn_id,
										dn1.name as dn2,
										dn1.id as id_dn,
										dn1.state as statedn,
										op.state as opstate,
										sp.state as spstate,
										sp2.state as sp2state
									FROM order_preparation as op
									LEFT JOIN delivery_note as dn ON dn.prepare_id=op.id
									LEFT JOIN stock_picking as sp ON sp.id=op.picking_id
									LEFT JOIN stock_picking as sp1 ON sp1.note_id=dn.id
									LEFT JOIN delivery_note as dn1 ON dn1.id=sp.note_id
									LEFT JOIN stock_picking as sp2 ON sp2.id=sp.backorder_id
									"
     							);

        $data = $command->queryAll();
        $out['results'] = array_values($data);
        foreach ($data as $value) {



        	/*
        		Update State OP done JIka DN DOne Dan Picking Done
	        	if ($value['opstate']=="approve"){
					$cekPick = Yii::$app->db->createCommand("SELECT id FROM stock_picking where sale_id='".$value['so_id']."' and state='confirmed'");
			     	$pick = $cekPick->queryOne();

			     	if ($pick['id']){
			     		echo 'Ada<br/>';
			     	}else{
			     		if ($value['dnstate']=="done" and $value['spstate']=="done"){
			     			$command = Yii::$app->db->createCommand("update order_preparation set state = 'done' where id = '".$value['op_id']."'");
					        $command->execute();	
					        echo 'status DN---'.$value['dnstate'].'---Status Picking--'.$value['spstate'].'----'.$value['op_id'].'<br/>';
			     		}

			     		

			     	}
	        	}
			*/
        	/*
        		// Rubah Picking ID OP yang status nya masih Approve dengan Picking ID yang statusnya Confirmed dari SO Terkait
        		if ($value['opstate']=="approve"){

	        		$cekPick = Yii::$app->db->createCommand("SELECT id FROM stock_picking where sale_id='".$value['so_id']."' and state='confirmed'");
		     		$pick = $cekPick->queryOne();

		     		if ($pick['id']){

		     			$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$pick['id']."' where id = '".$value['op_id']."'");
				        $command->execute();	
		     		}

        			echo $value['op_id'].'----'.$pick['id'].'<br/>';


        		}
        	
        	*/

        	/*
        	
        		// Cek OP Line By Product ID dan Qty Compare dengan Move lIne Product Id dan Qty, JIka ada yang sama, update Picking ID di OP
	        	if($value['opstate']=="done" and $value['spstate']=="done"){
		        	$cekOPLine = Yii::$app->db->
		     					createCommand("SELECT product_id, product_qty FROM order_preparation_line where preparation_id='".$value['op_id']."' ORDER BY product_id,product_qty ASC");
		     		$OPLine = $cekOPLine->queryAll();

		     		$a = "";
		     		foreach ($OPLine as $val) {
		     			$a .= $val['product_id'].'-'.$val['product_qty'].'-';
		     		}

					$cekMove = Yii::$app->db->
		     					createCommand("SELECT product_id, product_qty FROM stock_move where picking_id='".$value['pick_id']."' ORDER BY product_id,product_qty ASC");
		     		$MoveLine = $cekMove->queryAll();

		     		$b = "";
		     		foreach ($MoveLine as $valB) {
		     			$b .= $valB['product_id'].'-'.number_format($valB['product_qty'],2 ,'.', '').'-';
		     		}

		     		if ($a==$b){
		     		}else{
					
					// echo $value['no_op'].'<br/>';	     		
		     		// echo $a.'----'.$value['op_id'].'<br/>';
		     		// echo $b.'----'.$value['op_id'].'<br/>';

		     		// echo '<br/><br/>';
		     			$cekSO = Yii::$app->db->createCommand("SELECT id FROM stock_picking WHERE sale_id='".$value['so_id']."'")->queryAll();

		     			$idSO= "";
						foreach ($cekSO as $SO)
						{
							$idSO .= $SO['id'].',';

							$cekMove2 = Yii::$app->db->createCommand("SELECT product_id, product_qty FROM stock_move where picking_id='".$SO['id']."' ORDER BY product_id,product_qty ASC");
		     				$MoveLine1 = $cekMove2->queryAll();

		     				$c = "";
		     				foreach ($MoveLine1 as $valC) {
				     			$c .= $valC['product_id'].'-'.number_format($valC['product_qty'],2 ,'.', '').'-';
				     		}
				     		// if($c==$a){
				     		// 	echo $a.'----'.$value['pick_id'].'<br/>';
				     		// 	echo $c.'----'.$SO['id'].'<br/>';
				     			
				     		// 	$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$SO['id']."' where id = '".$value['op_id']."'");
				      		// $command->execute();	
				     		// }
				     		echo $c.'>>>>>>>>>>>'.$value['so_id'].'>>>>>>>>'.$SO['id'].'<br/>';				     		
						}
				     			
						echo '<br/><br/>';	
		     		}
		     	}
	 		
	 		*/
        	/*
        		// Update Picking ID di OP dengan cek Count OP Line Dan Move Line
	        	if ($value['backorder_id']){
			    	$cekLine = Yii::$app->db->createCommand("SELECT count(id) as total FROM order_preparation_line where preparation_id='".$value['op_id']."'");
			    	$xLine = $cekLine->queryOne();

			    	$cekMove = Yii::$app->db->createCommand("SELECT count(id) as total_move FROM stock_move where picking_id='".$value['backorder_id']."'");
			    	$yLine = $cekMove->queryOne();

			    	$cekMV = Yii::$app->db->createCommand("SELECT count(id) as total_pick FROM stock_move where picking_id='".$value['pick_id']."'");
			    	$nLine = $cekMV->queryOne();

			    	if ($xLine['total']==$yLine['total_move']){
			    		$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$value['backorder_id']."' where id = '".$value['op_id']."'");
				        $command->execute();	
			    	}

			    	if ($xLine['total']<>$nLine['total_pick']){
			    	   
			    	   $p = Yii::$app->db->createCommand("select sp.id, count(sm.id) total_sm
														from stock_picking sp
														left join stock_move as sm on sm.picking_id = sp.id
														where sp.sale_id ='".$value['so_id']."' 
														group by sp.id
														having count(sm.id)='".$xLine['total']."'");
			    	   $pLine = $p->queryOne();

			    		
			    	   if ($pLine['total_sm']==$xLine['total']){
				    	   	if($pLine['id']){
				    	   		$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$pLine['id']."' where id = '".$value['op_id']."'");
					        	$command->execute();
				    	   	}
				    	   	 	
			    	   }
				    	echo $value['op_id'].'-------OP---'.$xLine['total'].'------MOVE ID------'.$nLine['total_pick'].'--------TOTAL--'.$pLine['total_sm'].'------'.$pLine['id'].'<br/>';    
			    	}

	        		

	        	}
	        	*/

			

			// foreach ($datapickline as $pickID) {
			// 	$line[]=$pickID['product_id'];
			// }
			// echo '<pre>';
			// var_dump($line);
			// echo '</pre>';
			// echo '<br/>';
			// echo '<br/>';
        	/*
        		Update DN status Cancel Jika OP dan Stock Picking status Cancel
        		if ($value['dnstate']=="approve"){
        			if ($value['opstate']=="cancel" AND $value['spstate']=="cancel"){
        				$command = Yii::$app->db->createCommand("update delivery_note set state = 'cancel' where id = '".$value['dn_id']."'");
				        $command->execute();	
        			}
        		}
			
			*/

   			/*
        		//Update picking ID OP berdasarkan ID Picking yang masih belum Done, dikarnakan status DN masih belum Done
	        	if ($value['dnstate']=="approve"){
	    		    	$picking = Yii::$app->db->
	    		    							createCommand("
	    		    								SELECT id as picking_id FROM stock_picking where sale_id='".$value['so_id']."' and state ='assigned'
	    		    								");
	    		    	$datapick = $picking->queryOne();

	    		    if ($datapick['picking_id']){
	    		    	echo 'ID OP---------'.$value['op_id'].'-------state DN--------------'.$value['dnstate'].'------------------------'.$datapick['picking_id'].'<br/>';	
	    		    	$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$datapick['picking_id']."' where id = '".$value['op_id']."'");
				        $command->execute();	
	    		    }
	        		// echo 'ID OP---------'.$value['op_id'].'-------state DN--------------'.$value['dnstate'].'------------------------'.$datapick['picking_id'].'<br/>';	
	        	}
        	
			*/

        	/*
	        	// Update Stock Picking note ID samakan dengan ID DN dari OP 
	        	if ($value['dn_id']){
	        		if ($value['spstate']=="done"){
	        			$command = Yii::$app->db->createCommand("update stock_picking set note_id ='".$value['dn_id']."'  where id = '".$value['pick_id']."'");
			    		$command->execute();	 		
	        		}
	        		
	        	}
        	*/
	        /*
	        	Update OP dari Backoder ID dari stock picking yang status nya masih confirm dan cek backorder ID yang status nya Done, maka di replace ke ID backorder
				if ($value['backorder_id']){        
					if ($value['spstate']=="confirmed"){
						$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$value['backorder_id']."' where id = '".$value['op_id']."'");
			        	$command->execute();	
					}	
	        	}
        	*/


	        /*
	        	if ($value['backorder_id']){
	        		if ($value['pick_note_id1']==$value['pick_note_id2']){
	        			if ($value['spstate']=="confirmed" && $value['sp2state']=="done"){     				
	        				// Update stock picking yang masih confirm --> note id dibuat menjadi Null
	        				$command = Yii::$app->db->createCommand("update stock_picking set note_id = Null where id = '".$value['pick_id']."'");
			        		$command->execute();
			        		// Update order Preparation yang picking nya confirm menjadi picking yang done
			        		$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$value['backorder_id']."' where id = '".$value['op_id']."'");
			        		$command->execute();	
	        			}
	        		}
	        	}

			*/
        	
	      
	        	if ($value['spstate']=="assigned"){
					// Update Stock Picking Status Confirmed MNOte Id Menjadi Null
					$command = Yii::$app->db->createCommand("update stock_picking set note_id = Null where id = '".$value['pick_id']."'");
			        $command->execute();	         		
	        	}
	        


	        /*
	        	if ($value['dn_id'] == $value ['id_dn'])
	        	{
	        		echo $value['dn_id'].'--------------'.$value['id_dn'].'------------------'.$value['pick_id'];
	        	}
	        	else
	        	{
					echo $value['dn_id'].'--------------'.$value['id_dn'].'-------------------'.$value['pick_id'];
					if ($value['dn_id']){
						$command = Yii::$app->db->createCommand("update stock_picking set note_id = '".$value['dn_id']."' where id = '".$value['pick_id']."'");
			        $command->execute();	        			
					}
					
	        	}
			*/

	        /*
	        	if ($value['dn_id'] ==  $value ['id_dn'])
	        	{}else{
					
					$command = Yii::$app->db->createCommand("update stock_picking set note_id = '".$value['dn_id']."' where id = '".$value['pick_id']."'");
			        $command->execute();	        		
	        	}
	        */

	        /*
	        	if ($value['dn_name'] ==  $value ['dn2'])
	        	{	
	        		echo '111<br/>';
	        	}else{
	        		echo '222<br/>';
	        		if ($value['id_picking']){
	        			$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$value['id_picking']."' where id = '".$value['op_id']."'");
			        $command->execute();	
	        		}
	        		 
	        	}
			*/

			/*        	
	        	if ($value['pick_note_id']==''){
	        		$command = Yii::$app->db->createCommand("update stock_picking set note_id = '".$value['dn_id']."' where id = '".$value['pick_id']."'");
			        $command->execute();	
	        	}else{
	        		echo 'aaaaaa<br/>';
	        	}	
	        	if ($value['pick_note_id1']==''){
	        		if ($value['backorder_id']){
	        			$command = Yii::$app->db->createCommand("update order_preparation set picking_id = '".$value['backorder_id']."' where id = '".$value['op_id']."'");
			        	$command->execute();	
	        		}
	        			
	        	}else{
	        		echo 'aaaaaa<br/>';
	        	}
			*/
        
         }


     }

}

?>