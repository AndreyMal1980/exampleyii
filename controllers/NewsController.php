<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\News;
use yii\data\Pagination;

class NewsController extends Controller {

    public function actionIndex() {

        Yii::$app->layout = 'static_pages';
        $model = new News;
        $query = News::find();
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $news = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', ['model' => $model,'news' => $news, 'pages' => $pages]);
    }

}
