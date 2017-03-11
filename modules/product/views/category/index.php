<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
Yii::setAlias('@products', '/product/products');

?>
<div class="category-index">

    <p>
        <?= Html::a('Add new Category', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Edit products', ['@products'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'ukr',
            'rus',
            'eng',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
