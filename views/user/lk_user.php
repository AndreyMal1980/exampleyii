<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
?>

<div id="lk-user">

    <div class="container ">
        <div class="row">
            <h1 class="text-center">Личный кабинет пользователя</h1>
            <div class="title title--center">
                <div class="circle"></div>
            </div>
        </div>
    </div>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>          
        </div>
    <?php endif; ?> 




    <div class="kabinet">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="side-panel panel-info">

                        <div class="row"> 
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="profile" ><span>Мой профиль</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="application" ><span>Мои заявки</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="reviews" ><span>Мои отзывы</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="add-application" ><span>Подать заявку</span></div>
                                </a>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-4 col-sm-4 col-xs-12 ">
                    <div class="my-data" style="position: relative;">
                        <div class="col-lg-7 col-md-4 col-sm-4 col-xs-12 input-group">
                            <?php $form = ActiveForm::begin(['id' => 'data-user-form']); ?>
                            <div class="form-group-lg">
                                <?= $form->field($model, 'username')->label('')->input('text', ['placeholder' => 'Ваше имя']); ?>
                            </div>
                            <div class="form-group-lg">
                                <?= $form->field($model, 'city')->label('')->input('text', ['placeholder' => 'Ваш город']); ?>
                            </div>
                            <div class="form-group-lg">
                                <?= $form->field($model, 'email')->label('')->input('text', ['placeholder' => 'E-mail']); ?>
                            </div>
                            <div class="form-group-lg" >
                                <div class="add-phone"></div>
                                <?= $form->field($model, 'phone')->label('')->input('text', ['placeholder' => 'Телефон']); ?>

                            </div>

                            <div class="form-group-lg">
                                <?= $form->field($model, 'password')->label('')->input('text', ['placeholder' => 'Пароль']); ?>
                            </div>
                            <div class="form-group-lg">
                                <?= $form->field($model, 'type')->label('')->hiddenInput(['value' => Yii::$app->request->get('type')]); ?>
                            </div>

                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'data-user-button']) ?>


                            <?php ActiveForm::end(); ?>
                            <a class="service-help text-right" href="">Написать в техподдержку</a>
                        </div>
                    </div>
                </div>



                <div class="form-usluga" style="display: none">

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                        <?= $form->field($order, 'name_orders')->label('')->input('text', ['placeholder' => 'Название задачи']) ?>

                        <?= $form->field($order, 'description')->label('')->textArea(['placeholder' => 'Краткое описание задачи', 'rows' => 10]) ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?= $form->field($order, 'category_id')->label('')->dropDownList($listCategory, ['prompt' => 'Выберите рубрику']) ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?= $form->field($order, 'email')->label('')->input('email', ['placeholder' => app\models\User::findBySql("SELECT email FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->email, 'value' => app\models\User::findBySql("SELECT email FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->email]); ?>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                        
                            <?= $form->field($order, 'username')->label('')->input('text', ['placeholder' => Yii::$app->user->identity['username'], 'value' => Yii::$app->user->identity['username']]); ?>                         
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                          
                            <?= $form->field($order, 'phone')->label('')->input('phone', ['placeholder' => app\models\User::findBySql("SELECT phone FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->phone, 'value' => app\models\User::findBySql("SELECT phone FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->phone]); ?>                          
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                      
                            <?= $form->field($order, 'city')->label('')->input('city', ['value' => app\models\User::findBySql("SELECT city FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->city]); ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">                        
                            <?= $form->field($order, 'foto')->label('')->fileInput(); ?>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <?= Html::submitButton('Поручить заказ', ['class' => ' btn btn-info btn-lg btn-block', 'name' => 'usluga-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="data-application" style="display: none">
                        <?php
                        $dataProvider = new ActiveDataProvider([
                            'query' => app\models\Orders::find()->where(['user_id' => Yii::$app->user->getId()]),
                            'pagination' => [
                                'pageSize' => 20,
                            ],
                        ]);
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                'name_orders',
                                'date_added',
                                'status_id'
                            ]
                        ]);
                        ?>
                    </div>
                </div>

                <div id="reviews">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="data-reviews " style="display: none">
                            <div class="review-list">

                                <?php foreach ($reviews as $review): ?>
                                    <div class="review">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <span class="name"><?= $review->autor; ?></span>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="date" style="padding:0">
                                                        <span><?= date("d.m.Y", $review['date_added']); ?> </span> 
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="time">
                                                        <span> <?= date('H:i', $review['date_added']); ?> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                                <?= $review->review ?>
                                            </div>
                                            <?php if (isset($review->answer) && $review->answer != '') { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                                    <h2>Ответ мастера на Ваш отзыв</h2>
                                                    <?= $review->answer ?>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                                    <h2>Мастер еще не ответил на этот отзыв</h2>                    
                                                </div>
                                            <?php } ?>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                                <hr>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {

        $('.profile').on('click', function (event) {
            $('.form-usluga').hide();
            $('.data-application').hide();
            $('.data-reviews').hide();
            $('.my-data').toggle();
            event.preventDefault();
            $('#lk-user h1').text('Личный кабинет пользователя');
        });
        $('.add-application').on('click', function (event) {
            $('.my-data').hide();
            $('.data-application').hide();
            $('.data-reviews').hide();
            $('.form-usluga').toggle();
            event.preventDefault();
            $('#lk-user h1').html('Подать заявку');
        });
        $('.application').on('click', function (event) {
            $('.my-data').hide();
            $('.form-usluga').hide();
            $('.data-reviews').hide();
            $('.data-application').toggle();
            event.preventDefault();
            $('#lk-user h1').html('Мои заявки');
        });
        $('.reviews').on('click', function (event) {
            $('.my-data').hide();
            $('.form-usluga').hide();
            $('.data-application').hide();
            $('.data-reviews').toggle();
            event.preventDefault();
            $('#lk-user h1').html('Мои Отзывы');
        });
    });
</script>
