<?php

namespace frontend\controllers;

use common\components\SessionFlash;
use common\models\Dataset;
use common\models\search\DatasetSearch;
use Yii;
use yii\bootstrap5\Html;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * DatasetController implements the CRUD actions for Dataset model.
 */
class DatasetController extends Controller
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
     * Lists all Dataset models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DatasetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Dataset model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id = Yii::$app->encrypter->decrypt($id);
        $model = $this->findModel($id);
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => 'Dataset - ' . $model->file,
                'content' => $this->renderAjax('view', [
                    'model' => $model,
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-bs-dismiss' => 'modal']) .
                    Html::a('Edit', ['update', 'id' => Yii::$app->encrypter->encrypt($id)], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Finds the Dataset model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dataset the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dataset::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Dataset model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Dataset();
        $model->upload_date = date('Y-m-d H:i:s');
        $model->id_user = Yii::$app->user->identity->id;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => 'Upload new Dataset',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => 'submit'])

                ];
            } else if ($model->load($request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $nama = Yii::$app->user->identity->id . ' - ' . $model->nama . ' - ' . $model->file->baseName;
                $model->ekstensi = $model->file->extension;
                $model->size = $model->file->size;
                if ($model->validate()) {
                    $saveTo = 'datasetfile/' . $nama . '.' . $model->file->extension;
                    if ($model->file->saveAs($saveTo)) {
                        $model->file = $nama . '.' . $model->file->extension;
                        $model->save(false);
                        SessionFlash::sessionSuccessCustom('Dataset uploaded successfully');
                        return $this->redirect(['index']);
                    } else {
                        SessionFlash::sessionErrorCustom('Dataset failed to upload');
                        return $this->redirect(['index']);
                    }
                } else {
                    SessionFlash::sessionErrorCustom('Dataset failed to upload');
                    return $this->redirect(['index']);
                }
            } else {
                return [
                    'title' => 'Upload new Dataset',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => 'submit'])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing Dataset model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $id = Yii::$app->encrypter->decrypt($id);
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->upload_date = date('Y-m-d H:i:s');
        $model->id_user = Yii::$app->user->identity->id;
        $old_file = $model->file;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => 'Update Dataset - ' . $model->file,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            } else if ($model->load($request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file) {
                    if ($model->validate()) {
                        $nama = Yii::$app->user->identity->id . ' - ' . $model->nama . ' - ' . $model->file->baseName;
                        $model->ekstensi = $model->file->extension;
                        $model->size = $model->file->size;
                        @unlink(Yii::getAlias('@frontend') . '/web/datasetfile/' . $old_file);
                        $saveTo = 'datasetfile/' . $nama . '.' . $model->file->extension;
                        if ($model->file->saveAs($saveTo)) {
                            $model->file = $nama . '.' . $model->file->extension;
                            $model->save(false);
                            SessionFlash::sessionSuccessCustom('Dataset uploaded successfully');
                            return $this->redirect(['index']);
                        } else {
                            SessionFlash::sessionErrorCustom('Dataset failed to upload');
                            return $this->redirect(['index']);
                        }
                    } else {
                        SessionFlash::sessionErrorCustom('Dataset failed to upload');
                        return $this->redirect(['index']);
                    }
                } else {
                    SessionFlash::sessionErrorCustom('Empty file');
                    return $this->redirect(['index']);
                }

            } else {
                return [
                    'title' => 'Update Dataset - ' . $model->file,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-secondary float-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
        } else {
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
     * Delete an existing Dataset model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $id = Yii::$app->encrypter->decrypt($id);
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $old_file = $model->file;
        @unlink(Yii::getAlias('@frontend') . '/web/datasetfile/' . $old_file);
        $model->delete();

        SessionFlash::sessionSuccessDelete();
        return $this->redirect(['index']);

    }

    /**
     * Delete multiple existing Dataset model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $old_file = $model->file;
            @unlink(Yii::getAlias('@frontend') . '/web/datasetfile/' . $old_file);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }
}
