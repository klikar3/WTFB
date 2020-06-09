<?php

namespace frontend\controllers;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use IBAN\Validation\IBANValidator;
use IBAN\Generation\IBANGenerator;
use IBAN\Generation\IBANGeneratorDE;
use IBAN\Rule\RuleFactory;

use frontend\models\Intensiv;
use frontend\models\Mitglieder;
use frontend\models\Mitgliederschulen;
use frontend\models\MitgliederIntensivSearch;
use frontend\models\MitgliederSearch;
use frontend\models\Mitgliedergrade;
use frontend\models\Grade;
use frontend\models\Mitgliedersektionen;
use frontend\models\MitgliedersektionenSearch;
use frontend\models\Pruefer;
use frontend\models\Sektionen;

/**
 * MitgliederController implements the CRUD actions for Mitglieder model.
 */
class MitgliederController extends Controller
{
    public $percent;
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','mark','check','runcheck', 'swm','intensiv-index','createfromemail'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
						        [
						            'actions' => ['delete-admin','restore'],
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
     * Lists all Mitglieder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MitgliederSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tabnum' => 1,
        ]);
    }

    public function actionIntensivIndex()
    {
        $searchModel = new MitgliederIntensivSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     		$dataProvider->sort = ['defaultOrder' => ['LetztAendSifu' => SORT_DESC],];


        return $this->render('indexIntensiv', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tabnum' => 1,
        ]);
    }

    /**
     * Displays a single Mitglieder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$tabnum, $openv = 0, $iId = 0)
    {
        $model = $this->findModel($id);
        
        if (empty($tabnum)) $tabnum = 1;

				// Graduierungen
				$query = Mitgliedergrade::find();
				$query->andWhere(['=', 'MitgliedId', $id]);
				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC],],
          'pagination' => false,
				]);
				
				$grade_zur_auswahl = array_merge(["0" => ""], ArrayHelper::map( Grade::find()->all(), 'gradId', 'gKurz', 'DispName' ));
				$sektionen_zur_auswahl = ArrayHelper::map( Sektionen::find()->orderBy('sekt_id')->all(), 'sekt_id', 'name' );
  	    $pruefer_zur_auswahl = ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' );
  	
				// Sektionen
				$squery = Mitgliedersektionen::find();
				$squery->andWhere(['=', 'mitglied_id', $id]);
				$msdataProvider = new ActiveDataProvider([
			    'query' => $squery,
     			'sort'=> ['defaultOrder' => ['vdatum' => SORT_ASC],],
          'pagination' => false,
				]);
  	
  	    // Verträge
				$vquery = Mitgliederschulen::find();
				$vquery->andWhere(['=', 'MitgliederId', $id]);
				//Yii::info('-----$vquery: '.VarDumper::dumpAsString($vquery));
				$vdataProvider = new ActiveDataProvider([
			    'query' => $vquery,
     			'sort'=> ['defaultOrder' => ['Von' => SORT_ASC]]
				]);
				// Yii::info('-----$vdataProvider: '.VarDumper::dumpAsString($vdataProvider));
  	
        if ($iId != 0) {
            $intensiv = $this->getIntensiv($model->MitgliederId);
            if ($intensiv->load(Yii::$app->request->post())) { 
                      $intensiv->save();
          		        $mitglied = $model;
          		        date_default_timezone_set('Europe/Berlin');
          		        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
          				  	if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
          		        $mitglied->save();
//								Yii::warning('-----save $intensiv: '.VarDumper::dumpAsString($intensiv->errors));
            }           
        } else {
            if ($model->Schulort == 'WT-Intensiv') $intensiv = $this->getIntensiv($model->MitgliederId);
        }

        if ($model->load(Yii::$app->request->post())) {
//                Yii::warning('----- reqPost: ' . VarDumper::dumpAsString(Yii::$app->request->post()));
				        if (!empty($model->KontoNr) and !empty($model->BLZ)) {
				        	$model->IBAN = IBANGenerator::DE($model->BLZ,$model->KontoNr); 
//				        Yii::info('----- $KontoNr: '.VarDumper::dumpAsString($model->KontoNr));
//				        Yii::info('----- $BLZ: '.VarDumper::dumpAsString($model->BLZ));
//				        Yii::info('-----$generatedIban: '.VarDumper::dumpAsString($model->IBAN));
								$model->validate();      
								$errors = $model->errors;
//		        		Yii::trace($errors);
								}
//                if (empty($mitglied->mandatNr) and !empty($model->MitgliedsNr)) {
//                  $mitglied->mandatNr = $model->MitgliedsNr;
//                }
                
                  if ($model->Schulort == 'WT-Intensiv') {
                      $intensiv = $this->getIntensiv($model->MitgliederId);
                      if ($intensiv->load(Yii::$app->request->post())) { 
                          $intensiv->save();
//                                    Yii::warning('-----save $intensiv: '.VarDumper::dumpAsString($Intensiv->errors));
                      } 
                  }
								if ($model->save() and empty($model->errors)) {
            			return $this->redirect(['view', 'id' => $model->MitgliederId, 
																					'grade' => $mgdataProvider, 
																					'sektionen' => $msdataProvider, 
																					'contracts' => $vdataProvider, 
																					'tabnum' => $tabnum, 
																					'openv' => $openv,
																					'grade_zur_auswahl' => $grade_zur_auswahl,
																					'sektionen_zur_auswahl' => $sektionen_zur_auswahl,
																					'pruefer_zur_auswahl' => $pruefer_zur_auswahl,
																					]);
        				} else {
								$errors = $model->errors;
//								Yii::info('-----$save model: '.VarDumper::dumpAsString($errors));
		           	return $this->render('view', [
		                'model' => $model, 'errors' => $errors, 
										'grade' => $mgdataProvider, 'sektionen' => $msdataProvider, 
										'contracts' => $vdataProvider, 'tabnum' => $tabnum, 
										'openv' => $openv, 'grade_zur_auswahl' => $grade_zur_auswahl,
										'sektionen_zur_auswahl' => $sektionen_zur_auswahl,
										'pruefer_zur_auswahl' => $pruefer_zur_auswahl,
		            ]);
		        }
				} else {
						$errors = $model->errors;
//						Yii::info('-----$load model: '.VarDumper::dumpAsString($errors));
            return $this->render('view', [
                'model' => $model, 'errors' => $errors, 
								'grade' => $mgdataProvider, 'sektionen' => $msdataProvider, 
								'contracts' => $vdataProvider, 'tabnum' => $tabnum, 
								'openv' => $openv, 'grade_zur_auswahl' => $grade_zur_auswahl,
								'pruefer_zur_auswahl' => $pruefer_zur_auswahl,
								'sektionen_zur_auswahl' => $sektionen_zur_auswahl,
            ]);
        }

/*        return $this->render('view', [
            'model' => $this->findModel($id),
            'grade' => $mgdataProvider,
        ]);
*/        
    }

    /**
     * Creates a new Mitglieder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		    $model = new Mitglieder();

				// Graduierungen
				$query = Mitgliedergrade::find();
				$query->where(['=', 'mgID', '-1']);
				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC]]
				]);
  	
  	    // Verträge
				$vquery = Mitgliederschulen::find();
				$vquery->where(['=', 'msID', '-1']);
				$vdataProvider = new ActiveDataProvider([
			    'query' => $vquery,
     			'sort'=> ['defaultOrder' => ['Von' => SORT_ASC]]
				]);
				
        if ($model->load(Yii::$app->request->post()) ) {
//        		Yii::info("----------------if model-load: ".Vardumper::dumpAsString($model));
						$model->Kontoinhaber = $model->Name.', '.$model->Vorname; 
						$model->validate();      
						$errors = $model->errors;
        		Yii::trace($errors);
            if (empty($mitglied->mandatNr) and !empty($model->MitgliedsNr)) {
              $mitglied->mandatNr = $model->MitgliedsNr;
            }
        		if ($model->save()){
//            		Yii::info("----------------model saved: ".Vardumper::dumpAsString($model));
                if ($model->Schulort == 'WT-Intensiv') {
                  $intensiv = $this->getIntensiv($model->MitgliederId);
                  $intensiv->kontaktNachricht = $model->kontaktNachricht1;
                  $intensiv->KontaktAm = $model->KontaktAm;
                  $intensiv->save(); 
                }        
        				return $this->redirect(['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1]);
            }
        } //else {
						$errors = $model->errors;
        		Yii::trace($errors);
						$datum = date('Y-m-d');
		        $model->Geschlecht = 'männlich';
		        $model->Anrede = 'Lieber';
		        $model->Funktion = 'Schüler/in';
		        $model->AktivPassiv = "Aktiv";
		        $model->BeitrittDatum = $datum;
		        $model->MitgliedsNr = Yii::$app->db->createCommand('SELECT MAX(MitgliedsNr) FROM mitglieder')->queryScalar() + 1;
		        $model->MitgliederId = Yii::$app->db->createCommand('SELECT MAX(MitgliederId) FROM mitglieder')->queryScalar() + 1;
//            if ((empty($mitglied->mandatNr)) and (!empty($model->MitgliedsNr))) {
//              $mitglied->mandatNr = $model->MitgliedsNr;
//            }
		//        $grade = new Grade();
//        		Yii::info("----------------else model not loaded: ".Vardumper::dumpAsString($model));       
            return $this->render('create', [
                'model' => $model, 'errors' => $errors, 'grade' => $mgdataProvider, 'contracts' => $vdataProvider, 'mcf' => $model
            ]);
//        }
    }
    public function actionCreatefromemail()
    {
		    $model = new Mitglieder();
        $mcef = new \yii\base\DynamicModel([
                    'emailInhalt', 'Funktion', 'Schulort', 'MitgliederId', 'KontaktAm'
                ]);                             
        $mcef->addRule(['emailInhalt', 'Schulort', 'Funktion', 'MitgliederId'], 'required')
            ->addRule(['emailInhalt'], 'string',['max'=>999])
            ->addRule('Funktion', 'string',['max'=>32])
            ->addRule('Schulort', 'string',['max'=>32])
            ->addRule('KontaktAm' ,'date', ['format' => 'php:Y-m-d'])
            ->addRule('MitgliederId', 'integer');

				// Graduierungen
				$query = Mitgliedergrade::find();
				$query->where(['=', 'mgID', '-1']);
				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC]]
				]);
  	
  	    // Verträge
				$vquery = Mitgliederschulen::find();
				$vquery->where(['=', 'msID', '-1']);
				$vdataProvider = new ActiveDataProvider([
			    'query' => $vquery,
     			'sort'=> ['defaultOrder' => ['Von' => SORT_ASC]]
				]);
				
        if ($mcef->load(Yii::$app->request->post()) ) {
//        		Yii::warning("----------------mcef: ".Vardumper::dumpAsString($mcef));
            $val = array_map('trim', explode("\n", $mcef->emailInhalt));
        		Yii::warning("----------------mcef: ".Vardumper::dumpAsString($val));
            foreach($val as $v){
              if (strpos($v, 'Anrede: ') !== false ) {$model->Geschlecht = (str_replace('Anrede: ',"",$v)=='Herr') ? 'männlich' : 'weiblich' ;}
              else if (strpos($v, 'Vorname: ') !== false ) {$model->Vorname = str_replace('Vorname: ',"",$v) ;}
              else if (strpos($v, 'Name: ') !== false ) {$model->Name = str_replace('Name: ',"",$v) ;}
              else if (strpos($v, 'Nachname: ') !== false ) {$model->Name = str_replace('Nachname: ',"",$v) ;}
              else if (strpos($v, 'Email: ') !== false ) {$model->Email = str_replace('Email: ',"",$v) ;}
              else if (strpos($v, 'E-Mail: ') !== false ) {$model->Email = str_replace('E-Mail: ',"",$v) ;}
              else if (strpos($v, 'Telefon: ') !== false ) {$model->Telefon1 = str_replace('Telefon: ',"",$v) ;}
              else if (strpos($v, 'Nachricht: ') !== false ) {$model->kontaktNachricht1 = str_replace('Nachricht: ',"",$v) ;}
              else  $model->kontaktNachricht1 = $model->kontaktNachricht1 . "\n" . $v;
             }
            $model->Schulort = $mcef->Schulort;
            $model->Funktion = $mcef->Funktion;
            $model->MitgliederId = $mcef->MitgliederId;
						$model->Kontoinhaber = $model->Name.', '.$model->Vorname;
            $model->KontaktAm = $mcef->KontaktAm; 
						$model->validate();      
						$errors = $model->errors;
        		Yii::trace($errors);
            if (empty($mitglied->mandatNr) and !empty($model->MitgliedsNr)) {
              $mitglied->mandatNr = $model->MitgliedsNr;
            }
						$errors = $model->errors;
        		Yii::trace($errors);
						$datum = date('Y-m-d');
		        ;
		        $model->Anrede = ($model->Geschlecht == 'männlich') ? 'Lieber' : 'Liebe';
		        $model->AktivPassiv = "Aktiv";
//        		Yii::info("----------------else model not loaded: ".Vardumper::dumpAsString($model));       
            return $this->render('create', [
                'model' => $model, 'errors' => $errors, 'grade' => $mgdataProvider, 'contracts' => $vdataProvider, 'mcf' => $model
            ]);
        }
    }
    /**
     * Updates an existing Mitglieder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $tabnum)  
    {
				$query = Mitgliedergrade::find();
				$query->where(['=', 'MitgliedId', $id]);

				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC]]
				]);
        $model = $this->findModel($id);
        
        if (empty($tabnum)) $tabnum = 1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->Schulort == 'WT-Intensiv') $intensiv = getIntensiv($model->MitgliederId);       
            return $this->redirect(['view', 'id' => $model->MitgliederId, 'tabnum' => $tabnum]);
        } else {
						$errors = $model->errors;
						VarDumper::dump($errors);
            return $this->render('update', [
                'model' => $model, 'grade' => $mgdataProvider, 'tabnum' => $tabnum,
            ]);
        }
    }

    /**
     * Deletes an existing Mitglieder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteAdmin($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/mitglieder/index']);
    }

    /**
     * Deletes an existing Mitglieder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->RecDeleted = 1;
        if ($model->save()) {
          Yii::info("----- RecDeleted 1 gespeichert");
        } else {
          $errors = $model->errors;
          Yii::warning("----- RecDeleted 1 konnte nicht gespeichert werden!".Vardumper::dumpAsString($errors));
        }  

        return $this->redirect(['mitgliederliste/index']);
    }

    /**
     * Deletes an existing Mitglieder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->RecDeleted = 0;
        $model->save();

        return $this->redirect(['mitglieder/index']);
    }

    public function actionSwm($id)
    {
        $url = 'http://nl.wtfb.de/nl.php?' . http_build_query ( [ 'param' => 12 ] );
        $script = <<<JS
                function openInNewTab(url) {
                  var win = window.open(url, '_blank');
                  win.focus();
                }
                 openInNewTab('$url');
JS;
    
        $this->getView()->registerJs( $script , \yii\web\View::POS_READY );
        return $this->render ( 'Swm' );
//        return $this->redirect(['http://swm.wingtzun.de/nl.php'],307);
    }

    /**
     * Markiert ein Mitglied für die nächste Prüfung.
     * @return mixed
     */
    public function actionMark($id)
    {
				$query = Mitgliedergrade::find();
				$query->where(['=', 'MitgliedId', $id]);

				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC]]
				]);
				
        $model = $this->findModel($id);
        $lastGrad = '';
        $dat = date('r');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['mitgliederliste/index', 'id' => $model->MitgliederId]);
        } else {
						$errors = $model->errors;
						//VarDumper::dump($errors);
						//VarDumper::dump($errors);
						//VarDumper::dump($errors);
						//VarDumper::dump($errors);
						
						$mgrad = Mitgliedergrade::find()->andWhere(['MitgliedId' => $model->MitgliederId])->orderBy('datum desc')->one();//->max('Datum');
//						VarDumper::dump($mgrad);
						if (!empty($mgrad)) {
							$dat = $mgrad->Datum;
							$grad = Grade::find()->andWhere(['gradId' => $mgrad->GradId])->one();
							if (!empty($mgrad)) {
								$lastGrad = $grad->gKurz . ' ' . $grad->DispName;
		        		Yii::trace($lastGrad);
	        		}
        		}
//        		VarDumper::dump($model);
            return $this->render('mark', [
                'model' => $model, 'errors' => $errors, 'lastGrad' => $lastGrad, 'dat' => $dat, 'grade' => $mgdataProvider,
            ]);
        }                                                                        
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
        if (($model = Mitglieder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionCheck()
    {
        $session = Yii::$app->session;
        $session->set('checkPercent', 0);
//        Yii::$app->response->headers->set('Content-Type', 'text/event-stream');
//        Yii::$app->response->format = Response::FORMAT_JSON;
//        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
//        header('Cache-Control: no-cache'); 
//        ob_start();
          return $this->render('check', [
                'percent' => 0,
                'result' => '-' 
            ]);
//        $this->actionRuncheck();    
    }
    
    public function actionRuncheck()
    {
        set_time_limit(300);
        $session = Yii::$app->session;
        $session->set('checkPercent', 0);
        
//        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
//        header('Cache-Control: no-cache'); 
        $connection = Yii::$app->db;
        $dbSchema = $connection->schema;
        //or $connection->getSchema();
        $tables = $dbSchema->tableNames;//returns array of tbl schema's
//        ob_start();
        foreach($tables as $tbl)
        {
//            echo $tbl, ':<br/>';
        }
        
        $max = Mitglieder::find()->count();
        $i = $percent = 0;
        
        $this->send_message(0, 'start 0 of ' . $max , 10);
        
        $errors[] = 'Gefundene Fehler: ';
        foreach (Mitglieder::find()->each(10) as $model) {
            $i += 1;
            if (($i < 50) && !$model->validate()) {
              //Yii::$app->session->setFlash('success', "Mitglied {$model->MitgliederId}, {$model->Name}, {$model->Vorname}");
              $errors[] = 'Mitglied '.$model->MitgliederId.', '.$model->Name.', '.$model->Vorname.' validiert nicht!'.json_encode($model->errors).'<br>';
            }
            $percent = ($i * 100) / $max;
            $session->set('checkPercent', $percent);
//            if ($i %10 == 0) $this->send_message($i, 'on iteration ' . $i . ' of ' . $max , $percent);
//            if ($i %10 == 0) $this->renderAjax('progBar', ['percent' => $percent,]);
        }
//         VarDumper::dump($errors);
        Yii::warning("----- Validation Errors:".Vardumper::dumpAsString($errors));
//        $this->send_message($i, 'on iteration ' . $i . ' of ' . $max ,100);
        //return //ob_get_clean();
          return $this->render('check', [
                'percent' => 100,
                'result' => Vardumper::dumpAsString($errors) 
            ]);
//        $this->actionRuncheck();    
//        return '<html><body>'.Vardumper::dumpAsString($errors).'</body></html>';
    }
    
    public function actionDisplay($percent) {
        if (Yii::$app->request->isAjax) {
//            sleep(1);
            if (true) {
                $res = array(
                    'success' => true,
                    'nextLabel' => Yii::t('app', 'Action two ...'),
                    'nextUrl' => Url::to(['two'])
                );
            } else {
                $res = array(
                    'success' => false,
                    'errorMsg' => Yii::t('text', 'An error occurred while processing.'),
                );
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return $res;
        }
    }
    
    private function send_message($id, $message, $progress) {
        $d = array('message' => $message , 'progress' => $progress);
          Yii::warning("----- ProgBar Percent:".Vardumper::dumpAsString($progress));
          
//        echo "id: $id" . PHP_EOL;
//        echo "data: " . json_encode($d) . PHP_EOL;
//        echo PHP_EOL;
          
//        ob_flush();
//        flush();
        return $this->renderPartial('progbar',['percent' => $progress], false, true);
//        Yii::$app->end();
    }
    
    public function actionPercentage($id) {
    if (Yii::app()->request->isAjaxRequest) {
           $item = Mitglieder::model()->findByPk($id); //obtain instance of object containing your function
           echo $item->getBuildPercentage(); //to return value in ajax, simply echo it   
        }
    }


    public function getBuildPercentage() {
        $session = Yii::$app->session;
        $progress = $session->get('checkPercent');
      Yii::warning("----- getBuildPercentage Percent:".Vardumper::dumpAsString($progress));
        return $progress; 
    }

    private function getIntensiv($mId) {
        if (($intensiv = Intensiv::findOne(['mitgliederId' => $mId])) !== null) {
//      Yii::warning("----- getIntensiv $intensiv:".Vardumper::dumpAsString($intensiv));
            return $intensiv;
        } else {
            $intensiv = new Intensiv();
            $intensiv->mitgliederId = $mId;
            $intensiv->save();
//      Yii::warning("-----2 getIntensiv $intensiv:".Vardumper::dump($intensiv));
            return $intensiv;
        }
   
    }
}
