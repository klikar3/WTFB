<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Mitgliederschulen;
use frontend\models\MitgliederschulenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
                        'actions' => ['index','view','create','update','delete','createfast','deletefast','viewfrommitglied'],
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
        return $this->redirect(['/mitgliederschulen/view', 
            'id' => $id,
        ]);
        } else {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
    }    

    public function actionViewfrommitglied($id)
    {
        $model = $this->findModel($id);
//        if (($mgModel = Mitglieder::findOne($model->MitgliederId)) == null) {
//              throw new NotFoundHttpException('The requested page does not exist.');
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	return $this->redirect(['/mitglieder/view', 
            'id' => $model->MitgliederId, 'tabnum' => 3
        ]);
        } else {
        	return $this->redirect(['/mitglieder/view', 
            'id' => $model->MitgliederId, 'tabnum' => 3
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/mitglieder/view', 'id' => $model->MitgliederId]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletefast($id)
    {
    		$mid = $this->findModel($id)->MitgliederId;
        $this->findModel($id)->delete();

        return $this->redirect(['/mitglieder/view', 'id' => $mid]);
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
            return $this->renderPartial('_vertrag-details', ['model'=>$model]);
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }    
    
}
