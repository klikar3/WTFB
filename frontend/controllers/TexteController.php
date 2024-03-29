<?php

namespace frontend\controllers;

use Yii;
use yii\i18n\Formatter;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use kartik\mpdf\Pdf;

use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Mitgliederschulen;
use frontend\models\Mitgliedersektionen;
use frontend\models\Numbers;
use frontend\models\Texte;
use frontend\models\TexteSearch;

/**
 * TexteController implements the CRUD actions for Texte model.
 */
class TexteController extends Controller
{
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Texte models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TexteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Texte model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Texte model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Texte();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Texte model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Texte model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Texte model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Texte the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Texte::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionPrint($datamodel, $dataid, $txtcode = null, $SchulId = null, $vertragId = null, $txtid)
    {
//  				Yii::error("-----PRINT: ".Vardumper::dumpAsString($txtid));
    		
    		if ($txtcode == '') {
    			$numbers = new Numbers();
    			$numbers = Yii::$app->request->post('Numbers');
//    			Yii::error("-----PRINT: ".Vardumper::dumpAsString($numbers));
//    			Yii::error("-----PRINT: ".Vardumper::dumpAsString($numbers['id']));

 					$textmodel = Texte::findOne($numbers['id']);
				} else {
          if ($txtid != 0) {
 						$textmodel = Texte::findOne($txtid);
				  } else {
            if ($SchulId == 0) {
						$textmodel = Texte::find()
												->where(['code' => $txtcode])
												->one();
				    } else { 
						$textmodel = Texte::find()
												->where(['code' => $txtcode, 'SchulId' => $SchulId])
												->one();
            }
          }              
				}
				if (empty($textmodel)) {
//					$datamodel->addError("Zugehörigen Text nicht gefunden!");
					return "Zugehörigen Text nicht gefunden!" ;
				}	
//		Yii::error("-----PRINT: ".Vardumper::dumpAsString($textmodel));
        if ($datamodel == 'mitglieder') {
					$modelm = Mitglieder::findOne($dataid);
					$textmodel->txt = str_replace ( '#vorname#' , $modelm->Vorname , $textmodel->txt ); 
					$textmodel->txt = str_replace ( '#mitgliedernummer#' , $modelm->MitgliedsNr , $textmodel->txt );
					$textmodel->txt = str_replace ( '#nachname#' , $modelm->Name , $textmodel->txt );
					$textmodel->txt = str_replace ( '#geburtstag#' , Yii::$app->formatter->asDatetime($modelm->GeburtsDatum, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#schulort#' , $modelm->Schulort , $textmodel->txt );
					$textmodel->txt = str_replace ( '#sifu#' , str_replace ( 'Sifu ' , '', $modelm->Sifu) , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#anrede#' , $modelm->Anrede , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#strasse#' , $modelm->Strasse , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#wohnort#' , $modelm->Wohnort , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#plz#' , $modelm->PLZ , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#heute#' , date("d.m.Y") , $textmodel->txt );
				}
				
				
        if ($datamodel == 'vertrag') {
					$modelv = Mitgliederschulen::findOne($vertragId);
					$textmodel->txt = str_replace ( '#vorname#' , $modelv->mitglieder->Vorname , $textmodel->txt ); 
					$textmodel->txt = str_replace ( '#mitgliedernummer#' , $modelv->mitglieder->MitgliedsNr , $textmodel->txt );
					$textmodel->txt = str_replace ( '#nachname#' , $modelv->mitglieder->Name , $textmodel->txt );
					$textmodel->txt = str_replace ( '#geburtstag#' , Yii::$app->formatter->asDatetime($modelv->mitglieder->GeburtsDatum, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#kuendigungam#', Yii::$app->formatter->asDatetime($modelv->KuendigungAm, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#kuendigungsdatum#', Yii::$app->formatter->asDatetime($modelv->KuendigungAm, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#aussetzenvon#', Yii::$app->formatter->asDatetime($modelv->BeitragAussetzenVon, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#aussetzenbis#', Yii::$app->formatter->asDatetime($modelv->BeitragAussetzenBis, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#austrittsdatum#', Yii::$app->formatter->asDatetime($modelv->Bis, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#schulort#' , $modelv->mitglieder->Schulort , $textmodel->txt );
					$textmodel->txt = str_replace ( '#sifu#' , $modelv->mitglieder->Sifu , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#anrede#' , $modelv->mitglieder->Anrede , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#strasse#' , $modelv->mitglieder->Strasse , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#wohnort#' , $modelv->mitglieder->Wohnort , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#plz#' , $modelv->mitglieder->PLZ , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#eintritt#' , Yii::$app->formatter->asDatetime($modelv->Von, "php:d.m.Y") , $textmodel->txt );
					$textmodel->txt = str_replace ( '#heute#' , date("d.m.Y") , $textmodel->txt );
				}
        if ($datamodel == 'grad') {
					$model = Mitgliedergrade::findOne($dataid);
					$textmodel->txt = str_replace ( '#vorname#' , $model->mitglied->Vorname , $textmodel->txt ); 
					$textmodel->txt = str_replace ( '#nachname#' , $model->mitglied->Name , $textmodel->txt );
					$textmodel->txt = str_replace ( '#schulort#' , $model->mitglied->Schulort , $textmodel->txt );
					$textmodel->txt = str_replace ( '#grad#' , $model->grad->gKurz , $textmodel->txt );
					$textmodel->txt = str_replace ( '#print#' , $model->grad->print , $textmodel->txt );
					$textmodel->txt = str_replace ( '#sifu#' , $model->mitglied->Sifu , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#heute#' , Yii::$app->formatter->asDate($model->Datum, 'php:d.m.Y') , $textmodel->txt );
				}
        if ($datamodel == 'sektion') {
					$model = Mitgliedersektionen::findOne($dataid);
					$textmodel->txt = str_replace ( '#vorname#' , $model->mitglied->Vorname , $textmodel->txt ); 
					$textmodel->txt = str_replace ( '#nachname#' , $model->mitglied->Name , $textmodel->txt );
					$textmodel->txt = str_replace ( '#schulort#' , $model->mitglied->Schulort , $textmodel->txt );
					$textmodel->txt = str_replace ( '#sektion#' , $model->sektion->name , $textmodel->txt );
//					$textmodel->txt = str_replace ( '#print#' , $model->grad->print , $textmodel->txt );
					$textmodel->txt = str_replace ( '#sifu#' , $model->mitglied->Sifu , $textmodel->txt );	
					$textmodel->txt = str_replace ( '#heute#' , Yii::$app->formatter->asDate($model->pdatum, 'php:d.m.Y'), $textmodel->txt );
				}
				
        $textmodel->txt = str_replace ( 'Stuttgart Neu' , 'Stuttgart', $textmodel->txt );
							
				$pdf = new Pdf([
//						'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
						// set to use core fonts only
						'mode' => Pdf::MODE_UTF8,
						// A4 paper format
						'format' => ($textmodel->quer == 0) ? "A4" : "A4-L", //Pdf::FORMAT_A4,
						// portrait orientation
						'orientation' => ($textmodel->quer == 0) ? Pdf::ORIENT_PORTRAIT : Pdf::ORIENT_LANDSCAPE,
            'marginLeft' => empty($textmodel->randLinks) ? 25 : $textmodel->randLinks,
            'marginRight' => empty($textmodel->randRechts) ? 25 : $textmodel->randRechts,
            'marginTop' => empty($textmodel->randOben) ? 25 : $textmodel->randOben,
            'marginBottom' => empty($textmodel->randUnten) ? 25 : $textmodel->randUnten,
						// stream to browser inline
						'destination' => Pdf::DEST_BROWSER,
						// format content from your own css file if needed or use the
						// enhanced bootstrap css built by Krajee for mPDF formatting
						'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.css',
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
													'.kkl-addr{font-family:arial;font-size:16pt;text-align:right;}',
						'content' => $this->renderPartial('_print', [
		            'model' => $textmodel,
		        ]),
						'options' => [
								'title' => 'Ausdruck',
								'subject' => ''
						],
						'methods' => [
							'SetHeader' => [''],
							'SetFooter' => [''],
						]
			]);
			return $pdf->render();
    }

	protected static function textReplace($datamodel, $dataid, $txtcode, $SchulId, $txtid)
    {
//			Yii::Warning("-----textReplace datamodel: ".Vardumper::dumpAsString($datamodel));
//			Yii::Warning("-----textReplace dataid: ".Vardumper::dumpAsString($dataid));
//			Yii::Warning("-----textReplace txtcode: ".Vardumper::dumpAsString($txtcode));
//			Yii::Warning("-----textReplace SchulId: ".Vardumper::dumpAsString($SchulId));
//			Yii::Warning("-----textReplace txtid: ".Vardumper::dumpAsString($txtid));
  		
  		if ($txtcode == '') {
  			$numbers = new Numbers();
  			$numbers = Yii::$app->request->post('Numbers');
//    			Yii::error("-----PRINT: ".Vardumper::dumpAsString($numbers));
//    			Yii::error("-----PRINT: ".Vardumper::dumpAsString($numbers['id']));

				$textmodel = Texte::findOne($numbers['id']);
			} else if ($txtid != 0) {
					$textmodel = Texte::findOne($txtid);
			} else if ($SchulId == 0) {
					$textmodel = Texte::find()
											->where(['code' => $txtcode, 'fuer' => $datamodel])
											->one();
			} else { 
					$textmodel = Texte::find()
											->where(['code' => $txtcode, 'SchulId' => $SchulId, 'fuer' => $datamodel])
											->one();
			}
        if (empty($textmodel)) {
            return['betreff' => '', 'text' => '', 'link' => '', 'email' => ''];
        }
/*									, Url::to('') .
								"?subject=&body=",[
										'class' => 'btn btn-sm btn-default',
										'style' => 'width: 120px; text-align: left;',
										'title' => Yii::t('app', 'Email an Mitglied senden'),
										'disabled' => true,
						  	]);//''; //"Zugehörigen Text nicht gefunden!" ;
*/				
        $txt = $textmodel->txt;
//		Yii::Warning("-----textReplace txt: ".Vardumper::dumpAsString($txt));
          if ($datamodel == 'mitglieder') {
    		$model = Mitglieder::findOne($dataid);
    		$txt = str_replace ( '#vorname#' , $model->Vorname , $txt ); 
    		$txt = str_replace ( '#mitgliedernummer#' , $model->MitgliedsNr , $txt );
    		$txt = str_replace ( '#nachname#' , $model->Name , $txt );
    		$txt = str_replace ( '#geburtstag#' , Yii::$app->formatter->asDatetime($model->GeburtsDatum, "php:d.m.Y") , $txt );
    		$txt = str_replace ( '#schulort#' , $model->Schulort , $txt );
    		$txt = str_replace ( '#sifu#' , str_replace ( 'Sifu ' , '', $model->Sifu) , $txt );	
    		$txt = str_replace ( '#anrede#' , $model->Anrede , $txt );	
    		$txt = str_replace ( '#strasse#' , $model->Strasse , $txt );	
    		$txt = str_replace ( '#wohnort#' , $model->Wohnort , $txt );	
    		$txt = str_replace ( '#plz#' , $model->PLZ , $txt );	
    		$txt = str_replace ( '#heute#' , date("d.m.Y") , $txt );
            $email = $model->Email;
		}
				
				
        if ($datamodel == 'vertrag') {
			$modelv = Mitgliederschulen::findOne($dataid); 
			$txt = str_replace ( '#vorname#' , $modelv->mitglieder->Vorname , $txt ); 
			$txt = str_replace ( '#mitgliedernummer#' , $modelv->mitglieder->MitgliedsNr , $txt );
			$txt = str_replace ( '#nachname#' , $modelv->mitglieder->Name , $txt );
			$txt = str_replace ( '#geburtstag#' , Yii::$app->formatter->asDatetime($modelv->mitglieder->GeburtsDatum, "php:d.m.Y") , $txt );
			$txt = str_replace ( '#kuendigungam#', Yii::$app->formatter->asDatetime($modelv->KuendigungAm, "php:d.m.Y") , $txt );
			$txt = str_replace ( '#kuendigungsdatum#', Yii::$app->formatter->asDatetime($modelv->KuendigungAm, "php:d.m.Y") , $txt );
			$txt = str_replace ( '#austrittsdatum#', Yii::$app->formatter->asDatetime($modelv->Bis, "php:d.m.Y") , $txt );
			$txt = str_replace ( '#aussetzenvon#', Yii::$app->formatter->asDatetime($modelv->BeitragAussetzenVon, "php:d.m.Y") , $txt );
			$txt = str_replace ( '#aussetzenbis#', Yii::$app->formatter->asDatetime($modelv->BeitragAussetzenBis, "php:d.m.Y") , $txt );
			$txt = str_replace ( '#schulort#' , $modelv->mitglieder->Schulort , $txt );
			$txt = str_replace ( '#sifu#' , $modelv->mitglieder->Sifu , $txt );	
			$txt = str_replace ( '#anrede#' , $modelv->mitglieder->Anrede , $txt );	
			$txt = str_replace ( '#strasse#' , $modelv->mitglieder->Strasse , $txt );	
			$txt = str_replace ( '#wohnort#' , $modelv->mitglieder->Wohnort , $txt );	
			$txt = str_replace ( '#plz#' , $modelv->mitglieder->PLZ , $txt );	
			$txt = str_replace ( '#eintritt#' , Yii::$app->formatter->asDatetime($modelv->Von, "php:d.m.Y") , $txt );
			$txt = str_replace ( '#heute#' , date("d.m.Y") , $txt );
            $email = $modelv->mitglieder->Email;
		}
        if ($datamodel == 'grad') {
			$model = Mitgliedergrade::findOne($dataid);
			$txt = str_replace ( '#vorname#' , $model->mitglied->Vorname , $txt ); 
			$txt = str_replace ( '#nachname#' , $model->mitglied->Name , $txt );
			$txt = str_replace ( '#schulort#' , $model->mitglied->Schulort , $txt );
			$txt = str_replace ( '#grad#' , $model->grad->gKurz , $txt );
			$txt = str_replace ( '#print#' , $model->grad->print , $txt );
			$txt = str_replace ( '#sifu#' , $model->mitglied->Sifu , $txt );	
			$txt = str_replace ( '#heute#' , date("d.m.Y") , $txt );
            $email = $model->mitglied->Email;
		}

        if ($txtcode == 'EmailBegruessung') 
			$link = Yii::t('app', "Greet.-Email");
		else if ($txtcode == 'EmailAussetzen') 
			$link = Yii::t('app', "Susp.-Email");
		else if ($txtcode == 'EmailKuendigung') 
			$link = Yii::t('app', "Term.-Email");
		else if ($txtcode == 'EmailWTOnline') 
			$link = Yii::t('app', "WTO-Email");
		else if ($txtcode == 'EmailStandard') 
			$link = Yii::t('app', "Email");
		else $link = Yii::t('app', "by Email");						
		
		// Linefeed für Outlook ersetzen
		$txt = str_replace ( '<br>' , "%0D%0A" , $txt );
		
		//$txt = str_replace ( 'ü' , "&uuml;" , $txt );
        $t = ['betreff' => $textmodel->betreff, 'text' => $txt, 'link' => $link, 'email' => $email];
        return $t;
    }

    public static function createoutlooklink($datamodel, $dataid, $txtcode, $SchulId, $txtid)
    {
        $text = TexteController::textReplace($datamodel, $dataid, $txtcode, $SchulId, $txtid);
        
        if (empty($text['text'])) {
            return '<div class="btn btn-sm" style="width: 10em; text-align: left;background-color:lightgrey;color:grey;"><span class="fa fa-envelope"></span> per Email</div>';  

        } else {
    		$pdf = Html::mailto('<div class="btn btn-sm btn-default"	style="width: 10em; text-align: left;"><span class="fa fa-envelope"></span> &nbsp'.$text['link'].'</div>', Url::to($text['email']) .
    							"?subject=".$text['betreff']."&from="."verwaltung@wingtzun.de"."&body=".$text['text'],[
    									'title' => Yii::t('app', 'Send Email to Member'),
    					  	]);							
    	   return $pdf;
       }
    }

    public static function createoutlooklinkshort($datamodel, $dataid, $txtcode, $SchulId, $txtid)
    {
        $text = TexteController::textReplace($datamodel, $dataid, $txtcode, $SchulId, $txtid);
        
        if ((empty($text['text'])) or empty($text)){
            return '<span class="far fa-envelope"></span>';  

        } else {
    		$pdf = Html::mailto('<div class="btn btn-sm btn-default"	style="width: 2.3em; text-align: left;"><span class="fa fa-envelope"></span></div>', Url::to($text['email']) .
    							"?subject=".$text['betreff']."&from="."verwaltung@wingtzun.de"."&body=".$text['text'],[
    									'title' => Yii::t('app', 'Send Email to Member'),
    					  	]);							
    	   return $pdf;
       }
    }


}
