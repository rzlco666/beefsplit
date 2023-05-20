<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ManualBookController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDownload()
    {
        $file = 'panduan/ManualBook.pdf';
        $path = Yii::getAlias('@frontend') . '/web/' . $file;

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }
}
