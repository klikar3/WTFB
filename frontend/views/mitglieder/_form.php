<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitglieder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MitgliederId')->textInput() ?>

    <?= $form->field($model, 'MitgliedsNr')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'Vorname')->textInput(['maxlength' => 18]) ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => 29]) ?>

    <?= $form->field($model, 'RecDeleted')->textInput() ?>

    <?= $form->field($model, 'Geschlecht')->textInput(['maxlength' => 9]) ?>

    <?= $form->field($model, 'Anrede')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'GeburtsDatum')->textInput(['maxlength' => 19]) ?>

    <?= $form->field($model, 'PLZ')->textInput(['maxlength' => 13]) 
		?>

    <?= $form->field($model, 'Wohnort')->textInput(['maxlength' => 25]) 
		?>

    <?= $form->field($model, 'Strasse')->textInput(['maxlength' => 35]) 
		?>

    <?= $form->field($model, 'Telefon1')->textInput(['maxlength' => 18]) 
		?>

    <?= $form->field($model, 'Telefon2')->textInput(['maxlength' => 14]) 
		?>

    <?= $form->field($model, 'HandyNr')->textInput(['maxlength' => 18]) 
		?>

    <?= $form->field($model, 'Fax')->textInput(['maxlength' => 13]) 
		?>

    <?= $form->field($model, 'LetzteAenderung')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => 42]) 
		?>

    <?= $form->field($model, 'Beruf')->textInput(['maxlength' => 35]) 
		?>

    <?= $form->field($model, 'Nationalitaet')->textInput(['maxlength' => 22]) 
		?>

    <?= $form->field($model, 'BLZ')->textInput(['maxlength' => 9]) 
		?>

    <?= $form->field($model, 'Bank')->textInput(['maxlength' => 45]) 
		?>

    <?= $form->field($model, 'KontoNr')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Status')->textInput(['maxlength' => 17]) 
		?>

    <?= $form->field($model, 'AktivPassiv')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Kontoinhaber')->textInput(['maxlength' => 31]) 
		?>

    <?= $form->field($model, 'Schulort')->textInput(['maxlength' => 13]) 
		?>

    <?= $form->field($model, 'Disziplin')->textInput(['maxlength' => 20]) 
		?>

    <?= $form->field($model, 'Funktion')->textInput(['maxlength' => 16]) 
		?>

    <?= $form->field($model, 'Sifu')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'Woher')->textInput(['maxlength' => 27]) 
		?>

    <?= $form->field($model, 'Graduierung')->textInput(['maxlength' => 16]) 
		?>


    <?= $form->field($model, 'Geburtsort')->textInput(['maxlength' => 26]) 
		?>

    <?= $form->field($model, 'GruppenArt')->textInput(['maxlength' => 18]) 
		?>


    <?= $form->field($model, 'AufnahmegebuehrBezahlt')->textInput(['maxlength' => 14]) 
		?>

    <?= $form->field($model, 'EWTONr')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'EWTOAustritt')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'BeitragOffenAb')->textInput(['maxlength' => 18]) 
		?>

    <?= $form->field($model, 'BeitragOffenEuro')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'BeitragOffenBis')->textInput(['maxlength' => 13]) 
		?>

    <?= $form->field($model, 'Mahngebuehren')->textInput(['maxlength' => 9])
		 ?>

    <?= $form->field($model, 'GesamtOffen')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Mahnung1Am')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'Mahnung2Am')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'Mahnung3Am')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'BarZahlungAm')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'InkassoAm')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'Zahlungsfrist')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'Bemerkungen')->textInput(['maxlength' => 294]) 
		?>

    <?= $form->field($model, 'Betreff')->textInput(['maxlength' => 30]) 
		?>

    <?= $form->field($model, 'Text')->textInput(['maxlength' => 426]) 
		?>

    <?= $form->field($model, 'KontaktAm')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'KontaktArt')->textInput(['maxlength' => 5]) 
		?>

    <?= $form->field($model, 'Bemerkung1')->textInput(['maxlength' => 27]) 
		?>

    <?= $form->field($model, 'EinladungIAzum')->textInput(['maxlength' => 10]) 
		?>

    <?php // $form->field($model, 'warZumIAda')->textInput(['maxlength' => 6]) 
		?>

    <?= $form->field($model, 'zumIAnichtDa')->textInput(['maxlength' => 6]) 
		?>

    <?= $form->field($model, 'ProbetrainingAm')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'PTwarDa')->textInput(['maxlength' => 6]) 
		?>

    <?= $form->field($model, 'zumPTnichtDa')->textInput(['maxlength' => 6]) 
		?>

    <?= $form->field($model, 'VertragAbgeschlossen')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'VertragMit')->textInput() 
		?>

    <?= $form->field($model, 'Abschlussgespraech')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Bemerkung2')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'WTPruefungZum')->textInput(['maxlength' => 14]) 
		?>

    <?= $form->field($model, 'WTPruefungAm')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'KPruefungZum')->textInput(['maxlength' => 12]) 
		?>

    <?= $form->field($model, 'KPruefungAm')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'EPruefungZum')->textInput(['maxlength' => 12]) 
		?>

    <?= $form->field($model, 'EPruefungAm')->textInput(['maxlength' => 18]) 
		?>

    <?= $form->field($model, 'GutscheinVon')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Name2Schule')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'DM2Schule')->textInput(['maxlength' => 5]) 
		?>

    <?= $form->field($model, 'NeuerBeitrag')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Vereinbarung')->textInput(['maxlength' => 9]) 
		?>

    <?= $form->field($model, 'RechnungsNr')->textInput(['maxlength' => 1]) 
		?>

    <?= $form->field($model, 'VErgaenzungAb')->textInput(['maxlength' => 9]) 
		?>

    <?= $form->field($model, 'Land')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'AussetzenDauer')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Betrag')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'BezahltAm')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'ZahlungsweiseBetrag')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'AufnahmegebuehrBezahltAm')->textInput(['maxlength' => 19]) 
		?>


    <?= $form->field($model, 'SFirm')->textInput() 
		?>

    <?= $form->field($model, 'BListe')->textInput() 
		?>

    <?= $form->field($model, 'DVDgesendetAm')->textInput(['maxlength' => 19]) 
		?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
