<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
//use dosamigos\ckeditor\CKEditor;
//use dosamigos\tinymce\TinyMce;
use moonland\tinymce\TinyMCE;

use frontend\models\Schulen;
use frontend\models\Texte;

/* @var $this yii\web\View */
/* @var $model frontend\models\Texte */
/* @var $form yii\widgets\ActiveForm */

/* https://github.com/EVODelavega/placeholder-plugin */
$this->registerJS('tinymce.PluginManager.add("placeholder",function(d){var b,c,e=[],g=d.settings.ph_remove||!1,a=d.settings.placeholders,f="function"===typeof d.settings.ph_callback?d.settings.ph_callback:function(){tinymce.activeEditor.insertContent(this._value)};"string"===typeof a&&(a=document.querySelectorAll(a));if("object"!==typeof a||"undefined"===typeof a.length)throw new TypeError("placeholder items must be objects (pass either an array, a NodeList, a jQuery object or a selector string)");for(b=0;b<a.length;++b)a[b]instanceof HTMLElement?c={text:a[b].textContent,value:a[b].value||this.text,onclick:f}:"object"===typeof a[b]?(c=a[b],c.hasOwnProperty("value")||(c.value=c.text||""),c.hasOwnProperty("text")||(c.text=c.value),c.hasOwnProperty("onclick")||(c.onclick=f)):c=!1,c&&e.push(c);if(g)for(b=0;b<a.length;++b)a[b]instanceof HTMLElement&&a[b].parentNode.removeChild(a[b]);d.addButton("placeholder",{text:"Placeholders",type:"menubutton",name:"placeholder",icon:!1,menu:e})});');

?>

<div class="texte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 50])->label('Beschreibung') ?>

    <?= $form->field($model, 'fuer')->dropdownList(array_merge([""=>"","vertrag"=>"vertrag","grad"=>"grad","sektion"=>"sektion"],ArrayHelper::map( Texte::find()->all(), 'fuer', 'fuer' ) )
												)->label('Für Tabelle') ?>

    <?= $form->field($model, 'SchulId')->dropdownList(ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp' ),
													[ 'prompt' => 'Schule', 'id' => 'field-pid' ])->label('Schule'); ?>

		<?php if (strpos($model->code,'Email') !== false) {
							echo $form->field($model, 'txt')->textarea(['rows' => '6','maxlength' => true, 'style' => 'width:30em;']); }
					else
				echo $form->field($model, 'txt')->widget(TinyMCE::className(), [
				    'toggle' => [
				        'active' => true,
				    ],
            'options' => [ 
//                'class' => 'col-md-6',
                'style' => 'width:700px;',
            ],
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen fullpage",
                "insertdatetime media table contextmenu paste placeholder"
            ],
				    'toolbar' => [
							'styleselect formatselect fontselect fontsizeselect | placeholder | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify ',
  						'cut copy paste undo redo | searchreplace | bullist numlist | outdent indent blockquote | link unlink anchor image media code codesample | preview | forecolor backcolor',
 						  'table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft'								
						],
            'placeholders' => [
                ['value' => '#mitgliedernummer#', 'text' => 'MitgliedsNr'],
                ['value' => '#anrede#', 'text' => 'Anrede'],
                ['value' => '#vorname#', 'text' => 'Vorname'],
                ['value' => '#nachname#', 'text' => 'Nachname'],
                ['value' => '#geburtstag#', 'text' => 'Geburtstag'],
                ['value' => '#schulort#', 'text' => 'Schulort'],
                ['value' => '#sifu#', 'text' => 'Sifu'],
                ['value' => '#strasse#', 'text' => 'Strasse'],
                ['value' => '#plz#', 'text' => 'PLZ'],
                ['value' => '#wohnort#', 'text' => 'Wohnort'],
                ['value' => '#heute#', 'text' => 'Heute'],
                ['value' => '#kuendigungam#', 'text' => 'Kuendigung am'],
                ['value' => '#kuendigungsdatum#', 'text' => 'Kuendigungsdatum'],
                ['value' => '#austrittsdatum#', 'text' => 'Austrittsdatum'],
//                ['value' => '##', 'text' => ''],
//                ['value' => '##', 'text' => ''],
//                ['value' => '##', 'text' => ''],
            ],
						'content_css' => [
					    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
					    '//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.css',
					    '//www.tinymce.com/css/codepen.min.css'    
					  ],
					])->label('');
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
