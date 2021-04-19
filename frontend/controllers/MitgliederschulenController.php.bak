<?php

namespace frontend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

use kartik\widgets\ActiveForm;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\InteressentVorgaben;
use frontend\models\Intensiv;
use frontend\models\Mitglieder;
use frontend\models\Mitgliederschulen;
use frontend\models\MitgliederIntensivSearch;
use frontend\models\MitgliederSearch;
use frontend\models\Mitgliedergrade;
use frontend\models\Mitgliedersektionen;
use frontend\models\MitgliedersektionenSearch;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sektionen;
use frontend\models\Sifu;
use frontend\models\Vertrag;
use frontend\models\VertragSearch;

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
        if (($mgModel = Mitglieder::findOne($model->MitgliederId)) == null) {
              throw new NotFoundHttpException('The requested page does not exist.');
        } else { $mgId = $mgModel->MitgliederId;}

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
           if (!$model->validate()) {
              return ActiveForm::validate($model); 
           } else {
        $model->save();   
				// Graduierungen
				$query = Mitgliedergrade::find();
				$query->andWhere(['=', 'MitgliedId', $mgId]);
				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC],],
          'pagination' => false,
				]);
				
				$grade_zur_auswahl = array_merge(["0" => ""], ArrayHelper::map( Grade::find()->all(), 'gradId', 'gKurz', 'DispName' ));
				$sektionen_zur_auswahl = ArrayHelper::map( Sektionen::find()->orderBy('sekt_id')->all(), 'sekt_id', 'name' );
  	    $pruefer_zur_auswahl = ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' );
        $schulen = ArrayHelper::map( Schulen::find()->with('disziplinen')->all(), 'SchulId', 'SchulDisp' ); //array_merge(["" => ""], ArrayHelper::map( Schulen::find()->distinct()->orderBy('SchulId')->all(), 'Schulname', 'SchulDisp' ));
        $anreden = array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' ));
        $functions = array_merge(array_merge(["" => ""], ArrayHelper::map( Funktion::find()->distinct()->orderBy('FunkId')->all(), 'inhalt', 'inhalt' )),['style'=>'']);
        $sifus = array_merge(["" => ""], ArrayHelper::map( Sifu::find()->orderBy('sId')->all(), 'SifuName', 'SifuName' ));
        $disziplinen = array_merge(["" => ""], ArrayHelper::map( Disziplinen::find()->orderBy('sort')->all(), 'DispName', 'DispName' ));
  	
				// Sektionen
				$squery = Mitgliedersektionen::find();
				$squery->andWhere(['=', 'mitglied_id', $mgId]);
				$msdataProvider = new ActiveDataProvider([
			    'query' => $squery,
     			'sort'=> ['defaultOrder' => ['vdatum' => SORT_ASC],],
          'pagination' => false,
				]);
  	
  	    // Verträge
				$vquery = Mitgliederschulen::find();
				$vquery->andWhere(['=', 'MitgliederId', $mgId]);
				//Yii::info('-----$vquery: '.VarDumper::dumpAsString($vquery));
				$vdataProvider = new ActiveDataProvider([
			    'query' => $vquery,
     			'sort'=> ['defaultOrder' => ['Von' => SORT_ASC]]
				]);
				// Yii::info('-----$vdataProvider: '.VarDumper::dumpAsString($vdataProvider));

//          Yii::warning('errors '.Vardumper::dumpAsString($model->errors));
            return $this->render('/mitglieder/view', [
                'model' => $mgModel, 'tabnum' => 3, 'openv' => $openv,
                'grade' => $mgdataProvider, 'sektionen' => $msdataProvider, 
								'contracts' => $vdataProvider, 'grade_zur_auswahl' => $grade_zur_auswahl,
								'sektionen_zur_auswahl' => $sektionen_zur_auswahl,
								'pruefer_zur_auswahl' => $pruefer_zur_auswahl, 'errors' => $model->errors, 'formedit' => true,
                'schulen' => $schulen, 'anreden' => $anreden, 'functions' => $functions, 'sifus' => $sifus, 'disziplinen' => $disziplinen,
            ]);
           }               
 //       }
        } else {
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          if ($model->VertragId == 0) { $model->VertragId = null;}
          if ($model->save()) {
    	        //$mitglied = $model->mitglieder;
    	        date_default_timezone_set('Europe/Berlin');
    	        $mgModel->LetzteAenderung = date('Y-m-d H:i:s');
              if (empty($mgModel->mandatDatum) and !empty($model->VDatum)) {
                $mgModel->mandatDatum = $model->VDatum;
              }
    				  if (Yii::$app->user->identity->isAdmin) { $mgModel->LetztAendSifu = $mgModel->LetzteAenderung; }
    	        $mgModel->save();
            	return $this->redirect(['/mitglieder/view', 
                'id' => $model->MitgliederId, 'tabnum' => 3, 'openv' => $openv
            ]);
            } 
        } else {
//			  Yii::warning('----- Validation Error: $model->$attribute: '.VarDumper::dumpAsString($model->$attribute));
//        	return $this->redirect(['/mitglieder/view', 
//            'id' => $model->MitgliederId, 'tabnum' => 3, 'openv' => $openv


				// Graduierungen
				$query = Mitgliedergrade::find()->joinWith('grad')->joinWith('pruefer')->select(['*','pruefer.pName']);
				$query->andWhere(['=', 'MitgliedId', $mgId]);
				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC],],
          'pagination' => false,
				]);
				
				$grade_zur_auswahl = array_merge(["0" => ""], ArrayHelper::map( Grade::find()->all(), 'gradId', 'gkdk', 'DispName' ));
				$sektionen_zur_auswahl = ArrayHelper::map( Sektionen::find()->orderBy('sekt_id')->all(), 'sekt_id', 'name' );
  	    $pruefer_zur_auswahl = ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' );
        $schulen = ArrayHelper::map( Schulen::find()->with('disziplinen')->all(), 'SchulId', 'SchulDisp' ); //array_merge(["" => ""], ArrayHelper::map( Schulen::find()->distinct()->orderBy('SchulId')->all(), 'Schulname', 'SchulDisp' ));
        $anreden = array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' ));
        $functions = array_merge(array_merge(["" => ""], ArrayHelper::map( Funktion::find()->distinct()->orderBy('FunkId')->all(), 'inhalt', 'inhalt' )),['style'=>'']);
        $sifus = array_merge(["" => ""], ArrayHelper::map( Sifu::find()->orderBy('sId')->all(), 'SifuName', 'SifuName' ));
        $disziplinen = array_merge(["" => ""], ArrayHelper::map( Disziplinen::find()->orderBy('sort')->all(), 'DispName', 'DispName' ));
  	
				// Sektionen
				$squery = Mitgliedersektionen::find();
				$squery->andWhere(['=', 'mitglied_id', $mgId]);
				$msdataProvider = new ActiveDataProvider([
			    'query' => $squery,
     			'sort'=> ['defaultOrder' => ['vdatum' => SORT_ASC],],
          'pagination' => false,
				]);
  	
  	    // Verträge
				$vquery = Mitgliederschulen::find();
				$vquery->andWhere(['=', 'MitgliederId', $mgId]);
				//Yii::info('-----$vquery: '.VarDumper::dumpAsString($vquery));
				$vdataProvider = new ActiveDataProvider([
			    'query' => $vquery,
     			'sort'=> ['defaultOrder' => ['Von' => SORT_ASC]]
				]);
				// Yii::info('-----$vdataProvider: '.VarDumper::dumpAsString($vdataProvider));

//          Yii::warning('errors '.Vardumper::dumpAsString($model->errors));
            return $this->render('/mitglieder/view', [
                'model' => $mgModel, 'tabnum' => 3, 'openv' => $openv,
                'grade' => $mgdataProvider, 'sektionen' => $msdataProvider, 
								'contracts' => $vdataProvider, 'grade_zur_auswahl' => $grade_zur_auswahl,
								'sektionen_zur_auswahl' => $sektionen_zur_auswahl,
								'pruefer_zur_auswahl' => $pruefer_zur_auswahl, 'errors' => $model->errors, 'formedit' => false,
                'schulen' => $schulen, 'anreden' => $anreden, 'functions' => $functions, 'sifus' => $sifus, 'disziplinen' => $disziplinen,
            ]);
         }
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
              $model->Kontoinhaber = $model->mitglieder->Name.', '.$model->mitglieder->Vorname;
            }
            if ($model->save()) {
    	        $mitglied = $model->mitglieder;
    	        date_default_timezone_set('Europe/Berlin');
    	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
  //              if (empty($mitglied->mandatDatum) and !empty($model->VDatum)) {
//                $mitglied->mandatDatum = $model->VDatum;
//              }
      				  
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
    
    public function actionUpload($id = 0, $tabnum = 0)
    {
//        Yii::warning("-----actionUpload".$model);
        $id = $_POST['id'];
        $tabnum = $_POST['tabnum'];
        $model = $this->findModel($_POST['modelId']);
//        $model = \frontend\models\Mitgliederschulen::findOne($_POST['expandRowKey']);
        Yii::warning("-----model: ".VarDumper::dumpAsString($model));
        if (empty($_FILES[$id])) {
            $output = json_encode(['error'=>'No files found for upload.']); 
            return $output; // terminate
        }				
        
        $fileData = $_FILES[$id];
//        Yii::warning("-----Name: ".$fileData['tmp_name']);
				//$d = sys_get_temp_dir();
        //Yii::warning("-----dir: ".$d);
				//move_uploaded_file($fileData['tmp_name'], 'd:\wamp\tmp\test.pdf');
        		
				//$image = UploadedFile::getInstanceByName($fileData['tmp_name']);
				$file_blob = file_get_contents($fileData['tmp_name']);
        if (!$file_blob) {
            $output = json_encode(['error'=>'Datei nicht gefunden.']); 
            return $output; // terminate
        }
				if (!empty($file_blob)) {
	        if (!empty($model->VertragId)) {
            $vertrag = \frontend\models\Vertrag::findOne($model->VertragId);
	        	//$vertrag = $model->vertrag;
//            Yii::warning("-----Vertrag: ".$vertrag->VertragId);
					} else {
						$vertrag = new Vertrag();
				 	}
				  $vertrag->pdf = $file_blob;
				  $vertrag->name = $fileData['name'];
				  $vertrag->typ = $fileData['type'];
          if (!$vertrag->validate()) {
            $output = json_encode(['error'=>'Vertrag nicht validiert.']); 
            return $output; // terminate
          }
				  if ($vertrag->save()) {
            Yii::warning("-----vertrag gesichert");
            //Yii::warning($vertrag->pdf);
						$model->VertragId = $vertrag->VertragId;
            if (!$model->Validate()) {
                Yii::warning("-----model nicht validiert");
                $output = json_encode(['error'=>'Konnte MitgliederSchulen nicht validieren.']); 
                // or you can throw an exception 
                return $output; // terminate
            }	else {
                Yii::warning("-----model validiert");
                $output = json_encode(['success' => 'Mitgliederschule validiert']);
//                return $output;
            }                   
					
            if (!$model->save()) {
                Yii::warning("-----model nicht gesichert");
                $output = json_encode(['error'=>'Konnte MitgliederSchulen nicht speichern.']); 
                // or you can throw an exception 
                return $output; // terminate
            } else {
                Yii::warning("-----model gesichert");
                $output = json_encode(['success' => 'Mitgliederschule gesichert']);
                return $output;
            }                   
					}	else {
            Yii::warning("-----vertrag nicht gesichert");
            $model->addError('Vertrag konnte nicht gesichert werden!');
            $output = json_encode(['error' => 'Vertrag konnte nicht gesichert werden!']);
            return $output;
          }
				}
        
        $output = json_encode(['success' => 'Datei hochgeladen']);
				return $output;
//				return $this->renderPartial('/mitglieder/_vertrag-detail', ['model'=>$model]);
 //        if (isset($_POST['expandRowKey'])) {
    }

    public function actionVertrag($id,$tabnum)
    {
        $model = $this->findModel($id);
//        $model = \frontend\models\Mitgliederschulen::findOne($_POST['expandRowKey']);
        
				$image =  $model->vertrag->pdf;
				$typ = $model->vertrag->typ;
/**				
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
