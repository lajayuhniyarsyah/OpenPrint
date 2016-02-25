<?php

namespace app\controllers;

use Yii;
use app\models\SbmAdhocOrderRequest;
use app\models\SbmAdhocOrderRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SbmAdhocOrderRequestController implements the CRUD actions for SbmAdhocOrderRequest model.
 */
class SbmAdhocOrderRequestController extends Controller
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
     * Lists all SbmAdhocOrderRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SbmAdhocOrderRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SbmAdhocOrderRequest model.
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
     * Creates a new SbmAdhocOrderRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SbmAdhocOrderRequest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SbmAdhocOrderRequest model.
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
     * Deletes an existing SbmAdhocOrderRequest model.
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
     * Finds the SbmAdhocOrderRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SbmAdhocOrderRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SbmAdhocOrderRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // action print
    public function actionPrint($id,$test=0){
        $this->layout = 'printout';
        
        $model = $this->findModel($id);

        // PREPARE LINE DATA FOR PRINT
        
        $sets = [];
        
        // $prepLines = $this->prepareLineData($model->deliveryNoteLines); 
        // echo '<pre>';
        // var_dump($prepLines);
        // echo '</pre>';
        // $linesData = $this->renderLinesPrint($prepLines);
        return $this->render('print/print',['model'=>$model]);
    }

}
