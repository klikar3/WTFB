<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\MitgliedergradePrint;
use frontend\models\MitgliedergradeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\VarDumper;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;

/**
 * MitgliedergradeController implements the CRUD actions for Mitgliedergrade model.
 */
class MitgliedergradeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','createfast','print'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mitgliedergrade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MitgliedergradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mitgliedergrade model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mitgliedergrade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($mId)
    {
    		$query = Disziplinen::find();
				$ddataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort' => ['defaultOrder' => ['gradId' => SORT_ASC]]
				]);
				
    		$query = Grade::find();
				//$query->where(['=', 'MitgliedId', $mId]);
				$gdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort' => ['defaultOrder' => ['id' => SORT_ASC]]
				]);
				
    		$query = Mitgliedergrade::find();
				$query->where(['=', 'MitgliedId', $mId]);

				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort' => ['defaultOrder' => ['Datum' => SORT_DESC]]
				]);
				
//				$datum = date('Y-m-d H:i:s');
        $model = new Mitgliedergrade();
//        $model->MitgliedId = $mId;
//        $model->Datum = $datum;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->mgID]);
        } else {
            return $this->redirect(['mitgliedergrade/view', 'id' => $mId]);
/*            return $this->render('create', [
                'model' => $model ,
//                'ddataProvider' => $ddataProvider,
//                'gdataProvider' => $gdataProvider,                
            ]);
*/        }
    }

    public function actionCreatefast($mId, $grad)
    {
    		$query = Disziplinen::find();
				$ddataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort' => ['defaultOrder' => ['gradId' => SORT_ASC]]
				]);
				
    		$query = Grade::find();
				//$query->where(['=', 'MitgliedId', $mId]);
				$gdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort' => ['defaultOrder' => ['id' => SORT_ASC]]
				]);
				
    		$query = Mitgliedergrade::find();
				$query->where(['=', 'MitgliedId', $mId]);

				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort' => ['defaultOrder' => ['Datum' => SORT_DESC]]
				]);
				
        $modelp = new MitgliedergradePrint();
        $modelp->MitgliedId = $mId;
        $modelp->GradId = $grad;
        $modelp->Datum = date('Y-m-d');
        $modelp->PrueferId = Yii::$app->user->identity->PrueferId;
        $modelp->print = true;
				Yii::Error( 'test');
        if ($modelp->load(Yii::$app->request->post())) {
        		$model = new Mitgliedergrade();
        		$model->MitgliedId =$modelp->MitgliedId;
        		$model->GradId = $modelp->GradId;
        		$model->Datum = $modelp->Datum;
        		$model->PrueferId = $modelp->PrueferId;
//        		Yii::info("-----model: ".Vardumper::dumpAsString($model));
//        		Yii::info("-----modelp: ".Vardumper::dumpAsString($modelp));
        		if (!$model->save()){
            return $this->render('create', [
                'model' => $modelp, 'ddataProvider' => $ddataProvider, 'gdataProvider' => $gdataProvider,  
            ]);
        			return $this->redirect(['/mitgliedergrade/createfast', 'id' => $mgID]);
						}
        		$mgID = Yii::$app->db->getLastInsertID();
        		
        		$modelm = Mitglieder::find($mId)->one();
        		if ($modelm) {
//  Yii::info("-----modelm: ".Vardumper::dumpAsString($modelm));
		        		$modelm->PruefungZum = 0;
		        		$modelm->save();
        		}
        		if ($modelp->print) {
								return $this->redirect(['/mitgliedergrade/print', 'id' => $mgID]);
						}
            return $this->redirect(['mitglieder/view', 'id' => $model->MitgliedId, ]);
        } else {
            return $this->render('create', [
                'model' => $modelp ,
                'ddataProvider' => $ddataProvider,
                'gdataProvider' => $gdataProvider,                
            ]);
        }
    }

    /**
     * Updates an existing Mitgliedergrade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->mgID]);
        return $this->redirect(['/mitglieder/view', 'id' => $model->MitgliedId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mitgliedergrade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $mgid = $this->findModel($id)->mitglied->MitgliederId;
        $this->findModel($id)->delete();

//        return $this->redirect(['index']);
        return $this->redirect(['/mitglieder/view', 'id' => $mgid]);
    }

    /**
     * Finds the Mitgliedergrade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Mitgliedergrade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mitgliedergrade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPrint($id)
    {
//    	$this->layout = 'print';
    	
			 // get your HTML raw content without any layouts or scripts
			$content = $this->renderPartial('_reportView', array(
                                'model' => $this->findModel($id), 
                        ));
			
			// setup kartik\mpdf\Pdf component
			$pdf = new Pdf([
				// set to use core fonts only
				'mode' => Pdf::MODE_BLANK,
				// A4 paper format
				'format' => Pdf::FORMAT_A4,
				// portrait orientation
				'orientation' => Pdf::ORIENT_PORTRAIT,
				// stream to browser inline
				'destination' => Pdf::DEST_BROWSER,
				// your html content input
				'content' => $content,
				// format content from your own css file if needed or use the
				// enhanced bootstrap css built by Krajee for mPDF formatting
				'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
				// any css to be embedded if required
				'cssInline' => '.kv-heading-1{font-size:18px}'.
											'.kv-wrap{padding:20px;}' .
											'.kv-align-center{text-align:center;}' .
											'.kv-align-left{text-align:left;}' .
											'.kv-align-right{text-align:right;}' .
											'.kv-align-top{vertical-align:top!important;}' .
											'.kv-align-bottom{vertical-align:bottom!important;}' .
											'.kv-align-middle{vertical-align:middle!important;}' .
											'.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
											'.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
											'.wtfb-name{font-size:30px; font-weight: bold;}' .
											'.wtfb-grad{font-size:18px; font-weight: bold;}' .
											'.wtfb-datum{font-size:14px; font-weight: bold;}' .
											'.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
				// set mPDF properties on the fly
				'options' => ['title' => 'Prüfung'],
				// call mPDF methods on the fly
				'methods' => [
//					'SetHeader'=>['Krajee Report Header'],
//					'SetFooter'=>['{PAGENO}'],
				]
			]);
			
			// return the pdf output as per the destination setting
			return $pdf->render();
     }

}
