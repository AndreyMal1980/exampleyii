<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* echo '<pre>';
  print_r($model->getUsers());
  echo '</pre>'; */
?>

<?php
$this->params['breadcrumbs'][] = $this->title;
?> 
<button class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Подать заявку</button>
<div id="categories">
    <div class="container">
<?= \app\components\CategoryDivacesWidget::widget(['tpl' => 'select']); ?>
    </div>
</div>

        <?php if ($advantagi): $i = 0 ?>
    <div id="uslugi">
        <div class="advantagi">
            <div class="row">
                <h1 class="text-center">Преимущества работы с нами</h1>
                <div class="title title--center">
                    <div class="circle"></div>
                </div>
            </div>

            <div class="container">
    <?php foreach ($advantagi as $advantag): $i++ ?>
        <?php if ($i % 2 == 0) { ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="text">
                                    <div class="number"><?= $i ?></div>
            <?= $advantag->description ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                    <?= yii\bootstrap\Html::img(Yii::$app->request->baseUrl.'/'. $advantag->image, ['class' => 'img-responsive']); ?>
                            </div>
                        </div>
                            <?php } else { ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <?= yii\bootstrap\Html::img(Yii::$app->request->baseUrl.'/'.$advantag->image, ['class' => 'img-responsive']); ?>
                            </div>   
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="text">
                                    <div class="number"><?= $i ?></div>
            <?= $advantag->description ?>
                                </div>     
                            </div>
                        </div>
                                <?php } ?>
    <?php endforeach; ?>
            </div>
        </div>

            <?php endif; ?>
</div>

<section id="content">
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



<?php if ($articles): ?>
        <div class="block-4">
            <div class="container">
                <div class="row">
                    <h1 class="text-center">Полезно знать</h1>
                    <div class="title title--center">
                        <div class="circle"></div>
                    </div>
    <?php foreach ($articles as $article): ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="item">
                                <img class="img-responsive" <?php echo HTml::img(Yii::$app->request->baseUrl.'/'.$article->image, ['alt' => $article->title]); ?>
                                     <div class="articles">
                                    <h6><?php echo $article->title; ?></h6>
                                    <div class="l"></div>
                                    <p>
        <?php echo $article->excerpt; ?>
                                    </p>
                                    <div class="l-1"></div>
                                    <a href="#">Читать больше</a>
                                </div>
                            </div>
                        </div>
    <?php endforeach; ?>
<?php endif; ?>
                    <a class="scrolling" href="#"><img src="/img/button-scrolling.png"></a>
            </div>          
        </div>
        
</section>    
