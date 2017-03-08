<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = 'Sign up';
?>
<div class="site-signup">
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= Html::submitButton('Create account', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
