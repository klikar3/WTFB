<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedergrade */

$this->title = Yii::t('app', 'Graduierung vergeben').' für '.$model->mitglied->Vorname.' '. $model->mitglied->Name;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliedergrades'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitgliedergrade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ddataProvider' => $ddataProvider,
        'gdataProvider' => $gdataProvider,                
    ]) ?>

</div>
