<?php

namespace app\controllers;

use Yii;
use app\models\MediaFile;
use app\models\MediaFileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * MediaFileController implements the CRUD actions for MediaFile model.
 */
class MediaFileController extends Controller
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
     * Lists all MediaFile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('readFiledoc'))
        {
        $searchModel = new MediaFileSearch();
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
     * Displays a single MediaFile model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('readFiledoc'))
        {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Creates a new MediaFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('createFiledoc'))
        {
        $model = new MediaFile();
        // $namaDokumen = uniqid('namaDokumen-'.date('YmdH:i:s').'',true);
        // echo $namaDokumen;exit;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $model->file_doc = UploadedFile::getInstance($model, 'file_doc');
                $namaDokumen = uniqid('karyawanType-',true);
                $model->namaDokumen = $namaDokumen.'.'.$model->file_doc->extension;
                $model->file_doc = UploadedFile::getInstance($model, 'file_doc');

                $lokasi_simpan = 'upload/'.$namaDokumen.'.'.$model->file_doc->extension;
                $model->file_doc->saveAs($lokasi_simpan, false);
                
                $model->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Updates an existing MediaFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('updateFiledoc'))
        {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->file_doc = UploadedFile::getInstance($model, 'file_doc');
            $namaDokumen = uniqid('karyawanType-',true);
            $model->namaDokumen = $namaDokumen.'.'.$model->file_doc->extension;
            $model->file_doc = UploadedFile::getInstance($model, 'file_doc');

            $lokasi_simpan = 'upload/'.$namaDokumen.'.'.$model->file_doc->extension;
            $model->file_doc->saveAs($lokasi_simpan, false);
            
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Deletes an existing MediaFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('deleteFiledoc'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Finds the MediaFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MediaFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MediaFile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDownload($id)
{
    $model = $this->findModel($id);

    $filePath = Yii::getAlias('@webroot/upload/') . $model->namaDokumen;

    if (file_exists($filePath)) {
        Yii::$app->response->sendFile($filePath)->send();
    } else {
        // Handle file not found
    }
}
}
