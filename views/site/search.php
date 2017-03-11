<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\slider\Slider;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search form-group">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    echo Html::submitButton('All', ['class' => 'btn btn-default btn-block']);

    foreach ($categories as $categoryId => $categoryName) {
        echo Html::submitButton($categoryName, ['name' => 'ProductsSearch[categoryId]', 'value' => $categoryId,
            'class' => 'btn btn-default btn-block']);
    }
    echo '<br/>';
    echo $form->field($model, 'name');

    echo
        $form->field($model, 'priceRange')->widget(Slider::classname(), [
        'sliderColor'=>Slider::TYPE_GREY,
        'handleColor'=>Slider::TYPE_PRIMARY,
        'options' => [
            'style'=>'position: relative;'
        ],
        'pluginOptions'=>[
            'width'=>'50px',
            'min'=>10,
            'max'=>1000,
            'step'=>10,
            'range'=>true,
            'tooltip_split'=>'true',
            'precision'=>2,
        ],
    ]);

    echo Html::submitButton('Search', ['class' => 'btn btn-default btn-block']);

    ActiveForm::end(); ?>

</div>
