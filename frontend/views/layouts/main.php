<?php

/** @var View $this */

/** @var string $content */

use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="<?= Html::encode(Yii::$app->name) ?>" name="description"/>
        <meta content="<?= Html::encode(Yii::$app->name) ?>" name="author"/>
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | <?= Html::encode(Yii::$app->name) ?></title>
        <link rel="shortcut icon" href="<?= Url::home() ?>favicon.ico">
        <script src="<?= Url::home() ?>js/hyper-config.js"></script>
        <?php $this->head() ?>
    </head>
    <body>
    <div class="wrapper">
    <?php $this->beginBody() ?>
    <!-- ========== HEADER ========== -->
    <?php echo $this->render('partials/header'); ?>
    <!-- ========== END HEADER ========== -->
    <!-- ========== MAIN CONTENT ========== -->
    <!-- Navbar Vertical -->
    <?php echo $this->render('partials/navbar'); ?>
    <div class="content-page">
        <!-- Content -->
        <div class="content">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </div>
        <!-- End Content -->
        <!-- Footer -->
        <?php echo $this->render('partials/footer'); ?>
        <!-- End Footer -->
    </div>
    <!-- ========== END MAIN CONTENT ========== -->
    <!-- ========== SECONDARY CONTENTS ========== -->

    <!-- Welcome Message Modal -->
    <?php echo $this->render('partials/themes'); ?>
    <!-- End Welcome Message Modal -->
    <!-- ========== END SECONDARY CONTENTS ========== -->
    <?php echo $this->render('partials/notify'); ?>
    <?php $this->endBody() ?>
    </div>
    </body>
    </html>
<?php $this->endPage();
