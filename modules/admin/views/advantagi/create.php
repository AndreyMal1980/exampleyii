<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advantagi */

$this->title = 'Create Advantagi';
$this->params['breadcrumbs'][] = ['label' => 'Advantagis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advantagi-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
