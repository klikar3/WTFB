<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Mitgliederschulen;
use frontend\models\MitgliederschulenSearch;
use frontend\models\Vertrag;
use frontend\models\VertragSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MitgliederschulenController implements the CRUD actions for Mitgliederschulen model.
 */
class MitgliederschulenController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','createfast','deletefast','viewfrommitglied','upload','vertrag'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                   [
                        'allow' => false,
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
     * Lists all Mitgliederschulen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MitgliederschulenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mitgliederschulen model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        $mitglied = $model->mitglieder;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
          if (empty($mitglied->mandatDatum) and !empty($model->VDatum)) {
            $mitglied->mandatDatum = $model->VDatum;
          }
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
        return $this->redirect(['/mitgliederschulen/view', 
            'id' => $id,
        ]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }    

    public function actionViewfrommitglied($id, $openv = 0)
    {
        $model = $this->findModel($id);
//        if (($mgModel = Mitglieder::findOne($model->MitgliederId)) == null) {
//              throw new NotFoundHttpException('The requested page does not exist.');
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        $mitglied = $model->mitglieder;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
          if (empty($mitglied->mandatDatum) and !empty($model->VDatum)) {
            $mitglied->mandatDatum = $model->VDatum;
          }
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
        	return $this->redirect(['/mitglieder/view', 
            'id' => $model->MitgliederId, 'tabnum' => 3, 'openv' => $openv
        ]);
        } else {
        	return $this->redirect(['/mitglieder/view', 
            'id' => $model->MitgliederId, 'tabnum' => 3, 'openv' => $openv
//            return $this->render('/mitglieder/view', [
//                'model' => $mgModel,
            ]);
        }
    }    

    /**
     * Creates a new Mitgliederschulen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mitgliederschulen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        $mitglied = $model->mitglieder;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
          if (empty($mitglied->mandatDatum) and !empty($model->VDatum)) {
            $mitglied->mandatDatum = $model->VDatum;
          }
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
            return $this->redirect(['view', 'id' => $model->msID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatefast()
    {
        $model = new Mitgliederschulen();

        if ($model->load(Yii::$app->request->post())) {
            if (empty($model->mandatNr) and !empty($model->mitglieder->MitgliedsNr)) {
              $model->mandatNr = sprintf('%d',$model->mitglieder->MitgliedsNr);
            }
            if (empty($model->mandatDatum) and !empty($model->VDatum)) {
              $model->mandatDatum = $model->VDatum;
            }
            if (empty($model->Kontoinhaber)) {
              $model->Kontoinhaber = $model->mitglieder->Vorname.' '.$model->mitglieder->Name;
            }
            if ($model->save()) {
    	        $mitglied = $model->mitglieder;
    	        date_default_timezone_set('Europe/Berlin');
    	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
/*              if (empty($mitglied->mandatDatum) and !empty($model->VDatum)) {
                $mitglied->mandatDatum = $model->VDatum;
              }
*/    				  
            if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
    	        $mitglied->save();
                return $this->redirect(['/mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 3]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }    
    }

    /**
     * Updates an existing Mitgliederschulen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        $mitglied = $model->mitglieder;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
          if (empty($mitglied->mandatDatum) and !empty($model->VDatum)) {
            $mitglied->mandatDatum = $model->VDatum;
          }
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
            return $this->redirect(['view', 'id' => $model->msID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mitgliederschulen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
	        $mitglied = $this->findModel($id)->mitglieder;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletefast($id)
    {
	        $mitglied = $this->findModel($id)->mitglieder;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
    		$mid = $this->findModel($id)->MitgliederId;
        $this->findModel($id)->delete();

        return $this->redirect(['/mitglieder/view', 'id' => $mid, 'tabnum' => 3]);
    }
    
    /**
     * Finds the Mitgliederschulen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Mitgliederschulen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mitgliederschulen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Url action - /book/book-detail
     */
    public function actionSchulDetail() {
        if (isset($_POST['expandRowKey'])) {
            $model = \frontend\models\Mitgliederschulen::findOne($_POST['expandRowKey']);
            return $this->renderPartial('_vertrag-detail', ['model'=>$model]);
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }    
    
    public function actionUpload($id,$tabnum)
    {
        $model = $this->findModel($id);
//        $model = \frontend\models\Mitgliederschulen::findOne($_POST['expandRowKey']);
        
				$fileData = $_FILES['attachment_53'];
				$image = UploadedFile::getInstanceByName($fileData['tmp_name']);
				$file_blob = file_get_contents($fileData['tmp_name']);;
				if (!empty($file_blob)) {
	        if (!empty($model->VertragId)) {
	        	$vertrag = $model->vertrag;
					} else {
						$vertrag = new Vertrag();
				 	}
				  $vertrag->pdf = $file_blob;
				  $vertrag->name = $fileData['name'];
				  $vertrag->typ = $fileData['type'];
				  if ($vertrag->save()) {
						$model->VertragId = $vertrag->VertragId;
						if (!$model->save()) return '<div class="alert alert-danger">Konnte MitgliederSchulen nicht speichern</div>';;
					}	
				}
				return json_encode($image);
//				return $this->renderPartial('/mitglieder/_vertrag-detail', ['model'=>$model]);
/*        if (isset($_POST['expandRowKey'])) {
            $model = \frontend\models\Mitgliederschulen::findOne($_POST['expandRowKey']);
            return $this->renderPartial('_vertrag-details', ['model'=>$model]);
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
*/        
    }

    public function actionVertrag($id,$tabnum)
    {
        $model = $this->findModel($id);
//        $model = \frontend\models\Mitgliederschulen::findOne($_POST['expandRowKey']);
        
				$image =  $model->vertrag->pdf;
				$typ = $model->vertrag->typ;
/*				
				Yii::$app->response->format = yii\web\Response::FORMAT_RAW;	
				$headers = Yii::$app->response->headers;
				$headers->add('Content-Type',$typ);
				
       return $this->renderPartial('/mitglieder/image', [
            'image' => $image,
            'typ' => $typ
        ]);
*/
				$response = Yii::$app->getResponse();
//				$response = yii\web\Response::make($image, 200);
				$response->format = yii\web\Response::FORMAT_RAW;
				$response->headers->set('Content-Type', $typ);
				return $image;
    }

}
