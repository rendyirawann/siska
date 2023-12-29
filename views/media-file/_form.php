<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MediaFile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="media-file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_doc')->fileInput()->label('Upload Dokumen'); ?>

    <?= $form->field($model, 'namaDokumen')->hiddenInput()->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
