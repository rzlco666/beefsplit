<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Url;

class Breadcrumb extends Widget
{
    public static function levelSatu($title)
    {
        ?>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= $title ?></h4>
                </div>
            </div>
        </div>

        <?php
    }

    public static function levelDua($title, $title2, $link2)
    {
        ?>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= $link2 ?>"><?= $title2 ?></a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= $title ?></h4>
                </div>
            </div>
        </div>
        <?php
    }

    public static function levelTiga($title, $title2, $link2, $title3, $link3)
    {
        ?>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= $link3 ?>"><?= $title3 ?></a></li>
                            <li class="breadcrumb-item"><a href="<?= $link2 ?>"><?= $title2 ?></a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                    </div>
                    <h4 class="page-title"><?= $title ?></h4>
                </div>
            </div>
        </div>
        <?php
    }

}
