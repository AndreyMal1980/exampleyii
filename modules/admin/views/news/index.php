<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
  
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'title',
            // 'description:ntext',
            //'date_added',
            [
                'attribute' => 'date_added',
                'value' => function($data) {
                    return date('Y-m-d : H-i', $data->date_added);
                }
            ],
            // 'imageFile',
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
