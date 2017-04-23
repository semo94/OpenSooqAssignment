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
      $model->deleteOldPosts()
      echo 'delete task has been completed successfully';
    }
}



?>
