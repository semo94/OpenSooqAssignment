<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to OpenSooq</h1>

        <p class="lead">you can browse, create and edit your advertisements in ease!</p>

        <p> <?= Html::a('Get Start', ['..\post\index'], ['class' => 'btn btn-success']) ?></p>
    </div>

</div>
