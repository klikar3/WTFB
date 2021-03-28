<?php
use yii\bootstrap4\Html;
//use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = Yii::t('app','Language');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">


<br>
<div class="col-md-5 ">
  <div class="panel panel-info">
    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <br>
    <div class="row">
      <div class="col col-md-1">
      </div>
      <div class="col col-md-4">
      <?php
       $this->beginBlock('login', true);
      
          echo Html::beginForm(['site/language']). 
          Html::dropDownList('language', Yii::$app->language, 
              [
                  'en'    => 'English',
                  'de'    => 'Deutsch',    // 'Spanish',
                  'el'    => 'Greek',   // 'French',
              ], 
              [
                  'class' => 'form-control',
      //            'class' => 'panel panel-info',
                  'onchange' => "this.form.submit()"
              ]
          )
          .Html::endForm(); 
      
       $this->endBlock(); 
//      echo $this->blocks['login'];
      ?>
      <br>
      </div>
    </div>
  </div>
</div>
</div>
