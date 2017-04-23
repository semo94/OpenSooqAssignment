<?php

//use yii\;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts archive';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php  //echo $this->render('_search', ['model' => $searchModel]);
      //var_dump($this->params['breadcrumbs'][]);die;
     ?>

    <p>
        <?= Yii::$app->user->isGuest ?
         Html::a('please login first to start posting your ads..',['site/login'])
         : Html::a('Write Post', ['create'], ['class' => 'btn btn-success'])
         ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'description',
            [
                'attribute' => 'category',
                'format' => 'raw',
                'value' => function ($model) {
                        return '<div>'.$model->category['name'].'</div>';
                },
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'update' => function ($model, $key, $index) {
                    return $model->user_id === Yii::$app->user->getId() ? true : false;
                 },
                 'delete' => function ($model, $key, $index) {
                     return $model->user_id === Yii::$app->user->getId() ? true : false;
                  }
             ]
          ]
        ],
    ]); ?>
</div>
