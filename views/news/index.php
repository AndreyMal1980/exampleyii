<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="container">
    <div class="news">
        <h1 class="text-center">Новости</h1>
        <div class="title title--center">
            <div class="circle"></div>
        </div>

        <?php if ($news) { $i = 0 ;
              
                ?>
            <?php foreach ($news as $new): $i++; 
     // $img = $model->getImage();
         /*       echo '<pre>';
     print_r($new);      
           echo '</pre>';    */ ?>
                <?php if ($i % 2 == 0) { ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="novost">
                                <span class="title-news"><?= $new->title ?></span>  
                                <hr>
                                <div class="date">
                                    <span><?= date("d.m.Y", $new['date_added']); ?> </span> 
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
                                <a href="#" id="<?= $new->id; ?>" class="readmore" style="color: red" >+ Читать больше</a>  
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
                                 <div class="date">
                                    <span><?= date("d.m.Y", $new['date_added']); ?> </span> 
                                </div>
                                <div class="desc">
                                        <?php
                                      
                                        $text = strip_tags($new->description);
                                        $text = substr($text, 0, 450);
                                        $text_hidden = substr($new->description, 450, strlen($text));                                       
                                        $text = rtrim($text, "!,.-");
                                       // $text = substr($text, 0, strrpos($new->description, ' '));
                                        echo $text."… "; ?> 
                                    <p class="text-hidden-<?= $new->id; ?>" style="display: none">
                                          <?php echo $text_hidden;?>
                                     </p>
                                  
                                </div>
                                <hr>
                                <?php if(!empty($text_hidden)) { ?>
                                <a id="<?= $new->id; ?>" class="readmore" style="color: red" href="">+ Читать больше</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        <?php } ?>

        <div style="margin-bottom: 100px" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <?php
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
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