<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Reviews;
use yii\data\Pagination;

class ReviewsController extends Controller {

    public function actionIndex() {

        Yii::$app->layout = 'static_pages';
        $model = new Reviews;
        $query = Reviews::find();
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(),'pageSize' => 3]);
        $reviews = $query->offset($pages->offset)->limit($pages->limit)->all();
      
        if ($model->load(Yii::$app->request->post())) {
       
              $model->master_id = Yii::$app->request->get('master_id');
            if (!Yii::$app->user->isGuest) {
                if ($model->save()) {
                 
                    Yii::$app->session->setFlash('success', 'Ваш отзыв успешно принят');
                    return $this->refresh();
                } else {
                    Yii::$app->session->setFlash('error', 'Проверьте еще раз форму на ощибки');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Комментарии могут оставлять только зарегестрированные пользователи');
             
            }
        }
        return $this->render('index', ['model' => $model,'reviews' => $reviews, 'pages' => $pages]);
    }

}
