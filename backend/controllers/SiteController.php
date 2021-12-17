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
                        'actions' => ['login', 'error'],
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
        $model = new Anwesenheitsliste();

        $mitglieder = Mitglieder::find()->joinWith('mitgliederschulens')->select('concat_ws(".",`Name`,`Vorname`) as content, mitglieder.MitgliederId')->where('mitgliederschulen.Von <= :jetzt and mitgliederschulen.Bis >= :jetzt',['jetzt' => \DateTime::createFromFormat('d.m.Y', date('d.m.Y'))->format('Y-m-d')])->asArray()->all();
        Yii::warning(VarDumper::dumpAsString($mitglieder),'application');

        return $this->render('index', [
                'model' => $model,
                'mitglieder' => $mitglieder,
            ]);
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
}
