<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search form-group">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'class' => 'row',
    ]); ?>

    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'categoryId')->dropDownList($categories,['prompt' =>'please select']) ?>

    <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block']) ?>


    <div class="form-group">
    </div>

    <?php ActiveForm::end(); ?>

</div>
