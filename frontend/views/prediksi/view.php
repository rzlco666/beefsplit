<?php

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use common\models\Profile;
use FrosyaLabs\Lang\IdDateFormatter;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Prediksi */
$profile = Profile::find()->where(['id_user' => $model->id_user])->one();
?>
<div class="prediksi-view">

    <?= DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'attributes' => [
            'nama',
            'deskripsi',
            'dataset_name',
            [
                'attribute' => 'id_algoritma',
                'value' => $model->algoritma->nama,
                'label' => 'Algoritma',
            ],
            [
                'attribute' => 'date_created',
                'value' => IdDateFormatter::format($model->date_created, IdDateFormatter::COMPLETE_WITH_TIME),
                'label' => 'Tanggal prediksi',
            ],
            [
                'attribute' => 'id_user',
                'value' => $profile->nama,
                'label' => 'Dibuat oleh',
            ],
        ],
    ]) ?>

    <?php
    $path = 'klasifikasifile/'.$model->dataset_save_name;

    echo '
    <div class="card">
      <div class="card-header">
        <h4 class="card-header-title">'.$model->dataset_save_name.'</h4>
      </div>
    <div class="table-responsive datatable-custom">
    ';
    echo '<table class="js-datatable table table-nowrap table-align-middle card-table">';

    # open the file
    $reader = ReaderEntityFactory::createXLSXReader();
    $reader->open($path);
    # read each cell of each row of each sheet
    $isFirstRow = true; // flag to detect the first row
    foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
            echo '<tr>';
            foreach ($row->getCells() as $cell) {
                if ($isFirstRow) {
                    // add <b> tag to the cell value of the first row
                    echo '<td><b>' . $cell->getValue() . '</b></td>';
                } else {
                    echo '<td>' . $cell->getValue() . '</td>';
                }
            }
            echo '</tr>';
            $isFirstRow = false; // update flag
        }
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';

    $reader->close();
    ?>

</div>
