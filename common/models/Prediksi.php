<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "prediksi".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $deskripsi
 * @property string|null $dataset_name
 * @property string|null $dataset_save_name
 * @property int|null $id_algoritma
 * @property string|null $date_created
 * @property int|null $id_user
 *
 * @property Algoritma $algoritma
 * @property User $user
 */
class Prediksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prediksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataset_name', 'dataset_save_name'], 'string'],
            [['id_algoritma', 'id_user'], 'integer'],
            [['date_created'], 'safe'],
            [['nama', 'deskripsi'], 'string', 'max' => 255],
            [['id_algoritma'], 'exist', 'skipOnError' => true, 'targetClass' => Algoritma::class, 'targetAttribute' => ['id_algoritma' => 'id']],
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
            'deskripsi' => 'Deskripsi',
            'dataset_name' => 'Dataset Name',
            'dataset_save_name' => 'Dataset Save Name',
            'id_algoritma' => 'Id Algoritma',
            'date_created' => 'Date Created',
            'id_user' => 'Id User',
        ];
    }

    /**
     * Gets query for [[Algoritma]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlgoritma()
    {
        return $this->hasOne(Algoritma::class, ['id' => 'id_algoritma']);
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
