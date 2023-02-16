<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dataset".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $file
 * @property string|null $ekstensi
 * @property float|null $size
 * @property string|null $upload_date
 * @property int|null $id_user
 *
 * @property User $user
 */
class Dataset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dataset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['file', 'required'],
            [['file'], 'file', 'extensions' => ['xlsx', 'xls']],
            [['size'], 'number'],
            [['upload_date'], 'safe'],
            [['id_user'], 'integer'],
            [['nama'], 'string', 'max' => 255],
            [['ekstensi'], 'string', 'max' => 10],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'file' => 'File',
            'ekstensi' => 'Ekstensi',
            'size' => 'Size',
            'upload_date' => 'Upload Date',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
