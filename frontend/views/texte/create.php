<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Texte */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Texte',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Texte'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="texte-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
