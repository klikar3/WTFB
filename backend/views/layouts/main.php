<?php
use backend\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;

use \dektrium\user\Module;

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
                'brandLabel' => '<img src="'.str_replace('/index.php','',Yii::$app->homeUrl).'/favicon2.ico?v=1" class="pull-left" width="25" height="25">&nbsp;WTFB - Anwesenheitsliste',
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => ['class' => 'container-fluid col-12 col-md-10 mt-auto'],
                'options' => [
//                    'class' => 'navbar-inverse navbar-fixed-top',
                 'class' => 'navbar navbar-expand-md bg-dark navbar-dark',
                   ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                $menuItems[] = ['label' => Yii::t('app','Login'), 'url' => ['/user/security/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
//                'options' => ['class' => 'navbar navbar-nav navbar-right'],
                'options' => ['class' =>'nav-pills ml-auto'], // set this to nav-tabs to get tab-styled navigation
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <br>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
