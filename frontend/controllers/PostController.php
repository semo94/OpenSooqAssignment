<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Post;
use frontend\models\PostSearch;
use frontend\models\PostTag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {   $model = new Post();
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new Post();
        if(Yii::$app->user->isGuest){
            $this->redirect('../site/login');

        } else {
           return $this->render('view', [
               'model' => $this->findModel($id),
           ]);
        }
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

        if(Yii::$app->user->isGuest){
             $this->redirect('../site/login');
         }
        else if ($model->load(Yii::$app->request->post()) ) {
          $request = Yii::$app->request->post('Post');
          if($model->insertPost($request)){
            return $this->redirect(['view', 'id' => $model->id]);
          }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->isGuest){
            $this->redirect('../site/login');
         } else if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $request = Yii::$app->request->post('Post');
            if(is_array($request['tags'])){
              PostTag::deleteAll('post_id = :postID', [':postID' => $model->id]);
            }
            $model->insertTags($request);
            return $this->redirect(['view', 'id' => $model->id]);
         } else {
              return $this->render('update', [
                  'model' => $model,
              ]);
          }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest){
            $this->redirect('../site/login');
        } else {
            $model = $this->findModel($id);
            PostTag::deleteAll('post_id = :postID', [':postID' => $model->id]);
            $model->delete();
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
