<?php

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use common\models\Profile;
use FrosyaLabs\Lang\IdDateFormatter;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Dataset */
$profile = Profile::find()->where(['id_user' => $model->id_user])->one();
?>
<div class="dataset-view">

    <?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'attributes' => [
            'nama',
            'file:ntext',
            'ekstensi',
            [
                'attribute' => 'size',
                'value' => ByteUnits\bytes($model->size)->format(),
            ],
            [
                'attribute' => 'upload_date',
                'value' => IdDateFormatter::format($model->upload_date, IdDateFormatter::COMPLETE_WITH_TIME),
            ],
            [
                'attribute' => 'id_user',
                'label' => 'Uploader',
                'value' => $profile->nama,
            ],
        ],
    ]) ?>

    <br>

    <?php
    $path = 'datasetfile/'.$model->file;

    echo '
    <div class="card">
      <div class="card-header">
        <h4 class="card-header-title">'.$model->file.'</h4>
      </div>
    <div class="table-responsive datatable-custom">
    ';
    echo '<table class="js-datatable table table-nowrap table-align-middle card-table">';

    # open the file
    $reader = ReaderEntityFactory::createXLSXReader();
    $reader->open($path);
    # read each cell of each row of each sheet
    foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
            echo '<tr>';
            foreach ($row->getCells() as $cell) {
                echo '<td>' . $cell->getValue() . '</td>';
            }
            echo '</tr>';
        }
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';

    $reader->close();
    ?>

</div>
