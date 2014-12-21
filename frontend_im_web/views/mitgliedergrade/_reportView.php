<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliedergradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$mitglied = $model->mitglied;
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


		<div style="position: absolute; top: 86mm; left: 5mm; width: 200mm; text-align: center;  font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 22px; font-weight: bold;">
			<font size="22px" ><b><?= $mitglied->Vorname . ' ' . $mitglied->Name ?></b></font> 
		</div>
		<div style="position: absolute; top: 102mm; left: 70mm; width: 45mm;  font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 16px; font-weight: bold;">
			1. (erste)
		</div>

</html>
