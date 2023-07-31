<?php

use common\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;

$user = Profile::find()->where(['id_user' => Yii::$app->user->id])->one();
?>
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="index.html" class="logo-light">
                                <span class="logo-lg">
                                    <img src="<?= Url::home() ?>images/logo.png" alt="logo">
                                </span>
                    <span class="logo-sm">
                                    <img src="<?= Url::home() ?>images/logo-sm.png" alt="small logo">
                                </span>
                </a>

                <!-- Logo Dark -->
                <a href="index.html" class="logo-dark">
                                <span class="logo-lg">
                                    <img src="<?= Url::home() ?>images/logo-dark.png" alt="dark logo">
                                </span>
                    <span class="logo-sm">
                                    <img src="<?= Url::home() ?>images/logo-dark-sm.png" alt="small logo">
                                </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <?php if (!empty($user->foto) || $user->foto != null) : ?>
                                        <img src="<?= Url::home() ?>images/users/<?= $user->foto ?>" alt="user-image" width="32" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                    <?php else : ?>
                                        <div class="avatar avatar-xs">
                                                <span class="avatar-title bg-success rounded-circle"><?= substr($user->nama, 0, 1) ?></span>
                                            </div>
                                    <?php endif; ?>
                                </span>
                    <span class="d-lg-flex flex-column gap-1 d-none">
                                    <h5 class="my-0"><?= ucwords(strtolower($user->nama)) ?></h5>
                                    <h6 class="my-0 fw-normal"><?= Yii::$app->user->identity->email ?></h6>
                                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="<?= Url::to(['/profile']) ?>" class="dropdown-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>My Profile</span>
                    </a>

                    <!-- item-->
                    <?= Html::beginForm(['/site/logout'], 'post') ?>
                    <?= Html::submitButton(
                        '<i class="mdi mdi-logout me-1"></i> Logout',
                        ['class' => 'dropdown-item']
                    ) ?>
                    <?= Html::endForm() ?>
                </div>
            </li>
        </ul>
    </div>
</div>