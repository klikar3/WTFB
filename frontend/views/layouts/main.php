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

</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'WTFB-Data',
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
            		if (Yii::$app->user->identity->isAdmin /*role == 10*/) {
                $menuItems[] = ['label' => 'Stammdaten', 'url' => ['/site/index'], 'items' => [
																  	['label' => 'Anreden', 'url' => ['/anrede/index']],
																  	['label' => 'Funktionen', 'url' => ['/funktion/index']],
																  	['label' => 'Disziplinen', 'url' => ['/disziplinen/index']],
																  	['label' => 'Grade', 'url' => ['/grade/index']],
																  	['label' => 'Intensiv', 'url' => ['/intensiv/index']],
																  	['label' => 'Interessent-Vorgaben', 'url' => ['/interessent-vorgaben/index']],
																  	['label' => 'Prüfer', 'url' => ['/pruefer/index']],
																  	['label' => 'Schulen', 'url' => ['/schulen/index']],
																  	['label' => 'Schulleiter', 'url' => ['/schulleiter/index']],
																  	['label' => 'Schulleiter-Schulen', 'url' => ['/schulleiterschulen/index']],
																  	['label' => 'Sektionen', 'url' => ['/sektionen/index']],
																  	['label' => 'Sifus', 'url' => ['/sifu/index']],
																  	['label' => 'Texte', 'url' => ['/texte/index']],
																  	['label' => 'User', 'url' => ['/user/admin/index']],
																  	'<li role="presentation" class="divider"></li>',
																  	['label' => 'DB-Backup', 'url' => ['/backup']],
//																  	['label' => 'Userprofil', 'url' => ['/user/admin/index']],
																]];
                $menuItems[] = ['label' => 'Bewegungsdaten', 'url' => ['/site/index'], 'items' => [
																  	['label' => 'Prüfungen', 'url' => ['/pruefungen/index']],
																  	['label' => 'Mitgliederliste', 'url' => ['/mitgliederliste/index']],
																  	['label' => 'Mitglieder', 'url' => ['/mitglieder/index']],
																  	['label' => 'IntensivMitglieder', 'url' => ['/mitglieder/intensiv-index']],
																  	['label' => 'Mitglieder Grade', 'url' => ['/mitgliedergrade/index']],
																  	['label' => 'Mitglieder Schulen', 'url' => ['/mitgliederschulen/index']],
																  	['label' => 'Mitglieder Sektionen', 'url' => ['/mitgliedersektionen/index']],
																  	'<li role="presentation" class="divider"></li>',
																  	['label' => 'Alle Mitglieder-Daten Checken', 'url' => ['/mitglieder/check']],
																]];
/*                $menuItems[] = ['label' => 'System', 'url' => ['/backup'], 'items' => [
																  	['label' => 'DB-Backup', 'url' => ['/backup']],
																]];
*/							}	else {
                $menuItems[] = ['label' => 'Bewegungsdaten', 'url' => ['/site/index'], 'items' => [
																  	['label' => 'Prüfungen', 'url' => ['/pruefungen/index']],
																]];
                }							
//                $menuItems[] = ['label' => 'Contact', 'url' => ['/site/contact']];
                $menuItems[] = ['label' => 'Auswertungen', 'url' => ['/site/index'], 'items' => [
                                    ['label' => 'Interessenten-Liste', 'url' => ['/site/interessentenauswahl'],],
                                    ['label' => 'InfoAbend-Liste', 'url' => ['/site/infoabendauswahl'],
//																  	 'linkOptions' => ['target' => '_blank']
                                    ],
																  	['label' => 'SchülerZahlen', 'url' => ['/site/schuelerzahlenauswahl'],],
																  	['label' => 'MitgliederZahlen', 'url' => ['/site/mitgliederzahlen'],
																  	 'linkOptions' => ['target' => '_blank']],
																  	['label' => 'Sektionsliste', 'url' => ['/mitgliedersektionen/sektionsauswahl'],],
//																  	['label' => 'Geburtstagsliste', 'url' => ['/site/geburtstagsliste'],],
																]];
								$menuItems[] = ['label' => 'Account ('. Yii::$app->user->identity->username. ')', 'url' => ['/site/signup'],
																'items' =>[
																	['label' => 'Logout', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
																	['label' => 'Account', 'url' =>[ '/user/admin/update-profile', 'id' => Yii::$app->user->identity->id], 'linkOptions' => ['data-method' => 'post']]],
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
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);            
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
