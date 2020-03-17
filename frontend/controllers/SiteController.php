<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\data\ActiveDataProvider;

use kartik\mpdf\Pdf;

use frontend\models\AuswertungenForm;
use frontend\models\Mitglieder;
use frontend\models\MitgliederSearch;
use frontend\models\Mitgliederschulen;
use frontend\models\MitgliederschulenSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\Schulen;
use frontend\models\SignupForm;
use frontend\models\SwmBlockedEmails;
use frontend\models\Swmreceiver;
use frontend\models\ContactForm;
use frontend\models\Woocustomer;

/**
 * Site controller
 */
class SiteController extends Controller
{
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
                        'actions' => ['mitgliederliste', 'InfoAbendliste'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
						        [
						            'actions' => ['create'],
						            'allow' => true,
						            'roles' => ['admin'],
						        ],
						        [
						            'actions' => ['view', 'search'],
						            'allow' => true,
						            'roles' => ['@', 'admin'],
						        ],
                    [
                        'allow' => false,
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
 
		public function actionSchuelerzahlenauswahl() {
 				$model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        } else {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        }
    }


    public function actionSchuelerzahlen()
    {
				$model = new AuswertungenForm();

        $params = Yii::$app->request->queryParams;
//        Yii::warning('----params beginn: '.VarDumper::dumpAsString($params),'application');

        if (count($params) <= 2) {
          $params = Yii::$app->session['customerparams'];
          if(isset(Yii::$app->session['customerparams']['page']))
            $_GET['page'] = Yii::$app->session['customerparams']['page'];
          } else {
            Yii::$app->session['customerparams'] = $params;
        }

//        $model->load(Yii::$app->request->post());
//        Yii::warning(VarDumper::dumpAsString($model),'application');
        if (!$model->load(Yii::$app->request->post() )) {
//            Yii::warning('----- noload','application');
            $searchModel = new MitgliederschulenSearch();
            $dataProvider = $searchModel->search($params);
//        Yii::warning('----params not load: '.VarDumper::dumpAsString($params),'application');
//        $dataProvider->query->andWhere(['mitgliederschulen.SchulId'=> $model->schule]);
//        $dataProvider->query->andWhere('Von <= :von and ((Bis >= :von) or (Bis is null)) ',  
//											[':von'=> date('Y-m-d'), ]);
            $dataProvider->pagination = false;
            return $this->render('schuelerzahlen', [
//            return $this->redirect(['/site/schuelerzahlenauswahl', 
//                'model' => $model,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,                                               
            ]);
        } else {
            $params['MitgliederschulenSearch'] = ['SchulId' => (is_array($model->schule)) ? implode(', ', $model->schule) : $model->schule,
                                                'groesserVon' => date('Y-m-d'),
                                                'kleinerBis' => date('Y-m-d'), ];
            Yii::$app->session['customerparams'] = $params;
//            Yii::warning('----params load: '.VarDumper::dumpAsString($params),'application');
        }
//        Yii::warning('----params: '.VarDumper::dumpAsString($params),'application');
        
        $searchModel = new MitgliederschulenSearch();
        $dataProvider = $searchModel->search($params);
        $dataProvider->pagination = false;
//        $dataProvider->query->andWhere(['mitgliederschulen.SchulId'=> $model->schule]);
/*         $dataProvider->query->andWhere('Von <= :von and ((Bis >= :von) or (Bis is null)) ',   // and SchulId = :schule
											[':von'=> date('Y-m-d'), ]);
       $query = Mitgliederschulen::find()->joinWith('mgl')
            ->select(['NameLink', 'mitgliederliste.Grad', 'mitgliederliste.Schulname', 'mitgliederliste.Vertrag', 'Von', 'Bis', 'mitgliederschulen.SchulId', 'KuendigungAm', 'mitgliederschulen.MonatsBeitrag', 'mitgliederschulen.MitgliederId'])            
            ->where('Von <= :von and ((Bis >= :von) or (Bis is null)) ',   // and SchulId = :schule
											[':von'=> date('Y-m-d'), //\DateTime::createFromFormat('d.m.Y', $von)->format('Y-m-d'),
//													':schule' => $model->schule
                            ]
                    )
            ->andWhere(['mitgliederschulen.SchulId'=> $model->schule]);
            
//        $sql = $query->createCommand()->getRawSql($query);
//        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['Von' => SORT_DESC],
            		        'attributes' => [
            		            'Von',
            		            'Bis',
            		            'Vertrag',
                            'VDatum',
                            'mgl.Grad',
                            'Name',
            		            'KuendigungAm','MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise',		            
                            'mitgliederliste.Name' => [
            		                'asc' => ['mitgliederliste.Name' => SORT_ASC],
            		                'desc' => ['mitgliederliste.Name' => SORT_DESC],
            		                'label' => 'Name',
            		                'default' => SORT_ASC,
            		            ],  
            		          ],
                       ], 
            'pagination' => false,
        ]);
*/
//           Yii::warning(Vardumper::dumpAsString($dataProvider),'application');
                   
//        $datasets = $query
//						->orderBy('jahr,monat')
//            ->all();
//				$d = $datasets->toArray(['jahr','monat','WT-Eintritt']);
//           Yii::warning(Vardumper::dumpAsString($datasets),'application'); 
        return $this->render('schuelerzahlen',['model' => $model, 
                                                'dataProvider' => $dataProvider,
                                                'searchModel' => $searchModel,
                                                'von' => $model->von,
                                                'bis' => $model->bis, 
                                                'schule' => $model->schule]);
    }


		public function actionDvdlistenauswahl() {
 				$model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        } else {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        }
    }



    public function actionDvdliste( $print = 0)
    {
				$model = new AuswertungenForm();

        $params = Yii::$app->request->queryParams;
//        Yii::warning('----params beginn: '.VarDumper::dumpAsString($params),'application');

        if (count($params) <= 2) {
          $params = Yii::$app->session['customerparams'];
          if(isset(Yii::$app->session['customerparams']['page']))
            $_GET['page'] = Yii::$app->session['customerparams']['page'];
          } else {
            Yii::$app->session['customerparams'] = $params;
        }
            $schule = (is_array($model->schule)) ? implode(', ', $model->schule) : $model->schule; //  $params['schule']; 

//        $model->load(Yii::$app->request->post());
//        Yii::warning(VarDumper::dumpAsString($model),'application');
        if (!$model->load(Yii::$app->request->post() )) {
//            Yii::warning('----- noload','application');
            $searchModel = new MitgliederschulenSearch();
            $dataProvider = $searchModel->search($params);
//        Yii::warning('----params not load: '.VarDumper::dumpAsString($params),'application');
//        $dataProvider->query->andWhere(['mitgliederschulen.SchulId'=> $model->schule]);
//        $dataProvider->query->andWhere('Von <= :von and ((Bis >= :von) or (Bis is null)) ',  
//											[':von'=> date('Y-m-d'), ]);
            $dataProvider->pagination = false;
            return $this->render('dvdliste', [
//            return $this->redirect(['/site/schuelerzahlenauswahl', 
//                'model' => $model,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'schule' => $schule,
                'print' => $print                                               
            ]);
        } else {
            $params['MitgliederschulenSearch'] = ['SchulId' => (is_array($model->schule)) ? implode(', ', $model->schule) : $model->schule,
//                                                'groesserVon' => date('Y-m-d'),
//                                                'kleinerBis' => date('Y-m-d'), 
//                                                'DVDgesendetAm' => '0000-00-00'
                                                ];
            Yii::$app->session['customerparams'] = $params;
//            Yii::warning('----params load: '.VarDumper::dumpAsString($params),'application');
        }
//        Yii::warning('----params: '.VarDumper::dumpAsString($params),'application');
        
        $searchModel = new MitgliederschulenSearch();
        $dataProvider = $searchModel->search($params);
        $dataProvider->pagination = false;
//        $schule = (is_array($model->schule)) ? implode(', ', $model->schule) : $model->schule;
//        Yii::warning('----$schule: '.VarDumper::dumpAsString($schule),'application');

//        $dataProvider->query->andWhere(['mitgliederschulen.SchulId'=> $model->schule]);
/*         $dataProvider->query->andWhere('Von <= :von and ((Bis >= :von) or (Bis is null)) ',   // and SchulId = :schule
											[':von'=> date('Y-m-d'), ]);
       $query = Mitgliederschulen::find()->joinWith('mgl')
            ->select(['NameLink', 'mitgliederliste.Grad', 'mitgliederliste.Schulname', 'mitgliederliste.Vertrag', 'Von', 'Bis', 'mitgliederschulen.SchulId', 'KuendigungAm', 'mitgliederschulen.MonatsBeitrag', 'mitgliederschulen.MitgliederId'])            
            ->where('Von <= :von and ((Bis >= :von) or (Bis is null)) ',   // and SchulId = :schule
											[':von'=> date('Y-m-d'), //\DateTime::createFromFormat('d.m.Y', $von)->format('Y-m-d'),
//													':schule' => $model->schule
                            ]
                    )
            ->andWhere(['mitgliederschulen.SchulId'=> $model->schule]);
            
//        $sql = $query->createCommand()->getRawSql($query);
//        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['Von' => SORT_DESC],
            		        'attributes' => [
            		            'Von',
            		            'Bis',
            		            'Vertrag',
                            'VDatum',
                            'mgl.Grad',
                            'Name',
            		            'KuendigungAm','MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise',		            
                            'mitgliederliste.Name' => [
            		                'asc' => ['mitgliederliste.Name' => SORT_ASC],
            		                'desc' => ['mitgliederliste.Name' => SORT_DESC],
            		                'label' => 'Name',
            		                'default' => SORT_ASC,
            		            ],  
            		          ],
                       ], 
            'pagination' => false,
        ]);
*/
//           Yii::warning(Vardumper::dumpAsString($dataProvider),'application');
                   
//        $datasets = $query
//						->orderBy('jahr,monat')
//            ->all();
//				$d = $datasets->toArray(['jahr','monat','WT-Eintritt']);
//           Yii::warning(Vardumper::dumpAsString($datasets),'application'); 
        return $this->render('dvdliste',['model' => $model, 
                                                'dataProvider' => $dataProvider,
                                                'searchModel' => $searchModel,
//                                                'von' => $model->von,
//                                                'bis' => $model->bis, 
                                                'schule' => $schule,
                                                'print' => $print]);
    }


    public function actionAnwesenheit()
    {
				$model = new AuswertungenForm();
				$model->schule = 10;
//				$model->von = date('d.m.Y',mktime(0, 0, 0, date("m"), 1, date("Y")-1));
				$model->von = date('d.m.Y',mktime(0, 0, 0, 1, 1, date("Y")));
				$model->bis = date('d.m.Y',mktime(0, 0, 0, 1, 1, date("Y")+1)/*-"1d"*/);
//        VarDumper::dump($model);

        if ($model->load(Yii::$app->request->post() )) {
        } else {
            return $this->render('anwesenheit', [
                'model' => $model,
            ]);
        }
//        VarDumper::dump($model);
        $query = (new \yii\db\Query())
            ->select('trainingsid, datum, anzahl')
            ->from('anwesenheit a')
            ->join('LEFT OUTER JOIN', 'trainings t', 't.id=a.trainingsId')
            ->where('SchulId=:schule and (datum>=:vondatum and datum<=:bisdatum) ', 
											array(':vondatum' => \DateTime::createFromFormat('d.m.Y', $model->von)->format('Y-m-d'),
														':bisdatum' => \DateTime::createFromFormat('d.m.Y', $model->bis)->format('Y-m-d'),
														'schule' => $model->schule));
        $sql = $query->createCommand()->getRawSql($query);
        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        
        $datasets = $query
            ->groupBy(['trainingsId', 'datum'])
						->orderBy('datum desc')
            ->all();
//				$d = $datasets->toArray(['jahr','monat','WT-Eintritt']);
				$labels = (new \yii\db\Query())
            ->select('datum')
            ->from('anwesenheit a')
            ->join('LEFT OUTER JOIN', 'trainings t', 't.id=a.trainingsId')
            ->where('SchulId=:schule and (datum>=:vondatum and datum<=:bisdatum) ', 
											array(':vondatum' => \DateTime::createFromFormat('d.m.Y', $model->von)->format('Y-m-d'),
														':bisdatum' => \DateTime::createFromFormat('d.m.Y', $model->bis)->format('Y-m-d'),
														'schule' => $model->schule))
						->orderBy('datum desc')
            ->distinct()
						->all();
        Yii::warning("-----gt: ".Vardumper::dumpAsString($datasets));
        Yii::warning("-----gt: ".Vardumper::dumpAsString($labels));
//           Yii::warning(Vardumper::dumpAsString($datasets),'application'); 
/*        $datasets = (new \yii\db\Query())
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
*/            
        return $this->render('anwesenheit',['model' => $model, 
                                                'datasets' => $datasets, 
                                                'labels' => $labels,
                                                'von' => $model->von,
                                                'bis' => $model->bis, 
                                                'schule' => $model->schule]);
    }
        
    public function actionMitgliederzahlen()
    {
				$model = new AuswertungenForm();
				$model->schule = 10;
//				$model->von = date('d.m.Y',mktime(0, 0, 0, date("m"), 1, date("Y")-1));
				$model->von = date('d.m.Y',mktime(0, 0, 0, 1, 1, date("Y")));
				$model->bis = date('d.m.Y',mktime(0, 0, 0, 1, 1, date("Y")+1)/*-"1d"*/);
//        VarDumper::dump($model);

        if ($model->load(Yii::$app->request->post() )) {
        } else {
            return $this->render('mitgliederzahlen', [
                'model' => $model,
            ]);
        }
        
//        VarDumper::dump($model);
        $query = (new \yii\db\Query())
            ->select('concat_ws(".",`monat`,`jahr`) as l,jahr, monat, Eintritt, Austritt, Kuendigung')
            ->from('mitgliederzahl1 mz')
//            ->join('tbl_profile p', 'u.id=p.user_id')
            ->where('SchulId=:schule and (jahr>=:vonjahr and jahr<=:bisjahr) and not ((jahr=:vonjahr and monat <:vonmonat) or (jahr=:bisjahr and monat >:bismonat) )', 
											array(':vonjahr'=>date_parse_from_format("j.n.Y H:iP", $model->von)['year'],
														':vonmonat'=>date_parse_from_format("j.n.Y H:iP", $model->von)['month'], 
														':bisjahr'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['year'],
														':bismonat'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['month'],
														'schule' => $model->schule));
        $sql = $query->createCommand()->getRawSql($query);
//        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        
        $datasets = $query
						->orderBy('jahr,monat')
            ->all();
//				$d = $datasets->toArray(['jahr','monat','WT-Eintritt']);
				$labels = (new \yii\db\Query())
            ->select('concat_ws(".",`monat`,`jahr`) as l')
            ->from('mitgliederzahl1 mz')
            ->where('SchulId=:schule and (jahr>=:vonjahr and jahr<=:bisjahr) and not ((jahr=:vonjahr and monat <:vonmonat) or (jahr=:bisjahr and monat >:bismonat) )', 
											array(':vonjahr'=>date_parse_from_format("j.n.Y H:iP", $model->von)['year'],
														':vonmonat'=>date_parse_from_format("j.n.Y H:iP", $model->von)['month'], 
														':bisjahr'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['year'],
														':bismonat'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['month'],
														'schule' => (int)$model->schule))
						->orderBy('jahr,monat')
						->all();
//        Yii::info("-----gt: ".Vardumper::dumpAsString($datasets));
//           Yii::warning(Vardumper::dumpAsString($datasets),'application'); 
/*        $datasets = (new \yii\db\Query())
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
*/            
        return $this->render('mitgliederzahlen',['model' => $model, 
                                                'datasets' => $datasets, 
                                                'labels' => $labels,
                                                'von' => $model->von,
                                                'bis' => $model->bis, 
                                                'schule' => $model->schule]);
    }

        public function actionGeburtstagsliste($print = 0)
    {
				$model = new AuswertungenForm();
				$model->schule = 10;
				$model->von = date("d.m.Y", mktime(0,0,0,date("n", time()),date("j",time()) -7 ,date("Y", time())));
				$model->bis = date('d.m.Y', mktime(0,0,0,date("n", time()),date("j",time()) +7 ,date("Y", time())));
//        VarDumper::dump($model);

        if ($model->load(Yii::$app->request->post() )) {
        } else {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        }
        
        Yii::warning($model->von);
        $query = (new \yii\db\Query())
            ->select(['concat_ws(" ",m.Vorname,m.Name) as name', 's.Schulname', 's.Disziplin'])
            ->from('mitglieder m')
            ->leftJoin('mitgliederschulen ms', 'm.MitgliederId = ms.MitgliederId')
            ->leftJoin('schulen s', 's.SchulId = ms.SchulId')
            ->where(['ms.SchulId'=> $model->schule,'(GeburtsDatum>=:von and GeburtsDatum<=:bis)'], 
											[':von' => $model->von,
														':bis' => $model->bis,
														':schule' => $model->schule]) 
            ->orderBy('m.GeburtsDatum');
        $sql = $query->createCommand()->getRawSql($query);
//        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
/*            'sort' => ['defaultOrder' => ['GeburtsDatum' => SORT_DESC],
            		        'attributes' => [
            		            'Name',
                            'mitgliederliste.Name' => [
            		                'asc' => ['mitgliederliste.Name' => SORT_ASC],
            		                'desc' => ['mitgliederliste.Name' => SORT_DESC],
            		                'label' => 'Name',
            		                'default' => SORT_ASC,
            		            ],  
            		          ],
                       ],*/ 
            'pagination' => false,
        ]);
        $datasets = $dataProvider;
//				$d = $datasets->toArray(['jahr','monat','WT-Eintritt']);
/*				$labels = (new \yii\db\Query())
            ->select('concat_ws(".",`monat`,`jahr`) as l')
            ->from('mitgliederzahl1 mz')
            ->where('SchulId=:schule and (jahr>=:vonjahr and jahr<=:bisjahr) and not ((jahr=:vonjahr and monat <:vonmonat) or (jahr=:bisjahr and monat >:bismonat) )', 
											array(':vonjahr'=>date_parse_from_format("j.n.Y H:iP", $model->von)['year'],
														':vonmonat'=>date_parse_from_format("j.n.Y H:iP", $model->von)['month'], 
														':bisjahr'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['year'],
														':bismonat'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['month'],
														'schule' => (int)$model->schule))
						->orderBy('jahr,monat')
						->all();
*/            
//        Yii::info("-----gt: ".Vardumper::dumpAsString($datasets));
//           Yii::warning(Vardumper::dumpAsString($datasets),'application'); 
/*        $datasets = (new \yii\db\Query())
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
*/            
        return $this->render('geburtstagsliste',['model' => $model, 
                                                'dataProvider' => $dataProvider, 
//                                                'labels' => $labels,
                                                'von' => $model->von,
                                                'bis' => $model->bis, 
                                                'schule' => $model->schule,
                                                'print' => $print,]);
    }

    public function actionKuendigungen($von,$bis,$schule,$print = 0)
    {
//        Yii::warning(Vardumper::dumpAsString($model),'application');
        $searchModel = new MitgliederschulenSearch();
        $query = Mitgliederschulen::find()            
            ->where('KuendigungAm >= :von and KuendigungAm <= :bis and SchulId = :schule', 
											array(':von'=>\DateTime::createFromFormat('d.m.Y', $von)->format('Y-m-d'),
														':bis'=>\DateTime::createFromFormat('d.m.Y', $bis)->format('Y-m-d'),
														':schule' => $schule
                            )
                    );
//            ->orderBy('KuendigungAm desc')
        $sql = $query->createCommand()->getRawSql($query);
        Yii::warning(VarDumper::dumpAsString($sql),'application');
            
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['KuendigungAm' => SORT_DESC],]
        ]);
        $dataProvider->pagination = false;

        return $this->render('kuendigungen', [
//            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'von' => $von,
            'bis' => $bis, 
            'schule' => $schule,
            'print' => $print,
        ]);
    }

    public function actionEintritte($von,$bis,$schule,$print = 0)
    {
//        Yii::warning(Vardumper::dumpAsString($model),'application');
        $searchModel = new MitgliederschulenSearch();
        $query = Mitgliederschulen::find()            
            ->where('von >= :von and von <= :bis', 
											array(':von'=>\DateTime::createFromFormat('d.m.Y', $von)->format('Y-m-d'),
														':bis'=>\DateTime::createFromFormat('d.m.Y', $bis)->format('Y-m-d'),
                            )
                    )
            ->andWhere(['SchulId' => $schule]);
//            ->orderBy('Von desc')
        $sql = $query->createCommand()->getRawSql($query);
        //Yii::warning(VarDumper::dumpAsString($sql),'application');
            
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['Von' => SORT_DESC],]
        ]);
        $dataProvider->pagination = false;

        return $this->render('eintritte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
            'von' => $von,
            'bis' => $bis, 
            'schule' => $schule,
            'print' => $print,
        ]);
    }

    public function actionAustritte($von,$bis,$schule,$print = 0)
    {
//        Yii::warning(Vardumper::dumpAsString($model),'application');
        $searchModel = new MitgliederschulenSearch();
        $query = Mitgliederschulen::find()
//            ->join('Mitgliedergrade mg', 'mg.MitgliedId = Mitgliederschulen.MitgliedId')            
            ->where('bis >= :von and bis <= :bis and SchulId = :schule', 
											array(':von'=>\DateTime::createFromFormat('d.m.Y', $von)->format('Y-m-d'),
														':bis'=>\DateTime::createFromFormat('d.m.Y', $bis)->format('Y-m-d'),
														':schule' => $schule
                            )
                    );
//            ->orderBy('Bis desc')
        $sql = $query->createCommand()->getRawSql($query);
        //Yii::warning(VarDumper::dumpAsString($sql),'application');
            
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [ 'defaultOrder' => ['Bis' => SORT_DESC],
//                        'attributes' => ['Bis' => SORT_DESC]
                      ]
        ]);
        $dataProvider->pagination = false;

        return $this->render('austritte', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'von' => $von,
            'bis' => $bis, 
            'schule' => $schule,
            'print' => $print,
        ]);

//        VarDumper::dump($model);
        $query = (new \yii\db\Query())
            ->select('concat_ws(".",`monat`,`jahr`) as l,jahr, monat, Eintritt, Austritt, Kuendigung')
            ->from('mitgliederzahl1 mz')
//            ->join('tbl_profile p', 'u.id=p.user_id')
            ->where('SchulId=:schule and (jahr>=:vonjahr and jahr<=:bisjahr) and not ((jahr=:vonjahr and monat <:vonmonat) or (jahr=:bisjahr and monat >:bismonat) )', 
											array(':vonjahr'=>date_parse_from_format("j.n.Y H:iP", $model->von)['year'],
														':vonmonat'=>date_parse_from_format("j.n.Y H:iP", $model->von)['month'], 
														':bisjahr'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['year'],
														':bismonat'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['month'],
														'schule' => (int)$model->schule));
        $sql = $query->createCommand()->getRawSql($query);
        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        
        $datasets = $query
						->orderBy('jahr,monat')
            ->all();
//				$d = $datasets->toArray(['jahr','monat','WT-Eintritt']);
				$labels = (new \yii\db\Query())
            ->select('concat_ws(".",`monat`,`jahr`) as l')
            ->from('mitgliederzahl1 mz')
            ->where('SchulId=:schule and (jahr>=:vonjahr and jahr<=:bisjahr) and not ((jahr=:vonjahr and monat <:vonmonat) or (jahr=:bisjahr and monat >:bismonat) )', 
											array(':vonjahr'=>date_parse_from_format("j.n.Y H:iP", $model->von)['year'],
														':vonmonat'=>date_parse_from_format("j.n.Y H:iP", $model->von)['month'], 
														':bisjahr'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['year'],
														':bismonat'=>date_parse_from_format("j.n.Y H:iP", $model->bis)['month'],
														'schule' => (int)$model->schule))
						->orderBy('jahr,monat')
						->all();
//        Yii::info("-----gt: ".Vardumper::dumpAsString($datasets));
           Yii::warning(Vardumper::dumpAsString($datasets),'application'); 
/*        $datasets = (new \yii\db\Query())
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
*/            
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
    
		public function actionInfoabendauswahl() {
 				$model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        } else {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        }

    }


		public function actionInteressentenauswahl() {
 				$model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        } else {
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        }
    }


		public function actionInfoAbendliste() {
 
 				$model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            $schulen = Schulen::find()->where(['SchulId' => $model->schule])->all();
            $schulnamen = ArrayHelper::getColumn($schulen,'Schulname');
            $schule = implode(', ', $schulnamen);
        } else {
            Yii::warning('else','application');
            return $this->render('auswahl', [
                'model' => $model,
            ]);
        }
//        Yii::warning(VarDumper::dumpAsString($schulnamen),'application');
        
        $searchModel = new MitgliederSearch();
        $query = Mitglieder::find()->leftJoin('mitgliederschulen ms','mitglieder.MitgliederId=ms.MitgliederId')
                 ->andWhere(['is', 'ms.msID', new \yii\db\Expression('null')])
                 ->andWhere(['is', 'ProbetrainingAm', new \yii\db\Expression('null')])
//                 ->andWhere(['not', ['EinladungIAzum' => null]])
                 ->andWhere('EinladungIAzum >= CURRENT_DATE')
                 ->andWhere(['Schulort' => $schulnamen]);
//        $query->andFilterWhere(['>', 'PruefungZum', 0]);
//        Yii::warning(VarDumper::dumpAsString($query),'application');
//        $sql = $query->createCommand()->getRawSql($query);
//        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        $d = new ActiveDataProvider([
				     'query' => $query,
				]);
				$zz = 18;
				$r = $zz-($d->count % $zz);
				
        $query2 = (new \yii\db\Query())
//        ->select('MitgliederId, MitgliedsNr, Vorname, Nachname, Funktion, PruefungZum, Name, Schulname, LeiterName, DispName, Vertrag, Grad, LetzteAenderung, Email')
        ->select('m.*')
    		->from('mitglieder m')
    		->join('RIGHT JOIN', 'tally','m.MitgliederId = null')
    		->limit($r);
				
				$query->union($query2, true);//false is UNION, true is UNION ALL

				$dataProvider = new ActiveDataProvider([
				     'query' => $query,
				     'sort'=> ['defaultOrder' => ['Name'=>SORT_ASC]]
				]); 
        $dataProvider->pagination->pageSize = 200;
        
        $content = $this->renderPartial('ialiste', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		            'schule' => $schule,
		        ]); 

				$pdf = new Pdf([
						'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
						// set to use core fonts only
						'mode' => Pdf::MODE_BLANK,
						// A4 paper format
						'format' => Pdf::FORMAT_A4,
						// portrait orientation
						'orientation' => Pdf::ORIENT_LANDSCAPE,
						// stream to browser inline
						'destination' => Pdf::DEST_BROWSER,
						// format content from your own css file if needed or use the
						// enhanced bootstrap css built by Krajee for mPDF formatting
//						'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
//						'cssFile' => 'css/kv-mpdf-bootstrap.css',
						// any css to be embedded if required
						'cssInline' => '.kv-heading-1{font-size:18px}'.
													'.kv-wrap{padding:20px;}' .
													'.kv-align-center{text-align:center;}' .
													'.kv-align-left{text-align:left;}' .
													'.kv-align-right{text-align:right;}' .
													'.kv-align-top{vertical-align:top!important;}' .
													'.kv-align-bottom{vertical-align:bottom!important;}' .
													'.kv-align-middle{vertical-align:middle!important;}' .
													'.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
													'.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
													'.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}' .
                          ' table{width: 100%;line-height: inherit;text-align: left; } table, td, th {border: 1px solid black;border-collapse: collapse;}'
                          ,
            'marginTop' => 10,
            'marginLeft' => 0,
            'marginRight' => 5,
						'content' => $content,
						'options' => [
								'title' => 'InfoAbend-Liste',
								'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
						],
						'methods' => [
							'SetHeader' => [''], //['Erstellt am: ' . date("r")],
							'SetFooter' => ['|Seite {PAGENO}| '.Yii::$app->formatter->asDate(date('d.m.Y'), 'dd.MM.YYYY')],
						]
			]);
			return $pdf->render();
/*			return $this->renderPartial('pruefungsliste', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		            'plf' => $plf]);
*/		}
		
		public function actionInteressentenliste() {
 
 				$model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            $schulen = Schulen::find()->where(['SchulId' => $model->schule])->all();
            $schulnamen = ArrayHelper::map($schulen,'Schulname','Schulname');
            $schule = implode(', ', $schulnamen);
        }
        
        $searchModel = new MitgliederSearch();
        $query = Mitglieder::find()->leftJoin('mitgliederschulen ms','mitglieder.MitgliederId = ms.MitgliederId')
                 ->select('MitgliedsNr, Vorname, Name, KontaktAm, Schulort, Email, Disziplin, Telefon1, Telefon2, HandyNr, Woher, EinladungIAzum, IABest, WarZumIAda, ProbetrainingAm, PTwarDa, Bemerkung1')
                 ->andWhere(['is', 'ms.msID', new \yii\db\Expression('null')])
                 ->andWhere(['Schulort' => $schulnamen])
                 ->andWhere(['is not', 'mitglieder.RecDeleted', new \yii\db\Expression('true')])
                 ->andWhere(['or',
                                  ['is', 'mitglieder.wiederVorlageAm', new \yii\db\Expression('null')],
                                  ['<=', 'mitglieder.wiederVorlageAm', new \yii\db\Expression('CURRENT_DATE')],
            ]);
        if ($model->fon)  {
            $query->andWhere(['is not', 'mitglieder.Telefon1', new \yii\db\Expression('null')]);
            $query->andWhere(['or',
                                  ['<>', 'mitglieder.Telefon1', ''],
                                  ['<>', 'mitglieder.Telefon2', ''],
                                  ['<>', 'mitglieder.HandyNr', '']
            ]);
        }
        if ($model->ia)  {
            $query->andWhere(['is', 'mitglieder.ProbetrainingAm', new \yii\db\Expression('null')]);
            $query->andWhere(['is not', 'mitglieder.WarZumIAda', new \yii\db\Expression('true')]);
            $query->andWhere(['or',
                                  ['is not', 'mitglieder.EinladungIAzum', new \yii\db\Expression('null')],
                                  ['<=', 'EinladungIAzum', new \yii\db\Expression('CURRENT_DATE')]
                            ]);
        }
        if ($model->pt)  {
//            $query->andWhere(['is', 'mitglieder.ProbetrainingAm', new \yii\db\Expression('null')]);
            $query->andWhere(['is', 'mitglieder.WarZumIAda', new \yii\db\Expression('true')]);
/*            $query->andWhere(['or',
                                  ['is not', 'mitglieder.EinladungIAzum', new \yii\db\Expression('null')],
                                  ['EinladungIAzum <= CURRENT_DATE']
                            ]);
*/        }
//        $query->andFilterWhere(['>', 'PruefungZum', 0]);
//        Yii::warning(VarDumper::dumpAsString($query),'application');
        $sql = $query->createCommand()->getRawSql($query);
        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        $d = new ActiveDataProvider([
				     'query' => $query,
				]);
				$zz = 18;
				$r = $zz-($d->count % $zz);
				
        $query2 = (new \yii\db\Query())
        ->select('MitgliedsNr, Vorname, Name, KontaktAm, Schulort, Email, Disziplin, Telefon1, Telefon2, HandyNr, Woher, EinladungIAzum, IABest, WarZumIAda, ProbetrainingAm, PTwarDa, Bemerkung1')
//        ->select('m.*')
    		->from('mitglieder m')
    		->join('RIGHT JOIN', 'tally','m.MitgliederId = null')
        ->andWhere(['is', 'm.MitgliederId', new \yii\db\Expression('null')])
    		->limit($r);

				$query->union($query2, true);//false is UNION, true is UNION ALL

				$dataProvider = new ActiveDataProvider([
				     'query' => $query,
				     'sort'=> ['defaultOrder' => ['Name'=>SORT_ASC]]
				]); 
        $dataProvider->pagination->pageSize = 200;
        
/*			return $this->renderPartial('ialiste', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider ,
//		            'plf' => $plf
        ]);
*/        $content = $this->renderPartial('ialiste', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		            'schule' => $schule,
		        ]); 

				$pdf = new Pdf([
						'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
						// set to use core fonts only
						'mode' => Pdf::MODE_BLANK,
						// A4 paper format
						'format' => Pdf::FORMAT_A4,
						// portrait orientation
						'orientation' => Pdf::ORIENT_LANDSCAPE,
						// stream to browser inline
						'destination' => Pdf::DEST_BROWSER,
						// format content from your own css file if needed or use the
						// enhanced bootstrap css built by Krajee for mPDF formatting
//						'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
//						'cssFile' => 'css/kv-mpdf-bootstrap.css',
						// any css to be embedded if required
						'cssInline' => '.kv-heading-1{font-size:18px}'.
													'.kv-wrap{padding:20px;}' .
													'.kv-align-center{text-align:center;}' .
													'.kv-align-left{text-align:left;}' .
													'.kv-align-right{text-align:right;}' .
													'.kv-align-top{vertical-align:top!important;}' .
													'.kv-align-bottom{vertical-align:bottom!important;}' .
													'.kv-align-middle{vertical-align:middle!important;}' .
													'.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
													'.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
													'.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}' .
                          ' table{width: 100%;line-height: inherit;text-align: left; } table, td, th {border: 1px solid black;border-collapse: collapse;}',
            'marginTop' => 10,
            'marginLeft' => 0,
            'marginRight' => 5,
						'content' => $content,
						'options' => [
								'title' => 'InfoAbend-Liste',
								'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy',
						],
						'methods' => [
							'SetHeader' => [''], //['Erstellt am: ' . date("r")],
							'SetFooter' => ['|Seite {PAGENO}| '.Yii::$app->formatter->asDate(date('d.m.Y'), 'dd.MM.YYYY')],
						]
			]);
			return $pdf->render();
/*			return $this->renderPartial('pruefungsliste', [
		            'searchModel' => $searchModel,
		            'dataProvider' => $dataProvider,
		            'plf' => $plf]);
*/		}

      public function actionWooSwmAbgleich(){
        $swmRows = Swmreceiver::find()->count();
        $wooRows = Woocustomer::find()->count();

        $query = (new \yii\db\Query())
            ->select('woocustomer.id, woocustomer.email, woocustomer.vorname, woocustomer.nachname')
            ->from('woocustomer')
            ->join('LEFT OUTER JOIN', 'swmreceiver', 'woocustomer.email = swmreceiver.email')
            ->where('swmreceiver.email is null ')
            ->andWhere('woocustomer.email NOT IN (SELECT EMAIL FROM swm_blocked_emails)');
        $sql = $query->createCommand()->getRawSql($query);
        Yii::warning(VarDumper::dumpAsString($sql),'application');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        return $this->render('woo_swm', [
                'swmRows' => $swmRows,
                'wooRows' => $wooRows,
                'dataProvider' => $dataProvider
             ]);

      }

      public function actionGetSwmData(){
        Yii::$app->db->createCommand('TRUNCATE TABLE swmreceiver;')->execute();
        
        $rows = Yii::$app->dbswm->createCommand('SELECT u_EMail, \'\' as a, u_FirstName, u_LastName, \'\' as b, \'\' as c FROM wtintensivinteressentenshopbesteller_members m join wtintensivinteressentenshopbesteller_maillisttogroups g on g.Member_id = m.id WHERE g.groups_id IN (1,6) ') ->queryAll();;
        Yii::$app->db->createCommand()->batchInsert('swmreceiver', ['email', 'anrede', 'vorname', 'nachname', 'geburtstag', 'geschlecht'], $rows)->execute();

        return $this->redirect(['/site/woo-swm-abgleich']);
      }

      public function actionGetWooData(){
        Yii::$app->db->createCommand('TRUNCATE TABLE woocustomer;')->execute();

        $rows = Yii::$app->dbwoo->createCommand('SELECT email, \'\' as a, first_name, last_name, \'\' as b, \'\' as c FROM vsal5_wc_customer_lookup') ->queryAll();;
        Yii::$app->db->createCommand()->batchInsert('woocustomer', ['email', 'anrede', 'vorname', 'nachname', 'geburtstag', 'geschlecht'], $rows)->execute();

        return $this->redirect(['/site/woo-swm-abgleich']);
      }


      public function actionBlock($email){
          $da = SwmBlockedEmails::find()->select('email')->where(['email' => $email])->one();
          Yii::warning($da);
          if (empty($da)) {
              $model = new SwmBlockedEmails;
              $model->email = $email;
              $model->save();
              return 'Email wurde in SwmBlockedEmails eingetragen.';
          }
          return 'Email wurde nicht in SwmBlockedEmails eingetragen!';
      }
}

