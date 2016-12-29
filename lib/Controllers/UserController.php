<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 12/25/16
 * Time: 8:34 PM
 */

namespace Academy\Controllers;


use Academy\Model\UserModel;

class UserController extends BaseController
{

    public function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        $this->render('view');
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
        $model = (new UserModel())->findByPk($id);

        if(is_null($model)){
            header('Not found', true, 404);
            exit;
        }

        $this->render('view', ['model' => $model]);
//        echo $model->id . '<br>';
//        echo $model->username . '<br>';
//        echo $model->email . '<br>';
    }

}