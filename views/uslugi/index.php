<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
//echo \app\components\CategoryDivacesWidget::widget(['tpl' => 'menu']); 
?>

<div id="uslugi">
    <div class="categories-list">


        <?php
        /*  echo '<pre>';
          print_r($caterories);
          echo '</pre>'; */
        ?>
        <div class="container">
            <div class="row">

                <div style="" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                    <div class="text-center">
                        <img text-center src="<?= Yii::$app->request->baseUrl; ?>/img/category/category-4.png">
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                    <div class="text-center">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/category/category-5.png">
                    </div>


                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="text-center">
                        <img src="<?= Yii::$app->request->baseUrl; ?>/img/category/category-6.png">
                    </div>

                </div>

                <?php echo \app\components\CategoryDivacesWidget::widget(['tpl' => 'menu']); ?>

            </div>
        </div>
    </div>
    <div style="clear: both"></div>

    <?php if ($advantagi): $i = 0 ?>
    <div class="container">
        <div class="advantagi">
            <div class="row">
                <h1 class="text-center">Преимущества работы с нами</h1>
                <div class="title title--center">
                    <div class="circle"></div>
                </div>
            </div>
         
                <?php foreach ($advantagi as $advantag): $i++ ?>
                    <?php if ($i % 2 == 0) { ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="text">
                                    <div class="number"><?= $i ?></div>
                                   <?php
                                        $text = strip_tags($advantag->description );
                                        $text = substr($text, 0, 300);
                                          $text = rtrim($text, "!,.-");                                 
                                         echo $text."… "; 
                                        ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <?= yii\bootstrap\Html::img($advantag->getImage()->getUrl('400x200'), ['class' => 'img-responsive']); ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <?= yii\bootstrap\Html::img($advantag->getImage()->getUrl('400x200'), ['class' => 'img-responsive']); ?>
                            </div>   
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="text">
                                    <div class="number"><?= $i ?></div>
                                    <?php
                                        $text = strip_tags($advantag->description );
                                        $text = substr($text, 0, 300);
                                          $text = rtrim($text, "!,.-");                                 
                                         echo $text."… "; 
                                        ?>
                                </div>     
                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>

    <div class="block-3">
        <div class="container">
            <div class="row">
                <h1 class="text-center">Мы охватываем</h1>
                <div class="title title--center">
                    <div class="circle"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="maps">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=p1DmONlf-0z_bgCI4kvCCdFBfMpGG5kM&amp;width=100%&amp;height=400&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                    </div>
                </div>                     
            </div>
        </div>
    </div>

    <div class="news">
        <div class="container">
            <h1 class="text-center">Новости</h1>
            <div class="title title--center">
                <div class="circle"></div>
            </div>

            <?php if ($news): $i = 0 ?>
                <?php foreach ($news as $new): $i++ ;?>
                    <?php if ($i % 2 == 0) { ?>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="novost">
                                    <span class="title-news"><?= $new->title ?></span>  
                                    <hr>
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                     
                                            <div class="date">
                                                <span><?= date("d.m.Y", $new['date_added']); ?> </span> 
                                            </div>                                                                       
                                    </div>
                                    <div class="desc">
                                    <?php  
                                        $text = strip_tags($new->description);
                                        $text = substr($text, 0, 450);
                                        $text_hidden = substr($new->description, 450, strlen($text));
                                        $text = rtrim($text, "!,.-");
                                       // $text = substr($text, 0, strrpos($new->description, ' ')); ?>                                      
                                     <?=  $text."… "; ?>  
                                    <p class="text-hidden-<?= $new->id; ?>" style="display: none">
                                          <?php echo $text_hidden;?>
                                     </p>
                                     
                                </div>
                                    <hr>
                                      <?php if(!empty($text_hidden)) { ?>
                                    <a href="#" id="<?= $new->id; ?>" class="readmore" style="color: red">+ Читать больше</a> 
                                      <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= yii\bootstrap\Html::img($new->getImage()->getUrl('470x320'), ['alt' => $new->title, 'class' => 'img-responsive']); ?>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div class= "row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <?= yii\bootstrap\Html::img($new->getImage()->getUrl('470x320'), ['alt' => $new->title, 'class' => 'img-responsive']); ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="novost">
                                    <span class="title-news"><?= $new->title ?></span>  
                                    <hr>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                                     
                                            <div class="date">
                                                <span><?= date("d.m.Y", $new['date_added']); ?> </span> 
                                            </div>                                                                    
                                    </div>
                                     <div class="desc">
                                    <?php  
                                        $text = strip_tags($new->description);
                                        $text = substr($text, 0, 450);
                                        $text_hidden = substr($new->description, 450, strlen($text));
                                        $text = rtrim($text, "!,.-");
                                       // $text = substr($text, 0, strrpos($new->description, ' ')); ?>                                      
                                     <?=  $text."… "; ?>  
                                    <p class="text-hidden-<?= $new->id; ?>" style="display: none">
                                          <?php echo $text_hidden;?>
                                     </p>
                                     
                                </div>

                                    <hr>
                                      <?php if(!empty($text_hidden)) { ?>
                                    <a href="#" id="<?= $new->id; ?>" class="readmore" style="color: red">+ Читать больше</a>
                                      <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('.readmore').on('click',function(e){
          e.preventDefault();
        var id = $(this).attr('id');
	$('.text-hidden-'+id).toggle();
       
    });
});

</script>
