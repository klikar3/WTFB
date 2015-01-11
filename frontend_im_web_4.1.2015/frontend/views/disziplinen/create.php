<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Disziplinen */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Disziplinen',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disziplinens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disziplinen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
