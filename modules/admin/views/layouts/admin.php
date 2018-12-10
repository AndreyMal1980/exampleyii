<?php
/* @var $this DefaultController */
?>

<?php /* @var $this Controller */ ?>
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\ltAppAsset;
use kartik\widgets\SideNav;
use yii\helpers\Url;

AppAsset::register($this);
ltAppAsset::register($this);
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
        <div id="admin">
            <h1 class="text-center">Админка</h1>
            <div class="container">

                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">

                    <?php
                    echo SideNav::widget([
                        'type' => $type,
                        'encodeLabels' => false,
                        'heading' => $heading,
                        'items' => [
                            // Important: you need to specify url as 'controller/action',
                            // not just as 'controller' even if default action is used.
                            ['label' => 'Перейти на сайт', 'icon' => 'home', 'url' => Url::to(['/site/home', 'type' => $type]), 'active' => ($item == 'home')],
                            ['label' => 'Пользователи', 'icon' => 'glyphicon glyphicon-user', 'url' => Url::to(['/admin/user/listusers', 'type' => $type])],
                            ['label' => 'Мастера', 'icon' => 'glyphicon glyphicon-user', 'items' => [
                                    ['label' => 'Список мастеров', 'url' => Url::to(['/admin/user/listmasters', 'type' => $type])],
                                    ['label' => 'Верификация', 'url' => Url::to(['/admin/user/verificated', 'type' => $type])],
                                ]],
                            ['label' => 'Категории', 'icon' => 'list', 'url' => Url::to(['/admin/categories/index', 'type' => $type]), 'active' => ($item == 'fiction')],
                            //  ['label' => 'Добавить категорию', 'url' => Url::to(['/admin/categories/add', 'type' => $type]), 'active' => ($item == 'historical')],
                            ['label' => 'Новости', 'icon' => 'glyphicon glyphicon-blackboard', 'url' => Url::to(['/admin/news/index', 'type' => $type]), 'active' => ($item == 'profile')],
                            ['label' => 'Статьи', 'icon' => 'glyphicon glyphicon-file', 'url' => Url::to(['/admin/articles/index', 'type' => $type]), 'active' => ($item == 'profile')],
                            ['label' => 'Преимущества', 'icon' => 'glyphicon glyphicon-thumbs-up', 'url' => Url::to(['/admin/advantagi/index', 'type' => $type]), 'active' => ($item == 'profile')],
                            ['label' => 'Контактные данные', 'icon' => 'glyphicon glyphicon-phone-alt', 'url' => Url::to(['/admin/setting/index', 'type' => $type]), 'active' => ($item == 'profile')],
                           
                        ],
                    ]);
                    ?>
                </div>


              
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?= $content ?>

              
            </div>


        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>



















