<?php

namespace frontend\controllers;

use common\components\SessionFlash;
use common\models\Foto;
use Yii;
use common\models\Profile;
use common\models\search\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\bootstrap5\Html;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Profile::find()->where(['id_user' => Yii::$app->user->id])->one();
        $model = $this->findModel($id->id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save(false)) {
                SessionFlash::sessionSuccessUpdate();
                return $this->redirect(['index']);
            } else {
                SessionFlash::sessionErrorUpdate();
                return $this->redirect(['index']);
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }


    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> 'Profile #'.$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Updates an existing Profile model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $getId = Profile::find()->where(['id_user' => Yii::$app->user->id])->one();
        $request = Yii::$app->request;
        $model = Foto::findOne($getId->id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> 'Update Photo - '.$getId->nama,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>'submit'])
                ];
            }else if($model->load($request->post())){
                $model->foto = UploadedFile::getInstance($model, 'foto');
                $nama = $getId->id;
                if ($model->validate()) {
                    $saveTo = 'images/users/' . $nama . '.' . $model->foto->extension;
                    if ($model->foto->saveAs($saveTo)) {
                        $model->foto = $nama . '.' . $model->foto->extension;
                        $model->save(false);
                        SessionFlash::sessionSuccessCustom('Foto berhasil diubah');
                        return $this->redirect(['index']);
                    } else {
                        SessionFlash::sessionErrorCustom('Foto gagal diupload');
                        return $this->redirect(['index']);
                    }
                } else {
                    SessionFlash::sessionErrorCustom('Foto gagal diupload');
                    return $this->redirect(['index']);
                }
            }else{
                 return [
                    'title'=> 'Update Foto - '.$getId->nama,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>'submit'])
                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
