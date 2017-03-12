<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="products-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'categoryId')->dropDownList($categories, ['prompt' =>'please select']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descriptionUkr_Name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descriptionRus_Name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descriptionEng_Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($uploadModel, 'uploadedFiles[]')->fileInput(['multiple' => true, 'class' => 'image-input'])->label('Images') ?>

    <?= $form->field($model, 'descriptionUkr_Description')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'descriptionRus_Description')->textarea(['rows' => 5]) ?>
    <?= $form->field($model, 'descriptionEng_Description')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
