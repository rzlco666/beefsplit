<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $id_user
 * @property string|null $nama
 * @property string|null $organisasi
 * @property string|null $no_hp
 * @property string|null $jk
 * @property string|null $alamat
 * @property string|null $kota
 * @property string|null $provinsi
 * @property string|null $negara
 * @property string|null $foto
 * @property string|null $date_join
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user'], 'integer'],
            [['date_join'], 'safe'],
            [['nama'], 'string', 'max' => 200],
            [['organisasi', 'alamat', 'kota', 'provinsi', 'negara', 'foto'], 'string', 'max' => 255],
            [['no_hp'], 'match', 'pattern' => '/^\d{10,19}$/'],
            [['jk'], 'string', 'max' => 1],
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
            'id_user' => 'Id User',
            'nama' => 'Nama',
            'organisasi' => 'Perusahaan/Organisasi/Institusi',
            'no_hp' => 'No HP',
            'jk' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'kota' => 'Kota',
            'provinsi' => 'Provinsi',
            'negara' => 'Negara',
            'foto' => 'Foto',
            'date_join' => 'Date Join',
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
