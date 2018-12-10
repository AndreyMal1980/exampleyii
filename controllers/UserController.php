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

class UserController extends Controller {

    public function actionIndex() {

        return $this->render('index');
    }

    public function actionMasters() {

        Yii::$app->layout = 'static_pages';
        $model_help_select_master = new \app\models\HelperSelectMasterForm;
        $model = new \app\models\Orders;
        $modelUser = new User;
        $cities = User::find()->asArray()->distinct()->all();
        $category_id = Yii::$app->request->get('category_id');
        // $city = null;
        if ($modelUser->load(Yii::$app->request->post())) {
            $sessionCity = Yii::$app->session;
            $sessionCity->remove('city');
            $sessionCity->set('city', $_POST['User']['city']);
        }
        $sessionCity = Yii::$app->session;
        $city = $sessionCity->get('city');


        $user_id = \Yii::$app->user->getId();
        // echo $user_id;
        // print_r($city);
        /* if (Yii::$app->request->isAjax) {

          $city  = 'k,m,nm';//$_POST['User']['city'];
          echo $city;
          die;

          // $master_to_category = \app\models\MasterToCategory::find()->joinWith('users', 'categories')->where(['category_id' => $category_id, 'city' => $city])->all();
          } */
        // echo $city;
        $master_to_category = \app\models\MasterToCategory::find()->joinWith('users', 'categories')->where(['category_id' => $category_id, 'city' => $city])->all();
        /* $session = Yii::$app->session;
          $master_to_category = $session->get('master_to_category');
          $session->remove('master_to_category'); */

        /*   if (isset($_POST['city'])) {
          $category_id = $_GET['category_id'];
          $master_to_category = \app\models\MasterToCategory::find()->joinWith('users', 'categories')->where(['category_id' => $category_id, 'city' => Yii::$app->request->post('city')])->all();
          } */

        /* echo '<pre>';
          print_r($master_to_category);

          echo '</pre>'; */

        return $this->render('masters', ['model_help_select_master' => $model_help_select_master,
                    'model' => $model, 'master_to_category' => $master_to_category, 'cities' => $cities,
                    'modelUser' => $modelUser
        ]);
    }

    public function actionApplication() {
        Yii::$app->layout = 'static_pages';
        $order = new Orders;
        
         $type_user = User::getTypeUser(\Yii::$app->user->getId());
        $keys = [];
        if ($type_user == 2) {
            $master_category = \app\models\MasterToCategory::find()->asArray()->where(['user_id' => \Yii::$app->user->getId()])->all();
            foreach ($master_category as $category) {
                $keys[] = $category['category_id'];
            }
            for ($i = 0; $i < count($keys); $i++) {
                $key = $keys[$i];
                foreach ($listCategory as $k => $category) {
                    if ($key == $k)
                        unset($listCategory[$k]);
                }
            }
            /*   echo '<pre>';
              print_r($keys);
              echo '</pre>';

              echo '<pre>';
              print_r($listCategory);
              echo '</pre>'; */
        }
        
        
        if ($order->load(Yii::$app->request->post())) {
             if (Yii::$app->user->isGuest && $_POST['Orders']['reg'] == 1) {

                $user->username = $session['usercallback']['username'];
                $user->phone = $session['usercallback']['phone'];
                $user->email = $_POST['Orders']['email'];
                $user->city = $_POST['Orders']['city'];
                $user->password = '123';
                $user->type = 1;

                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'Ваш заказ успешно принят и Вы успешно '
                            . 'зарегестрировались на нашем портале.На указанную Вами почту выслано письмо'
                            . ' с паролем для входа в Ваш личный кабинет.Этот пароль Вы можете изменить в личном кабинете.');
                    $identity = User::findByUsername($user->email, $user->phone);
                    Yii::$app->user->login($identity);
                }
            }


            $category_id = $_POST['Orders']['category_id'];
            $parent_id = Category::findBySql("SELECT parent_id FROM categories WHERE id = " . (int) ($category_id))->one()->parent_id;
            $order->status_id = 5;
            $order->date_added = time();
            if (!Yii::$app->user->isGuest) {
                $order->user_id = Yii::$app->user->getId();
            } else {
                $order->user_id = $user->id;
            }
            if ($order->save()) {

                $sessionCity = Yii::$app->session;
                $sessionCity->set('city', \Yii::$app->user->identity['city']);

                $session = Yii::$app->session;
                if (!Yii::$app->user->isGuest) {
                    $session['user_order'] = [
                        'user_id' => Yii::$app->user->getId(),
                        'order_id' => Yii::$app->db->lastInsertID,
                        'category_id' => $order->category_id
                    ];
                }

                if (Yii::$app->user->isGuest) {
                    $session['user_order'] = [
                        'username' => $_POST['Orders']['username'],
                        'order_id' => Yii::$app->db->lastInsertID,
                        'category_id' => $order->category_id
                    ];
                }

                Yii::$app->session->setFlash('success', 'Ваша заявка принята'
                        . '.В ближайшее время мы свяжемся с вами для уточнения деталей');
                return $this->redirect(\yii\helpers\Url::toRoute('/user/masters?category_id='.(int)  \Yii::$app->request->get('category_id')));
            }
        
        }
        
         $cat = $this->getTteeCategory();
        $listCategory = $this->getCategory($cat);
        return $this->render('application', ['order' => $order, /* 'modeluser' => $modeluser, */
                    'listCategory' => $listCategory, 'settings' => $settings]);
    }

    public function actionCallbackmaster() {
        Yii::$app->layout = 'static_pages';

        $user = new User;

        /*  echo '<pre>';
          print_r($_POST);
          echo '</pre>'; */

        $type_user = User::getTypeUser(\Yii::$app->user->getId());
        $keys = [];
        if ($type_user == 2) {
            $master_category = \app\models\MasterToCategory::find()->asArray()->where(['user_id' => \Yii::$app->user->getId()])->all();
            foreach ($master_category as $category) {
                $keys[] = $category['category_id'];
            }
            for ($i = 0; $i < count($keys); $i++) {
                $key = $keys[$i];
                foreach ($listCategory as $k => $category) {
                    if ($key == $k)
                        unset($listCategory[$k]);
                }
            }
            /*   echo '<pre>';
              print_r($keys);
              echo '</pre>';

              echo '<pre>';
              print_r($listCategory);
              echo '</pre>'; */
        }


        $order = new Orders;
        $session = Yii::$app->session;
        if ($_POST['CallbackMasterForm']['username'] && $_POST['CallbackMasterForm']['phone']) {

            $order->username = $_POST['CallbackMasterForm']['username'];
            $order->phone = $_POST['CallbackMasterForm']['phone'];
            $order->status_id = 2;
            $order->date_added = time();
            $order->user_id = NULL;
            if ($order->save()) {
                $session->set('order_id', Yii::$app->db->lastInsertID);
            }

            $session['usercallback'] = [
                'username' => $_POST['CallbackMasterForm']['username'],
                'phone' => $_POST['CallbackMasterForm']['phone'],
            ];

            if ($session->has('usercallback')) {
                Yii::$app->session->setFlash('success', 'Ваши данные отправлены администратору.'
                        . 'Вам надо заполнить форму для того ,чтобы мы быстро подобрали мастера'
                        . '.В ближайшее время мы свяжемся с вами для уточнения деталей');
                return $this->refresh();
            }
        }
        /*   echo '<pre>';
          print_r($session['usercallback']);
          echo '<pre>'; */
        $order_id = $session->get('order_id');


        if (Yii::$app->request->post('Orders')) {

            $order = Orders::findOne($order_id);

            $order->load(Yii::$app->request->post());
            if (Yii::$app->user->isGuest && $_POST['Orders']['reg'] == 1) {

                $user->username = $session['usercallback']['username'];
                $user->phone = $session['usercallback']['phone'];
                $user->email = $_POST['Orders']['email'];
                $user->city = $_POST['Orders']['city'];
                $user->password = '123';
                $user->type = 1;

                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'Ваш заказ успешно принят и Вы успешно '
                            . 'зарегестрировались на нашем портале.На указанную Вами почту выслано письмо'
                            . ' с паролем для входа в Ваш личный кабинет.Этот пароль Вы можете изменить в личном кабинете.');
                    $identity = User::findByUsername($user->email, $user->phone);
                    Yii::$app->user->login($identity);
                }
            }


            $category_id = $_POST['Orders']['category_id'];
            $parent_id = Category::findBySql("SELECT parent_id FROM categories WHERE id = " . (int) ($category_id))->one()->parent_id;
            $order->status_id = 5;
            $order->date_added = time();
            if (!Yii::$app->user->isGuest) {
                $order->user_id = Yii::$app->user->getId();
            } else {
                $order->user_id = $user->id;
            }
            if ($order->save()) {

                $sessionCity = Yii::$app->session;
                $sessionCity->set('city', \Yii::$app->user->identity['city']);

                $session = Yii::$app->session;
                if (!Yii::$app->user->isGuest) {
                    $session['user_order'] = [
                        'user_id' => Yii::$app->user->getId(),
                        'order_id' => Yii::$app->db->lastInsertID,
                        'category_id' => $order->category_id
                    ];
                }

                if (Yii::$app->user->isGuest) {
                    $session['user_order'] = [
                        'username' => $_POST['Orders']['username'],
                        'order_id' => Yii::$app->db->lastInsertID,
                        'category_id' => $order->category_id
                    ];
                }

                Yii::$app->session->setFlash('success', 'Ваша заявка принята'
                        . '.В ближайшее время мы свяжемся с вами для уточнения деталей');
                return $this->refresh();
            }
        }

        $settingsresult = \app\models\Setting::find()->all();
        $settings = [];

        foreach ($settingsresult as $setting) {
            if ($setting->name == 'phone') {
                $settings['phones'][] = $setting->value;
            }
            if ($setting->name == 'email') {
                $settings['emails'][] = $setting->value;
            }
            if ($setting->name == 'address') {
                $settings['address'] = $setting->value;
            }
            if ($setting->name == 'grafikworks') {
                $settings['grafikworks'] = $setting->value;
            }
        }
        /*  echo '<pre>';
          print_r($settings);
          echo '</pre>'; */
        $cat = $this->getTteeCategory();
        $listCategory = $this->getCategory($cat);


        return $this->render('application', ['order' => $order, /* 'modeluser' => $modeluser, */
                    'listCategory' => $listCategory, 'settings' => $settings]);
        // die;
    }

    public function actionKabinetuser() {

        Yii::$app->layout = 'static_pages';

        $model = User::findOne(Yii::$app->user->getId());


        $sessionCity = Yii::$app->session;
        $sessionCity->set('city', \Yii::$app->user->identity['city']);
        //print_r($sessionCity['city']);

        $order = new Orders;
        $reviews = \app\models\Reviews::findAll(['user_id' => Yii::$app->user->getId()]);

        $cat = $this->getTteeCategory();
        $listCategory = $this->getCategory($cat);

        if ($order->load(Yii::$app->request->post())) {
            $order->user_id = Yii::$app->user->identity['id'];
            $order->date_added = time();
            $order->status_id = 5;
            if ($order->save()) {
                $session = Yii::$app->session;
                $session['user_order'] = [
                    'user_id' => Yii::$app->user->identity['id'],
                    'order_id' => Yii::$app->db->lastInsertID,
                    'category_id' => $order->category_id,
                ];
                // print_r($session['user_order']);
                return $this->redirect(['/user/masters?category_id=' . (int) ($order->category_id)]);

                Yii::$app->session->setFlash('success', 'Ваша заявка успешно принята');
            } else {
                Yii::$app->session->setFlash('error', 'Проверьте еще раз форму на ощибки');
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Ваши данные успешно обновлены');
            } else {
                Yii::$app->session->setFlash('error', 'Проверьте еще раз форму на ощибки');
            }
        }
        return $this->render('lk_user', ['listCategory' => $listCategory, 'model' => $model, 'order' => $order, 'reviews' => $reviews]);
    }

    public function actionCloseapplication() {
        if (Yii::$app->request->isAjax) {
            $q = Yii::$app->db->createCommand('UPDATE orders SET date_close=:date_close ,status_id=:status_id WHERE id=:order_id', [':status_id' => (int) (Yii::$app->request->post('status')), ':order_id' => (int) (Yii::$app->request->post('order_id')), 'date_close' => time()])->execute();
            if (!$q)
                echo json_encode('error');
            else
                echo json_encode(['sucess' => 'success', 'order_id' => Yii::$app->request->post('order_id')]);
            Yii::$app->end();
        }
    }

    public function actionGetapplication() {
        if (Yii::$app->request->isAjax) {
            $q = Yii::$app->db->createCommand('UPDATE orders SET date_reject_or_accept=:date_reject_or_accept, status_id=:status_id WHERE id=:order_id', [':status_id' => (int) (Yii::$app->request->post('status')), ':order_id' => (int) (Yii::$app->request->post('order_id')), ':date_reject_or_accept' => time()])->execute();
            if (!$q)
                echo json_encode('error');
            else
                echo json_encode(['sucess' => 'success', 'order_id' => Yii::$app->request->post('order_id')]);
            Yii::$app->end();
        }
    }

    public function actionAddmastercategory() {

        if (Yii::$app->request->isAjax) {
            $master_to_category = new \app\models\MasterToCategory;
            $category = new Category;
            //  echo Yii::$app->request->post('category_id');
            //die;
            $master_to_category->category_id = Yii::$app->request->post('category_id');

            $parent_id = Category::findBySql("SELECT parent_id FROM `categories` WHERE id=" . (int) (Yii::$app->request->post('category_id')))->one()->parent_id;
            $master_to_category->parent_id = $parent_id;
            // echo json_encode($parent_id);
            // die;
            print_r($parent_id);
            $master_to_category->is_par = Yii::$app->request->post('is_par');
            $master_to_category->user_id = Yii::$app->user->identity['id'];
            if ($master_to_category->save())
            //  echo json_encode($master_to_category->category_id);
                Yii::$app->end();
        }
    }

    public function deleteCategory($category_id) {

        if (!empty($category_id)) {
            $parent_id = Category::findBySql("SELECT parent_id FROM `categories` WHERE id=" . (int) $category_id)->one()->parent_id;
            $q = \app\models\MasterToCategory::deleteAll(['category_id' => (int) $category_id, 'user_id' => Yii::$app->user->identity['id']]);
            if ($q) {
                // print_r($q);
                echo json_encode(['sucess' => 'success']);
            }
            $count = \app\models\MasterToCategory::find()->where(['parent_id' => (int) $parent_id])->count();
            //  print_r($count);
            if ($count > 0) {
                return;
            } else {
                $this->deleteCategory($parent_id);
            }
        }
    }

    public function actionDeletemastercategory() {
        if (Yii::$app->request->isAjax) {
            $master_to_category = new \app\models\MasterToCategory;
            $category = new Category;
            $this->deleteCategory(Yii::$app->request->post('category_id'));
        }
    }

    public function actionKabinetmaster() {
        Yii::$app->layout = 'static_pages';

        $sessionCity = Yii::$app->session;
        $sessionCity->set('city', \Yii::$app->user->identity['city']);

        $model = User::findOne(Yii::$app->user->getId());
        $master_to_category = new \app\models\MasterToCategory;

        $modelreviews = new Reviews;
        $query = Reviews::find()->where(['master_id' => Yii::$app->user->getId()]);
        $countQuery = clone $query;
        $pages = new \yii\data\Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 3]);
        $master_reviews = $query->offset($pages->offset)->limit($pages->limit)->all();
        /* echo '<pre>';
          print_r($master_reviews);
          echo '</pre>'; */
        $category = new Category;

        // $model_master = new User;
        $packages = new \app\models\Packages;
        $packagesAll = \app\models\Packages::find()->all();
        
        $orders_to_master = Orders::find()->with('category', 'status')->asArray()->where(['master_id' => \Yii::$app->user->identity['id']])->all();
        $packages_to_master = \app\models\MasterToPackade::find()->asArray()->with('package')->where(['user_id' => \Yii::$app->user->getId()])->all();
        $master_to_categories = \app\models\MasterToCategory::find()->asArray()->with('categories')->where(['user_id' => $model->id, 'is_par' => 0])->all();

        /*   echo '<pre>';
          print_r($master_to_categories);
          echo '</pre>'; */
        $running_orders = null;
        $received_orders = null;

        if (isset($orders_to_master)) {
            foreach ($orders_to_master as $orders) {

                if ($orders['status_id'] == 3) {
                    $running_orders[] = $orders;
                }
                if ($orders['status_id'] == 0 || $orders['status_id'] == 2) {
                    $received_orders[] = $orders;
                }
            }
        }


        if ($modelreviews->load(Yii::$app->request->post())) {

            $q = Yii::$app->db->createCommand('UPDATE reviews SET answer=:answer WHERE date_added=:date_added ', [':date_added' => (int) ($_POST['Reviews']['date_added']), ':answer' => $_POST['Reviews']['answer']])->execute();
            if ($q)
                Yii::$app->session->setFlash('success', 'Ващ ответ опубликован');
            else
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
            return $this->refresh();
        }


        if ($model->load(Yii::$app->request->post())) {


            $model->avatar = \yii\web\UploadedFile::getInstance($model, 'avatar');

            if ($model->avatar) {
                $model->upload();
            }


            $model->birthday = mktime(0, 0, 0, (int) $_POST['User']['birthday_month'], (int) $_POST['User']['birthday_day'], (int) $_POST['User']['birthday_year']);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Ващи данные успешно сохранены');
                $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Проверьте еще раз форму на ощибки');
            }
        }
        /* echo '<pre>';
          print_r($master_to_categories);
          echo '</pre>'; */

        return $this->render('lk_master', ['model' => $model, 'packages' => $packages,
                    'packagesAll' => $packagesAll, 'packages_to_master' => $packages_to_master,
                    'orders_to_master' => $orders_to_master, 'running_orders' => $running_orders,
                    'received_orders' => $received_orders, 'master_to_categories' => $master_to_categories,
                    'master_reviews' => $master_reviews, 'pages' => $pages, 'modelreviews' => $modelreviews
        ]);
    }

    public function actionMaster() {
        Yii::$app->layout = 'static_pages';
        $master = User::find()->with()->where(['id' => Yii::$app->request->get('master_id')])->one();

        $session = Yii::$app->session;
        if ($session->has('user_order')) {
            $user_order = $session->get('user_order');
            /*  print_r($user_order); */

            if (Yii::$app->request->get('call') == 1) {
                if (!Yii::$app->user->isGuest) {
                    Yii::$app->db->createCommand('UPDATE orders SET master_id=:master_id, status_id=0 WHERE user_id=:user_id AND id=:order_id', [':master_id' => (int) (Yii::$app->request->get('master_id')), ':user_id' => (int) ($user_order['user_id']), ':order_id' => (int) ($user_order['order_id'])])->execute();
                    Yii::$app->session->setFlash('success', 'Поздравляем!!! Вы успешно выбрали мастера.В ближайшее время Ваш заказ будет выполнен');
                    return $this->redirect(\yii\helpers\Url::toRoute('/'));
                }
            }
        }

        $model = new Reviews;
        $query = Reviews::find()->where(['master_id' => Yii::$app->request->get('master_id')]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $reviews = $query->offset($pages->offset)->limit($pages->limit)->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->date_added = time();
            if (!Yii::$app->user->isGuest) {
                $model->master_id = Yii::$app->request->get('master_id');
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


        /*   echo '<pre>';
          print_r($master);
          echo '</pre>'; */
        return $this->render('master', ['master' => $master, 'model' => $model, 'reviews' => $reviews, 'pages' => $pages]);
    }

    public function getTteeCategory() {
        $cat = [];
        $result = Category::find()->asArray()->indexBy('id')->all();

        foreach ($result as $id => &$node) {
            if (!$node['parent_id']) {
                $cat[$id] = &$node;
            } else {
                $result[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $cat;
    }

    public function getCategory($cat) {
        static $result;

        if (is_array($cat)) {
            foreach ($cat as $i => &$val) {

                if (!isset($val['childs'])) {
                    $result[$i] = &$val['title'];

                    // $result = array_merge($result, $t);
                } else {
                    $this->getCategory($val['childs']);
                }
                //  $val['childs'] = '';
                // $result[] = $val;
            }
        }

        /*  echo '<pre>';
          print_r($result);
          echo '</pre>'; */
        return $result;
    }

}
?>

