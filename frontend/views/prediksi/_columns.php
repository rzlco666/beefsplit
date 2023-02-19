<?php

use yii\helpers\Html;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nama',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'deskripsi',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dataset_name',
    ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dataset_save_name',
    ],*/
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id_algoritma',
        'label' => 'Algoritma',
        'value' => function($model){
            return $model->algoritma->nama;
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'date_created',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id_user',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view} {delete}',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>Yii::$app->encrypter->encrypt($key)]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<i class="uil uil-eye"></i>', $url, [
                    'role' => 'modal-remote',
                    'title' => 'Detail',
                    'data-toggle' => 'tooltip',
                    'class' => 'link-info'
                ]);
            },
            'update' => function ($url, $model) {
                return Html::a('<i class="uil uil-pen"></i>', $url, [
                    'role' => 'modal-remote',
                    'title' => 'Update',
                    'class' => 'link-success'
                ]);
            },
            'delete' => function ($url, $model) {
                return Html::a('<i class="uil uil-trash"></i>', $url, [
                    'role' => 'modal-remote', 'title' => 'Delete',
                    'class' => 'link-danger',
                    'data-confirm' => false,
                    'data-method' => false,// for overide yii data api
                    'data-request-method' => 'post',
                    'data-toggle' => 'tooltip',
                    'data-confirm-title' => 'Delete',
                    'data-confirm-message' => 'Are you sure you want to delete this item?',
                ]);
            },
        ],
    ],

];
