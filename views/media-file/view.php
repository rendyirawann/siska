<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\MediaFile $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Media Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="media-file-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if (Yii::$app->user->can('readFiledoc')){ ?>
    <?= Html::a('Download', ['download', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?php } ?>
    <?php if (Yii::$app->user->can('updateFiledoc')){ ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
        <?php if (Yii::$app->user->can('deleteFileDoc')){ ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <div class="row">
        <div class="col-md-7">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'namaDokumen'
        ],
    ]) ?>
    </div>
    <div class="col-md-5">
        <center>
            <?php if(!empty($model->namaDokumen)){
            ?>
            <img src="<?= Yii::$app->request->baseUrl;?>/upload/<?= $model->namaDokumen; ?>" width="50%" alt="">
            <?php
            }
            else { ?>
            <img src="<?= Yii::$app->request->baseUrl;?>/upload/nodisplay.png" width="50%" />
            <?php } ?>
        </center>
    </div>
    </div>

</div>
