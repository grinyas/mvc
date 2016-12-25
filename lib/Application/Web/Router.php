<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 12/25/16
 * Time: 9:01 PM
 */

namespace Academy\Application\Web;

use Academy\App;

class Router
{
    protected $route = [];

    public function resolve()
    {
        $defaults = [
            'controller' => App::$i->config->get('defaultController'),
            'action' => 'index',
        ];


//        if(array_key_exists(ROUTER, $this->queryParams)){
//            $route = $this->queryParams[ROUTER];
//            unset($this->queryParams[ROUTER]);
//        }

        $resolvedPath = [];
        if($route = App::$i->request->getParam(ROUTE)){
            $parts = explode('/', $route);
            $resolvedPath = [
                'controller' => $parts[0],
                'action' => !empty($parts[1])
                    ? $parts[1]
                    : NULL,

            ];
        }

        $this->route = $resolvedPath + $defaults;
        return  $this;
    }
}