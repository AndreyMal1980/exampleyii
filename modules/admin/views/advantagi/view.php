<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advantagi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Advantagis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advantagi-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            //'image',
            [
                'attribute' => 'imageFile',
                'value' => "<img src='{$model->getImage()->getUrl('x100')}'>",
                'format' => 'html' ,   
            ],
            'description:html',
        ],
    ]) ?>

</div>
