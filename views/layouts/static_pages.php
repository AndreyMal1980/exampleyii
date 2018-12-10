<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\ltAppAsset;

AppAsset::register($this);
ltAppAsset::register($this);
?>
<?php
 $settingsresult = \app\models\Setting::find()->all();
        $settings = [];
    
        foreach ($settingsresult as $setting) {
            if($setting->name == 'phone') {
                $settings['phones'][] = $setting->value;
            }
             if($setting->name == 'email'){
                $settings['emails'][] = $setting->value;
            }
             if($setting->name == 'address'){
                $settings['address'] = $setting->value;
            }
            if($setting->name == 'grafikworks'){
                $settings['grafikworks'] = $setting->value;
            }
        }
        ?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body>
        <?php $this->beginBody() ?>
        <section id="header">
            <div class="topheader">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-7 col-xs-12">
                            <span>Ваш город Днепр ?</span>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-5 col-xs-12">
                            <a class="yes" href="#">Да</a><a class="no" href="#">Нет, я из другого города</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="middleheader">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                            <div class="logo">
                                <a href="/"><img src="<?= Yii::$app->request->baseUrl; ?>/img/logo.png"></a>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                            <button style="margin-top: 15px" type="button" class="btn btn-info btn-lg center-block call-master">Вызвать мастера</button>
                        </div>

                        <div class="col-lg-4 col-md-8 col-sm-7 col-xs-12">
                            <div id="menu">
                                <nav class="navbar navbar-default navbar-static-top " role="navigation">
                                    <div class="row">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                            <a class="navbar-brand visible-xs" href=""></a>
                                        </div>
                                        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
                                            <ul class="nav navbar-nav">
                                                <li id="button_about" class="">
                                                    <a href="<?= \yii\helpers\Url::to(['/site/about']); ?>">
                                                        О нас
                                                    </a>
                                                </li>
                                                <li id="button_rubric" class="">
                                                    <a href="#" >
                                                        Полезно знать

                                                    </a>
                                                </li>
                                                <li id="button_reviews" class="">
                                                    <a href="<?= \yii\helpers\Url::to(['/reviews/index']); ?>">
                                                        Отзывы
                                                    </a>
                                                </li>
                                                <li id="button_contacts" class="">
                                                    <a href="<?= \yii\helpers\Url::to(['/site/contact']); ?>">
                                                        Контакты
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                <div id="phone">
                                    <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                                +38(050) 502-49-48
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <?php if (!empty($settings['phones'])) : ?>
                                                    <?php for ($i = 0; $i < count($settings['phones']); $i++) : ?>      
                                                        <li class="phone"> <a href="#"><?= $settings['phones'][$i]; ?></a></li>
                                                    <?php endfor; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-top: 8px">
                            <div class="col-lg-12 col-md-6 col-sm-3 col-xs-12" style="margin-top: 8px">
                                <?php if (!Yii::$app->user->isGuest) { ?>
                                    <a class="avtoriz avtoriz-bottom" href="<?php echo \yii\helpers\Url::to(['/site/logout']) ?>"><span>Выйти(<?= Yii::$app->user->identity['username'] ?>)</span></a>
                                <?php } else { ?>
                                    <a class="avtoriz avtoriz-bottom" href="<?php echo \yii\helpers\Url::to(['/site/registration']) ?>"><span>Войти</span></a>
                                <?php } ?>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-3 col-xs-12">
                                <div id="avtoriz-registr">
                                    <ul class="nav nav-pills">

                                        <li class="dropdown">
                                            <a href="" data-toggle="dropdown" class="dropdown-toggle register ">
                                                <span>Регистрация</span>
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="master-registr" href="<?= \yii\helpers\Url::to(['/site/registration?type=2']) ?>"><span>Для мастера</span></a></li>
                                                <li><a class="client-registr" href="<?= \yii\helpers\Url::to(['/site/registration?type=1']) ?>"><span>Для клиента</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                            <div class="language text-right">
                                <span>RU</span>
                                <span>|</span>
                                <span>UA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
       
        <?= $content ?>
    
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                    <a class="scrolling" href=".topheader"><img src="/img/button-scrolling.png"></a>
                </div>
            </div>
        </div>
        <section id="footer">
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-menu">
                                <ul>
                                 <li><a href="<?= \yii\helpers\Url::to('/uslugi/index') ?>">Услуги</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/packages/index') ?>">Пакеты</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/site/about') ?>">О нас</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/news/index') ?>">Новости</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/article/index') ?>">Статьи</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/reviews/index') ?>">Отзывы</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/site/contact') ?>">Контакты</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/site/garanty') ?>">Гарантии</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/site/applicationinfo') ?>">Как подать объявление</a></li>
                                <li><a href="<?= \yii\helpers\Url::to('/site/conditionusing') ?>">Условия пользования</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-contacts">
                                <ul>
                                    <?php if (!empty($settings['phones'])) : ?>
                                        <?php for ($i = 0; $i < count($settings['phones']); $i++) : ?>      
                                            <li class="phone"> <a href="#"><?= $settings['phones'][$i]; ?></a></li>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['emails'])) : ?>
                                        <?php for ($i = 0; $i < count($settings['emails']); $i++) : ?>
                                            <li class="email"> <a href="#"><?= $settings['emails'][$i]; ?></a></li>
                                        <?php endfor; ?>
                                    <?php endif; ?>
                                    <li class="time-work"><a  href="#"><span>Заявки принимаем в любое время суток</span></a></li>   
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="social">
                                <h6>Присоединяйся к нам:</h6>
                                <ul>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-vk.png"></a></li>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-fb.png"></a></li>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-go.png"></a></li>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-tw.png"></a></li>
                                </ul>
                            </div>
                            <div class="payment">
                                <ul>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-mastercard.png"></a></li>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-yandexmony.png"></a></li>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-webmoney.png"></a></li>
                                    <li><a href=""><img src="<?= Yii::$app->request->baseUrl; ?>/img/icon-ligpay.png"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>             
            </footer>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            © 2015-2016  Все права защищены. Разработка I-PR
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php echo \app\components\CallbackMasterWidget::widget(); ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>




