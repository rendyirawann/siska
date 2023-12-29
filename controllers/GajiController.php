<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Jabatan;
use app\models\Gaji;
use app\models\GajiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GajiController implements the CRUD actions for Gaji model.
 */
class GajiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Gaji models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('readGaji'))
        {
        $searchModel = new GajiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }else{
        return $this->redirect(Yii::$app->homeUrl);
    }
    }

    /**
     * Displays a single Gaji model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('readGaji'))
        {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Creates a new Gaji model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('createGaji'))
        {
        $model = new Gaji();
        $jabatan = Jabatan::find()->all();
        $jabatanlist = ArrayHelper::map($jabatan, 'id', 'jabatan');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect('index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'jabatanlist' => $jabatanlist,
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Updates an existing Gaji model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('updateGaji'))
        {
        $model = $this->findModel($id);
        $jabatan = Jabatan::find()->all();
        $jabatanlist = ArrayHelper::map($jabatan, 'id', 'jabatan');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
            'jabatanlist' => $jabatanlist,
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Deletes an existing Gaji model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('deleteGaji'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Finds the Gaji model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Gaji the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gaji::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
