<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
<div class="users">


    <h3>Список пользователей</h3>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'username',
            // 'userfamily',
            'avatar',
            'phone',
            // 'desc:ntext',
            'city',
            'email:email',
            // 'birthday',
            // 'street',
            // 'hourse',
            // 'password',
            // 'type',
            // 'verificated',
            // 'auth_key',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/admin/user/viewuser?id=' . (int) ($model->id));
                    },
                ],
            ],
        ],
    ]);
    ?>

</div>
</div>