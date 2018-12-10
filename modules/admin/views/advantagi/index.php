<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Advantagis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advantagi-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           // 'image',
            [
                 'attribute' => 'imageFile',
                 'format' => 'html' , 
               
                'value' => function($data) {
                   /* echo '<pre>';
                    print_r($data);
                     echo '</pre>';*/
                   
                    return "<img src='{$data->getImage()->getUrl('x50')}'>";
                }
                
            ],
           // 'description:html',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
