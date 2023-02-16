<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
?>
<div class="profile-view">
 
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
            'id_user',
            'nama',
            'organisasi',
            'no_hp',
            'jk',
            'alamat',
            'kota',
            'provinsi',
            'negara',
            'foto',
            'date_join',
        ],
    ]) ?>

</div>
