<?php

use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

?>
<div class="row">
<div class="col-3">
<?php
echo '<img src="data:image/jpeg;base64,'.base64_encode($model['foto'] ).'" alt="Foto"/>';
			$form1 = ActiveForm::begin([
			    'options'=>[//'enctype'=>'multipart/form-data', 
                      'action' => Url::toRoute(['/mitglieder/upload', 'id' => $model->MitgliederId, 
													 				'tabnum' => 3]), // important
                      'target' => '_blank',
          ]           
			]);
		?>
<?php 
if (!empty($model['foto'])) {
  echo Html::a(Yii::t('app', 'Delete'),  
  	Url::to(['mitglieder/clear-foto', 'id' => $model->MitgliederId, 
			'tabnum' => 3 ] ), [
	           'title' => Yii::t('app', 'Delete foto'),
               'class'=>'btn btn-sm btn-danger',
	          'data' => [
	              'confirm' => Yii::t('app', 'Do you really want to delete this foto?'),
	              'method' => 'post',
			          ],
 	        ]);
}    

// echo '<br><p>Fuer Android hilft die App "Camera Folder" (FDroid) - dann kann direkt ein Foto aufgenommen werden.</p>';        
?> 
  
        
        
</div>        
<div class="col-9">	
		<?php	
			// A block file picker button with custom icon and label
//      Yii::$app->params['uploadUrl'] = Url::toRoute(['/mitgliederschulen/upload', 'id' => $model->msID, 
//													 				'tabnum' => 3 ] );
			echo FileInput::widget([
			    'name' => 'attachment_1'.$model->MitgliederId,
                'id' => 'attachment_1'.$model->MitgliederId,
			    'pluginOptions' => [
			        'showCaption' => true, //'action' => 'get',
			        'showRemove' => true,
			        'showUpload' => true,
                'uploadAsync' => true,
			        'uploadLabel' =>  Yii::t('app', 'Upload'),
			        'browseLabel' =>  Yii::t('app', 'Select File'),
			        'msgSizeTooLarge' => Yii::t('app', "The File '{name}'' ({size} KB) is bigger than the maximum allowed Size of {maxSize} KB!"),
//			        'previewClass' => '',
//			        'mainClass' => '',
			        'browseClass' => 'btn btn-default btn-sm',
			        'browseIcon' => '<i class="fa fa-file-alt"></i> ',
			        'maxFileSize' => 10240,
			        'maxFileCount' => 1,
			        'allowedFileExtensions' => ['jpg','gif','png','pdf'],
              'uploadPath' => 'D:'. DIRECTORY_SEPARATOR .'wamp64'. DIRECTORY_SEPARATOR .'tmp',
              'uploadUrl' => Url::toRoute(['/mitglieder/upload', 'id' => 'attachment_1'.$model->MitgliederId, 
													 				'tabnum' => 9]),//\Yii::$app->request->BaseUrl.'/index.php?r=mitgliederschulen/upload',
              'uploadExtraData' => [
                  'id' => 'attachment_1'.$model->MitgliederId,
                  'tabnum' => 9,
                  'modelId' => $model->MitgliederId
              ]
//			        'uploadUrl' => Url::to(['/mitgliederschulen/upload', 'id' => $model->msID, 
//													 				'tabnum' => 3 ] ),
			    ],
			    'options' => ['accept' => 'image/jpeg,application/pdf',
			    		'multiple' => false, 'id' => 'attachment_1'.$model->MitgliederId,
              'title' => Yii::t('app', 'Upload Foto into WT-Data'),
					],
//          'pluginEvents' => [
//              'fileuploaded' => 'this.form.submit()',
//          ],
			]);
//    echo Html::submitButton('Eintragen', ['class' => 'btn btn-sm btn-default']);  
			ActiveForm::end();
?>
</div>
</div>