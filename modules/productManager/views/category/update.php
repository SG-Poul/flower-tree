<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\productManager\models\Category */

$this->title = 'Update Category: ' . $model->name;
?>
<div class="category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
