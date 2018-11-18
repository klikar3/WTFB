<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Mitgliederschulen;
use frontend\models\MitgliedergradePrint;
use frontend\models\MitgliedergradeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
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
                        'actions' => ['index','view','create','update','delete','createfast','print','viewfrommitglied'],
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
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//	        	$model = $this->findModel($id);
	        $mitglied = $model->Mitglied;
	        Vardumper::dump($mitglied) ;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
	        return $this->redirect(['/mitgliedergrade/view', 
	            'id' => $id,
	        ]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }

/*        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->mgID]);
        return $this->redirect(['/mitglieder/view', 'id' => $model->MitgliedId]);
*/    }

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
	        $mitglied = $model->mitglied;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
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
        $modelp->print = false;
//				Yii::Error( 'test');
        if ($modelp->load(Yii::$app->request->post())) {
        		$model = new Mitgliedergrade();
        		$model->MitgliedId =$modelp->MitgliedId;
        		$model->GradId = $modelp->GradId;
        		$model->Datum = $modelp->Datum;
        		$model->PrueferId = $modelp->PrueferId;
//        		Yii::info("-----model: ".Vardumper::dumpAsString($model));
//        		Yii::info("-----modelp: ".Vardumper::dumpAsString($modelp));
        		if (!$model->save()){
//		        			return $this->redirect(['/mitgliedergrade/createfast', 'mId' => $mId, 'grad' => $grad]);
								$modelp->addErrors ($model->errors);
		            return $this->render('create', [
		                'model' => $modelp, 'ddataProvider' => $ddataProvider, 'gdataProvider' => $gdataProvider,  
		            ]);
						}
        		$mgID = Yii::$app->db->getLastInsertID();
		        $mitglied = $model->mitglied;
		        date_default_timezone_set('Europe/Berlin');
		        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
				  	if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
		        $mitglied->save();
        		
        		$modelm = Mitglieder::find($mId)->one();
        		if ($modelm) {
//  				Yii::info("-----modelm: ".Vardumper::dumpAsString($modelm));
		        		$modelm->PruefungZum = 0;
		        		$modelm->save();
        		}
        		if ($modelp->print) {
								return $this->redirect(['/mitgliedergrade/print', 'id' => $mgID]);
						}
            return $this->redirect(['mitglieder/view', 'id' => $model->MitgliedId, 'tabnum' => 5, ]);
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
	        $mitglied = $model->mitglied;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
        return $this->redirect(['/mitglieder/view', 'id' => $model->MitgliedId, 'tabnum' => 5]);
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
        return $this->redirect(['/mitglieder/view', 'id' => $mgid, 'tabnum' => 5]);
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
        $model = $this->findModel($id);
        $txtcode = $model->grad->textcode;
        $dispName = $model->grad->DispName;
        $Schule = MitgliederSchulen::find()->joinWith('schul')->joinWith('schul.disziplinen')->andWhere(['MitgliederID' => $model->MitgliedId,'DispName' => $dispName])->one();
        $url = Url::toRoute(['texte/print', 
																					'datamodel' => 'grad', 
																					'dataid' => $id, 
													 								'SchulId' => $Schule->SchulId, 
																					 'txtcode' => $txtcode, 
																					 'txtid' => 0,
																					 ],[
                                           'target' => '_blank',
                                           ]);
        return $this->redirect($url);
			
     }

    public function actionViewfrommitglied($id)
    {
        $model = $this->findModel($id);
//        if (($mgModel = Mitglieder::findOne($model->MitgliederId)) == null) {
//              throw new NotFoundHttpException('The requested page does not exist.');
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	        $mitglied = $model->mitglied;
	        date_default_timezone_set('Europe/Berlin');
	        $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
				  if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
	        $mitglied->save();
        	return $this->redirect(['/mitglieder/view', 
            'id' => $model->MitgliedId, 'tabnum' => 5
        ]);
        } else {
        	return $this->redirect(['/mitglieder/view', 
            'id' => $model->MitgliedId, 'tabnum' => 5
//            return $this->render('/mitglieder/view', [
//                'model' => $mgModel,
            ]);
        }
    }    

}
