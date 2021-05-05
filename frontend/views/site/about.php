<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
//use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Hilfe';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>


<br>


Videos: <br> <br>

<?= Html::a('DATA Nr. 1 - Programmübersicht, Menü und Personendaten, was findest du wo', 
              '/DATA Nr. 1 - Programmübersicht, Menu und Personendaten, was findest du wo.mp4', [
													'class'=>'btn btn-success',
													'target'=>'_blank',
//													'data-confirm' => 'Wirklich die Prüfungsmarkierungen und Druckmarkierungen zurücksetzen?',
//													'data-toggle'=>'tooltip',
//													'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
													]) ?>    <br>   <br>
<?= Html::a('DATA Nr. 2 - Interessent anlegen, Info Abend und Interessenten Liste generieren', '/DATA Nr. 2 - Interessent anlegen, Info Abend und Interessenten Liste generieren.mp4', [
													'class'=>'btn btn-success',
													'target'=>'_blank',
//													'data-confirm' => 'Wirklich die Prüfungsmarkierungen und Druckmarkierungen zurücksetzen?',
//													'data-toggle'=>'tooltip',
//													'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
													]) ?>  <br>   <br>
<?= Html::a('DATA Nr. 3 - Neues Mitglied erfassen', '/DATA Nr. 3 - Neues Mitglied erfassen.mp4', [
													'class'=>'btn btn-success',
													'target'=>'_blank',
//													'data-confirm' => 'Wirklich die Prüfungsmarkierungen und Druckmarkierungen zurücksetzen?',
//													'data-toggle'=>'tooltip',
//													'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
													]) ?>   <br>   <br>
<?= Html::a('DATA Nr. 4 - Teilnehmerzahlen vom Training erfassen und auswerten', '/DATA Nr. 4 - Teilnehmerzahlen vom Training erfassen und auswerten.mp4', [
													'class'=>'btn btn-success',
													'target'=>'_blank',
//													'data-confirm' => 'Wirklich die Prüfungsmarkierungen und Druckmarkierungen zurücksetzen?',
//													'data-toggle'=>'tooltip',
//													'title'=>'Setzt alle Markierungen für die Prüfungsliste zurück'
													]) ?>

                           <br> <br><hr> <br>Admin: <br>
                           Reihenfolge beim Anlegen eines neuen Users:
<ol><li>Schule(n) Anlegen. (Ort und Disziplin)
</li><li>Schulleiter anlegen.
</li><li>Schulleiter-Schulen anlegen für alle Schulen des Schulleiters.
</li><li>User anlegen mit LeiterId des Schulleiters.
</li>
</ol>
<hr>
Admin:<br>
Einstellen der SuperWebMailer - Eintragungs-Buttons:
<ol>
<li>Im SWM Empfängerliste erstellen</li>
<li>Im SWM unter Einstellungen - HTML-Seiten/Umleitungen 2 Seiten erstellen: eine für Fehlerhafte und eine für erfolgreiche Anmeldung</li>
<li>Im SWM unterWebseite - An-und Abmeldeformulare ein Anmeldeformular für die Empfängerliste erstellen und bei Ausgabe die jeweiligen Webseiten eintragen</li>

<li>In Data bei der Schule die Nummern der Empfängerliste und des Formulars eintragen</li>
<li>Das ganze für jede Schule einmal für die Interessenten und einmal für die Mitglieder</li>
</ol>
<hr>
    <p>Dies ist die Hilfe-Seite. Ihr Inhalt kann geändert werden unter:</p>

    <code><?= __FILE__ ?></code>
</div>
