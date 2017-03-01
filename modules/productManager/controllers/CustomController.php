<?php
namespace app\modules\productManager\controllers;
use yii\web\Controller;
class CustomController extends Controller {
    public function actionGreet() {
        return $this->render('greet');
    }
}

