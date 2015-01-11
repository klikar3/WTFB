<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
		 
use frontend\models\Grade;
use frontend\models\Mitglieder;
use frontend\models\Mitgliederliste;
use frontend\models\MitgliederlisteSearch;
use frontend\models\PruefungslisteForm;

/**
 * MitgliederController implements the CRUD actions for Mitglieder model.
 */
class MitgliederlisteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup', 'mitgliederliste'],
                'rules' => [
                    [
                        'actions' => ['index','view','pruefungsliste','resetpliste'],
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
     * Lists all Mitglieder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MitgliederlisteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mitglieder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
//        $searchModel = new MitgliederGradeSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
				
        return $this->render('view', [
            'model' => $this->findModel($id),
            'grade' => $mgdataProvider,
        ]);
    }

    /**
     * Creates a new Mitglieder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mitgliederliste();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/mitgliederliste/view', 'id' => $model->MitgliederId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mitglieder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->MitgliederId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mitglieder model.
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
     * Finds the Mitglieder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mitglieder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mitgliederliste::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
		* THE CONTROLLER ACTION
		*/
		// Privacy statement output demo
		public function actionPruefungsliste() {
//        Yii::info(Vardumper::dumpAsString($plf));
    		$plf = new PruefungslisteForm();
				$gt = Yii::$app->request->get();
        Yii::info("-----gt: ".Vardumper::dumpAsString($gt));
				$plf->datum = $gt['PruefungslisteForm']['datum'];
				$plf->pgeb = $gt['PruefungslisteForm']['pgeb'];
				$plf->disp = $gt['PruefungslisteForm']['disp'];

//				$plf->load(Yii::$app->request->get(0));
//				Yii::info(Vardumper::dumpAsString(Yii::$app->request->get(0)));
        Yii::info("-----test");
        Yii::info("-----plf: ".Vardumper::dumpAsString($plf));

				$grads = ArrayHelper::map( Grade::find()->where(['DispName' => $plf->disp])->all(), 'gradId', 'gradId') ; 
        Yii::info("-----grads: ".Vardumper::dumpAsString($grads));

        $searchModel = new MitgliederlisteSearch();
        $query = Mitgliederliste::find()
                 ->where(['PruefungZum' => $grads] );
        $query->andFilterWhere(['>', 'PruefungZum', 0]);

				$dataProvider = new ActiveDataProvider([
				     'query' => $query,
				     'sort'=> ['defaultOrder' => ['PruefungZum'=>SORT_ASC]]
				]);  

				$pdf = new Pdf([
						'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
						// set to use core fonts only
						'mode' => Pdf::MODE_BLANK,
						// A4 paper format
						'format' => Pdf::FORMAT_A4,
						// portrait orientation
						'orientation' => Pdf::ORIENT_PORTRAIT,
						// stream to browser inline
						'destination' => Pdf::DEST_BROWSER,
						// format content from your own css file if needed or use the
						// enhanced bootstrap css built by Krajee for mPDF formatting
						'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
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
													'.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
						'content' => $this->renderPartial('pruefungsliste', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		            'plf' => $plf,
		        ]),
						'options' => [
								'title' => 'Prüfungsliste',
								'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
						],
						'methods' => [
							'SetHeader' => ['Erstellt am: ' . date("r")],
							'SetFooter' => ['|Seite {PAGENO}|'],
						]
			]);
			return $pdf->render();
		}
		
    public function actionResetpliste()
    {
        Mitglieder::updateAll(['PruefungZum' => '']);
        return $this->redirect(['index']);
    }
}
