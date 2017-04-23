<?php

//use yii\;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
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
