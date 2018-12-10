<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
<div class="users-index ">

    <h3>Список Мастеров</h3>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-condensed table-bordered',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'username',
            'userfamily',
           // 'avatar',
             [
                 'attribute' => 'avatar',
                 'format' => 'html' , 
               
                'value' => function($data) {
                   /* echo '<pre>';
                    print_r($data);
                     echo '</pre>';*/
                   
                    return "<img src='{$data->getImage()->getUrl('x50')}'>";
                }
                
            ],
            'phone',
            //'desc:ntext',
            'city',
            'email:email',
            // 'birthday',
            // 'street',
            // 'hourse',
            // 'password',
            // 'type',
            [
                'attribute' => 'verificated',
                'value' => function ($data) {
                    return !$data->verificated ? 'Не пройдена' : 'Пройдена';
                }
            ],
            // 'verificated',
            // 'auth_key',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '/admin/user/viewmaster?id=' . (int) ($model->id));
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
</div>
