<?php

use yii\grid\GridView;
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
            <?php foreach ($models as $model) {?>
                <a href="<?= $model->id?>" title="<?= $model->name?>" style="color: #2A2A2A">
                    <div style="
                            border: 1px solid #2A2A2A;
                            display: inline-block;
                            overflow:hidden;
                            width: 220px;
                            margin: 0px 2px 20px;
                            padding-bottom: 10px;
                            border-radius: 4px;
                       ">
                        <div style="width:220px; height:220px; overflow:hidden;"><?= $model->MainPhotoIndex ?>
                        </div>
                        <h4 style="text-align: center"><?= $model->name ?> </h4>
                        <span class="glyphicon glyphicon-comment" style=" display: block;float:left;width: 30%;padding-left: 10px" aria-hidden="true"> 0</span>
                        <span class="glyphicon glyphicon-tag" style=" display: block;float:right;width: 50%;" aria-hidden="true"> <?= $model->price ?> UAH </span>
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
