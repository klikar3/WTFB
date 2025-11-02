<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

use frontend\models\AuswertungenForm;
use frontend\models\Mitglieder;
use frontend\models\Mitgliederschulen;
use frontend\models\Mitgliedersektionen;
use frontend\models\MitgliedersektionenSearch;
use frontend\models\Schulen;
use frontend\models\Sektionen;
use frontend\models\SektionenSearch;

/**
 * MitgliedersektionenController implements the CRUD actions for Mitgliedersektionen model.
 */
class MitgliedersektionenController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                   [
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mitgliedersektionen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MitgliedersektionenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mitgliedersektionen model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mitgliedersektionen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mitgliedersektionen();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->msekt_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatefast($mId, $sektion)
    {
            $query = Sektionen::find();
                //$query->where(['=', 'MitgliedId', $mId]);
                $sdataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['id' => SORT_ASC]]
                ]);
                
            $query = Mitgliedersektionen::find();
                $query->where(['=', 'mitglied_id', $mId]);

                $msdataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort' => ['defaultOrder' => ['datum' => SORT_DESC]]
                ]);
                
        $models = new Mitgliedersektionen();
        $models->mitglied_id = $mId;
        $models->sektion_id = $sektion;
        $models->vdatum = date('Y-m-d');
        $models->vermittler_id = null; //Yii::$app->user->identity->SifuId;
        $models->pdatum = date('Y-m-d');
        $models->pruefer_id = Yii::$app->user->identity->PrueferId;
//              Yii::Error( 'test');
        if ($models->load(Yii::$app->request->post())) {
                $model = new Mitgliedersektionen();
                $model->mitglied_id =$models->mitglied_id;
                $model->sektion_id = $models->sektion_id;
                $model->pdatum = $models->pdatum;
                $model->pruefer_id = $models->pruefer_id;
                $model->vdatum = $models->vdatum;
                $model->vermittler_id = $models->vermittler_id;
//              Yii::info("-----model: ".Vardumper::dumpAsString($model));
//              Yii::info("-----modelp: ".Vardumper::dumpAsString($modelp));
                if (!$model->save()){
//                          return $this->redirect(['/mitgliedergrade/createfast', 'mId' => $mId, 'grad' => $grad]);
                                $models->addErrors ($model->errors);
                    return $this->render('create', [
                        'model' => $models, //'ddataProvider' => $ddataProvider, 'gdataProvider' => $gdataProvider,  
                    ]);
                        }
                $msID = Yii::$app->db->getLastInsertID();
                $mitglied = $model->mitglied;
                date_default_timezone_set('Europe/Berlin');
                $mitglied->LetzteAenderung = date('Y-m-d H:i:s');
                if (Yii::$app->user->identity->isAdmin) { $mitglied->LetztAendSifu = $mitglied->LetzteAenderung; }
                $mitglied->save();
                
                $mitglied->PruefungZum = 0;
                $mitglied->save();
//              $modelm = Mitglieder::findModel($mId)->one();
//              if ($modelm) {
//                  Yii::info("-----modelm: ".Vardumper::dumpAsString($modelm));
//                      $modelm->PruefungZum = 0;
//                      $modelm->save();
//              }
            return $this->redirect(['mitglieder/view', 'id' => $model->mitglied_id, 'tabnum' => 5, ]);
        } else {
            return $this->render('create', [
                'model' => $models ,
//                'ddataProvider' => $ddataProvider,
//                'gdataProvider' => $gdataProvider,                
            ]);
        }
    }

    /**
     * Updates an existing Mitgliedersektionen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->msekt_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mitgliedersektionen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $mgid = $model->mitglied_id;
        $model->delete();

//        return $this->redirect(['index']);
        return $this->redirect(['/mitglieder/view', 'id' => $mgid, 'tabnum' => 5]);
    }

    /**
     * Finds the Mitgliedersektionen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mitgliedersektionen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mitgliedersektionen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
        public function actionSektionsauswahl() {
                $model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            return $this->render('/site/auswahl', [
                'model' => $model,
            ]);
        } else {
            return $this->render('/site/auswahl', [
                'model' => $model,
            ]);
        }
    }


    /**
        * THE CONTROLLER ACTION
        */
        // Privacy statement output demo
        public function actionSektionsliste() {

                $model = new AuswertungenForm();
        if ($model->load(Yii::$app->request->post() )) {
            $schulen = Schulen::find()->where(['SchulId' => $model->schule])->all();
            $schule = implode(', ', ArrayHelper::map($schulen,'Schulname','Schulname'));
            $schulids = implode(', ', ArrayHelper::map($schulen,'SchulId','SchulId'));
            Yii::warning("----load: ".Vardumper::dumpAsString($schulids));
        } else  {
            Yii::warning("----noload: ");
        }
        
//              $plf->load(Yii::$app->request->get(0));
//              Yii::info(Vardumper::dumpAsString(Yii::$app->request->get(0)));
        //Yii::info("-----test");
        //Yii::info("-----plf: ".Vardumper::dumpAsString($plf));

//              $sekts = ArrayHelper::map( Sektionen::find()->all(), 'kurz') ; 
        //Yii::info("-----grads: ".Vardumper::dumpAsString($grads));

        $searchModel = new MitgliedersektionenSearch();
/*        $subquery =  (new \yii\db\Query())->select([new \yii\db\Expression('1')])
          ->from('mitgliederschulen ms')
          ->where('ms.MitgliederId = c.mitglied_id')
          ->andWhere('ms.Von <= CURDATE()')
          ->andWhere('(ms.Bis >= CURDATE()) or (ms.Bis is null)');
//          ->andWhere(['ms.SchulId' => $model->schule]);
        $command = $subquery->createCommand();
        Yii::warning("----subquery: ".Vardumper::dumpAsString($command->sql));
        Yii::warning("----model->schule: ".Vardumper::dumpAsString($model->schule));
*/    
        $query = Mitgliedersektionen::findBySql('
        select c.msekt_id, c.mitglied_id, c.sektion_id, c.vdatum, c.vermittler_id, c.pdatum, c.pruefer_id, max(c.m) as m, m.Vorname, m.Name as Nachname 
        from ( select a.msekt_id, a.mitglied_id, a.sektion_id, a.vdatum, a.vermittler_id, a.pdatum, a.pruefer_id, count(*) as rn, max(a.sektion_id) as m 
                FROM mitgliedersektionen a join mitgliedersektionen b on a.mitglied_id = b.mitglied_id and a.sektion_id >= b.sektion_id group by a.mitglied_id, a.sektion_id order by sektion_id desc
                ) c 
        inner join mitglieder m on m.MitgliederId = c.mitglied_id 
        WHERE EXISTS (SELECT 1 FROM mitgliederschulen ms where ms.MitgliederId = c.mitglied_id and ms.Von <= CURDATE() and (ms.Bis >= CURDATE() or ms.Bis is null)
                    and ms.SchulId in (:schule)) 
        group by c.mitglied_id order by c.sektion_id asc ',                
        [ 'schule' => $schulids]
        );
/*        
//        ->innerJoin('mitglieder m','m.MitgliederId = c.mitgliedId') //->on('m.MitgliederId' = c.mitgliedId')
        ->where(['EXISTS', $subquery])
  //      ->groupBy('c.mitglied_id')
        ->orderBy('c.sektion_id desc');
//        $query = Mitgliedersektionen::find();
//                 ->where(['sektionen.kurz' => $grads] );
//        $query->andFilterWhere(['>', 'PruefungZum', 0]);
*/
        $command = $query->createCommand();
        Yii::warning("----query: ".Vardumper::dumpAsString($command->sql));
        
        $d = new ActiveDataProvider([
                     'query' => $query,
                ]);
        $c = $query->count();
//        Yii::warning("-----d: ".Vardumper::dumpAsString($d));
                $zz = 32;
                $r = $zz-($d->count % $zz);
//        Yii::warning("-----r: ".Vardumper::dumpAsString($r));
                
        $query2 = (new \yii\db\Query())
//        ->select('MitgliederId, MitgliedsNr, Vorname, Nachname, Funktion, PruefungZum, Name, Schulname, LeiterName, DispName, Vertrag, Grad, LetzteAenderung, Email')
        ->select('m.*', 'NULL')
            ->from('mitgliedersektionen m')
            ->join('RIGHT JOIN', 'tally','m.msekt_id = null')
            ->limit($r);
                
                $query->union($query2, true);//false is UNION, true is UNION ALL

                $dataProvider = new ActiveDataProvider([
                     'query' => $query,
                     'sort'=> ['defaultOrder' => ['vdatum'=>SORT_ASC]]
                ]);  

                $pdf = new Pdf([
//                      'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                        // set to use core fonts only
                        'mode' => Pdf::MODE_BLANK,
                        // A4 paper format
                        'format' => Pdf::FORMAT_A4,
                        // portrait orientation
                        'orientation' => Pdf::ORIENT_PORTRAIT,
                        // stream to browser inline
                        'destination' => Pdf::DEST_BROWSER,
                        // format content from your own css file if needed or use the
                        // enhanced bootstrap css built by Krajee for mPDF formatting
//                      'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.css',
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
                          ' p, td,div { font-family: helvetica, verdana, sansserif;  font-size: 10pt !important;}' .
                          ' body, p { font-family: helvetica, verdana, sansserif; font-size: 12pt; };' .
                          ' table{width: 100%;line-height: inherit;text-align: left; } ' .
                          ' table, td, th {font-size: 10pt;font-family: helvetica, verdana, sansserif; border: 1px solid black;border-collapse: collapse;}' .
                          ' th{font-size: 12pt;} td{line-height: 0.5em; }'
            ,
                        'content' => $this->renderPartial('sektionsliste', [
//                  'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'schule' => $schule,
                ]),
                        'options' => [
                                'title' => 'Sektionsliste',
                                'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                        ],
                        'methods' => [
                            'SetHeader' => [''], //['Erstellt am: ' . date("r")],
//                          'SetFooter' => ['|Seite {PAGENO}|'],
                            'SetFooter' => [''],
                        ]
            ]);
            return $pdf->render();
        }
    
    public function actionPrint($id)
    {
        $model = $this->findModel($id);
//        $txtcode = $model->sektion->textcode;
//        $dispName = $model->grad->DispName;
        $Schule = MitgliederSchulen::find()->joinWith('schul')->joinWith('schul.disziplinen')->andWhere(['MitgliederID' => $model->mitglied_id,'DispName' => 'Wing Tzun'])->one();
        $url = Url::toRoute(['texte/print', 
                                                                                    'datamodel' => 'sektion', 
                                                                                    'dataid' => $id, 
//                                                                                  'SchulId' => $Schule->SchulId, 
                                                                                'txtcode' => 'sektionBest', 
                                                                                    'txtid' => 0,
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
            'id' => $model->mitglied_id, 'tabnum' => 5
        ]);
        } else {
            return $this->redirect(['/mitglieder/view', 
            'id' => $model->mitglied_id, 'tabnum' => 5
//            return $this->render('/mitglieder/view', [
//                'model' => $mgModel,
            ]);
        }
    }    
}
