<?php
return [
    'timeZone' => 'Asia/Jakarta',
    'language' => 'en',
    'name' => 'BeefSplit',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'encrypter' => [
            'class' => '\nickcv\encrypter\components\Encrypter',
            'globalPassword' => 'beefpork2022',
            'iv' => 'zxcvbnmasdfghjkl',
            'useBase64Encoding' => true,
            'use256BitesEncoding' => false,
        ],
    ],
];
