<?php

namespace app\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\News;
use app\models\Advantagi;

class UslugiController extends Controller {

    public function actionIndex() {
        Yii::$app->layout = 'static_pages';

        $news = new News;
        $queryAdvantagi = new Advantagi;
        $queryNews = News::find();
        $pagesNews = new \yii\data\Pagination(['totalCount' => $queryNews->count(), 'pageSize' => 3]);
        $news = $queryNews->offset($pagesNews->offset)->limit($pagesNews->limit)->all();

        $advantagi = Advantagi::find()->all();
       
        
        /*  echo '<pre>';
          print_r($advantagi);
          echo '</pre>'; */
        return $this->render('index', ['news' => $news, 'pagesNews' => $pagesNews, 'advantagi' => $advantagi]);
    }

}
