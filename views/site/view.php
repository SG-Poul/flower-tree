<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Products */

$language = \Yii::$app->language;

if ($language == 'uk') {
    $this->title =  $model->descriptionUkr_Name;
} else if ($language == 'ru') {
    $this->title =  $model->descriptionRus_Name;
} else if ($language == 'en') {
    $this->title =  $model->descriptionEng_Name;
}


?>
<div class="products-view">
    <div class="container">
        <div class="col-sm-8">
            <?php
            $imgCount = 0;
            foreach ($images as $img) {
                $imgCount++;
                echo '<div class="photo-container">' . $img . '</div>';
            }
            ?>
        </div>

        <div class="col-sm-4">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?php
                    if ($language == 'uk') {
                        echo $model->descriptionUkr_Description;
                    } else if ($language == 'ru') {
                        echo $model->descriptionRus_Description;
                    } else if ($language == 'en') {
                        echo $model->descriptionEng_Description;
                    }
                ?>
            </p>
            <span class="glyphicon glyphicon-tag product-price" aria-hidden="true"> <?= $model->price ?> <?= \Yii::t('app', 'UAH')?> </span>
            <?php $form = ActiveForm::begin(['class'=>'form-horizontal', 'action'=>Url::toRoute(['order/cart/add-to-cart','id'=>$model->id])]); ?>
            <?= Html::submitButton(\Yii::t('order', 'add to cart')) ?>
            <?php ActiveForm::end(); ?>

        </div>
        <br/>
        <?php
        // the model to which are added comments, for example:
        //            $model = Post::find()->where(['title' => 'some post title'])->one();

        echo \yii2mod\comments\widgets\Comment::widget([
            'model' => $model,
            'commentView' => '@app/modules/commentModule/views/index'
        ]); ?>
    </div>

    <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <?php
    $imageScript = <<< JS
        $('.img-modal').click(function(){
            $('.modal-body').empty();
  	        $($(this).parents('div').html()).appendTo('.modal-body');
  	        $('#myModal').modal({show:true});
        });
        $('.modal-body').click(function(){
            $('.modal-body').empty();
  	        $('#myModal').modal('hide');
        });
JS;
    $this->registerJs($imageScript, yii\web\View::POS_READY);
    ?>

</div>
