<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>


<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>          
    </div>
<?php endif; ?> 

<?php
$check;
if (!Yii::$app->user->isGuest)
    $check = true;
else {
    $check = false;
}

//$user = $session->get('user');
//echo $check;
//$session->remove('user');
$category_id = (int) (Yii::$app->request->get('category_id'));
$parent_id = (int) (Yii::$app->request->get('parent_id'));
?>

<div id="master">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12">               
                <div class="circle">
                    <a href=""><?= HTml::img(Yii::$app->request->baseUrl.$master->avatar, ['alt' => '']); ?></a>
                </div>                                                     
                <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                    <span class="name"><?= $master->username; ?></span>
                    <span class="age">31год</span><br>
                    <span class="city">г.<?= $master->city ?></span><br>
                    <span class="count-orders"><span><?= app\models\Orders::find()->where(['master_id' => $master->id])->count();?> заказов</span></span>
                </div>
            </div>
            <div class="col-lg-9 col-md-2 col-sm-2 col-xs-12">

                <div class="show-contact">
                    <a href="#" id="example1"><span>Открыть контактную информацию</span></a>
                </div>

                <div style="display: none" class="contact-info">
                    <div class="phone">
                        телефон - <?= $master->phone ?>
                    </div>
                    <div class="email">
                        email - <?= $master->email ?>
                    </div>                            
                </div>
                <span class="category"><?= Yii::$app->request->get('category') ?></span>             
                <div style="margin-top: 20px" class="description">
                    <?= $master->desc ?> 
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="slider slides-portfolio-master">    
            <div class="slides-top">
                <img src="<?= Yii::$app->request->baseUrl; ?>/img/portfolio-foto-masters/img-1.png">               
            </div>
            <div class="slides-top">
                <img src="<?= Yii::$app->request->baseUrl; ?>/img/portfolio-foto-masters/img-2.png">                
            </div>
            <div class="slides-top">
                <img src="<?= Yii::$app->request->baseUrl; ?>/img/portfolio-foto-masters/img-3.png">                        
            </div>
            <div class="slides-top">
                <img src="<?= Yii::$app->request->baseUrl; ?>/img/portfolio-foto-masters/img-4.png">            
            </div>       
            <div class="slides-top">
                <img src="<?= Yii::$app->request->baseUrl; ?>/img/portfolio-foto-masters/img-5.png">            
            </div>      
        </div>                        
    </div>
</div> 
<div id="reviews">
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

                <?php foreach ($reviews as $review): 
                    
               /* echo '<pre>';
                print_r($review);
                echo '<pre>';*/
                    
                    ?>
                
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
                                        <?= Yii::$app->request->baseUrl; ?>/<?= Html::img(Yii::$app->request->baseUrl . '/img/avatars/no-foto.png') ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span class="name"><?= $review->autor; ?></span>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
                                    <div class="date">
                                        <span><?= date("d.m.Y", $review['date_added']); ?> </span> 
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                    <div class="time">
                                        <span> <?= date('H:i', $review['date_added']); ?> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                <?= $review->review ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                <hr>
                            </div>
                            <?php if(isset($review['answer']) && $review['answer'] != ''){ ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                <h2>Ответ мастера на Ваш комментарий</h2>
                                <?= $review->answer ?>
                            </div>
                            <?php } else { ?>
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                <h2>Мастер пока не ответил на Ваш комментарий</h2>
                                <?= $review->answer ?>
                            </div>
                             <?php } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div style="margin-bottom: 100px" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <?php
                echo \yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

<div style="display: none">
    <div class="box-modal" id="modal-call-master" >
        <div class="box-modal_close arcticmodal-close">закрыть</div>
        <h2>Вам удалось дозвониться ?</h2>
        <div class="quest">
            <a href="<?= \yii\helpers\Url::to("/user/master?category_id=" . (int) ($category_id) . "&parent_id=" . (int) ($parent_id) . "&call=1" . "&category=" . Yii::$app->request->get('category') . "&master_id=") . (int) ($master['id']) ?>">ДА</a>
            <a href="<?= \yii\helpers\Url::to("/user/masters?category_id=" . (int) ($category_id) . "&parent_id=" . (int) ($parent_id)) ?>">НЕТ</a>
        </div>
    </div>
</div>


<script>
    $(function () {
        var check = <?php echo $check; ?>

        $('.show-contact').on('click', function () {
            if (check == 1) {
                $('.contact-info').show();
                setTimeout(showCallMaster, 1000);
            } else {
                alert("Чтобы просматривать контактные данные мастеров Вам необходимо зарегестрироваться на портале");
            }
        });

        // $("body").on("contextmenu", false);
        function showCallMaster() {
            $('#modal-call-master').arcticmodal({
                closeOnEsc: false,
                closeOnOverlayClick: false,
            });
        }

    });
</script>