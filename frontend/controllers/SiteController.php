<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;

use frontend\models\AuswertungenForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

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
                'only' => ['logout', 'signup', 'mitgliederliste'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['mitgliederliste'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
//        return $this->render('index');
					return $this->redirect(['/mitgliederliste/index']);    }

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

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionMitgliederzahlen()
    {
				$model = new AuswertungenForm();
				$model->schule = 10;
//				$model->von = date_create_from_format('d.m.Y', '01.01.2016');
				$model->von = '01.01.2016';
				$model->bis = '31.03.2016';
        VarDumper::dump($model);

        if ($model->load(Yii::$app->request->post() )) {
        } else {
            return $this->render('mitgliederzahlen', [
                'model' => $model,
            ]);
        }
        
        VarDumper::dump($model);
        
        $datasets = (new \yii\db\Query())
            ->select('concat_ws(".",`monat`,`jahr`) as l,jahr, monat, WT-Eintritt, WT-Austritt, WT-Kuendigung, E-Eintritt, E-Austritt, E-Kuendigung')
            ->from('mitgliederzahlen mz')
//            ->join('tbl_profile p', 'u.id=p.user_id')
            ->where('(jahr=:vonjahr and monat >=:vonmonat) or (jahr>:vonjahr and jahr<:bisjahr) or (jahr=:bisjahr and monat <=:bismonat)', 
											array(':vonjahr'=>date_parse_from_format("j.n.Y H:iP", $model->von)['year'],
														':vonmonat'=>date_parse_from_format("j.n.Y H:iP", $model->von)['month'], 
														':bisjahr'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['year'],
														':bismonat'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['month'],))
            ->all();
//				$d = $datasets->toArray(['jahr','monat','WT-Eintritt']);
				$labels = (new \yii\db\Query())
            ->select('concat_ws(".",`monat`,`jahr`) as l')
            ->from('mitgliederzahlen mz')
            ->where('(jahr=:vonjahr and monat >=:vonmonat) or (jahr>:vonjahr and jahr<:bisjahr) or (jahr=:bisjahr and monat <=:bismonat)', 
											array(':vonjahr'=>date_parse_from_format("j.n.Y H:iP", $model->von)['year'],
														':vonmonat'=>date_parse_from_format("j.n.Y H:iP", $model->von)['month'], 
														':bisjahr'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['year'],
														':bismonat'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['month'],))
						->all();
//        Yii::info("-----gt: ".Vardumper::dumpAsString($datasets));
            
        return $this->render('mitgliederzahlen',['model' => $model, 'datasets' => $datasets, 'labels' => $labels]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    
/*    public function actionMitglieder()
    {
        return $this->render('/mitglieder/index');
    }
 */
}
