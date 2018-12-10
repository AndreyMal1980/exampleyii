<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Category;
use app\models\Article;
use app\models\Orders;
use app\models\User;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $categories_main = Category::find()->where(['parent_id' => '0'])->all();

        $queryarticles = \app\modules\admin\models\Articles::find();
        $pages = new \yii\data\Pagination(['totalCount' => $queryarticles->count(), 'pageSize' => 4]);
        $articles = $queryarticles->offset($pages->offset)->limit($pages->limit)->all();

        if (!Yii::$app->user->isGuest) {
            $sessionCity = Yii::$app->session;
            $sessionCity->set('city', \Yii::$app->user->identity['city']);
        }
        /* echo '<pre>';
          print_r($articles);
          echo '</pre>'; */
        /*   echo '<pre>';
          print_r($categories_main);
          echo '</pre>'; */
        return $this->render('index', ['modelCallbackMaster' => $modelCallbackMaster,
                    'categories_main' => $categories_main, 'articles' => $articles, 'pages' => $pages]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        Yii::$app->layout = 'static_pages';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $modelLogin = new LoginForm();
        if ($modelLogin->load(Yii::$app->request->post()) && $modelLogin->login()) {

            return $this->goBack();
        }
        return $this->render('login', [
                    'modelLogin' => $modelLogin,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {


        Yii::$app->layout = 'contacts';
        $model = new Orders;
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



        $model_help_select_master = new \app\models\HelperSelectMasterForm;

        if ($model->load(Yii::$app->request->post())) {

            if (Yii::$app->user->isGuest && $_POST['Orders']['reg'] == 1) {
                $user = new User;

                $user->username = $_POST['Orders']['username'];
                $user->phone = $_POST['Orders']['phone'];
                $user->email = $_POST['Orders']['email'];
                $user->city = $_POST['Orders']['city'];
                $user->password = '123';
                $user->type = 1;

                if ($user->save()) {

                    $identity = User::findByUsername($user->email, $user->phone);
                    Yii::$app->user->login($identity);
                }
            }
            $model->date_added = time();
            $model->status_id = 5;
            $category_id = $_POST['Orders']['category_id'];
            $parent_id = Category::findBySql("SELECT parent_id FROM categories WHERE id = " . (int) ($category_id))->one()->parent_id;

            if (!Yii::$app->user->isGuest) {
                $model->user_id = Yii::$app->user->getId();
            } else {
                $model->user_id = $user->id;
            }

            if (!Yii::$app->user->isGuest || Yii::$app->request->post('reg') == 0) {
                Yii::$app->session->setFlash('success', 'Ваш заказ успешно принят.Выберите город и система предложит Вам мастеров из выбранного города');
            }
            if (Yii::$app->user->isGuest || Yii::$app->request->post('reg') == 1) {
                Yii::$app->session->setFlash('success', 'Ваш заказ успешно принят и Вы успешно '
                        . 'зарегестрировались на нашем портале.На указанную Вами почту выслано письмо'
                        . ' с паролем для входа в Ваш личный кабинет.Этот пароль Вы можете изменить
                                в личном кабинете. Выберите город и система предложит Вам мастеров из выбранного города');
            }


            if ($model->save()) {

                $sessionCity = Yii::$app->session;
                $sessionCity->set('city', \Yii::$app->user->identity['city']);

                $session = Yii::$app->session;
                if (!Yii::$app->user->isGuest) {
                    $session['user_order'] = [
                        'user_id' => Yii::$app->user->getId(),
                        'order_id' => Yii::$app->db->lastInsertID,
                        'category_id' => $model->category_id
                    ];
                }

                if (Yii::$app->user->isGuest) {
                    $session['user_order'] = [
                        'username' => $_POST['Orders']['username'],
                        'order_id' => Yii::$app->db->lastInsertID,
                        'category_id' => $model->category_id
                    ];
                }

                return $this->redirect('/user/masters?category_id=' . (int) ($model->category_id));
            } else {
                Yii::$app->session->setFlash('error', 'Проверьте еще раз форму на ощибки');
            }
        }
        return $this->render('contact', ['model' => $model, 'listCategory' => $listCategory,
                    'model_help_select_master' => $model_help_select_master, 'settings' => $settings]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        Yii::$app->layout = 'static_pages';
        return $this->render('about');
    }

    public function actionApplicationinfo() {
        Yii::$app->layout = 'static_pages';
        return $this->render('applicationinfo');
    }

    public function actionGaranty() {
        Yii::$app->layout = 'static_pages';
        return $this->render('garanty');
    }

    public function actionConditionusing() {
        Yii::$app->layout = 'static_pages';
        return $this->render('conditionusing');
    }

    public function actionRegistration() {
        Yii::$app->layout = 'static_pages';
        $model = new User;
        /*
          echo '<pre>';
          print_r($model);
          echo '<pre>'; */

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $modelLogin = new LoginForm();
        if ($modelLogin->load(Yii::$app->request->post()) && $modelLogin->login()) {

            $type = User::getTypeUser(Yii::$app->user->getId());
            if ($type == 1) {
                return $this->redirect(\yii\helpers\Url::to('/user/kabinetuser'));
            }
            if ($type == 2) {
                return $this->redirect(\yii\helpers\Url::to('/user/kabinetmaster'));
            }
            // return $this->goBack();
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {

                $identity = User::findByUsername($model->email, $model->phone);
                Yii::$app->user->login($identity);

                $session = Yii::$app->session;
                $session->set('city', $model->city);

                if ($model->type == 1) {
                    return $this->redirect(\yii\helpers\Url::to('/user/kabinetuser'));
                }
                if ($model->type == 2) {
                   
                    return $this->redirect(\yii\helpers\Url::to('/user/kabinetmaster'));
                }

                // $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('password'));
                Yii::$app->session->setFlash('success', 'Вы успешно зарегестрировались.Теперь Вам необходимо пройти'
                        . ' собеседавание по скайп или телефону.В ближайшее время менеджер свяжется с Вами');
            } else {
                Yii::$app->session->setFlash('error', 'Проверьте еще раз форму на ощибки');
            }
        }
        return $this->render('registration', ['model' => $model, 'modelLogin' => $modelLogin]);
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
