<?php

use yii\helpers\Html;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\MitgliedergradePrint;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedergradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$mitglied = $model->mitglied;
$mgrad = Mitgliedergrade::find()->andWhere(['MitgliedId' => $mitglied->MitgliederId])->orderBy('datum desc')->one();//->max('Datum');
if (!empty($mgrad)) {
$grad = Grade::find()->andWhere(['gradId' => $mgrad->GradId])->one();
if (!empty($grad)) {
		$lastGrad = $grad->sort . '.'; // . ' ' . $grad->DispName;
//		Yii::trace($lastGrad);
	}
}

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


		<div class="wtfb-name" style="position: absolute; top: 80mm; left: 5mm; width: 200mm; text-align: center; font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 32px; font-weight: bold;">
			<?= $mitglied->Vorname . ' ' . $mitglied->Name ?> 
		</div>
		<div class="wtfb-grad" style="position: absolute; top: 98mm; left: 55mm; width: 45mm; text-align: center; font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 16px; font-weight: bold;">
			<?= $lastGrad ?>
		</div>
		<div class="wtfb-datum" style="position: absolute; top: 240mm; left: 35mm; width: 45mm; text-align: center; font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 16px; font-weight: bold;">
			<?= Yii::$app->formatter->asDatetime($model->Datum, "php:d.m.Y"); ?>
		</div>

</html>
