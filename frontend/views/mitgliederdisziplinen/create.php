<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliederdisziplinen */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Mitgliederdisziplinen',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliederdisziplinens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitgliederdisziplinen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
