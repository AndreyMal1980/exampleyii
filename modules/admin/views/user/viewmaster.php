<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">
 
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <?php $orders_ostatok = app\modules\admin\models\Orders::find()->asArray()->with('category', 'status', 'user')->where(['master_id' => (int) $model->id,'status_id' => 0])->all(); ?>
        <?php if($orders_ostatok){ ?>
          <h3> Остаток заявок &nbsp(&nbsp<?= count($orders_ostatok); ?>&nbsp) </h3>
        <?php } else { ?>
         <h3>нет заявок на остатке</h3>
        <?php } ?>
        <h3 class="text-center"><?= Html::encode($model->username) ?></h3>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                //  'id',
                'username',
                'userfamily',
                'avatar',
                'phone',
                'desc:ntext',
                'city',
                'email:email',
                // 'birthday',
                [
                    'attribute' => 'birthday',
                    'value' => date('Y-m-d', $model->birthday)
                ],
                'street',
                'hourse',
                //'password',
                // 'type',
                //'verificated',
                [                      // name свойство зависимой модели owner
                    'label' => 'Верификация',
                    'value' => !$model->verificated ? 'Не пройдена' : 'Пройдена'
                ],
            // 'auth_key',
            ],
        ])
        ?>
</div>
    <?php $orders_done = app\modules\admin\models\Orders::find()->asArray()->with('category', 'status', 'user')->where(['master_id' => (int) $model->id,'status_id' => 2])->all(); ?>
    <?php $orders_otkaz = app\modules\admin\models\Orders::find()->asArray()->with('category', 'status', 'user')->where(['master_id' => (int) $model->id,'status_id' => 4])->all(); ?>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
         <?php if ($orders_done) { ?>
        <h3> Выполненные заявки &nbsp(&nbsp<?= count($orders_done); ?>&nbsp) </h3>
        <div class="table-responsive table-bordered table-condensed"> 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>№ п/п</th>
                                <th>Создана</th>
                                <th>Имя заявки</th>
                                <th>Категория</th>
                                <th>Заказал</th>
                            </tr>
                        </thead>
                        <tbody>
   <?php    foreach ($orders_done as $order) : $i = 0;

      /*   echo '<pre>';
          print_r($orders_done);
          echo '</pre>'; */
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
                                   
                                    <td><a href="<?= \yii\helpers\Url::to('/admin/user/viewuser?id='.(int)($order['user']['id'])) ?>"><?= $order['user']['username'] ?></a></td>
                                   
                                </tr>
                                    <?php $i++ ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div> 
             <?php } else { ?>
              <h3>нет выполненных заявок</h3>
              <?php } ?>
        
          <?php if ($orders_otkaz) { ?>
        <h3>не принятые заявки &nbsp(&nbsp<?= count($orders_otkaz); ?>&nbsp) </h3>
        <div class="table-responsive table-bordered table-condensed"> 
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>№ п/п</th>
                                <th>Создана</th>
                                <th>Имя заявки</th>
                                <th>Категория</th>
                                <th>Заказал</th>
                            </tr>
                        </thead>
                        <tbody>
   <?php    foreach ($orders_otkaz as $order) : $i = 0;

      /*   echo '<pre>';
          print_r($orders_done);
          echo '</pre>'; */
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
                                   
                                    <td><a href="<?= \yii\helpers\Url::to('/admin/user/viewuser?id='.(int)($order['user']['id'])) ?>"><?= $order['user']['username'] ?></a></td>
                                   
                                </tr>
                                    <?php $i++ ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div> 
             <?php } else { ?>
             <h3>отказа от заявок не было</h3>
              <?php } ?>
        
        
    </div>
    
<?php $orders = app\modules\admin\models\Orders::find()->asArray()->with('category', 'status', 'master')->where(['master_id' => (int) $model->id])->all(); ?>

    <?php
    /*  echo '<pre>';
      print_r($orders);
      echo '</pre>'; */
    ?>
   <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php if ($orders) : ?>
                <h3> Все заявки </h3>
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
                              
                            </tr>
                        </thead>
                        <tbody>
    <?php
    foreach ($orders as $order) : $i = 0;

        /* echo '<pre>';
          print_r($order);
          echo '</pre>'; */
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
                                    <td><?= $order['status']['status'] ?></td>
                                    
                                </tr>
                                    <?php $i++ ?>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div> 
             <?php endif; ?>
        </div>
    </div>
  </div>


