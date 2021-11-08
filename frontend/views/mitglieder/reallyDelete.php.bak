<?php

//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Really delete Members');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('
$(document).on("click","#delete",function(e){
    let selected=$(".grid-view>table>tbody :input"); 
    let data = selected.serialize(); 
    if(selected.length){
        let confirmDelete = confirm("Are you sure you want to delete?");
        if(confirmDelete){
            $.ajax({
                url:"really-delete",
                data:data,
                dataType:"json",
                method:"post",
                success:function(data){
                    if(data.success){
                        $.pjax({container:"#my-grid"});
                    }else{
                        alert(data.msg);
                    }
                },
                error:function(error,responseText,code){}
            });
        }
    } else { 
        alert("select some items to delete");
    }
});
', \yii\web\view::POS_READY);

$this->registerJs(
    "$(document).ready(function(){
      if (".$backAchtung." == 1) {
        $('#mg-back-mod').modal('show');
        return true;
      }  
    });");

?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
   <h5><?= Html::encode($this->title) ?></h5>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="alert alert-warning">
        <p><?= Yii::t('app', 'No Backup - no Pity!') ?></p>
    </div>

    <p>
    <?=  ($backAchtung == 1) ?
    Html::button(Yii::t('app', 'Delete marked records'), ['class' => 'btn btn-danger', 'id' => 'delete', 'disabled' => 'disabled'])
    : Html::button(Yii::t('app', 'Delete marked records'), ['class' => 'btn btn-danger', 'id' => 'delete'])?>
        
    </p>
  </div>
  <div class="card-body border-primary bg-light">
<?php Pjax::begin(['id' => 'my-grid']);
//foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
//    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
//}
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => \yii\grid\CheckboxColumn::className(),
                      'checkboxOptions' => function ($a) {
                          return ['value' => $a->MitgliederId];
                      }],

            'MitgliederId',
            'MitgliedsNr',
            'Vorname',
            'Name',
//            'Geschlecht',
            'RecDeleted',
            'Schulort',
             'Disziplin',
            // 'BListe',
            // 'DVDgesendetAm',

         ],             
    ]); ?>
<?php Pjax::end();?>
</div>
 <div id="modal" class="d-block">    
 <?php // echo function_exists('proc_open') ? "Yep, that will work" : "Sorry, that won't work";
 ?>
			<?php Modal::begin([ 'id' => 'mg-back-mod',
				'title' => '<center><h5>Achtung! Heute wurde noch kein Backup erstellt. Daher kann ich keine Löschungen erlauben!</h5></center>',
//				'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i><i class="fa glyphicon glyphicon-envelope"></i>', 'class' => 'btn btn-success', 
//													'title'=>'Neues Mitglied aus Email anlegen'],
				'size'=>'modal-md', 
				'clientOptions' => [ 
            'style' => 'adjust:center;',
						'backdrop' => true,
						'keyboard' => true,'tabindex'=>'-1',
				],					
        'headerOptions' => ['class' => ' bg-danger',]
		]);
		?>
              Der letzte Backup stammt vom <?php echo $lastDate->format('d.m.Y') ?>. Bitte erstelle einen neuen Backup!
							<div class="row">																	
							<div class="col-xs-1 col-sm-2 col-md-2 col-lg-2">
							</div>
							<div class="col-xs-4 col-sm-8 col-md-8 col-lg-8">

			<div style="float:right;margin-bottom: 8px;" class="row"> <br>
				<?= Html::a('Db Backup erstellen >>', ['/backup'], ['class'=>'btn btn-sm btn-success', 'style'=>"margin-right:5px;"]) . "  &nbsp;" 
				?>
			</div>
     </div> 
     </div>
		<?php Modal::end();
		
		// class="col-xs-8 col-xs-offset-1 col-sm-8 col-sm-offset-1"                      class="col-md-offset-4 
		//col-xs-11 col-sm-11 col-md-11 col-lg-11 
		//    col-md-offset-2"  		   				style="text-align:right;"
		?>
