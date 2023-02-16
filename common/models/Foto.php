<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *

 *

 */
class Foto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['foto', 'required'],
            [['foto'], 'file', 'extensions' => ['jpg', 'jpeg', 'png'], 'maxSize' => 1024*1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'foto' => 'Foto',
        ];
    }

}
