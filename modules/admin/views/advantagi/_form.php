<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Advantagi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advantagi-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?php
    echo $form->field($model, 'description')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);
    ?>
    <div class="image" style="margin-bottom: 50px;margin-top: 50px">
        <img src="<?= $model->getImage()->getUrl('150x100') ?>">
    </div>
    <?=  $form->field($model, 'imageFile')->label('')->fileInput() ?>
    <?php/* $form->field($model, 'description')->textarea(['rows' => 6]) */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
