<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$language = \Yii::$app->language;
$product_name = '';
$url = '';
$this->title = \Yii::t('order', 'cart');


?>
<div class="Order-default-index">
    <div class="row">
        <div class="col-xs-6">
            <?php
            foreach ($positions as $position):
                $model = $models[$position->id];
                ?>
                <div class="well">
                    <div class="photo-container">
                        <?= $photos[$position->id] ?>
                    </div>
                    <div class="cart-description">
                        <?php
                        if ($language == 'uk') $product_name = Html::encode($model->descriptionUkr_Name);
                        else if ($language == 'ru') $product_name = Html::encode($model->descriptionRus_Name);
                        else if ($language == 'en') $product_name = Html::encode($model->descriptionEng_Name);
                        $url = Url::to(['/site/' . $position->id]);
                        ?>

                        <a href="<?= $url ?>" style="color: #1c1c1c; text-decoration: none;"><h1> <?= $product_name ?> </h1></a>
                        <p> <h3><?= \Yii::t('order', 'price') ?> <?= $position->price ?></h3></p>

                        <div class="btn-group" role="group" aria-label="...">
                            <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action' => ['/order/cart/change-quantity'], 'method' => 'get',]); ?>
                            <?= Html::hiddenInput('id', $position->id); ?>
                            <?= Html::submitButton('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>', ['name' => 'value', 'value' => -1, 'class' => 'btn btn-default btn-lg']); ?>
                            <?= Html::button(\Yii::t('order', 'quantity') . ' : ' . $position->quantity, ['class' => 'btn btn-default btn-lg disabled ']) ?>
                            <?= Html::submitButton('<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', ['name' => 'value', 'value' => 1,  'class' => 'btn btn-default btn-lg']); ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action'=>Url::toRoute(['/order/cart/delete-from-cart','id'=>$position->id])]); ?>
                        <?= Html::submitButton(\Yii::t('order', 'delete'), ['class' => 'btn btn-danger btn-sm']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            <?php endforeach;
            ?>
        </div>

        <div class="col-xs-6">
            <div class="well">
                <?php
                    $totalPrice = 0;
                    foreach ($positions as $position):
                        $totalPrice+= $position->price * $position->quantity;
                    endforeach;
                ?>

                <h3><?= \Yii::t('order', 'total price') ?>: <?= $totalPrice ?> <?=\Yii::t('app', 'UAH') ?></h3>

                <div class="user-profile-edit">

                    <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action' => ['/order/cart/make-order'], 'method' => 'get',]); ?>

                    <?= $form->field($userModel, 'fullname')->textInput(['maxlength' => true])->label(\Yii::t('user', 'full name')) ?>
                    <?= $form->field($userModel, 'email')->textInput(['maxlength' => true])->label(\Yii::t('user', 'email')) ?>
                    <?= $form->field($userModel, 'phone',
                        ['template'=>'<label for="phone">' . \Yii::t('user', 'phone') . '</label><div class="input-group"><span class="input-group-addon">+380</span>{input}</div>{error}'])->
                    textInput() ?>
                    <?= $form->field($userModel, 'address')->textarea(['rows' => 3])->label(\Yii::t('user', 'address')) ?>

                    <div class="form-group">
                        <?= Html::submitButton(\Yii::t('order', 'make order'), ['class' => 'btn btn-success btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
