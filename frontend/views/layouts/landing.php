<?php

/** @var View $this */

/** @var string $content */

use frontend\assets\LandingAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\web\View;

LandingAsset::register($this);
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
        <title><?= Html::encode(Yii::$app->name) ?></title>
        <link rel="shortcut icon" href="<?= Url::home() ?>favicon.ico">
        <script src="<?= Url::home() ?>js/hyper-config.js"></script>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <!-- ========== HEADER ========== -->
    <?php echo $this->render('landing/header.php'); ?>
    <!-- ========== END HEADER ========== -->
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="main">
        <?= $content ?>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
    <!-- ========== FOOTER ========== -->
    <?php echo $this->render('landing/footer.php'); ?>
    <!-- ========== END FOOTER ========== -->
    <?php echo $this->render('partials/notify'); ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
