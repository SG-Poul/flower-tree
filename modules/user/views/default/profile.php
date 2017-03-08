<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserDB */

$this->title = $model->username;
?>
<div class="user-profile-edit">

    <h2><?= Html::encode($this->title) ?></h2>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'phone',
        ['template'=>'<label for="phone">' . $model->getAttributeLabel('phone') . '</label><div class="input-group"><span class="input-group-addon">+380</span>{input}</div>{error}'])->
            textInput(['placeholder' => $model->getAttributeLabel( 'phone' )]) ?>
        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save changes', ['class' => 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
