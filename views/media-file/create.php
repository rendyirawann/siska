<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MediaFile $model */

$this->title = 'Create Media File';
$this->params['breadcrumbs'][] = ['label' => 'Media Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->user->can('createFiledoc')){ ?>
<div class="media-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php } ?>