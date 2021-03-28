<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Schulleiterschulen */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Schulleiterschulen',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schulleiterschulens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schulleiterschulen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
