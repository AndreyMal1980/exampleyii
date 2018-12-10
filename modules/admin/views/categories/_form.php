<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'parent_id')->textInput() ?>

    <?php // echo $form->field($model, 'parent_id')->dropDownList(yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'title')) ?>

    <div class="form-group field-categories-parent_id required has-success">
        <label class="control-label" for="categories-parent_id">Родительская категория</label>
        <select id="categories-parent_id" class="form-control" name="Categories[parent_id]">
            <option value="0">Самостоятельная категория</option>
            <?= \app\components\CategoryDivacesWidget::widget(['tpl' => 'selectadmin','model' => $model]) ?>
        </select>
    </div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_modificate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
