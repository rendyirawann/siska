<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gaji".
 *
 * @property int $id
 * @property string $gaji
 * @property int $id_jabatan
 */
class Gaji extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gaji';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gaji', 'id_jabatan'], 'required'],
            [['id_jabatan'], 'integer'],
            [['gaji'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gaji' => 'Gaji',
            'id_jabatan' => 'Id Jabatan',
        ];
    }

    public function getJabatan()
{
    return $this->hasOne(Jabatan::className(), ['id' => 'id_jabatan']);
}
}
