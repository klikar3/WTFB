<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Hilfe';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Dies ist die Hilfe-Seite. Ihr Inhalt kann geändert werden unter:</p>

    <code><?= __FILE__ ?></code>
</div>
<br>

Reihenfolge beim Anlegen eines neuen Users:
<ol><li>Schule(n) Anlegen. (Ort und Disziplin)
</li><li>Schulleiter anlegen.
</li><li>Schulleiter-Schulen anlegen für alle Schulen des Schulleiters.
</li><li>User anlegen mit LeiterId des Schulleiters.
</li>
</ol>