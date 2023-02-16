<!--- Notify Session -->
<?php

use kartik\growl\Growl;

if (Yii::$app->session->hasFlash('success')):
    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => 'Success!',
        'icon' => 'bi-check2-circle',
        'closeButton' => ['label' => false, 'tag' => false],
        'body' => Yii::$app->session->getFlash('success'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => true,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
endif;
if (Yii::$app->session->hasFlash('error')):
    echo Growl::widget([
        'type' => Growl::TYPE_DANGER,
        'title' => 'Error!',
        'icon' => 'bi-x-circle',
        'closeButton' => ['label' => false, 'tag' => false],
        'body' => Yii::$app->session->getFlash('error'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => true,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
endif;
if (Yii::$app->session->hasFlash('info')):
    echo Growl::widget([
        'type' => Growl::TYPE_INFO,
        'title' => 'Info!',
        'icon' => 'bi-info-circle',
        'closeButton' => ['label' => false, 'tag' => false],
        'body' => Yii::$app->session->getFlash('info'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'showProgressbar' => true,
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
endif;
?>
<!--- End Notify Session -->
