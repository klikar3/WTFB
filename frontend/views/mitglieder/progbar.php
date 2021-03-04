<?php

use yii\bootstrap4\Progress;


?>
<div id="showOnlyProgbar">
<?php
echo Progress::widget([
        'percent' => $percent,
        'barOptions' => ['class' => 'progress-bar-info',],
        'options' => ['id' => 'progBar', 'class' => 'active progress-striped']
//        'options' => ['id' => 'progBar', 'class' => 'active progress-striped', 'style' => '#display: none;']
    ]);
?>
</div>