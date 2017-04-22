<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>

    <?=
    $form->field($model, 'category_id')->dropDownList($model->getAllCategories(),
             ['prompt'=>'- Choose your Category -'])->label('Select Category') ?>

    <?=
    $form->field($model, 'tags')->ListBox($model->getAllTags(),
             ['multiple' => 'multiple'])->label('choose your preferd tags:') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
