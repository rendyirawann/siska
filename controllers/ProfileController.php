<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Jabatan;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
     * Lists all Profile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('readProfile'))
        {
        $searchModel = new ProfileSearch();
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
     * Displays a single Profile model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->can('readProfile'))
        {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('createProfile'))
        {
        $model = new Profile();
        
        $users = User::find()->all();
        $userslist = ArrayHelper::map($users, 'id', 'username');
        $jabatan = Jabatan::find()->all();
        $jabatanlist = ArrayHelper::map($jabatan, 'id', 'jabatan');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                // return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect('index');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'userslist' => $userslist,
            'jabatanlist' => $jabatanlist,
            
        ]);
    }else{
        return $this->redirect('index');
    }
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('updateProfile'))
        {
        $model = $this->findModel($id);
        $users = User::find()->all();
        $userslist = ArrayHelper::map($users, 'id', 'username');
        $jabatan = Jabatan::find()->all();
        $jabatanlist = ArrayHelper::map($jabatan, 'id', 'jabatan');

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
            'userslist' => $userslist,
            'jabatanlist' => $jabatanlist,
        ]);
        }else{
            return $this->redirect('index');
        }
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('deleteProfile'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }else{
            return $this->redirect('index');
        }
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
