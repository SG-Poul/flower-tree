<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\UserDBSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';

?>
<div class="user-db-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
             'email:email',
//             [
//                 'attribute' => 'status',
//                 'value' => function($model) {
//                     return $model->status == 0 ? 'Inactive' : 'Active';
//                 },
//                 'filter' => [
//                     0 => 'Inactive',
//                     10 => 'Active'
//                 ]
//             ],
             'created_at:date',
             'fullname',
             'address:ntext',
             'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
