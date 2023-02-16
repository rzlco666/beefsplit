<?php

use common\components\Breadcrumb;
use common\models\AppsCountries;
use common\models\Profile;
use denkorolkov\ajaxcrud\CrudAsset;
use FrosyaLabs\Lang\IdDateFormatter;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

$user = Profile::find()->where(['id_user' => Yii::$app->user->id])->one();

?>
    <div class="page-header">
        <?= Breadcrumb::levelDua($this->title, 'General', Url::to(['/'])) ?>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <?php if (!empty($user->foto) || $user->foto != null) : ?>
                        <img src="<?= Url::home() ?>images/users/<?= $user->foto ?>" alt="user-image" width="32" class="rounded-circle avatar-lg img-thumbnail">
                    <?php else : ?>
                    <center>
                        <div class="avatar avatar-lg rounded-circle img-thumbnail ce">
                            <span class="avatar-title bg-success rounded-circle"><?= substr($user->nama, 0, 1) ?></span>
                        </div>
                    </center>
                    <?php endif; ?>

                    <h4 class="mt-2"><?= ucwords(strtolower($model->nama)) ?></h4>

                    <?= Html::a('<i class="uil uil-image-upload"></i> Update photo', ['update'],
                        ['role' => 'modal-remote', 'title' => 'Create new Tes', 'class' => 'btn btn-primary btn-sm mb-2']) ?>

                    <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase">About Me :</h4>
                        <p class="text-muted mb-2 font-13"><strong>Nama :</strong> <span class="ms-2"><?= ucwords(strtolower($model->nama)) ?></span></p>

                        <p class="text-muted mb-2 font-13"><strong>No HP :</strong><span class="ms-2"><?= $model->no_hp == null ? '-' : ucwords(strtolower($model->no_hp)) ?></span></p>

                        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 "><?= Yii::$app->user->identity->email ?></span></p>

                        <p class="text-muted mb-1 font-13"><strong>Negara :</strong> <span class="ms-2"><?= $model->negara == null ? '-' : ucwords(strtolower($model->negara)) ?></span></p>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->

        </div> <!-- end col-->

        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailLabel" placeholder="Email"
                                           aria-label="Email" value="<?= Yii::$app->user->identity->email ?>"
                                           disabled readonly>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <?= $form->field($model, 'organisasi')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div> <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <?= $form->field($model, 'jk')->inline(false)->radioList(['L' => 'Male', 'P' => 'Female']) ?>
                                </div>
                            </div>
                        </div> <!-- end row -->

                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-home me-1"></i> Alamat</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <?= $form->field($model, 'negara')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(AppsCountries::find()->all(), 'country_name', 'country_name'),
                                    'options' => ['placeholder' => 'Select Country'],
                                    'pluginOptions' => [
                                        'allowClear' => false
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $form->field($model, 'kota')->textInput(['maxlength' => true, 'placeholder' => 'City']) ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <?= $form->field($model, 'provinsi')->textInput(['maxlength' => true, 'placeholder' => 'State']) ?>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <?= $form->field($model, 'alamat')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>
                            </div>
                        </div>
                    </div> <!-- end row -->

                        <div class="text-end">
                            <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row-->
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "title" => '<h4 class="modal-title">Modal title</h4>',
    "options" => [
        "tabindex" => -1, // important for Select2 to work properly,
        "class" => "modal fade",
    ],
    "centerVertical" => true,
    "footer" => "",// always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>