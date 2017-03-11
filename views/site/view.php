<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Products */

$this->title = $model->name;
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
            <span class="glyphicon glyphicon-tag product-price" aria-hidden="true"> <?= $model->price ?> UAH </span>
            INFO
        </div>
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
