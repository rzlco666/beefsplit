<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tes */
?>
<div class="tes-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
        'heading'=>'View # ' . $model->id,
        'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => [
            'id',
            'name',
            'description',
        ],
    ]) ?>

</div>
