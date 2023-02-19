<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "algoritma".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $kode
 *
 * @property Prediksi[] $prediksis
 */
class Algoritma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'algoritma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'string', 'max' => 5],
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
            'kode' => 'Kode',
        ];
    }

    /**
     * Gets query for [[Prediksis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrediksis()
    {
        return $this->hasMany(Prediksi::class, ['id_algoritma' => 'id']);
    }
}
