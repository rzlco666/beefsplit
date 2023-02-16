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
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'description',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view} {update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'buttons' => [
            'view' => function ($url, $model) {
                return Html::a('<i class="bi-eye"></i>', $url, [
                    'role' => 'modal-remote',
                    'title' => 'Detail',
                    'data-toggle' => 'tooltip',
                    'class' => 'link-info'
                ]);
            },
            'update' => function ($url, $model) {
                return Html::a('<i class="bi-pencil"></i>', $url, [
                    'role' => 'modal-remote',
                    'title' => 'Update',
                    'class' => 'link-success'
                ]);
            },
            'delete' => function ($url, $model) {
                return Html::a('<i class="bi-trash"></i>', $url, [
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
