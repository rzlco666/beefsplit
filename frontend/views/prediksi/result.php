<?php

use common\components\Breadcrumb;
use kartik\grid\GridView;
use yii\bootstrap5\Html;
use yii\bootstrap5\Modal;
use yii\helpers\Url;

$this->title = 'Result - '.$model->nama;

/*echo $model->nama." <br> ";
echo $datasetname." <br> ";
echo $model->deskripsi." <br> ";
echo $model->id_algoritma." <br> ";
echo $model->dataset_name." <br> <br> ";
echo $predict;*/
?>
<div class="page-header">
    <?= Breadcrumb::levelTiga($this->title, 'Prediksi', Url::to(['/prediksi']), 'Dashboard', Url::home()) ?>
</div>
<div class="card">
    <div class="card-header">
        <?= Html::a('<i class="uil uil-download-alt"></i> Download Result', ['download', 'file' => Yii::$app->encrypter->encrypt($savename)],
            ['title' => 'Download Result', 'class' => 'btn btn-primary']) ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?= $predict ?>
        </div>
    </div>
</div>
