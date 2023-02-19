<?php

use yii\helpers\Url;

?>
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="<?= Url::home() ?>" class="logo logo-light">
                    <span class="logo-lg">
                        <img src="<?= Url::home() ?>images/logo.png" alt="logo">
                    </span>
        <span class="logo-sm">
                        <img src="<?= Url::home() ?>images/logo-sm.png" alt="small logo">
                    </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.html" class="logo logo-dark">
                    <span class="logo-lg">
                        <img src="<?= Url::home() ?>images/logo-dark.png" alt="dark logo">
                    </span>
        <span class="logo-sm">
                        <img src="<?= Url::home() ?>images/logo-dark-sm.png" alt="small logo">
                    </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="<?= Url::home() ?>images/users/avatar-1.jpg" alt="user-image" height="42" class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>

            <li class="side-nav-item <?php if (Yii::$app->controller->id == 'site') echo 'menuitem-active'; ?>">
                <a href="<?= Url::to(['/site/index']) ?>" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item <?php if (Yii::$app->controller->id == 'profile') echo 'menuitem-active'; ?>">
                <a href="<?= Url::to(['/profile']) ?>" class="side-nav-link">
                    <i class="uil-user-circle"></i>
                    <span> Profile </span>
                </a>
            </li>

            <li class="side-nav-title">Apps</li>

            <li class="side-nav-item <?php if (Yii::$app->controller->id == 'dataset') echo 'menuitem-active'; ?>">
                <a href="<?= Url::to(['/dataset']) ?>" class="side-nav-link">
                    <i class="uil-file-alt"></i>
                    <span> Dataset </span>
                </a>
            </li>

            <li class="side-nav-item <?php if (Yii::$app->controller->id == 'prediksi') echo 'menuitem-active'; ?>">
                <a href="<?= Url::to(['/prediksi']) ?>" class="side-nav-link">
                    <i class="uil-chart"></i>
                    <span> Predict </span>
                </a>
            </li>

            <li class="side-nav-title">Others</li>

            <li class="side-nav-item <?php if (Yii::$app->controller->id == 'manual') echo 'menuitem-active'; ?>">
                <a href="<?= Url::to(['/profile']) ?>" class="side-nav-link">
                    <i class="uil-book-alt"></i>
                    <span> Manual Book </span>
                </a>
            </li>

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>