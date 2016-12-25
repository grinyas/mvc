<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 12/25/16
 * Time: 8:50 PM
 */

namespace Academy\Controllers;


class SiteController
{

    public function actionIndex()
    {
        echo __METHOD__ . '<br><br>';
        var_dump($_SERVER);
    }
}