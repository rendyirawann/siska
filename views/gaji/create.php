<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Gaji $model */

$this->title = 'Tambah Gaji';
$this->params['breadcrumbs'][] = ['label' => 'Gaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'jabatanlist' => $jabatanlist,
    ]) ?>

</div>
