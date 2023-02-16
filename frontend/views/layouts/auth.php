<?php

/** @var View $this */

/** @var string $content */

use frontend\assets\AuthAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

AuthAsset::register($this);
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
    <body class="authentication-bg">
    <?php $this->beginBody() ?>
    <!-- ========== MAIN CONTENT ========== -->
    <!-- Navbar Vertical -->
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
        <div class="container">
        <!-- Content -->
        <?= $content ?>
        <!-- End Content -->
        </div>
    </div>
    <footer class="footer footer-alt">
        <?= date('Y') ?> © <?= Html::encode(Yii::$app->name) ?>
    </footer>
    <!-- ========== END MAIN CONTENT ========== -->
    <?php echo $this->render('partials/notify'); ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
