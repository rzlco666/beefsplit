<?php

use common\components\Breadcrumb;
use denkorolkov\ajaxcrud\CrudAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii2assets\pdfjs\PdfJs;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\DatasetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manual Book';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="page-header">
    <?= Breadcrumb::levelDua($this->title, 'Dashboard', Url::home()) ?>
</div>
<div class="card">
    <div class="card-header">
        <?= Html::a('<i class="uil uil-download-alt"></i> Download Manual Book', ['download'],
            ['title' => 'Download Manual Book', 'class' => 'btn btn-primary']) ?>
    </div>
    <div class="card-body">
        <?= PdfJs::widget([
            'width'=>'100%',
            'height'=> '800px',
            'url' => Url::base() . '/panduan/ManualBook.pdf'
        ]); ?>
    </div>
</div>
