<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Mitglieder;
use frontend\models\MitgliederSearch;
use frontend\models\Mitgliedergrade;
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
                        'actions' => ['index','view','create','update','delete'],
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
        ]);
    }

    /**
     * Displays a single Mitglieder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
				$query = Mitgliedergrade::find();
				$query->where(['=', 'MitgliedId', $id]);

				$mgdataProvider = new ActiveDataProvider([
			    'query' => $query,
     			'sort'=> ['defaultOrder' => ['Datum' => SORT_ASC]]
				]);
//s				$mgdataProvider->sort->defaultOrder = ['grad.GradTyp' => SORT_ASC];
  	
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
		    $model = new Mitglieder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->MitgliederId]);
        } else {
						$errors = $model->errors;
        		Yii::trace($errors);
						$datum = date('Y-m-d');
		        $model->Geschlecht = 'männlich';
		        $model->Anrede = 'Lieber';
		//        $model->Disziplin = 1;
		        $model->Funktion = 'Schüler';
		        $model->AktivPassiv = "Aktiv";
		        $model->BeitrittDatum = $datum;
		        $model->MitgliedsNr = Mitglieder::find()->max('MitgliedsNr') + 1;
		        $model->MitgliederId = Mitglieder::find()->max('MitgliederId') + 1;
		//        $grade = new Grade();
        		Yii::info($model);
            return $this->render('create', [
                'model' => $model, 'errors' => $errors,
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
        if (($model = Mitglieder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
