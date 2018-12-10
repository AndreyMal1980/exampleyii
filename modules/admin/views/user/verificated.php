<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="users-index ">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <h3>Список Мастеров для прохождения верификации</h3>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => [
                'class' => 'table table-condensed table-bordered',
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn',
                ],
                // 'id',
                'username',
                'userfamily',
                'avatar',
                'phone',
                //'desc:ntext',
                'city',
            // 'email:email',
            // 'birthday',
            // 'street',
            // 'hourse',
            // 'password',
            // 'type',
            // 'verificated',
            // 'auth_key',
            /* ['class' => 'yii\grid\ActionColumn',
              ], */
            ],
        ]);
        ?>
        <button class="btn btn-md btn-info text-right varificated">Сохранить</button>
    </div>
</div>

<script>
    $(function () {
        $('.varificated').on('click', function () {
            var keys = $('#w0').yiiGridView('getSelectedRows');// массив ключей для отмеченных строк
            //console.log(keys);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "<?= \yii\helpers\Url::toRoute(['/admin/user/verificatedconfirm']) ?>",
                data: {keys: keys},
                success: function (data) {
                    console.log(data);
                    if (data) {
                        location.reload();
                    }
                },
                error: function (data) {
                    alert('Возникла ошибка');
                },
            });

       
        });
    });


</script>


