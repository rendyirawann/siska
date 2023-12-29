<?php

use app\models\Gaji;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\GajiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gaji';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->user->can('readGaji')){ ?>
<div class="gaji-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Gaji', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gaji',
            // 'id_jabatan',
            [
                'attribute'=>'id_jabatan',
                'value'=>'jabatan.jabatan',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Gaji $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
<?php } ?>
