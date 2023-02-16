<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

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
                <li class="nav-item">
                    <a href="#predict" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2">
                        <i class="mdi mdi-lightning-bolt-outline font-18 align-middle me-1"></i>
                        <span class="d-none d-sm-inline">Predict</span>
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
                                    <?= $form->field($model, 'id_algoritma')->textInput()->label(false) ?>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <ul class="list-inline wizard mb-0">
                        <li class="next list-inline-item float-end">
                            <a href="javascript:void(0);" class="btn btn-info">Add More Info <i
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
                                    <?= $form->field($model, 'dataset_name')->textInput(['maxlength' => true])->label(false) ?>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <ul class="pager wizard mb-0 list-inline">
                        <li class="previous list-inline-item">
                            <button type="button" class="btn btn-light"><i class="mdi mdi-arrow-left me-1"></i> Back to
                                ML Model
                            </button>
                        </li>
                        <li class="next list-inline-item float-end">
                            <button type="button" class="btn btn-info">Add More Info <i
                                        class="mdi mdi-arrow-right ms-1"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="tab-pane" id="predict">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                <h3 class="mt-0">Thank you !</h3>

                                <p class="w-75 mb-2 mx-auto">Quisque nec turpis at urna dictum luctus. Suspendisse
                                    convallis dignissim eros at volutpat. In egestas mattis dui. Aliquam
                                    mattis dictum aliquet.</p>

                                <div class="mb-3">
                                    <div class="form-check d-inline-block">
                                        <input type="checkbox" class="form-check-input" id="customCheck1">
                                        <label class="form-check-label" for="customCheck1">I agree with the Terms and
                                            Conditions</label>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <ul class="pager wizard mb-0 list-inline mt-1">
                        <li class="previous list-inline-item">
                            <button type="button" class="btn btn-light"><i class="mdi mdi-arrow-left me-1"></i> Back to
                                Data Test
                            </button>
                        </li>
                        <li class="next list-inline-item float-end">
                            <button type="button" class="btn btn-info"><i
                                        class="mdi mdi-lightning-bolt-outline"></i> Predict</button>
                        </li>
                    </ul>
                </div>

            </div> <!-- tab-content -->
        </div> <!-- end #basicwizard-->
        <?php ActiveForm::end(); ?>

    </div> <!-- end card-body -->
</div> <!-- end card-->
