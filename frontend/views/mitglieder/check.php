<?php

use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
//use yii\helpers\BaseHtml;
use yii\bootstrap4\Html;
use yii\bootstrap4\BaseHtml;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Progress;
use yii\web\View;
use yii\widgets\DetailView;
use yii\helpers\Url;

use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitgliedersektionen;
use frontend\models\MitgliedersektionenSearch;
use frontend\models\Numbers;
use frontend\models\Pruefer;
use frontend\models\Texte;
/*
$this->registerJs('jquery');
$this->registerJs('ajax-percentage','
$(document).ready(function() {   var interval = 500;
   var refreshId = setInterval(function() { $.ajax(
        type: "GET",
        url: '.Yii::$app->urlManager->createUrl('mitglieder/getBuildPercentage').',
        success: function (percents) {
            // you have got your percents, so you can now assign it to progressbar value here
            $( "#progressbar" ).progressbar({
                value: = percents
        }
 )}, interval);
 alert(1);
}');
*/
?>
Seite
       <br />
        <input type="button" onclick="startTask();"  value="Start Long Task" />
        <input type="button" onclick="stopTask();"  value="Stop Task" />
        <br />
        <p>Results</p>
         
<?php // Pjax::begin(['id'=>'pjaxGridView_']); ?>
        <div id="results" style="border:1px solid #000; padding:10px; width:1200px; height:250px; overflow:auto; background:#eee;"><?= $result ?></div>
<?php // Pjax::end(); ?>
        <br />
<?php  /*
echo Progress::widget([
    'percent' => Mitglieder::getBuildPercentage(),
    'barOptions' => ['class' => 'progress-bar-danger'],
    'id' => 'progressbar'
]);  */
/*    $this->widget(
        'bootstrap.widgets.TbProgress',
        array(    
            'type' => 'success', 
            'percent' => Mitglieder::getBuildPercentage(),
            'htmlOptions' => array(
                'data-toggle' => 'tooltip',
                'title' => 'Approximately ...to go.'
                )                                
            )
        )*/
/* 
      <progress id='progressor' value="0" max='100' style=""></progress>  
        <span id="percentage" style="text-align:right; display:block; margin-top:5px;">0</span>
*/        
?> 
<div name="progBar" id="ajaxprogbar" class="progress-bar-show" style="font-family: Arial, Helvetica, sans-serif;">
<?php // Pjax::begin(['id'=>'pjaxGridView_']); ?>
<?php
     echo $this->renderAjax('progbar',['percent' => $percent]);  ?>
<?php // Pjax::end(); ?>
   
    <div id="app" style="display:none" data-done="<?= Yii::t('app', 'DONE') ?>" data-skipped="<?= Yii::t('app', 'SKIPPED') ?>" data-failed="<?= Yii::t('app', 'FAILED') ?>" ></div>

    <div id="info-panel" class="panel panel-info" style="display: none;">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Yii::t('app', 'Details') ?></h3>
        </div>
        <div id="info-body" class="panel-body">
            <div class="row" id="info-row">
                <div class="col-sm-5"></div>
                <div class="col-sm-7"></div>
            </div>
            <?= Html::tag('div', "", ['id' => 'detail-info']); ?>
        </div>
    </div>

    <div id="error-panel" class="panel panel-danger" style="display: none;">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Yii::t('app', 'Error Message') ?></h3>
        </div>
        <div class="panel-body">
            <?= Html::tag('div', "", ['id' => 'detail-error']); ?>
        </div>
    </div>
    
    <div id="options-panel">
        <div class="row" id="info-row">
            <div class="col-sm-6">
                <div class="well well-sm"><strong>Info!</strong> <?= Yii::t('app', 'Running this progress may take some time.') ?></div>
            </div>
            <div class="col-sm-3"> <label class="control-label"> <?= Yii::t('app', 'run third action?') ?> </label>
                 <?php
//                SwitchInput::widget(['name' => 'backpic', 'options' => ['id' => 'backpic'], 'value' => false, 'pluginOptions' => [
//                        'onText' => Yii::t('app', 'Yes'),
//                        'offText' => Yii::t('app', 'No')
//                ]]);
                ?>
            </div>
         
            <div class="col-sm-3"><br>
                <?php //echo Html::button(Yii::t('app', 'Start'), [ 'class' => 'btn btn-info', 'id'=> 'post-submit-btn']);
                //echo Html::button(Yii::t('app', 'Start'), [ 'class' => 'btn btn-info', 'onClick' => 'send();', 'id'=> 'post-submit-btn']);
                echo Html::a(Yii::t('app', 'Start'), ['/mitglieder/runcheck'], ['class'=>'btn btn-primary']) 
                ?>
            </div>
        </div>
    </div>
</div>

    

<script type="text/javascript">

function send() {
	var data= null; //$("#post-form").serialize();
//   alert(data);
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::$app->urlManager->createUrl("mitglieder/runcheck"); ?>',
			data:data,
			success:function(data) {
				// $("#list-of-post").append(data);
        $("#post-submit-btn").attr("disabled", false);
//        $("#results").append();
    //    addLog("...fertig");
//        $("progBar").percent = 5;
//				jQuery("#progbar").load("<?php echo Yii::$app->urlManager->createUrl("mitglieder/runcheck"); ?>");
//				$("#ForumPost_content").val('');
			},
			error: function(data) { // if error occured
				alert("Error occured.please try again");
				// alert(data);
			},
			dataType:'html'
		});
  $("#post-submit-btn").attr("disabled", "disabled");
  addLog("Starte...");
//  setintVal();
  return false;
}

/*$(document).ready(function() {
	$("#post-submit-btn").attr("disabled", "disabled");
        var refreshId = setInterval(function()
        {
            $.pjax.reload('#pjaxGridView_')
        }, 1000);
});
*/
function enableBtn(val) {
	if(val==null||val=="") {
		$("#post-submit-btn").attr("disabled", "disabled");
	} else {
		$("#post-submit-btn").removeAttr("disabled");
	}
}
/*
function setintVal(){
    setInterval(function() { $.ajax(
            type: "GET",
            url: '<?php echo Yii::$app->urlManager->createUrl('mitglieder/getBuildPercentage')?>',
            success: function (percents) {
                // you have got your percents, so you can now assign it to progressbar value here
                $( "#progressbar" ).progressbar({
                    value: = percents
            }
     )}, 500);
     alert("1");
    }
}
*/
</script>

<?php

$url = Yii::$app->urlManager->createUrl("/mitglieder/runcheck"); 
$url1 = Yii::$app->urlManager->createUrl("/mitglieder/check"); 
$js = <<< JS
    var es;
  
function startTask() {
    es = new EventSource('$url1');
      
    //a message is received
    es.addEventListener("message", function(e) {
        var result = JSON.parse( e.data );
          
        addLog(result.message);       
          
        if(e.lastEventId == "CLOSE") {
            addLog("Received CLOSE closing");
            es.close();
            var pBar = document.getElementById("progressor");
            pBar.value = pBar.max; //max out the progress bar
        }
        else {
            var pBar = document.getElementById("progressor");
            pBar.value = result.progress;
            var perc = document.getElementById("percentage");
            perc.innerHTML   = result.progress  + "%";
            perc.style.width = (Math.floor(pBar.clientWidth * (result.progress/100)) + 15) + "px";
        }
    });
      
    es.addEventListener("error", function(e) {
        addLog("Error occurred");
        es.close();
    });
    
		$.ajax({
			type: 'POST',
			url: '$url',
//			data:data,
			success:function() {
				// $("#list-of-post").append(data);
        $("#post-submit-btn").attr("disabled", "disabled");
			},
			error: function() { // if error occured
				alert("Error occured.please try again");
//				 alert(data);
			},
			dataType:'html'
		});
    
}
  
function stopTask() {
    es.close();
    addLog("Interrupted");
}
  
function addLog(message) {
    var r = document.getElementById("results");
    r.innerHTML += message + "<br>";
    r.scrollTop = r.scrollHeight;
}

JS;
$this->registerJs($js,View::POS_END);

?>