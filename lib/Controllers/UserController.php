<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 12/25/16
 * Time: 8:34 PM
 */

namespace Academy\Controllers;


use Academy\Model\UserModel;

class UserController extends Controller
{

    public function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
//        var_dump($_SERVER);
    }

    public function actionLogin($login)
    {
        echo __METHOD__ . '<br><br>';
//        var_dump($_SERVER);
//        echo "Login: {$login}";

        $userInfo = new UserModel();
        var_dump($userInfo->findByPk($login));
    }

    public function actionView($id)
    {
        echo "ID {$id}";

    }

}