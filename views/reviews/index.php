<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div id="reviews">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1 class="text-center">Отзывы</h1>
                <div class="title title--center">
                    <div class="circle"></div>
                </div>

                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo Yii::$app->session->getFlash('success'); ?>          
                    </div>
                <?php endif; ?> 
                <div class="col-lg-offset-1 col-lg-10" >
                    <?php $form = ActiveForm::begin(['id' => 'reviews-form']); ?>

                    <?= $form->field($model, 'review')->textarea(['placeholder' => 'Введите свой комментарий', 'rows' => 7]); ?>

                    <?= $form->field($model, 'autor')->label('')->hiddenInput(['value' => Yii::$app->user->identity['username']]); ?>

                    <?= $form->field($model, 'user_id')->label('')->hiddenInput(['value' => Yii::$app->user->getId()]); ?>

                </div>

                <div class="form-group">
                    <div class="col-lg-offset-9 col-lg-1 r">
                        <?= Html::submitButton('Оставить отзыв', ['class' => 'btn btn-info btn-large', 'name' => 'reviews-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

                <div style="clear: both"></div>
                <div class="review-list">

                    <?php foreach ($reviews as $review): ?>
                        <div class="review">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                <div class="row">
                                    <div class="foto text-center">
                                        <?php
                                        $res = app\models\User::find()->where(['id' => Yii::$app->user->getId()])->one();
                                        $res->avatar;
                                        ?>
                                        <?php if ($res->avatar) { ?>
                                            <?= Html::img($res->avatar) ?>
                                        <?php } else { ?>
                                            <?= Yii::$app->request->baseUrl; ?>/<?= Html::img('/img/avatars/no-foto.png') ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="name"><?= $review->autor; ?></span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span style="padding-left: 30px" class="date"><?= $review->date_added; ?></span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                    <?= $review->review ?>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 100px" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <?php
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
    </div>
</div>






