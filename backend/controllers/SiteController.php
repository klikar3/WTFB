<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use common\models\LoginForm;

use kartik\datecontrol\DateControl;
use kartik\sortable\Sortable;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;

use backend\models\Anwesenheitsliste;
use backend\models\Trainings;
use backend\models\Schulen;
use backend\models\Mitglieder;
use backend\models\Mitgliederschulen;
///use backend\models\

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'trainings', 'datums'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        Yii::warning(Yii::$app->request->post());
//        Yii::warning($_GET);
        $model = new Anwesenheitsliste();
        $schulen = ArrayHelper::map( Schulen::find()->joinWith('disziplin',['eagerLoading' => false])->select('SchulId,concat_ws(" ",`Schulname`,`DispKurz`) as Schule')->all(), 'SchulId', 'Schule' );

        if ($model->load(Yii::$app->request->post() )) {
            $mitglieder = Mitglieder::find()->joinWith('mitgliederschulens',['eagerLoading' => false])->select('concat_ws(" ",`Name`,`Vorname`) as content, mitglieder.MitgliederId')
                                            ->where('mitgliederschulen.Von <= :jetzt and mitgliederschulen.Bis >= :jetzt',['jetzt' => \DateTime::createFromFormat('d.m.Y', date('d.m.Y'))
                                            ->format('Y-m-d') ])
                                            ->andWhere(['mitgliederschulen.SchulId' => $model->schule])
                                            ->asArray()->all();
            Yii::warning(VarDumper::dumpAsString($mitglieder),'application');
            $trainings = ArrayHelper::map( Trainings::find()->select('id, description as name')->where(['schulId' => $model->schule])->asArray()->all(), 'id', 'name' );
            $anwesende = Anwesenheitsliste::find()->joinWith('mitglied0',['eagerLoading' => false])->select('concat_ws(" ",`Name`,`Vorname`) as content, mitglieder.MitgliederId')
                            ->where(['datum' => $model->datum, 'schule' => $model->schule[1], 'training' => $model->training])->asArray()->all();
    
            return $this->render('index', [
                    'model' => $model,
                    'schulen' => $schulen,
                    'mitglieder' => $mitglieder,
                    'trainings' => $trainings,
                    'anwesende' => $anwesende,
                ]);
        } else {
            $mitglieder = Mitglieder::find()->joinWith('mitgliederschulens',['eagerLoading' => false])->select('concat_ws(" ",`Name`,`Vorname`) as content, mitglieder.MitgliederId')
                                            ->where('mitgliederschulen.Von <= :jetzt and mitgliederschulen.Bis >= :jetzt',['jetzt' => \DateTime::createFromFormat('d.m.Y', date('d.m.Y'))
                                            ->format('Y-m-d')])->asArray()->all();
            Yii::warning(VarDumper::dumpAsString($mitglieder),'application');
            $trainings = ['id' => 1, 'name' => ''];
            $anwesende = [];
    
            return $this->render('index', [
                    'model' => $model,
                    'schulen' => $schulen,
                    'mitglieder' => $mitglieder,
                    'trainings' => $trainings,
                    'anwesende' => $anwesende,
                ]);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionDatums() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        Yii::warning($_POST);
//        Yii::warning($_GET);
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                $param2 = null;
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0]; // get the value of input-type-1
                    $param2 = $params[1]; // get the value of input-type-2
                }
     
                $out = self::getDatumList1($cat_id, $param1, $param2); 
                // the getSubCatList1 function will query the database based on the
                // cat_id, param1, param2 and return an array like below:
                // [
                //    'group1' => [
                //        ['id' => '<sub-cat-id-1>', 'name' => '<sub-cat-name1>'],
                //        ['id' => '<sub-cat_id_2>', 'name' => '<sub-cat-name2>']
                //    ],
                //    'group2' => [
                //        ['id' => '<sub-cat-id-3>', 'name' => '<sub-cat-name3>'], 
                //        ['id' => '<sub-cat-id-4>', 'name' => '<sub-cat-name4>']
                //    ]            
                // ]
                
                
                $selected = self::getDefaultDatum($cat_id, $param1);
                // the getDefaultSubCat function will query the database
                // and return the default sub cat for the cat_id
                
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    
    public function actionTrainings() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::warning($_POST);
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $param1 = null;
                $param2 = null;
                if (!empty($_POST['depdrop_all_params'])) {
                    $params = $_POST['depdrop_all_params'];
                    $param1 = $params['schule-id']; // get the value of input-type-1
//                    $param2 = $params[1]; // get the value of input-type-2
                }
     
                $out = self::getTraining1($cat_id, $param1); 
                // the getSubCatList1 function will query the database based on the
                // cat_id, param1, param2 and return an array like below:
                // [
                //    'group1' => [
                //        ['id' => '<sub-cat-id-1>', 'name' => '<sub-cat-name1>'],
                //        ['id' => '<sub-cat_id_2>', 'name' => '<sub-cat-name2>']
                //    ],
                //    'group2' => [
                //        ['id' => '<sub-cat-id-3>', 'name' => '<sub-cat-name3>'], 
                //        ['id' => '<sub-cat-id-4>', 'name' => '<sub-cat-name4>']
                //    ]            
                // ]
                
                
                $selected = self::getDefaultTraining($cat_id, $param1);
                // the getDefaultSubCat function will query the database
                // and return the default sub cat for the cat_id
                
                return ['output' => $out, 'selected' => $selected];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
    
    public function getTraining1($training_id, $param1)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        Yii::warning($training_id);
//        Yii::warning($param1);
        $trainings = Trainings::find()->select('id, description as name')->where(['schulId' => $param1])->asArray()->all();
//        Yii::warning($trainings);
        return $trainings;
    }
    
    public function getDefaultTraining($training_id, $param1)
    {
        return Trainings::find()->select('id, description as name')->where(['schulId' => $param1])->limit(1)->asArray()->all();
    }
    
    public function getDatumList1($training_id, $param1)
    {
        return ArrayHelper::map( Trainings::find()->where(['schulId' => $param1])->all(), 'id', 'description', 'description' );
    }
    
    public function getDefaultDatum($training_id, $param1)
    {
        return Trainings::find()->select('id')->where(['schulId' => $param1])->one();
    }
    
    
    
}
