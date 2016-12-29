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

    public function actionLogin($id)
    {
        echo __METHOD__ . '<br><br>';
//        var_dump($_SERVER);
//        echo "Login: {$login}";

        $userInfo = new UserModel();
        var_dump($userInfo->findByPk($id));
    }

    public function actionView($id)
    {
//        echo "ID {$id}";
        $model = (new UserModel())->findByPk($id);
//        var_dump($model);
        if(is_null($model)){
            header('Not found', true, 404);
            exit;
        }

        echo $model->id . '<br>';
        echo $model->username . '<br>';
        echo $model->email . '<br>';
    }

}