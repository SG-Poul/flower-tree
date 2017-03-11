<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = 'Flowertree';
?>
<div class="site-index">

    <div class="container">
        <div class="col-sm-2">
            <?= $this->render('search', ['model' => $searchModel, 'categories' => $categories]) ?>
        </div>
        <div class="col-sm-10">
            <?php foreach ($models as $model) {
                $url = Url::to(['site/view', 'id' => $model->id]);
                ?>

                <a href="<?= $url ?>" title="<?= $model->name?>" style="color: #2A2A2A">
                    <div class="product-container">
                        <div class="product-photo"><?= $model->MainPhotoIndex ?></div>
                        <h4 style="text-align: center"><?= $model->name ?> </h4>
                        <span class="glyphicon glyphicon-comment product-comment" aria-hidden="true"> 0 </span>
                        <span class="glyphicon glyphicon-tag product-price" aria-hidden="true"> <?= $model->price ?> UAH </span>
                    </div>
                </a>
             <?php } ?>

        </div>
        <div class="container" style="margin: auto; width: 300px">
            <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
            ?>
        </div>
    </div>

</div>
