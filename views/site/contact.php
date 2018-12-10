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

<div id="contacts">
    <div class="container">
        <div class="row">
            <h1 class="text-center">Контакты</h1>
            <div class="title title--center">
                <div class="circle"></div>
            </div> 
            <div style="margin-top: 50px" class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h6>Телефоны</h6>
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
                </ul>

                <hr>
                <h6>График работы</h6>
                <?php if (!empty($settings['grafikworks'])) : ?>
                    <div class="grafic">
                        <?= $settings['grafikworks']; ?><br>
                        Оформление заказов на<br> сайте в любое время суток
                    </div>
                <?php endif; ?>
                <hr>
                <h6>Адрес офиса</h6>
                <?php if (!empty($settings['address'])) : ?>
                    <div class="address">
                     <?= $settings['address']; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="map text-center">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=EnXGNQRPwVOROT_noDmGuLI2WHCr8Il7&amp;width=100%&amp;height=565&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                    <div class="show-to-map"><span>Показать на карте</span></div>
                </div>
            </div>
        </div>
    </div>


    <div class="form-usluga">
        <div class="container">
            <h1><?= Html::encode($this->title) ?></h1>
            <h2 class="text-center">Какую услугу нужно выполнить</h2>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">

                    <?php $form = ActiveForm::begin(['id' => 'usluga-form']); ?>

                    <?= $form->field($model, 'name_orders')->input('text', ['placeholder' => 'Название задачи']) ?>

                    <?= $form->field($model, 'description')->textArea(['placeholder' => 'Краткое описание задачи', 'rows' => 10]) ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'category_id')->dropDownList($listCategory, ['prompt' => 'Выберите рубрику']) ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <?= $form->field($model, 'email')->input('email', ['placeholder' => app\models\User::findBySql("SELECT email FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->email, 'value' => app\models\User::findBySql("SELECT email FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->email]); ?>
                        <?php } else { ?>
                            <?= $form->field($model, 'email')->input('email', ['placeholder' => 'E-mail']); ?>
                        <?php } ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <?= $form->field($model, 'username')->input('text', ['placeholder' => Yii::$app->user->identity['username'], 'value' => Yii::$app->user->identity['username']]); ?>
                        <?php } else { ?>
                            <?= $form->field($model, 'username')->input('text', ['placeholder' => 'Ваше имя']); ?>
                        <?php } ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <?= $form->field($model, 'phone')->input('phone', ['placeholder' => app\models\User::findBySql("SELECT phone FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->phone, 'value' => app\models\User::findBySql("SELECT phone FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->phone]); ?>
                        <?php } else { ?>
                            <?= $form->field($model, 'phone')->input('text', ['placeholder' => 'Телефон']); ?>
                        <?php } ?>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <?= $form->field($model, 'city')->input('city', ['placeholder' => app\models\User::findBySql("SELECT city FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->city, 'value' => app\models\User::findBySql("SELECT city FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->city]); ?>
                        <?php } else { ?>
                            <?= $form->field($model, 'city')->input('text', ['placeholder' => 'Город']); ?>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <?= Html::submitButton('Поручить заказ', ['class' => ' btn btn-info btn-lg btn-block', 'name' => 'usluga-button']) ?>
                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php if (Yii::$app->user->isGuest) { ?>
                            <?= $form->field($model, 'reg')->checkbox(['checked ' => true]); ?>
                        <?php } ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>


    <div id="help-select-masters">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="logo">
                        <a href="/"><img src="<?= Yii::$app->request->baseUrl; ?>/img/logo.png"></a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-2 col-sm-12 col-xs-12">
                    <div class="language">
                        <span>RU</span>
                        <span>|</span>
                        <span>UA</span>
                    </div>
                </div>
            </div>
            <div class="form-help-select-master">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <span> Помощь в выборе специалиста</span>
                </div>
                <?php $form = ActiveForm::begin(['id' => 'help-select-master-form']); ?>
                <div class="col-lg-5 col-md-3 col-sm-12 col-xs-12" >
                    <?= $form->field($model_help_select_master, 'phone')->input('text', ['placeholder' => 'Укажите свой номер телефона', 'style' => ['height' => '46px']]); ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="form-group">                      
                        <?= Html::submitButton('Отправить', ['class' => ' btn btn-info btn-lg btn-block', 'name' => 'help-select-master-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>



