<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliederschulen */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Mitgliederschulen',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliederschulens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitgliederschulen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
