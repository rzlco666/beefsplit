<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var LoginForm $model */

use common\models\LoginForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Login';
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
                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <div class="mb-3">
                        <?= $form->field($model, 'username')->textInput(['class' => 'form-control', 'autofocus' => true, 'placeholder' => 'Enter your Username']) ?>
                    </div>

                    <div class="mb-3">
                        <a href="<?= Url::to(['site/request-password-reset']) ?>" class="text-muted float-end"><small>Forgot your password?</small></a>
                        <label for="password" class="form-label">Password</label>
                        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Enter your password'])->label(false) ?>
                    </div>

                    <div class="mb-3 mb-3">
                        <div class="form-check">
                            <input type="hidden" name="LoginForm[rememberMe]" value="0">
                            <input type="checkbox" id="loginform-rememberme" class="form-check-input"
                                   name="LoginForm[rememberMe]" value="1" checked>
                            <label class="form-check-label" for="termsCheckbox">
                                Remember me
                            </label>
                        </div>
                    </div>

                    <div class="mb-3 mb-0 text-center">
                        <?= Html::submitButton('Log In', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

        <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Don't have an account? <a href="<?= Url::to(['/site/signup']) ?>" class="text-muted ms-1"><b>Sign Up</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- end col -->
</div>
