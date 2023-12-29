<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "media_file".
 *
 * @property int $id
 * @property string $namaDokumen
 */
class MediaFile extends \yii\db\ActiveRecord
{
    public $file_doc;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['namaDokumen'], 'safe'],
            [['namaDokumen'], 'string', 'max' => 255],
            [['file_doc'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,pdf', 'maxSize'=>'1560000',]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namaDokumen' => 'Nama Dokumen',
        ];
    }
}
