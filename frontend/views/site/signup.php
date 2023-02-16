<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var SignupForm $model */

use frontend\models\SignupForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-5">
        <div class="card">

            <!-- Logo -->
            <div class="card-header py-4 text-center bg-primary">
                <a href="<?= Url::home() ?>">
                    <span><img src="<?= Url::home() ?>images/logo.png" alt="logo" height="22"></span>
                </a>
            </div>

            <div class="card-body p-4">

                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign Up</h4>
                    <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute.</p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'nama')->textInput(['class' => 'form-control', 'autofocus' => true, 'placeholder' => 'Enter your name'])->label('Full Name') ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'autofocus' => true, 'placeholder' => 'Enter your Username']) ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Enter your email']) ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Enter your password']) ?>
                </div>

                <div class="mb-3 mb-0 text-center">
                    <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Already have account? <a href="<?= Url::to(['/site/login']) ?>" class="text-muted ms-1"><b>Log In</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
