<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\productManager\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="products-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'categoryId')->dropDownList($categories) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <h2>Images</h2>

    <!-- Image section Start -->

    <div class="container">
        <div class="row">

            <?php
            $imgCount = 0;
            foreach ($images as $img) {
                $imgCount++;
                ?>
                <div class="col-lg-3 col-sm-4 col-xs-6">
                    <a title="<?= 'id-' . $model->id . '-' . $imgCount . '.png'?>" href="#">
                        <img class="thumbnail img-responsive" src="<?= $img ?>">
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">×</button>
                    <h3 class="modal-title">Heading</h3>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Choose as main</button>
                    <button class="btn btn-danger delete-image">Delete</button>
                    <button class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        $imageScript = <<< JS
        $('.thumbnail').click(function(){
            $('.modal-body').empty();
  	        var title = $(this).parent('a').attr("title");
  	        $('.modal-title').html(title);
  	        $($(this).parents('div').html()).appendTo('.modal-body');
  	        $('#myModal').modal({show:true});
        });
        $('.delete-image').click(function(event){
            event.preventDefault();
  	        var image = $('.modal-title').html();
  	        $.post( "deleteimg", { imageName : image })
              .done(function( data ) {
                location.reload();
              });
        });
JS;
        $this->registerJs($imageScript, yii\web\View::POS_READY);
    ?>
    <!-- Image section End -->

    <?= $form->field($uploadModel, 'uploadedFiles[]')->fileInput(['multiple' => true])->label('Add new') ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
