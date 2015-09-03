<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use kartik\mpdf\Pdf;

use frontend\models\Mitglieder;
use frontend\models\Texte;
use frontend\models\TexteSearch;

/**
 * TexteController implements the CRUD actions for Texte model.
 */
class TexteController extends Controller
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
     * Lists all Texte models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TexteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Texte model.
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
     * Creates a new Texte model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Texte();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Texte model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Texte model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Texte model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Texte the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Texte::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPrint($datamodel, $dataid, $txtid)
    {
        if ($datamodel = 'mitglieder') {
					 $model = Mitglieder::findOne($dataid);
				}
				
				$textmodel = Texte::findOne($txtid);
				$textmodel->txt = str_replace ( '#vorname#' , $model->Vorname , $textmodel->txt ); 
				$textmodel->txt = str_replace ( '#mitgliedernummer#' , $model->MitgliedsNr , $textmodel->txt );
				$textmodel->txt = str_replace ( '#nachname#' , $model->Name , $textmodel->txt );
				$textmodel->txt = str_replace ( '#geburtstag#' , Yii::$app->formatter->asDatetime($model->GeburtsDatum, "php:d.m.Y") , $textmodel->txt );
				$textmodel->txt = str_replace ( '#schulort#' , $model->Schulort , $textmodel->txt );
				$textmodel->txt = str_replace ( '#sifu#' , $model->Sifu , $textmodel->txt );	
				$textmodel->txt = str_replace ( '#anrede#' , $model->Anrede , $textmodel->txt );	
				$textmodel->txt = str_replace ( '#strasse#' , $model->Strasse , $textmodel->txt );	
				$textmodel->txt = str_replace ( '#wohnort#' , $model->Wohnort , $textmodel->txt );	
				$textmodel->txt = str_replace ( '#plz#' , $model->PLZ , $textmodel->txt );	
				$textmodel->txt = str_replace ( '#heute#' , date("d.m.Y") , $textmodel->txt );
				
							
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
						'content' => $this->renderPartial('print', [
		            'model' => $textmodel,
		        ]),
						'options' => [
								'title' => 'Prüfungsliste',
								'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
						],
						'methods' => [
							'SetHeader' => [''],
							'SetFooter' => [''],
						]
			]);
			return $pdf->render();
    }

		protected function textReplace($datamodel, $dataid, $txtid)
    {
        if (($model = Texte::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
