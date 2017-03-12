<?php

namespace app\modules\order\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\product\models\Products;
use app\modules\user\models\UserDB;

/**
 * Default controller for the `Order` module
 */
class CartController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }

        $positions = [];
        $photos = [];
        $models = [];
        foreach (Yii::$app->cart->positions as $position) {
            $model = Products::findOne($position->id);
            $models[$position->id] = $model;
            $photo = Html::img('@web/assets/products/id-' . $position->id . '-1.png', ['class' => 'img-responsive']);
            $positions[] = $position;
            $photos[$position->id] = $photo;
        }

        $userModel = $this->findUser();

        return $this->render('index', [
            'positions' => $positions,
            'photos' => $photos,
            'models' => $models,
            'userModel' => $userModel,
        ]);
    }

    public function actionAddToCart($id)
    {
        $cart = Yii::$app->cart;;

        $model = Products::findOne($id);
        if ($model) {
            $cart->put($model, 1);
            return $this->redirect(['index']);
        }
        throw new NotFoundHttpException();
    }

    public function actionChangeQuantity($id, $value)
    {
        $position = Yii::$app->cart->getPositionById($id);
        $quantity = $position->quantity + $value;
        Yii::$app->cart->update($position, $quantity);
        return $this->redirect(['index']);
    }

    public function actionDeleteFromCart($id)
    {
        Yii::$app->cart->removeById($id);
        return $this->redirect(['index']);
    }

    public function actionMakeOrder()
    {
        return 'ok';
    }

    protected function findUser()
    {
        if (($userModel = UserDB::findOne(Yii::$app->user->id)) !== null) {
            return $userModel;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
