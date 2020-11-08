<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
//use frontend\widgets\Alert;
use yii\widgets\Menu;
use \dektrium\user\Module;

use kartik\widgets\Alert; 
use kartik\widgets\AlertBlock;
use kartik\widgets\Growl;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>/../favicon3.ico">
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
          
<?php
 $this->beginBlock('login', true);

    echo Html::beginForm(['site/language','class' => 'navbar-nav navbar-right',]). 
    Html::dropDownList('language', Yii::$app->language, 
        [
            'en'    => 'English',
            'de'    => 'Deutsch',    // 'Spanish',
            'el'    => 'Greek',   // 'French',
        ], 
        [
//            'class' => 'form-control',
            'class' => 'navbar-nav navbar-right',
            'onchange' => "this.form.submit()"
        ]
    )
    .Html::endForm(); 

 $this->endBlock(); 
?>

<?php       
$stammdaten[] = ['label' => Yii::t('app', 'Trainings'), 'url' => ['/trainings/index']];      
$bewegungsdaten[] =  ['label' => Yii::t('app', 'Presence'), 'url' => ['/anwesenheit/index']];
$bewegungsdaten[] =  ['label' => Yii::t('app', 'Exams'), 'url' => ['/pruefungen/index']];
										 
$auswertungen[] = ['label' => Yii::t('app', 'Presence'), 'url' => ['/site/anwesenheit'],];
$auswertungen[] = ['label' => Yii::t('app', 'Interessent.-List'), 'url' => ['/site/interessentenauswahl'],];
$auswertungen[] = ['label' => Yii::t('app', 'EvalEvening-List'), 'url' => ['/site/infoabendauswahl'],
  //  							  	 'linkOptions' => ['target' => '_blank']
                      ];
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
        $stammdaten[] =  '<li role="presentation" class="divider"></li>';
        $stammdaten[] =  ['label' => Yii::t('app', 'Woo-SWM Adjustment'), 'url' => ['/site/woo-swm-abgleich']];
        $stammdaten[] =  ['label' => Yii::t('app', 'SWM blocked Emails'), 'url' => ['/swm-blocked-emails/index']];
        $stammdaten[] =  '<li role="presentation" class="divider"></li>';
        $stammdaten[] =  ['label' => Yii::t('app', 'DB-Backup'), 'url' => ['/backup']];
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
        $bewegungsdaten[] = '<li role="presentation" class="divider"></li>';
        $bewegungsdaten[] = ['label' => Yii::t('app', 'Check all Member Data'), 'url' => ['/mitglieder/check']];
                                  
        $auswertungen[] = ['label' => Yii::t('app', 'DVD-List'), 'url' => ['/site/dvdlistenauswahl']];                                                                
    }

}                                
                                

            NavBar::begin([
                'brandLabel' => '<img src="/frontend/favicon3.ico?v=1" class="pull-left" width="16" height="16">&nbsp;WTFB-Data',
//                'brandLabel' => 'WTFB-Data',
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => ['class' => 'container-fluid'],
                'options' => [
                    'class' => 'navbar navbar-inverse navbar-fixed-top',
                ],
            ]);
            if (Yii::$app->user->isGuest) {
//                $menuItems[] = ['label' => 'About', 'url' => ['/site/about']];
//                $menuItems[] = ['label' => 'Contact', 'url' => ['/site/contact']];
//                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
            } else {
                $menuItems[] = ['label' => Yii::t('app', 'Base data'), 'url' => ['/site/index'], 'items' => $stammdaten ]; 
                $menuItems[] = ['label' => Yii::t('app', 'Moving data'), 'url' => ['/site/index'], 'items' => $bewegungsdaten];
 					 		  $menuItems[] = ['label' => Yii::t('app', 'Reports'), 'url' => ['/site/index'], 'items' => $auswertungen];
								$menuItems[] = ['label' => Yii::t('app', 'Account ('). Yii::$app->user->identity->username. ')', 'url' => ['/site/signup'],
																'items' =>[
																	['label' => Yii::t('app', 'Logout'), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
																	['label' => Yii::t('app', 'Account'), 'url' =>[ '/user/admin/update-profile', 'id' => Yii::$app->user->identity->id], 'linkOptions' => ['data-method' => 'post']]],
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
*/          echo $this->blocks['login'];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right', 'style' => 'margin-right:0px;'],
                'items' => $menuItems,
            ]);   ?>
<?php                        
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 
        ]) ?>
        <?php /*echo Alert::widget()*/ 
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
Alert::widget(['delay'=>false, 'options'=>['id'=>'alert-id'], 'type'=>Alert::TYPE_DANGER,
													    'icon' => 'glyphicon glyphicon-exclamation-sign', 'body' => "Alert: ".$message ]);
//echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}			
				?>
        <?php echo AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => AlertBlock::TYPE_ALERT
]);/*echo Alert::widget(['delay'=>false, 'options'=>['id'=>'alert-id'], 'type'=>Alert::TYPE_DANGER,
													    'icon' => 'glyphicon glyphicon-exclamation-sign', ]); // will display `error` flash messages
*/        ?>
        <?= $content ?>   

        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left"><span class="hidden-xs hidden-sm hidden-md hidden-lg"> XL </span>
<span class="hidden-xs hidden-sm hidden-md hidden-xl">(LG)</span>
<span class="hidden-xs hidden-sm hidden-lg hidden-xl">(MD)</span>
<span class="hidden-xs hidden-md hidden-lg hidden-xl">(SM)</span>
<span class="hidden-sm hidden-md hidden-lg hidden-xl">(XS)</span>
    &copy; WTFB <?= date('Y') ?></p>
        <p class="pull-right">Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a>&nbsp;<?= Yii::getVersion() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
