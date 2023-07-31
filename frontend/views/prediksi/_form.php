<?php

use common\models\Algoritma;
use common\models\Dataset;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Prediksi */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="card">
    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>
        <div id="basicwizard">

            <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                <li class="nav-item">
                    <a href="#mlmodel" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2 active">
                        <i class="mdi mdi-face-man-profile font-18 align-middle me-1"></i>
                        <span class="d-none d-sm-inline">ML Model</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#datatest" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2">
                        <i class="mdi mdi-file-excel-outline font-18 align-middle me-1"></i>
                        <span class="d-none d-sm-inline">Data Test</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content b-0 mb-0">
                <div class="tab-pane active" id="mlmodel">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-9">
                                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">Description</label>
                                <div class="col-md-9">
                                    <?= $form->field($model, 'deskripsi')->textarea(['maxlength' => true])->label(false) ?>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-md-3 col-form-label">Algorithm</label>
                                <div class="col-md-9">
                                    <?= $form->field($model, 'id_algoritma')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(Algoritma::find()->all(), 'id', 'nama'),
                                        'options' => ['placeholder' => 'Select Algorithm'],
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                    ])->label(false) ?>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <ul class="list-inline wizard mb-0">
                        <li class="next list-inline-item float-end">
                            <a href="#datatest" class="btn btn-info" data-toggle="tab">Data Test <i
                                        class="mdi mdi-arrow-right ms-1"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="tab-pane" id="datatest">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <label class="col-md-3 col-form-label">Dataset</label>
                                <div class="col-md-9">
                                    <?= $form->field($model, 'dataset_name')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map(Dataset::find()->where(['id_user' => Yii::$app->user->id])->all(), 'file', function ($model) {
                                            return $model->nama . ' (' . $model->file . ')';
                                        }),
                                        'options' => ['placeholder' => 'Select Dataset'],
                                        'pluginOptions' => [
                                            'allowClear' => false
                                        ],
                                    ])->label(false) ?>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <ul class="pager wizard mb-0 list-inline">
                        <li class="previous list-inline-item">
                            <a href="#mlmodel" data-bs-toggle="tab" data-toggle="tab" class="btn btn-light">
                                <i class="mdi mdi-arrow-left me-1"></i> Back to
                                ML Model
                            </a>
                        </li>
                        <li class="next list-inline-item float-end">
                            <button type="submit" class="btn btn-info"><i
                                        class="mdi mdi-lightning-bolt-outline"></i> Predict
                            </button>
                        </li>
                    </ul>
                </div>

            </div> <!-- tab-content -->
        </div> <!-- end #basicwizard-->
        <?php ActiveForm::end(); ?>

    </div> <!-- end card-body -->
</div> <!-- end card-->


