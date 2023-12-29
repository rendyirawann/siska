<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MediaFile $model */

$this->title = 'Update Media File: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Media Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?php if (Yii::$app->user->can('updateFiledoc')){ ?>
<div class="media-file-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php } ?>