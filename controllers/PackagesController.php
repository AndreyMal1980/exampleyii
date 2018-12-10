<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Category;
use app\models\Reviews;
use app\models\Article;
use app\models\Orders;
use app\models\User;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\data\Pagination;

class PackagesController extends Controller {

    public function actionIndex() {
        Yii::$app->layout = 'static_pages';
        return $this->render('index');
    }

}
