<?php

namespace common\components;

use Yii;
use yii\base\Widget;

class SessionFlash extends Widget
{
    public static function sessionSuccessUpdate()
    {
        Yii::$app->session->setFlash('success', 'Data berhasil diubah!');
    }

    public static function sessionErrorCreate()
    {
        Yii::$app->session->setFlash('error', 'Data gagal ditambah!');
    }

    public static function sessionSuccessCreate()
    {
        Yii::$app->session->setFlash('success', 'Data berhasil dibuat!');
    }

    public static function sessionErrorUpdate()
    {
        Yii::$app->session->setFlash('error', 'Data gagal diubah!');
    }

    public static function sessionSuccessDelete()
    {
        Yii::$app->session->setFlash('success', 'Data berhasil dihapus!');
    }

    public static function sessionErrorDelete()
    {
        Yii::$app->session->setFlash('error', 'Data gagal dihapus!');
    }

    public static function sessionSuccessCustom($custom)
    {
        Yii::$app->session->setFlash('success', $custom);
    }

    public static function sessionErrorCustom($custom)
    {
        Yii::$app->session->setFlash('error', $custom);
    }

    public static function sessionInfoCustom($custom)
    {
        Yii::$app->session->setFlash('info', $custom);
    }

}
