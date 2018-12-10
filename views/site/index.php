<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Yii Application';
?>

<section id="content">
    <?php if ($categories_main): ?>
        <div class="block-category">
            <div class="container">
                <div class="row">
                    <h1 class="text-center">Выберите услугу</h1>
                    <div class="title title--center">
                        <div class="circle"></div>
                    </div>
                    <?php foreach ($categories_main as $category): ?> 
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-box">
                                <div class="cat-img">
                                    <a  href="<?= \yii\helpers\Url::to(['category/index?category_id=' . (int) ($category->id) . '&parent_id=' . (int) ($category->parent_id)]); ?>"><?php echo HTml::img($category->image, ['alt' => $category->title]); ?> </a>
                                </div>
                                <a class="cat-name" href="<?= \yii\helpers\Url::to(['/category/index?category_id=' . (int) ($category->id) . '&parent_id=' . (int) ($category->parent_id)]); ?>"><?php echo $category->title; ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>   

                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="block-1">
        <div class="container">
            <div class="row">
                <h1 class="text-center">Как это работает</h1>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">                   
                    <div class="item">
                        <div class="circle-1">
                            <span>1</span>                               
                        </div>
                        <div class="line-1"></div>
                        <div class="line"></div>
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/block-1/img-1.png">
                        <div class="desc">
                            Вы оформляете заявку
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                    <div class="item center">
                        <div class="circle-1">
                            <span>2</span>                               
                        </div>
                        <div class="line-1"></div>
                        <div class="line"></div>
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/block-1/img-2.png">
                        <div class="desc">
                            Связываетесь напрямую с мастером
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                    <div class="item center">
                        <div class="circle-1">
                            <span>3</span>                               
                        </div>
                        <div class="line-1"></div>
                        <div class="line"></div>
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/block-1/img-3.png">
                        <div class="desc">
                            Мастер выполняет работу
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

                    <div class="item right">
                        <div class="circle-1">
                            <span>4</span>                               
                        </div>

                        <div class="line"></div>
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/block-1/img-4.png">
                        <div class="desc">
                            Вы довольны результатом
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="<?= \yii\helpers\Url::to('site/contact') ?>"><button type="button" class="btn btn-info btn-lg right  call-zakaz">Поручить заказ</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="block-2 line">
        <div class="container">
            <div class="row">
                <h1 class="text-center">Нам доверяют</h1>
                <div class="title title--center">
                    <div class="circle"></div>
                </div>
                <div class="slider slides">    

                    <div class="slides-top">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/cannnon.png">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/indezit.png">
                    </div>
                    <div class="slides-top">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/sony.png">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/bocsh.png">
                    </div>
                    <div class="slides-top">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/tefal.png">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/samsung.png">
                    </div>
                    <div class="slides-top">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/phillips.png">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/panasonic.png">
                    </div>
                    <div class="slides-top">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/tefal.png">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/samsung.png">
                    </div>
                    <div class="slides-top">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/phillips.png">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/company/panasonic.png">
                    </div>
                </div>                        
            </div>
        </div>
    </div>
    <div class="block-3">
        <div class="container">
            <div class="row">
                <h1 class="text-center">Мы охватываем</h1>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="maps">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=p1DmONlf-0z_bgCI4kvCCdFBfMpGG5kM&amp;width=100%&amp;height=400&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                    </div>
                </div>                     
            </div>
        </div>
    </div>
    <?php if ($articles): ?>
        <div class="block-4">
            <div class="container">
                <div class="row">
                    <h1 class="text-center">Полезно знать</h1>
                    <div class="title title--center">
                        <div class="circle"></div>
                    </div>
                    <?php foreach ($articles as $article): $i = 0 ;
                     /* echo '<pre>';
                      print_r($article);
                       echo '</pre>';*/
                            ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="item">
                                <?= yii\bootstrap\Html::img($article->getImage()->getUrl('1128x814'), ['alt' => $article->title,'class' => 'img-responsive']); ?>
                                
                                <div class="articles">
                                    <h6><?= $article->title; ?></h6>
                                    <div class="l"></div>
                                    <p>
                                        <?= $article->excerpt; ?>
                                    </p>
                                    <div class="l-1"></div>
                                    <a href="<?= \yii\helpers\Url::to('/article/article?id='.(int)($article->id)) ?>">Читать больше</a>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                        <?php if ($i % 2 == 0) : ?>
                            <div style="clear: both"></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <?php
                    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]);
                    ?>
                </div>
            </div>          
        </div>

</section>


