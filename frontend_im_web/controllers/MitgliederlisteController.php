<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Mitgliederliste;
use frontend\models\MitgliederlisteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                        'actions' => ['index','view',],
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
}
