<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Prediksi */
?>
<div class="prediksi-view">
 
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
            'nama',
            'deskripsi',
            'dataset_name:ntext',
            'dataset_save_name:ntext',
            'id_algoritma',
            'date_created',
            'id_user',
        ],
    ]) ?>

</div>
