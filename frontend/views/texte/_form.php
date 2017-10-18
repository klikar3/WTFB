<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use moonland\tinymce\TinyMCE;

use frontend\models\Schulen;
use frontend\models\Texte;

/* @var $this yii\web\View */
/* @var $model frontend\models\Texte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="texte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 50])->label('Beschreibung') ?>

    <?= $form->field($model, 'fuer')->dropdownList(array_merge([""=>"","vertrag"=>"vertrag","grad"=>"grad"],ArrayHelper::map( Texte::find()->all(), 'fuer', 'fuer' ) )
												)->label('Für Tabelle') ?>

    <?= $form->field($model, 'SchulId')->dropdownList(ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp' ),
													[ 'prompt' => 'Schule', 'id' => 'field-pid' ])->label('Schule'); ?>

		<?php if (strpos($model->code,'Email') !== false) {
							echo $form->field($model, 'txt')->textarea(['rows' => '6','maxlength' => true]); }
					else
				echo $form->field($model, 'txt')->widget(TinyMCE::className(), [
				    'toggle' => [
				        'active' => true,
				    ],
				    'toolbar' => [
							'newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect',
  						'cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor',
 '						table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft'								
/*								'undo redo',
								'fontsizeselect',
								'bold italic underline',
								'alignleft aligncenter alignright alignjustify',
								'bullist numlist outdent indent',
								'link image',
//								'forecolor backcolor',
								'print preview code fullscreen codesample about',
*/						],
						'content_css' => [
					    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
					    '//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.css',
					    '//www.tinymce.com/css/codepen.min.css'    
					  ],
					]);
/*				$form->field($model, 'txt')->widget(CKEditor::className(), [
        'options' => ['rows' => 16],
        'preset' => 'full',
        'clientOptions' => [
						'startupMode' => 'source',
						'toolbarCanCollapse' => true,
						'allowedContent' => true,
						'extraPlugins' => 'panel,floatpanel,listblock,button,richcombo',
						'toolbar' => [
	            [
	                'name' => 'row1',
	                'items' => [
	                    'Source', '-',
	                    'Bold', 'Italic', 'Underline', 'Strike', '-',
	                    'Subscript', 'Superscript', 'RemoveFormat', '-',
	                    'TextColor', 'BGColor', '-',
	                    'NumberedList', 'BulletedList', 'lineheight', '-',
	                    'Outdent', 'Indent', '-', 'Blockquote', '-',
	                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'list', 'indent', 'blocks', 'align', 'bidi', '-',
	                    'Link', 'Unlink', 'Anchor', '-',
	                    'ShowBlocks', 'Maximize',
	                ],
	            ],
	            [
	                'name' => 'row2',
	                'items' => [
	                    'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe', '-',
	                    'NewPage', 'Print', 'Templates', '-',
	                    'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-',
	                    'Undo', 'Redo', '-',
	                    'Find', 'SelectAll', 'Format', 'Font', 'FontSize',
	                ],
	            ],
	            [
									'name' => 'styles',
									'items' => ['Font', 'lineheight', 'FontSize', 'TextColor', 'BGColor']						
							],
					],
				]
    ])
*/
 ?> 
 				<?= $form->field($model, 'betreff')->textInput(['maxlength' => true]) ?>
		
		   	<?= $form->field($model, 'quer')->dropdownList(array("0"=>"Hoch","1"=>"Quer" )
												)->label('Orientierung')  ?>
		   	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Erstellen') : Yii::t('app', 'Sichern'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
