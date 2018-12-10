<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Статья';
$this->params['breadcrumbs'][] = $this->title;
//echo \app\components\CategoryDivacesWidget::widget(['tpl' => 'menu']); 
?>
<div id="content">
    <?php if ($article): ?>
        <div class="article">
            <div class="block-4">
                <div class="container">
                    <div class="row">
                        <h1 class="text-center">Полезно знать</h1>
                        <div class="title title--center">
                            <div class="circle"></div>
                        </div>
                        <?php
                        foreach ($article as $value):
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="text-center"> <?= $value->title; ?> </h2>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               
                                    <?= yii\bootstrap\Html::img($value->getImage()->getUrl(), ['alt' => $article->title, 'class' => 'img-responsive']); ?>
                              
                         


                                <?= $value->description; ?>
                            </div>
                        <div style="clear: both"></div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
