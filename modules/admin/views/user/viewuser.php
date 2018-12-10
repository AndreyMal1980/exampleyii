<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="users-view">
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <h3 class="text-center"><?= Html::encode($model->username) ?></h3>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //  'id',
            'username',
            // 'userfamily',
            'avatar',
            'phone',
            // 'desc:ntext',
            'city',
            'email:email',
        // 'birthday',
        // 'street',
        //  'hourse',
        // 'password',
        // 'type',
        //  'verificated',
        // 'auth_key',
        ],
    ]);
    ?>

    <?php $orders = app\modules\admin\models\Orders::find()->asArray()->with('category','status','master')->where(['user_id' => (int)$model->id])->all(); ?>
   
</div> 
</div> 

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<?php if ($orders) : ?>
        <h3> Заявки пользователя </h3>
        <div class="table-responsive table-bordered table-condensed"> 
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>№ п/п</th>
                        <th>Создана</th>
                        <th>Имя заявки</th>
                        <th>Категория</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Мастер</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach ($orders as $order) : 
                            
/*echo '<pre>';
print_r($order);
echo '</pre>';*/
?> 
                          
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <div class="date" style="padding:0">
                                    <span><?= date("d.m.Y", $order['date_added']); ?> </span> 
                                </div>
                                <div class="time">
                                    <span> <?= date('H:i', $order['date_added']); ?> </span>
                                </div>
                            </td>
                            <td><?= $order['name_orders'] ?></td>
                            <td><?= $order['category'][$i]['title'] ?></td>
                            <td><?= $order['description'] ?></td>
                            <td><?= $order['status']['status']  ?></td>
                            <?php if(!empty($order['master'])){ ?>
                            <td><?= $order['master']['username'] ?></td>
                            <?php  } else { ?>
                             <td>Нет мастера</td>
                             <?php }  ?>
                        </tr>
                        <?php  $i++ ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div> 
    <?php endif; ?>
 </div> 