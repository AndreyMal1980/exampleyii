<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;

class ArticleController extends Controller {

    public function actionIndex() {
      
       $queryarticles = \app\modules\admin\models\Articles::find();
        $pages = new \yii\data\Pagination(['totalCount' => $queryarticles->count(), 'pageSize' => 2]);
        $articles = $queryarticles->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['articles' => $articles, 'pages' => $pages]);
    }
    
     public function actionArticle($id) {
        Yii::$app->layout = 'static_pages';
        $article = \app\modules\admin\models\Articles::find()->where('id = '.(int)Yii::$app->request->get('id'))->all();
       
        return $this->render('article', ['article' => $article]);
    }

}
