<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\productManager\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
?>
<div class="products-index">
    <p>
        <?= Html::a('Add new Products', ['create'], ['class' => 'btn btn-success btn-block']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
