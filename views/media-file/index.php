<?php

use app\models\MediaFile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MediaFileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Media Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->user->can('readFiledoc')){ ?>
<div class="media-file-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('createFiledoc')){ ?>
    <p>
        <?= Html::a('Create Document File', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'namaDokumen',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MediaFile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
<?php } ?>