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
<?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>

<div id="application">
    <div class="container">
        <div class="row">
            <h1 class="text-center">Подача заявки</h1>
            <div class="title title--center">
                <div class="circle"></div>
            </div> 
            <div class="form-usluga">
                <h1 style="margin-bottom: 80px"><?= Html::encode($this->title) ?></h1>
                
                <div class="col-lg-8 col-lg-offset-2">
                
                <?php $form = ActiveForm::begin(['id' => 'usluga-form']); ?>

                <?= $form->field($order, 'name_orders')->label('')->input('text', ['placeholder' => 'Название задачи']) ?>

                <?= $form->field($order, 'description')->textArea(['placeholder' => 'Краткое описание задачи', 'rows' => 10]) ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?= $form->field($order, 'category_id')->dropDownList($listCategory, ['prompt' => 'Выберите рубрику','value' => Yii::$app->request->get('category_id')]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <?= $form->field($order, 'email')->input('email', ['placeholder' => app\models\User::findBySql("SELECT email FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->email, 'value' => app\models\User::findBySql("SELECT email FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->email]); ?>
                    <?php } else { ?>
                        <?= $form->field($order, 'email')->input('email', ['placeholder' => 'E-mail']); ?>
                    <?php } ?>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?php $session = Yii::$app->session; 
                   // print_r($session['usercallback']['phone']);
                    ?>
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <?= $form->field($order, 'username')->input('text', ['placeholder' => Yii::$app->user->identity['username'], 'value' => Yii::$app->user->identity['username']]); ?>
                    <?php } else { ?>
                        <?= $form->field($order, 'username')->input('text', ['placeholder' => 'Ваше имя','value' => $session['usercallback']['username'] ? $session['usercallback']['username'] : '']); ?>
                    <?php } ?>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <?= $form->field($order, 'phone')->input('phone', ['placeholder' => app\models\User::findBySql("SELECT phone FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->phone, 'value' => app\models\User::findBySql("SELECT phone FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->phone]); ?>
                    <?php } else { ?>
                        <?= $form->field($order, 'phone')->input('text', ['placeholder' => 'Телефон','value' => $session['usercallback']['phone'] ? $session['usercallback']['phone'] : '']); ?>
                    <?php } ?>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <?= $form->field($order, 'city')->input('city', ['placeholder' => app\models\User::findBySql("SELECT city FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->city, 'value' => app\models\User::findBySql("SELECT city FROM users WHERE id = " . (int) Yii::$app->user->getId())->one()->city]); ?>
                    <?php } else { ?>
                        <?= $form->field($order, 'city')->input('text', ['placeholder' => 'Город']); ?>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <div class="col-lg-12">
                        <?= Html::submitButton('Поручить заказ', ['class' => ' btn btn-info btn-lg btn-block', 'name' => 'usluga-button']) ?>
                    </div>

                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php if (Yii::$app->user->isGuest) { ?>
                        <?= $form->field($order, 'reg')->checkbox(['checked ' => true]); ?>
                    <?php } ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    </div>


