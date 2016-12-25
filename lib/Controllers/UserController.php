<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 12/25/16
 * Time: 8:34 PM
 */

namespace Academy\Controllers;


class UserController
{

    public function actionLogin()
    {
        echo __METHOD__ . '<br><br>';
        var_dump($_SERVER);
    }

}