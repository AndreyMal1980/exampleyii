<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Создать статью', ['Создать'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'slug',
           // 'excerpt',
           // 'description:html',
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
             'date_added',
            // 'date_modificate',
            // 'show',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
