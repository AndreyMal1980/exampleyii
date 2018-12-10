<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

  <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Добавить новую', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function($data){
                  return  $data->category->title ? $data->category->title : 'Самостоятельная категория';
                }
            ],
            'title',
            //'description:ntext',
            //'keywords',
            // 'image',
            // 'date_added',
            // 'date_modificate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
