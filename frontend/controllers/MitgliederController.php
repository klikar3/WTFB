<?php

namespace frontend\controllers;

use Yii;
use yii\db\Query;
use yii\helpers\VarDumper;
use frontend\models\Mitglieder;
use frontend\models\Mitgliederschulen;
use frontend\models\MitgliederSearch;
use frontend\models\Mitgliedergrade;
use frontend\models\Grade;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * MitgliederController implements the CRUD actions for Mitglieder model.
 */
class MitgliederController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','mark'],
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
        $searchModel = new MitgliederSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
    public function actionView($id,$tabnum, $openv = 0)
    {
        $model = $this->findModel($id);
        
        if (empty($tabnum)) $tabnum = 1;

				// Graduierungen
				$query = Mitgliedergrade::find();
				$query->andWhere(['=', 'MitgliedId', $id]);
				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC]]
				]);
  	
  	    // Verträge
				$vquery = Mitgliederschulen::find();
				$vquery->andWhere(['=', 'MitgliederId', $id]);
				Yii::info('-----$vquery: '.VarDumper::dumpAsString($vquery));
				$vdataProvider = new ActiveDataProvider([
			    'query' => $vquery,
     			'sort'=> ['defaultOrder' => ['Von' => SORT_ASC]]
				]);
				// Yii::info('-----$vdataProvider: '.VarDumper::dumpAsString($vdataProvider));
  	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->MitgliederId, 'tabnum' => $tabnum, 'openv' => $openv]);
        } else {
						$errors = $model->errors;
						VarDumper::dump($errors);
						VarDumper::dump($errors);
						VarDumper::dump($errors);
						VarDumper::dump($errors);
            return $this->render('view', [
                'model' => $model, 'grade' => $mgdataProvider, 'contracts' => $vdataProvider, 'tabnum' => $tabnum, 'openv' => $openv
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
        		Yii::info("----------------if model-load: ".Vardumper::dumpAsString($model));
						$model->Kontoinhaber = $model->Name.', '.$model->Vorname; 
						$model->validate();      
						$errors = $model->errors;
        		Yii::trace($errors);
        		if ($model->save()){
            		Yii::info("----------------model saved: ".Vardumper::dumpAsString($model));       
        				return $this->redirect(['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1]);
            }
        } //else {
						$errors = $model->errors;
        		Yii::trace($errors);
						$datum = date('Y-m-d');
		        $model->Geschlecht = 'männlich';
		        $model->Anrede = 'Lieber';
		//        $model->Disziplin = 1;
		        $model->Funktion = 'Schüler/in';
		        $model->AktivPassiv = "Aktiv";
		        $model->BeitrittDatum = $datum;
		        $model->MitgliedsNr = Yii::$app->db->createCommand('SELECT MAX(MitgliedsNr) FROM mitglieder')->queryScalar() + 1;
		        $model->MitgliederId = Yii::$app->db->createCommand('SELECT MAX(MitgliederId) FROM mitglieder')->queryScalar() + 1;
		//        $grade = new Grade();
        		Yii::info("----------------else model not loaded: ".Vardumper::dumpAsString($model));       
            return $this->render('create', [
                'model' => $model, 'errors' => $errors, 'grade' => $mgdataProvider, 'contracts' => $vdataProvider, 'mcf' => $model
            ]);
//        }
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['mitgliederliste/index']);
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
						VarDumper::dump($errors);
						VarDumper::dump($errors);
						VarDumper::dump($errors);
						VarDumper::dump($errors);
						
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
}
