<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $id_user
 * @property string $nama
 * @property string $alamat
 * @property int $id_jabatan
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
            [['id_user', 'nama', 'alamat', 'id_jabatan'], 'required'],
            [['id_user', 'id_jabatan'], 'integer'],
            [['nama', 'alamat'], 'string', 'max' => 255],
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
            'nama' => 'Nama Lengkap',
            'alamat' => 'Alamat',
            'id_jabatan' => 'Id Jabatan',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getUser()
    // {
    //     return $this->hasOne(User::class, ['id' => 'id_user']);
    // }
}
