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
                'brandLabel' => 'WTFB-Datenbank',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
								['label' => 'Home', 'url' => ['/site/index']],
            ];
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
																  	['label' => 'Interessent-Vorgaben', 'url' => ['/interessent-vorgaben/index']],
																  	['label' => 'Prüfer', 'url' => ['/pruefer/index']],
																  	['label' => 'Schulen', 'url' => ['/schulen/index']],
																  	['label' => 'Schulleiter', 'url' => ['/schulleiter/index']],
																  	['label' => 'Schulleiter-Schulen', 'url' => ['/schulleiterschulen/index']],
																  	['label' => 'Sifus', 'url' => ['/sifu/index']],
																  	['label' => 'Texte', 'url' => ['/texte/index']],
																  	['label' => 'User', 'url' => ['/user/admin/index']],
																  	['label' => 'Userprofil', 'url' => ['/user/admin/index']],
																]];
								}								
                $menuItems[] = ['label' => 'Bewegungsdaten', 'url' => ['/site/index'], 'items' => [
																  	['label' => 'Mitgliederliste', 'url' => ['/mitgliederliste/index']],
																  	['label' => 'Mitglieder', 'url' => ['/mitglieder/index']],
																  	['label' => 'Mitglieder Grade', 'url' => ['/mitgliedergrade/index']],
																  	['label' => 'Mitglieder Schulen', 'url' => ['/mitgliederschulen/index']],
																]];
//                $menuItems[] = ['label' => 'About', 'url' => ['/site/about']];
//                $menuItems[] = ['label' => 'Contact', 'url' => ['/site/contact']];
								$menuItems[] = ['label' => 'Account ('. Yii::$app->user->identity->username. ')', 'url' => ['/site/signup'],
																'items' =>[
																	['label' => 'Logout', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
																	['label' => 'Account', 'url' =>[ '/user/settings/account', 'id' => Yii::$app->user->identity->id], 'linkOptions' => ['data-method' => 'post']]],
																	];
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
													    'icon' => 'glyphicon glyphicon-exclamation-sign', 'body' => $message ]);
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
        <p class="pull-left">&copy; WT Data <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
