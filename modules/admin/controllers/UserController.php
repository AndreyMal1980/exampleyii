<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Users;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for Users model.
 */
class UserController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex() {
        
    }

    public function actionListusers() {
        $listUsers = new ActiveDataProvider([
            'query' => Users::find()->where(['type' => 1]),
        ]);
        return $this->render('listusers', [
                    'dataProvider' => $listUsers,
        ]);
    }

    public function actionListmasters() {
        $listMasters = new ActiveDataProvider([
            'query' => Users::find()->where(['type' => 2]),
        ]);

        return $this->render('listmasters', [
                    'dataProvider' => $listMasters,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param string $id
     * @return mixed
     */
    public function actionViewuser($id) {

        $dataProvider = new ActiveDataProvider([
            'query' => Users::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('viewuser', [
                    'model' => $this->findModel($id),
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionViewmaster($id) {
        return $this->render('viewmaster', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionVerificatedconfirm() {
        if (Yii::$app->request->isAjax) {
            if (Users::updateAll(['verificated' => 1], ['id' => Yii::$app->request->post('keys')])) {
               
              $order = new \app\modules\admin\models\Orders;
              $order->MasterToApplications(Yii::$app->user->getId());
               Yii::$app->session->setFlash('success', 'Верификация успешно подтверждена');
            
             // echo '<meta http-equiv="refresh" content="0; url=http://yii2.loc/user/kabinetmaster">';
                echo json_encode('success');
            } else {
                echo json_encode('error');
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
            }
        }
    }

    public function actionVerificatedsuccess() {
       
      //  header('Location', 'http://yii2.loc/user/kabinetmaster');
       // echo '<meta http-equiv="refresh" content="0; url=http://yii2.loc/user/kabinetmaster">';
    }

    public function actionVerificated() {

        $listMasters = new ActiveDataProvider([
            'query' => Users::find()->where(['type' => 2, 'verificated' => 0]),
        ]);



        /*   echo '<pre>';
          print_r((Yii::$app->request->post('keys')));
          echo '</pre>'; */

        return $this->render('verificated', ['dataProvider' => $listMasters]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
