<?php

namespace frontend\controllers;

use common\components\SessionFlash;
use Yii;
use common\models\Prediksi;
use common\models\search\PrediksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\bootstrap5\Html;

/**
 * PrediksiController implements the CRUD actions for Prediksi model.
 */
class PrediksiController extends Controller
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
     * Lists all Prediksi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrediksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Prediksi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id = Yii::$app->encrypter->decrypt($id);
        $model = $this->findModel($id);
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> 'Prediksi - '.$model->nama,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                        Html::a('Download',['download','file'=>Yii::$app->encrypter->encrypt($model->dataset_save_name)],['class'=>'btn btn-primary'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Prediksi model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Prediksi();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=>'Predict',
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    /*'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>'submit'])*/

                ];
            }else if($model->load($request->post())){
                $datasetname = $model->dataset_name;
                $savename = $model->nama . '-' . $datasetname;
                $model->dataset_save_name = $savename;
                $model->date_created = date('Y-m-d H:i:s');
                $model->id_user = Yii::$app->user->id;

                $tabel = "python D:\\laragon\\www\\beefsplit\\frontend\\web\\engine\\tabel.py $datasetname";
                $predict = shell_exec($tabel);
                $simpan = "python D:\\laragon\\www\\beefsplit\\frontend\\web\\engine\\savefile.py $datasetname $savename";
                //$savefile = shell_exec($simpan);

                $model->save();
                SessionFlash::sessionSuccessCustom('Prediction Success');

                return $this->render('result', [
                    'model' => $model,
                    'predict' => $predict,
                    'datasetname' => $datasetname,
                    'savename' => $savename,
                ]);
            }else{
                return [
                    'title'=> 'Predict',
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    /*'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>'submit'])*/

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $datasetname = $model->dataset_name;
                $savename = $model->nama . '-' . $datasetname;
                $model->dataset_save_name = $savename;
                $model->date_created = date('Y-m-d H:i:s');
                $model->id_user = Yii::$app->user->id;

                $tabel = "python D:\\laragon\\www\\beefsplit\\frontend\\web\\engine\\tabel.py $datasetname";
                $predict = shell_exec($tabel);
                $simpan = "python D:\\laragon\\www\\beefsplit\\frontend\\web\\engine\\savefile.py $datasetname $savename";
                //$savefile = shell_exec($simpan);

                $model->save();
                SessionFlash::sessionSuccessCustom('Prediction Success');

                return $this->render('result', [
                    'model' => $model,
                    'predict' => $predict,
                    'datasetname' => $datasetname,
                    'savename' => $savename,
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

    }

    /**
     * Updates an existing Prediksi model.
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

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> 'Update Prediksi - '.$model->nama,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>'submit'])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> 'Prediksi - '.$model->nama,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>'modal']).
                            Html::a('Download',['download','file'=>Yii::$app->encrypter->encrypt($model->dataset_save_name)],['class'=>'btn btn-primary'])
                ];
            }else{
                 return [
                    'title'=> 'Update Prediksi - '.$model->nama,
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
                return $this->redirect(['view', 'id' => Yii::$app->encrypter->encrypt($model->id)]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Download an existing Prediksi model.
     * For ajax request will return json object
     * and for non-ajax request if download is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDownload($file)
    {
        $file = Yii::$app->encrypter->decrypt($file);
        $path = Yii::getAlias('@frontend') . '/web/klasifikasifile/' . $file;
        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }

    /**
     * Delete an existing Prediksi model.
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
        $old_file = $model->dataset_save_name;

        @unlink(Yii::getAlias('@frontend') . '/web/klasifikasifile/' . $old_file);
        $model->delete();

        SessionFlash::sessionSuccessDelete();
        return $this->redirect(['index']);
    }

     /**
     * Delete multiple existing Prediksi model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $old_file = $model->dataset_save_name;
            @unlink(Yii::getAlias('@frontend') . '/web/klasifikasifile/' . $old_file);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the Prediksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prediksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prediksi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
