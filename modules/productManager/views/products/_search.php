<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\productManager\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search form-group">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'class' => 'row',
    ]); ?>

    <div class="table-responsive">
        <table class="table">
            <tr>
                <td><?= $form->field($model, 'id') ?></td>
                <td><?= $form->field($model, 'name') ?></td>
                <td><?= $form->field($model, 'categoryId')->dropDownList($categories,['prompt' =>'please select']) ?></td>
            </tr>
        </table>
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block']) ?>

    </div>
    <div class="form-group">
    </div>

    <?php ActiveForm::end(); ?>

</div>
