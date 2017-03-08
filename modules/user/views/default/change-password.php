<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = 'Change Password';
?>
<div class="site-signup">
    <h2 style="text-align: center"><?= Html::encode($this->title) ?></h2>

    <p>Please fill out the following fields to change password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
                <?= $form->field($model, 'oldPassword')->passwordInput() ?>
                <?= $form->field($model, 'newPassword')->passwordInput() ?>
                <?= $form->field($model, 'retypePassword')->passwordInput() ?>
               <?= Html::submitButton('Change', ['class' => 'btn btn-primary btn-block', 'name' => 'change-button']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
