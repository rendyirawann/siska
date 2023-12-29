<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = 'Tambah Profil Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Profil Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userslist'=> $userslist,
        'jabatanlist'=> $jabatanlist,
    ]) ?>

</div>
