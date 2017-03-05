<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\productManager\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
Yii::setAlias('@category', '/productManager/category');
?>
<div class="products-index">
    <div class="form-group">
        <?= Html::a('Add new Products', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Edit categories', ['@category'], ['class' => 'btn btn-success']) ?>
    </div>

    <p>
        <?= $this->render('_search', ['model' => $searchModel, 'categories' => $categories]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Photo',
                'attribute' => 'mainPhoto',
                'format' => 'raw',
                'contentOptions' => ['style' => 'max-width: 100px;']
            ],
            'name',
            [
                'label' => 'ID',
                'attribute' => 'id',
                'format' => 'raw',
                'contentOptions' => ['style' => 'max-width: 30px;']
            ],
            'categoryName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
