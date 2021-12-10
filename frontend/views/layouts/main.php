<?php
//use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap4\Nav;
use yii\bootstrap4\Html;
use yii\bootstrap4\NavBar;

//use yii\widgets\Breadcrumbs;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap4\Widgets;
//use frontend\widgets\Alert;
//use yii\widgets\Menu;
use \dektrium\user\Module;


use kartik\nav\NavX;
use kartik\widgets\Alert; 
use kartik\widgets\AlertBlock;
use kartik\widgets\Growl;
//use kartik\icons\FontAwesomeAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
//FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
   <?php    

      $stammdaten[] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['/trainings/index']];      
      $bewegungsdaten[] =  ['label' => Yii::t('app', 'Presence'), 'url' => ['/anwesenheit/index']];
      $bewegungsdaten[] =  ['label' => Yii::t('app', 'Exams'), 'url' => ['/pruefungen/index']];
      										 
      $auswertungen[] = ['label' => Yii::t('app', 'Presence'), 'url' => ['/site/anwesenheit'],];
      $auswertungen[] = ['label' => Yii::t('app', 'Interessent.-List'), 'url' => ['/site/interessentenauswahl'],];
      $auswertungen[] = ['label' => Yii::t('app', 'EvalEvening-List'), 'url' => ['/site/infoabendauswahl'],
        //  							  	 'linkOptions' => ['target' => '_blank']
        ];
      $auswertungen[] = ['label' => Yii::t('app', 'TestTraining-List'), 'url' => ['/site/probetrainingauswahl'],];
      $auswertungen[] = ['label' => Yii::t('app', 'StudentNumbers'), 'url' => ['/site/schuelerzahlenauswahl'],];
      $auswertungen[] = ['label' => Yii::t('app', 'MemberNumbers'), 'url' => ['/site/mitgliederzahlen'],
          							  	 'linkOptions' => ['target' => '_blank']];
      $auswertungen[] = ['label' => Yii::t('app', 'SektionsList'), 'url' => ['/mitgliedersektionen/sektionsauswahl']]; 
      
      if (!empty(Yii::$app->user->identity)) {
          if (Yii::$app->user->identity->username == 'michael') {
          $auswertungen[] = ['label' => Yii::t('app', 'DVD-Liste'), 'url' => ['/site/dvdlistenauswahl']];                                                                
          }                                                               
                                      
          if (Yii::$app->user->identity->isAdmin /*role == 10*/) {
          
              $stammdaten[] =  ['label' => Yii::t('app', 'Salutations'), 'url' => ['/anrede/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Functions'), 'url' => ['/funktion/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Disciplins'), 'url' => ['/disziplinen/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Levels'), 'url' => ['/grade/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Intensiv'), 'url' => ['/intensiv/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Interessent-Defaults'), 'url' => ['/interessent-vorgaben/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Examiner'), 'url' => ['/pruefer/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Schools'), 'url' => ['/schulen/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Head Master'), 'url' => ['/schulleiter/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Head Master-Schools'), 'url' => ['/schulleiterschulen/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Sektions'), 'url' => ['/sektionen/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Sifus'), 'url' => ['/sifu/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Texts'), 'url' => ['/texte/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'Trainings'), 'url' => ['/trainings/index']];
              $stammdaten[] =  ['label' => Yii::t('app', 'User'), 'url' => ['/user/admin/index']];
      //        $stammdaten[] =  '<li role="presentation" class="divider"></li>';
              //																  	['label' => 'Userprofil', 'url' => ['/user/admin/index']],
              //								];
                                             
              
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Presence'), 'url' => ['/anwesenheit/index']];
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Exams'), 'url' => ['/pruefungen/index']];
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Member List'), 'url' => ['/mitgliederliste/index']];
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Members'), 'url' => ['/mitglieder/index']];
              $bewegungsdaten[] = ['label' => Yii::t('app', 'IntensivMembers'), 'url' => ['/mitglieder/intensiv-index']];
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Member Levels'), 'url' => ['/mitgliedergrade/index']];
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Member Schools'), 'url' => ['/mitgliederschulen/index']];
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Member Sektions'), 'url' => ['/mitgliedersektionen/index']];
      //        $bewegungsdaten[] = '<li role="presentation" class="divider"></li>';
              $bewegungsdaten[] = '<div class="dropdown-divider"></div>';
              $bewegungsdaten[] = ['label' => Yii::t('app', 'Check all Member Data'), 'url' => ['/mitglieder/check']];
                                        
              $auswertungen[] = ['label' => Yii::t('app', 'DVD-List'), 'url' => ['/site/dvdlistenauswahl']];  
              
              $aktionen[] =  ['label' => Yii::t('app', 'Really delete Members'), 'url' => ['/mitglieder/mark-really-delete']];                                                             
              $aktionen[] =  '<div class="dropdown-divider"></div>';
              $aktionen[] =  ['label' => Yii::t('app', 'Woo-WT-Shop - SWM Adjustment'), 'url' => ['/site/woo-swm-abgleich']];
              $aktionen[] =  ['label' => Yii::t('app', 'Woo-WTO-Shop - SWM Adjustment'), 'url' => ['/site/woo-aka-swm-abgleich']];
              $aktionen[] =  ['label' => Yii::t('app', 'SWM blocked Emails'), 'url' => ['/swm-blocked-emails/index']];
      //        $stammdaten[] =  '<li role="presentation" class="divider"></li>';
              $aktionen[] =  '<div class="dropdown-divider"></div>';
              $aktionen[] =  ['label' => Yii::t('app', 'DB-Backup'), 'url' => ['/backup']];
          }
      
      }                                
                                      
      
                  if (Yii::$app->user->isGuest) {
      //                $menuItems[] = ['label' => 'About', 'url' => ['/site/about']];
      //                $menuItems[] = ['label' => 'Contact', 'url' => ['/site/contact']];
      //                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                      $menuItems[] = ['label' => Yii::t('app','Login'), 'url' => ['/user/security/login']];
                      $menuItems[] = ['label' => Yii::t('app', 'Language'), 'url' => ['/site/select-language'], 'linkOptions' => ['data-method' => 'post']];
                  } else {
                      if (Yii::$app->user->identity->isAdmin /*role == 10*/) {
                        $menuItems[] = ['label' => Yii::t('app', 'Actions'), 'url' => ['/site/index'], 'items' => $aktionen];
                      }
                      $menuItems[] = ['label' => Yii::t('app', 'Base data'), 'url' => ['/site/index'], 'items' => $stammdaten]; 
                      $menuItems[] = ['label' => Yii::t('app', 'Moving data'), 'url' => ['/site/index'], 'items' => $bewegungsdaten];
       					 		  $menuItems[] = ['label' => Yii::t('app', 'Reports'), 'url' => ['/site/index'], 'items' => $auswertungen];
      								$menuItems[] = ['label' => Yii::t('app', 'Account ('). Yii::$app->user->identity->username. ')', 'url' => ['/site/signup'],
      																'items' =>[
      																	['label' => Yii::t('app', 'Language'), 'url' => ['/site/select-language'], 'linkOptions' => ['data-method' => 'post']],
      																	['label' => Yii::t('app', 'Account'), 'url' =>[ '/user/admin/update-profile', 'id' => Yii::$app->user->identity->id], 'linkOptions' => ['data-method' => 'post']],
      																	['label' => Yii::t('app', 'Logout'), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']]],
      																	];
                      $menuItems[] = ['label' => '?', 'url' => ['/site/about']];
      /*                $menuItems[] = [
      	                ['label' => 'Account ('. Yii::$app->user->identity->username. ')', 
      									 'url' => ['/site/index'], 'items' => [
                          ['label' => 'Logout', 'url' => ['/user/security/logout']],
      	                  ['label' => 'Account', 'url' =>[ Url::toRoute(['/user/settings/account', 'id' => Yii::$app->user->identity->id])]],
      									 ]],
                      ];
      */            }
      /*            $menuItems[] = $this->blocks['login']; [
                    'label' => Yii::$app->language, 
      							 'items' => $this->blocks['login'],
                        ['label' => 'English', 'url' => [ '/site/language', 'language' => 'en'], 'linkOptions' => ['data-method' => 'post']],
                        ['label' => 'Deutsch', 'url' => [ '/site/language', 'language' => 'de'], 'linkOptions' => ['data-method' => 'post']],
                        ['label' => 'Greek', 'url' => [ Url::to(['/site/language', 'language' => 'el'])]],
      							 ]
                  ];
      */ //         echo $this->blocks['login'];
    $bl = '<img src="'.str_replace('/index.php','',Yii::$app->homeUrl).'/favicon3.ico?v=1" class="pull-left" width="25" height="25">&nbsp;WTFB-Data';
  ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>/../favicon3.ico">
    <script defer src="https://use.fontawesome.com/releases/v5.15.2/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/solid.css" rel="stylesheet"> 
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
  <wrapper class="d-flex flex-column">
    <div class="menu-container">
       <?php
            NavBar::begin([
                'id' => 'mainNav',
                'brandLabel' => $bl,
                'brandUrl' => Url::to(['/', 'language' => Yii::$app->language]),
                'innerContainerOptions' => ['class' => 'container-fluid col-12 col-md-10 mt-auto'],
                'options' => [
                    //'class' => 'navbar-inverse navbar-fixed-top', 
                    //'class' => 'navbar navbar-expand-lg navbar-light bg-light',
                    'class' => 'navbar navbar-expand-md bg-dark navbar-dark',
                ],
            ]); 
       ?>
       <?php
             echo NavX::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => $menuItems,
                'activateParents' => true,
                'encodeLabels' => false,
            ]);
       ?>
       <?php
            NavBar::end();
       ?>
    </div>

    <div class="container container-fluid flex-fill col-12 col-md-10">
      <?= Breadcrumbs::widget([
          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          'homeLink' =>['url' => Yii::$app->homeUrl.'/'.Yii::$app->language, 'label' => Yii::t('app', 'Home')], 
      ]) ?>
      <?php echo AlertBlock::widget([
          'useSessionFlash' => true,
          'type' => AlertBlock::TYPE_ALERT
        ]);        ?>
      <?= $content ?>   
  
    </div>     
    <footer class="footer col-12 col-md-10 mt-auto container">
        <div class="col-xs-2 float-left">
            <span class="d-none d-xl-block font-italic font-weight-light">(XL)    &copy; WTFB <?= date('Y') ?></span>
            <span class="d-none d-lg-block d-xl-none font-italic font-weight-light">(LG)    &copy; WTFB <?= date('Y') ?></span>
            <span class="d-none d-md-block d-lg-none font-italic font-weight-light">(MD)    &copy; WTFB <?= date('Y') ?></span>
            <span class="d-none d-sm-block d-md-none font-italic font-weight-light">(SM)    &copy; WTFB <?= date('Y') ?></span>
            <span class="d-block d-sm-none font-italic font-weight-light">(XS)    &copy; WTFB <?= date('Y') ?></span>
        </div>
        <div class="col-xs-10 float-right font-italic font-weight-light">
          Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a>&nbsp;<?= Yii::getVersion() ?>         
        </div>
    </footer>
  </wrapper>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
