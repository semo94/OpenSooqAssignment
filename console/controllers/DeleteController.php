<?php

namespace console\controllers;

use yii\console\Controller;
use backend\models\Post;

/**
 * Delete controller
 */
class DeleteController extends Controller {

    public function actionIndex() {
      $model = new Post();
      if($model->deleteOldPosts()){
        echo 'deleted successfuly';
      } else {
        echo 'no old post to delete!';
      }
    }



}



?>
