<?php

/** @var yii\web\View $this */

use common\components\Breadcrumb;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Url;

$this->title = 'Dashboard';
?>
<div class="page-header">
    <?= Breadcrumb::levelDua($this->title, 'General', Url::to(['/#'])) ?>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="uil-users-alt widget-icon"></i>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Total Users">Total Users</h5>
                <h3 class="mt-3 mb-3"><?= $count_user ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="uil-chart widget-icon"></i>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Predictions Saved">Predictions Saved</h5>
                <h3 class="mt-3 mb-3"><?= $count_predict ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card widget-flat">
            <div class="card-body">
                <div class="float-end">
                    <i class="uil-file-alt widget-icon"></i>
                </div>
                <h5 class="text-muted fw-normal mt-0" title="Uploaded Dataset">Uploaded Dataset</h5>
                <h3 class="mt-3 mb-3"><?= $count_dataset ?></h3>
            </div>
        </div>
    </div>

</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="d-flex card-header justify-content-between align-items-center">
                <h4 class="header-title">Total Prediction Saved</h4>
            </div>
            <div class="card-body pt-0">
                <div dir="ltr">
                    <?php
                    $prediksi = [];
                    $bulan = [];

                    foreach ($grafik_prediksi as $values) {
                        $prediksi[] = $values['jumlah_prediksi'];
                        $bulan[] = $values['bulan'];
                    }

                    echo ChartJs::widget([
                        'type' => 'line',
                        'options' => [
                            'height' => 100,
                            'width' => 400
                        ],
                        'data' => [
                            'labels' => $bulan,
                            'datasets' => [
                                [
                                    'label' => "Prediksi",
                                    'backgroundColor' => "rgba(179,181,198,0.2)",
                                    'borderColor' => "rgba(179,181,198,1)",
                                    'pointBackgroundColor' => "rgba(179,181,198,1)",
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                    'data' => $prediksi
                                ],
                            ]
                        ]
                    ]);
                    ?>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row -->
