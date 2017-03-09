<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "userPermission" permission
        $userPermission = $auth->createPermission('userPermission');
        $userPermission->description = 'Basic users right';
        $auth->add($userPermission);

        // add "adminPermission" permission
        $adminPermission = $auth->createPermission('adminPermission');
        $adminProductRoute = $auth->createPermission('/product/*');
        $adminUserRoute = $auth->createPermission('/user/admin/*');
        $adminPermission->description = 'Admin rights';
        $auth->add($adminPermission);
        $auth->add($adminProductRoute);
        $auth->add($adminUserRoute);

        // add "user" role and give this role the "userPermission" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $userPermission);

        // add "admin" role and give this role the "adminPermission" permission
        // as well as the permissions of the "user" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $adminPermission);
        $auth->addChild($admin, $adminProductRoute);
        $auth->addChild($admin, $adminUserRoute);
        $auth->addChild($admin, $user);
    }
}