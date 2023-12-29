<?php

use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sistem Informasi Karyawan';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->user->can('readUser')){ ?>
<div class="profile-index">

    <h1>Profil Karyawan</h1>

    <?php if (Yii::$app->user->can('createProfile')){ ?>
    <p>
        <?= Html::a('Tambah Profil Karyawan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'id_user',
            [
                'attribute'=>'id_user',
                'value'=>'user.username',
            ],
            'nama',
            'alamat',
            // 'id_jabatan',
            [
                'attribute'=>'id_jabatan',
                'value'=>'jabatan.jabatan',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Profile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
<?php } ?>