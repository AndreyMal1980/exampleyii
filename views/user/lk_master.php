<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$days = [];
$year = [];

for ($i = 1; $i <= 31; $i++) {
    $days[$i] = $i;
}
for ($i = 1950; $i <= date('Y') - 17; $i++) {
    $year[$i] = $i;
}
$month = [
    '01' => 'Январь',
    '02' => 'Февраль',
    '03' => 'Март',
    '04' => 'Апрель',
    '05' => 'Май',
    '06' => 'Июнь',
    '07' => 'Июль',
    '08' => 'Август',
    '09' => 'Сентябрь',
    '10' => 'Октябрь',
    '11' => 'Ноябрь',
    '12' => 'Декабрь',
];
$model->birthday_day = (int) date('d', $model->birthday);
$model->birthday_month = date('m', $model->birthday);
$model->birthday_year = date('Y', $model->birthday);
//echo  $model->birthday_day;//date('Y:M:d',$model->birthday); 
?>

<div id="lk-master">

    <div class="container ">
        <div class="row">
            <h1 class="text-center">Личный кабинет мастера</h1>
            <div class="title title--center">
                <div class="circle"></div>
            </div>
        </div>
        <h3 style="margin-top:50px"><span style="text-align:center;display:block">Внимание!!!</span><br>
            Вы еще не прошли верификацию и поэтому пока не можете полностью пользоваться 
            услугами портала.Для прохождения верификации менеджер свяжется с Вами в ближайшее время<br>
            <span style="font-size:24px; color:red;display: block;margin-top: 20px;text-align: center">(внимательно проверьте введенный Вами при регистрации номер телефона )</span>
        </h3>
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
                                    <div class="packages" ><span>Мои пакеты</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="story-orders" ><span>История заказов</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="reviews" ><span>Мои отзывы(<?php
                                            if (isset($master_reviews))
                                                echo count($master_reviews);
                                            else
                                                echo '0';
                                            ?>)</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="portfolio" ><span>Портфолио</span></div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="side-panel panel-bonus">
                        <div class="row">
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="bonus" ><span>Бонусы</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="count-application" ><span><?= count($received_orders) ?>&nbsp;&nbsp;(Заявок)</span></div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
                                <a href="#">
                                    <div class="btn btn-lg btn-block btn-info" >Использовать</div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="side-panel panel-rating">
                        <h3>Рейтинг</h3>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px">
                            <div class="category-rating">
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9" style="padding: 0">
                                    <div class="category">Ремонт холодильников </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3" style="padding: 0">
                                    <div class="rating">5</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px">
                            <div class="category-rating">
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9" style="padding: 0">
                                    <div class="category">Ремонт холодильников </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3" style="padding: 0">
                                    <div class="rating">15</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-data" style="position: relative;">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="avatar">
                            <div class="upr">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="add-avatar"><span>Добавить</span></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="edit-avatar"><span>Изменить</span></div>
                                    </div>
                                </div>
                                <div class="save-avatar"><span>Сохранить</span></div>
                            </div>
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                            <?= $form->field($model, 'avatar')->label('')->fileInput() ?>
                            <div class="form-group">
                                <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                            <img src="<?= Yii::$app->request->baseUrl; ?>/img/avatars/master-lk-avatar.png">
                        </div>
                    </div>


                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">


                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 input-group">
                            <?php $form = ActiveForm::begin(['id' => 'data-master-form']); ?>
                            <div class="form-group-lg">
                                <?= $form->field($model, 'username')->label('')->input('text', ['placeholder' => 'Имя']); ?>
                            </div>

                            <div class="form-group-lg">
                                <?= $form->field($model, 'userfamily')->label('')->input('text', ['placeholder' => 'Фамилия']); ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                    <div class="form-group-lg">
                                        <?= $form->field($model, 'birthday_day')->label('')->dropDownList($days); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                    <div class="form-group-lg">
                                        <?= $form->field($model, 'birthday_month')->label('')->dropDownList($month); ?>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                    <div class="form-group-lg">
                                        <?= $form->field($model, 'birthday_year')->label('')->dropDownList($year); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-lg">
                                <?= $form->field($model, 'phone')->label('')->input('text', ['placeholder' => 'Телефон']); ?>
                            </div>

                            <div class="form-group-lg">
                                <?= $form->field($model, 'email')->label('')->input('text', ['placeholder' => 'E-mail']); ?>
                            </div>

                            <div class="form-group-lg">
                                <?= $form->field($model, 'password')->label('')->input('text', ['placeholder' => 'Пароль']); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">

                            <div class="form-group-lg">
                                <?= $form->field($model, 'city')->label('')->input('text', ['placeholder' => 'Ваш город']); ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group-lg">
                                        <?= $form->field($model, 'street')->label('')->input('text', ['placeholder' => 'Улица']); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group-lg">
                                        <?= $form->field($model, 'hourse')->label('')->input('text', ['placeholder' => 'Дом']); ?>
                                    </div>
                                </div>
                            </div>




                            <h3> Выберите категории в которых будете выполнять заявки </h3>
                            <ul class="catalog" style="margin-bottom:50px">
                                <?= \app\components\CategoryDivacesWidget::widget(['tpl' => 'treeview']); ?>
                            </ul>
                        </div>


                        <?php if ($master_to_categories) { ?>
                            <div class="categories" style="margin-top:50px;margin-bottom:50px">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cont-cat">
                                    <h3 class="text-center"> Вы выбрали следующие категории:</h3>
                                    <div class="append-category">
                                        <?php foreach ($master_to_categories as $category) { ?> 

                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                <div class="category">
                                                    <?= $category['categories']['title']; ?> 
                                                    <div category_id ="<?= $category['category_id'] ?>" class="delete-category">
                                                        <a  style="color: #0092ef" href="#">Удалить категорию</a>
                                                    </div>
                                                </div>         
                                            </div>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="form-group-lg">
                                <?= $form->field($model, 'desc')->label('')->textarea(['placeholder' => 'Расскажите о своих навыках', 'rows' => 10]) ?>
                            </div>
                        </div>

                        <div class="col-lg-offset-5 col-lg-5 col-md-5 col-sm-5 col-xs-12 text-right">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'data-user-button']) ?>

                            <a style="color:#000;margin-top: 20px;display: inline-block" class="service-help text-right" href="#">Написать в техподдержку</a>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>

                </div>



                <div class="my-packages" style="display: none">
                    <?php if (!empty($packages_to_master)) { ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="table-responsive"> 
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Действующий</th>
                                            <th>Срок действия</th>
                                            <th>Продлить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($packages_to_master as $package_to_master) { ?>
                                            <tr>                                    
                                                <td><?= $package_to_master['package']['name'] ?></td>
                                                <td style="border: 1px solid #cecece"><?= $package_to_master['package']['date_begin']; ?> - <?= $package_to_master['package']['date_end']; ?></td>
                                                <td> <button style="border-radius: 0" class="btn btn-xs btn-info btn-block">Продлить</button></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>


                    <?php if ($packagesAll) { ?>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <h3>Попробовать еще</h3>
                            <?php foreach ($packagesAll as $package) : ?>
                                <div class="col-lg-4 col-md-4 col-sm-24 col-xs-12">                           
                                    <div class="package">
                                        <div class="name"><?= $package->name ?></div>
                                        <div class="price">$<?= $package->price ?></div>
                                        <div class="description">
                                            <?= $package->description ?>
                                        </div>
                                        <button style="border-radius: 0" class="btn btn-lg btn-info btn-block">Купить</button>
                                    </div>                             
                                </div>
                            <?php endforeach; ?>
                        </div>  
                    <?php } ?>
                </div>


                <div class="my-story-orders" style="display: none">
                    <?php
                    if (!empty($orders_to_master)) {
                        /*   echo '<pre>';
                          print_r($orders_to_master);
                          echo '</pre>'; */
                        ?>   

                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <h3>У Вас <?= count($running_orders); ?> выполненных заказа</h3>                  
                            <div class="table-responsive"> 
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Клиент</th>
                                            <th>Дата</th>
                                            <th>Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($orders_to_master as $order) :
                                            /*  echo '<pre>';
                                              print_r($order);
                                              echo '</pre>'; */
                                            ?>
                                            <tr>
                                                <td><?= $order['username']; ?>&nbsp&nbsp г.&nbsp <?= $order['city']; ?></td>
                                                <td style="border: 1px solid #cecece">
                                                    <div class="date">
                                                        <span><?= date("d.m.Y", $order['date_added']); ?> </span> 
                                                    </div>
                                                    <div class="time">
                                                        <span> <?= date('H:i', $order['date_added']); ?> </span>
                                                    </div>
                                                </td>
                                                <td><?= $order['status'][0]['status']; ?></td>
                                            </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                 


                    </div>
                <?php } ?>

                <?php if (!empty($master_reviews)) { ?>

                    <div class="my-reviews" style="display:none">
                        <div id="reviews" style=";margin-top: 0;">                      
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">                             
                                <div class="row">
                                    <div class="review-list">
                                        <?php foreach ($master_reviews as $review): ?>
                                            <div class="review" style="padding-bottom: 0;margin: 0">

                                                <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <span class="name"><?= $review->autor; ?></span>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="date" style="padding:0">
                                                                <span><?= date("d.m.Y", $review['date_added']); ?> </span> 
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
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
                                                            <h2>Мой ответ</h2>
                                                            <?= $review->answer ?>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                                            <h2>Я еще не ответил на этот отзыв</h2>                    
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 txt">
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12">
                                                <?php $form = ActiveForm::begin(['id' => 'reviews-form']); ?>
                                            </div>
                                            <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12">
                                                <?= $form->field($modelreviews, 'date_added')->label('')->hiddenInput(['value' => $review['date_added']]); ?>
                                            </div>
                                            <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12">
                                                <?= $form->field($modelreviews, 'answer')->label('')->textarea(['placeholder' => 'Введите свой комментарий', 'rows' => 7]); ?>
                                            </div>
                                            <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12">
                                                <?= $form->field($modelreviews, 'autor')->label('')->hiddenInput(['value' => Yii::$app->user->identity['username']]); ?>
                                            </div>
                                            <div class="col-lg-12 col-md-9 col-sm-9 col-xs-12">
                                                <?= $form->field($modelreviews, 'user_id')->label('')->hiddenInput(['value' => Yii::$app->user->getId()]); ?>
                                            </div>


                                            <div class="form-group text-right">
                                                <?= Html::submitButton('Ответить', ['class' => 'btn btn-info btn-lg', 'name' => 'reviews-button']) ?>
                                            </div>
                                            <?php ActiveForm::end(); ?>
                                        <?php endforeach; ?>
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
                        </div>



                    </div>
                <?php } ?>

                <div class="my-portfolio" style="display: none">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <h3>Загрузите на портал свои работы</h3>   


                        <div class="row" style="margin-bottom: 10px">

                            <div class="img-portfolio">

                            </div>
                        </div>
                    </div>

                    <a class="add-foto" href="#">Загрузите больше фотографий</a>
                </div>
                <?php if ($received_orders) { ?>
                    <div class="my-recived-orders" style="display: none">

                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                            <div class="table-responsive"> 
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>№ </td>
                                            <th>Заказчик</th>
                                            <th>Дата добавления</th>
                                            <th>Категория</th>
                                            <th>Описание</th>
                                            <th>Действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($received_orders as $order):
                                            /*   echo '<pre>';
                                              print_r($order);
                                              echo '</pre>'; */
                                            ?>

                                            <tr orderId ="<?= $order['id'] ?>" id="tr-<?= $order['id'] ?>">
                                                <td style="border: 1px solid #cecece">
                                                    <?= $i; ?>
                                                </td>
                                                <td>
                                                    Имя - <?= $order['username']; ?><br>
                                                    Телефон - <?= $order['phone']; ?><br>
                                                    E-mail - <?= $order['email']; ?><br>
                                                </td>
                                                <td style="border: 1px solid #cecece">
                                                    <div class="date">
                                                        <span><?= date("d.m.Y", $order['date_added']); ?> </span> 
                                                    </div>
                                                    <div class="time">
                                                        <span> <?= date('H:i', $order['date_added']); ?> </span>
                                                    </div>
                                                </td>
                                                <td style="border: 1px solid #cecece">
                                                    <?= $order['category']['title'] ?>
                                                </td>
                                                <td style="border: 1px solid #cecece">
                                                    <?= $order['description'] ?>
                                                </td>
                                                <?php if ($order['status_id'] == 2) { ?>
                                                    <td> <button  class="btn btn-lg btn-warning btn-block proccess">Заявка принята</button>
                                                        <button  class="btn btn-lg btn-success btn-block close-appl">Закрыть заявку</button></td>
                                                <?php } else { ?>
                                                    <?php if ($order['status_id'] == 0) { ?>
                                                        <td> <button class="btn btn-lg btn-info btn-block accept">Принять</button>
                                                            <button  class="btn btn-lg btn-danger btn-block reject">Отклонить</button></td>
                                                        <?php } ?>
                                                    <?php } ?>
                                            </tr>
                                            <?php $i++ ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>                     
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
  </div>







        <script>
            $(document).ready(function () {
                
                var eventSource = new EventSource("<?php \yii\helpers\Url::toRoute('/admin/user/verificatedconfirm') ?>");

eventSource.onmessage = function(e) {
  console.log("Пришло сообщение: " + e.data);
};
                
                
                
                var is_par;
                $('.catalog li').on('click', function (e) {
                    e.preventDefault();

                    if ($(this).is(':has(ul)')) {
                        alert('Выберите подкатегорию');
                        is_par = 0;
                        e.stopPropagation();

                    } else {
                        e.stopPropagation();
                        var parent_category_id;
                        parent_category_id = $(this).find('.main').attr('parent_id');
                        var category_id = $(this).find('.main').attr('category_id');
                        // var category_name = $(this).find('.main').text();
                        is_par = 0;

                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: "<?= \yii\helpers\Url::toRoute(['/user/addmastercategory']) ?>",
                            data: {category_id: category_id, parent_category_id: parent_category_id, is_par: is_par},
                            success: function (data) {
                                console.log(data);
                                if (data) {
                                    $.ajax({
                                        type: 'POST',
                                        dataType: 'json',
                                        url: "<?= \yii\helpers\Url::toRoute(['/user/addmastercategory']) ?>",
                                        data: {category_id: parent_category_id, parent_category_id: parent_category_id, is_par: 1},
                                        success: function (data) {
                                            console.log(data);
                                            if (data) {
                                                //   location.reload();
                                            }
                                        },
                                        error: function (data) {
                                            alert('Возникла ошибка');
                                        }
                                    });


                                    alert("Категория добавлена");
                                    location.reload();
                                }
                            },
                            error: function (data) {
                                alert('Возникла ошибка');
                            }
                        });
                    }

                });

                $('.category').on('click', '.delete-category', function (e) {
                    e.preventDefault();
                    var category_id = $(this).attr('category_id')
                    //  alert(category_id);
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "<?= \yii\helpers\Url::toRoute(['/user/deletemastercategory']) ?>",
                        data: {category_id: category_id},
                        success: function (data) {
                            console.log(data);
                            if (data) {
                                alert("Категория удалена");
                                location.reload();
                            }

                        },
                        error: function (data) {
                            location.reload();
                            // alert('Возникла ошибка');
                        }
                    });

                });

                $('.profile').on('click', function (event) {
                    event.preventDefault();
                    $('.my-story-orders').hide();
                    $('.my-packages').hide();
                    $('.my-story-orders').hide();
                    $('.my-portfolio').hide();
                    $('.my-recived-orders').hide();
                    $('.my-reviews').hide();
                    $('.my-data').toggle();
                    $('#lk-master h1').text('Личный кабинет мастера');
                });
                $('.packages').on('click', function (event) {
                    event.preventDefault();
                    $('.my-data').hide();
                    $('.my-story-orders').hide();
                    $('.my-portfolio').hide();
                    $('.my-recived-orders').hide();
                    $('.my-reviews').hide();
                    $('.my-packages').toggle();
                    $('#lk-master h1').text('Мои пакеты');
                });
                $('.story-orders').on('click', function (event) {
                    event.preventDefault();
                    $('.my-data').hide();
                    $('.my-packages').hide();
                    $('.my-portfolio').hide();
                    $('.my-recived-orders').hide();
                    $('.my-reviews').hide();
                    $('.my-story-orders').toggle();
                    $('#lk-master h1').text('История заказов');
                });
                $('.reviews').on('click', function (event) {
                    event.preventDefault();
                    $('.my-data').hide();
                    $('.my-packages').hide();
                    $('.my-portfolio').hide();
                    $('.my-recived-orders').hide();
                    $('.my-story-orders').hide();
                    $('.my-reviews').toggle();
                    $('#lk-master h1').text('Мои отзывы');
                });
                $('.portfolio').on('click', function (event) {
                    event.preventDefault();
                    $('.my-data').hide();
                    $('.my-packages').hide();
                    $('.my-story-orders').hide();
                    $('.my-recived-orders').hide();
                    $('.my-reviews').hide();
                    $('.my-portfolio').toggle();
                    $('#lk-master h1').text('Портфолио');
                });

                $('.count-application').on('click', function () {
                    $('.my-data').hide();
                    $('.my-packages').hide();
                    $('.my-story-orders').hide();
                    $('.my-portfolio').hide();
                    $('.my-reviews').hide();
                    $('.my-recived-orders').toggle();
                });



                $('.my-recived-orders').on('click', '.close-appl', function () {
                    var order_id = $(this).parents('tr').attr('orderId');
                    var status = 3;
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "<?= \yii\helpers\Url::toRoute(['/user/closeapplication']) ?>",
                        data: {status: status, order_id: order_id},
                        success: function (data) {
                            // console.log(data[0]);
                            //   var obj = $.parseJSON(data);
                            //  console.log(data['success']);
                            // if (data.success === 'success') {
                            //  alert();
                            $("#tr-" + data.order_id).remove();
                            //  $("#tr-" + data.order_id).hide(3500);
                            alert("Заявка выполнена");
                            // }
                        },
                        error: function (data) {
                            alert('Возникла ошибка');
                        }
                    });
                });
                $('.my-recived-orders').on('click', '.accept', function () {
                    var order_id = $(this).parents('tr').attr('orderId');
                    var status = 2;
                    //  alert(order_id);
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "<?= \yii\helpers\Url::toRoute(['/user/getapplication']) ?>",
                        data: {status: status, order_id: order_id},
                        success: function (data) {
                            //console.log(data.success);
                            //var obj = $.parseJSON(data);
                            //  console.log(data['success']);
                            //if (data.success === 'success') {    
                            //   alert();
                            $("#tr-" + data.order_id).find('.accept');
                            $("#tr-" + data.order_id).find('.accept').text('Заявка принята');
                            $("#tr-" + data.order_id).find('.accept').removeClass('btn-info');
                            $("#tr-" + data.order_id).find('.accept').addClass('btn-warning');
                            $("#tr-" + data.order_id).find('.accept').removeClass('accept');
                            $("#tr-" + data.order_id).find('.btn-warning').addClass('proccess');


                            $("#tr-" + data.order_id).find('.reject');
                            $("#tr-" + data.order_id).find('.reject').text('Заявка принята').text('Закрыть Заявку');
                            $("#tr-" + data.order_id).find('.reject').removeClass('btn-danger');
                            $("#tr-" + data.order_id).find('.reject').addClass('btn-success');
                            $("#tr-" + data.order_id).find('.reject').removeClass('reject');
                            $("#tr-" + data.order_id).find('.btn-success').addClass('close-appl');
                            // $("#tr-" + data.order_id).hide(3500); 
                            alert("Заявка принята");

                            // }
                        },
                        error: function (data) {
                            alert('Возникла ошибка');
                        }
                    });
                });
                $('.my-recived-orders').on('click', '.reject', function () {
                    var order_id = $(this).parents('tr').attr('orderId');
                    var status = 4;
                    // alert(order_id);
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "<?= \yii\helpers\Url::toRoute(['/user/getapplication']) ?>",
                        data: {status: status, order_id: order_id},
                        success: function (data) {
                            // console.log(data[0]);
                            //   var obj = $.parseJSON(data);
                            //  console.log(data['success']);
                            // if (data.success === 'success') {
                            //  alert();
                            $("#tr-" + data.order_id).remove();

                            //  $("#tr-" + data.order_id).hide(3500);
                            alert("Заявка отклонена");
                            // }
                        },
                        error: function (data) {
                            alert('Возникла ошибка');
                        }
                    });
                });


            });
        </script>
