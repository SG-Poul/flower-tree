<?php

/** @var ShoppingCart $sc */
foreach(Yii::$app->cart->positions as $position){
    echo $this->render('_cart_item',['position'=>$position]);
    //var_dump($position);
}
