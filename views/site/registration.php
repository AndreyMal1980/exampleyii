<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
?>
<div id="site-registrationt-avtorization">

    <div class="container">

        <?php
        $this->title = 'Регистрация';
        $this->params['breadcrumbs'][] = $this->title;
        ?>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('success'); ?>          
            </div>
        <?php endif; ?> 

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo Yii::$app->session->getFlash('error'); ?>
            </div>
        <?php endif; ?>




        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 

            <h3>Войти в личный кабинет</h3>

            <div class="social">
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="vk"></a>
                </div>
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="fb"></a>
                </div>
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="tw"></a>
                </div>
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="go"></a>
                </div>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'avtorization-form']); ?>

            <?= $form->field($modelLogin, 'email')->label('')->textInput(['placeholder' => 'E-mail', 'autofocus' => true]) ?>

            <?= $form->field($modelLogin, 'phone')->label('')->input('text', ['placeholder' => 'Телефон']); ?>

            <?= $form->field($modelLogin, 'password')->label('')->passwordInput(['placeholder' => 'Пароль']) ?>

            <div class="form-group">
                <?= Html::submitButton('Войти', ['id' => 'login-button', 'class' => 'btn btn-info btn-block btn-large', 'name' => 'login-button']) ?>
            </div>
            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12"> 
                <?=
                $form->field($modelLogin, 'auth_key')->checkbox([
                    'template' => "<div class=\"\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ])
                ?>
            </div>
            <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12">
                <a href="<?= \yii\helpers\Url::to() ?>">Забыли пароль?</a> 
            </div>
            <?php ActiveForm::end(); ?>

        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 col-lg-offset-4">  
            <h3>Создать кабинет</h3>

            <div class="social">
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="vk"></a>
                </div>
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="fb"></a>
                </div>
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="tw"></a>
                </div>
                <div class="col-lg-3 col-md-1 col-sm-1 col-xs-12"> 
                    <a class="go"></a>
                </div>
            </div>


            <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>

            <?= $form->field($model, 'username')->label('')->input('text', ['placeholder' => 'Ваше имя']); ?>

            <?=
            $form->field($model, 'city')->label('')->input('text', ['placeholder' => 'Ваш город']);
            ;
            ?>

            <?= $form->field($model, 'email')->label('')->input('text', ['placeholder' => 'E-mail']); ?>

            <?=
            $form->field($model, 'phone')->label('')->input('text', ['placeholder' => 'Телефон']);
            ;
            ?>

            <?= $form->field($model, 'password')->label('')->passwordInput(['placeholder' => 'Пароль']); ?>

            <?= $form->field($model, 'type')->label('')->hiddenInput(['value' => Yii::$app->request->get('type')]); ?>

            <div class="form-group">
                <?= Html::submitButton('Зарегестрироваться', ['class' => 'btn btn-info btn-block btn-large', 'name' => 'contact-button']) ?>
            </div>
            <?=
            $form->field($model, 'auth_key')->checkbox([
                'template' => "<div class=\"col-lg-6\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])
            ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


