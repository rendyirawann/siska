<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Gaji $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gaji-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gaji')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_jabatan')->dropDownList($jabatanlist, ['prompt' => 'Pilih Jabatan']) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
