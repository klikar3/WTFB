<?php

//use yii\helpers\Html;
use yii\bootstrap4\Html;
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
?>
<div class="mitglieder-index modal-content">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?=Html::button(Yii::t('app', 'Delete marked records'), ['class' => 'btn btn-danger', 'id' => 'delete'])?>
        
    </p>
<?php Pjax::begin(['id' => 'my-grid']);
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $message . '">' . $key . '</div>';
}
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
