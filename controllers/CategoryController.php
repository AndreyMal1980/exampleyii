<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;
use app\models\Article;
use \app\models\Advantagi;

class CategoryController extends Controller {

    public function actionIndex() {
        Yii::$app->layout = 'static_pages';

        $advantagi = Advantagi::find()->all();
        $articles = Article::find()->all();
      
         
        return $this->render('index', ['advantagi' => $advantagi, 'articles' => $articles]);
    }

}

   