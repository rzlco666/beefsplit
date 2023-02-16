<?php

/** @var yii\web\View $this */

use common\components\Breadcrumb;
use yii\helpers\Url;

$this->title = 'Dashboard';
?>
<div class="page-header">
    <?= Breadcrumb::levelDua($this->title, 'General', Url::to(['/#'])) ?>
</div>
<hp>This is <?= $this->title?></hp>
<!-- End Row -->
