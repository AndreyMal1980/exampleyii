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
    <?php if ($articles): ?>
        <div class="article">
            <div class="block-4">
                <div class="container">
                    <div class="row">
                        <h1 class="text-center">Полезно знать</h1>
                        <div class="title title--center">
                            <div class="circle"></div>
                        </div>
                        <?php
                        foreach ($articles as $article):
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 50px">
                                <h2 class="text-center"> <?= $value->title; ?> </h2>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?= yii\bootstrap\Html::img($article->getImage()->getUrl(), ['alt' => $article->title, 'class' => 'img-responsive']); ?>
                                <?= $article->description; ?>
                            </div>
                            <div style="clear: both"></div>
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
        </div>
    </div>
</div>
