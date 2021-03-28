<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\SwmBlockedEmails */

$this->title = Yii::t('app', 'Create Swm Blocked Emails');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Swm Blocked Emails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="swm-blocked-emails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
