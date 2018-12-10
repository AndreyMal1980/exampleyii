<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$sessionCity = Yii::$app->session;
if ($sessionCity->has('city')) {
    $city = $sessionCity->get('city');
    //     print_r($city);
}
?>


<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>          
    </div>
<?php endif; ?> 


<div class="container">
    <button class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Подать заявку</button>
    <div id="categories">
        <div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <ul class="catalog" style="margin-bottom:50px">
                        <?= \app\components\CategoryDivacesWidget::widget(['tpl' => 'treeview']); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="list-masters">
    <div class="container">
        <h1 class="text-center zag"><?= $master_to_category[0]['categories']['title'] ?></h1>
        <hr>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="btn-group" style="float: right" >

                    <?php if ($cities) :
                        ?>

                        <?php $form = ActiveForm::begin(['id' => 'master-serch-form']); ?>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="form-group-lg">
                                <?= $form->field($modelUser, 'city')->label('')->dropDownList(yii\helpers\ArrayHelper::map($cities, 'city', 'city'), ['prompt' => 'Выберите город', 'options' => [$sessionCity->get('city') => ['Selected' => true]]]); ?>
                            </div>
                        </div>

                        <?= Html::submitButton('Выбрать', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'data-user-button']) ?>
                        <?php ActiveForm::end(); ?>

                    <?php endif; ?>
                </div>
            </div>

        </div>
        <hr>


        <?php if (isset($master_to_category) && !empty($master_to_category)) { ?>

            <?php foreach ($master_to_category as $master) { ?>
                <?php
                /*  echo '<pre>';
                  print_r($master);
                  echo '</pre>'; */
                ?>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="circle">
                            <?php
                            
                            $session = Yii::$app->session;

                        $user_order = $session->get('user_order');

                        if (!Yii::$app->user->isGuest && $user_order['user_id'] == \Yii::$app->user->identity['id'] && $user_order['user_id'] == $master['user_id']) {
                            ?>                                                                              
                               <a class="select-master" href="<?= \yii\helpers\Url::to('/user/kabinetmaster'); ?>">
                                <?= HTml::img(Yii::$app->request->baseUrl .'/'. $master['users']['avatar']); ?>
                            </a>
                        <?php } ?>

                        <?php if (!Yii::$app->user->isGuest && $user_order['user_id'] != $master['user_id']) { ?>                               
                              <a class="select-master" href="<?= \yii\helpers\Url::to("/user/master?category_id=" . (int) ($master['categories']['id']) . "'&parent_id=" . (int) ($master['categories']['parent_id']) . "&category=" . $master['categories']['title'] . "&call=0&master_id=" . (int) $master['user_id']) ?> ">
                                <?= HTml::img(Yii::$app->request->baseUrl .'/'. $master['users']['avatar']); ?>
                            </a>
                        <?php } ?>

                        <?php if (Yii::$app->user->isGuest) { ?>                                                                              
                              <a class="select-master" href="<?= \yii\helpers\Url::to("/user/master?category_id=" . (int) ($master['categories']['id']) . "'&parent_id=" . (int) ($master['categories']['parent_id']) . "&category=" . $master['categories']['title'] . "&call=0&master_id=" . (int) $master['user_id']) ?>">
                                <?= HTml::img(Yii::$app->request->baseUrl .'/'. $master['users']['avatar']); ?>
                            </a>
                        <?php } ?>

                            
                            
                            
                            
                            <a class="select-master" href="<?= \yii\helpers\Url::to("/user/master?&category=" . $master['categories']['title'] . "&category_id=" . (int) ($master['categories']['id']) . "&parent_id=" . (int) ($master['categories']['parent_id']) . "&call=0" . "&master_id=" . (int) $master['user_id']) ?>">
                                <?= HTml::img(Yii::$app->request->baseUrl .'/'. $master['users']['avatar']); ?>
                            </a>
                        </div>                     
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <h1 class="text-center" style="margin-bottom: 40px"><?= $master['categories']['title'] ?></h1>
                        <div class="description" style="margin-bottom: 40px; margin-left: 40px">
                            <?= $master['users']['desc']; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <?php
                        $session = Yii::$app->session;

                        $user_order = $session->get('user_order');

                        if (!Yii::$app->user->isGuest && $user_order['user_id'] == \Yii::$app->user->identity['id'] && $user_order['user_id'] == $master['user_id']) {
                            ?>                                                                              
                            <a  class="select-master" href="<?= \yii\helpers\Url::to('/user/kabinetmaster'); ?>"><?= $master['users']['username']; ?> 31год <span class="text-center" style="display: block"> </span></a>
                        <?php } ?>

                        <?php if (!Yii::$app->user->isGuest && $user_order['user_id'] != $master['user_id']) { ?>                               
                            <a  class="select-master" href="<?= \yii\helpers\Url::to("/user/master?category_id=" . (int) ($master['categories']['id']) . "'&parent_id=" . (int) ($master['categories']['parent_id']) . "&category=" . $master['categories']['title'] . "&master_id=" . (int) $master['user_id']) ?>"><?= $master['users']['username']; ?> 31год <span class="text-center" style="display: block"> </span></a>
                        <?php } ?>

                        <?php if (Yii::$app->user->isGuest) { ?>                                                                              
                            <a  class="select-master" href="<?= \yii\helpers\Url::to("/user/master?category_id=" . (int) ($master['categories']['id']) . "'&parent_id=" . (int) ($master['categories']['parent_id']) . "&category=" . $master['categories']['title'] . "&master_id=" . (int) $master['user_id']) ?>"><?= $master['users']['username']; ?> 31год <span class="text-center" style="display: block"> </span></a>
                        <?php } ?>

                    </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="work-info">
                        <span class="count-orders"><span><?= app\models\Orders::find()->where(['master_id' => $master['users']['id']])->count() ?> заказов</span></span>
                        <span class="count-reviews"><span><?= app\models\Reviews::find()->where(['master_id' => $master['users']['id']])->count() ?> отзыва</span></span>
                        <span class="reting"><span>45</span></span>                     
                    </div>
                </div>
                <hr>
            <?php } ?>
        <?php } ?> 


    </div>
</div>
<div id="content">
    <div id="contacts">
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
                            <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Category::find()->all(), 'id', 'title'), ['prompt' => 'Выберите рубрику']) ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <?= $form->field($model, 'email')->input('email', ['placeholder' => 'E-mail']); ?>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <?= $form->field($model, 'username')->input('text', ['placeholder' => 'Ваше имя']); ?>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <?= $form->field($model, 'phone')->input('text', ['placeholder' => 'Телефон']); ?>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <?= $form->field($model, 'city')->input('text', ['placeholder' => 'Город']); ?>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <?= Html::submitButton('Поручить заказ', ['class' => ' btn btn-info btn-lg btn-block', 'name' => 'usluga-button']) ?>
                            </div>

                        </div>
                        <?php if (Yii::$app->user->isGuest) : ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?= $form->field($model, 'reg')->checkbox(['checked ' => true]); ?>
                            </div>
                        <?php endif; ?>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="help-select-masters">
        <div class="container">
            <div class="logo hidden-xs hidden-md hidden-sm">
                <a href="/"><img src="<?= Yii::$app->request->baseUrl; ?>/img/logo.png"></a>
            </div>
            <div class="language">
                <span>RU</span>
                <span>|</span>
                <span>UA</span>
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


    <div class="block-1" style="margin-bottom: 0">
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
                    <button type="button" class="btn btn-info btn-lg right  call-zakaz">Поручить заказ</button>
                </div>
            </div>
        </div>
    </div>
</div>

