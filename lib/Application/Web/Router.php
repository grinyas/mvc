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
    /**
     * Resolved request route
     *
     * @var array
     */
    protected $route = [];

    /**
     * Resolved route params.
     *
     * @var array
     */
    protected $routeParams = [];

    public function resolve()
    {


        $defaults = [
            'controller' => App::$i->getComponent('config')->get('defaultController'),
            'action' => 'index',
        ];

        $resolvedPath = [];
        if($route = App::$i->getComponent('request')->getParam('route')){

            $parts = explode('/', $route);
            $resolvedPath = [
                'controller' => array_shift($parts),
                'action' => !empty($parts[0])
                    ? array_shift($parts)
                    : null,
            ];

            $this->resolveParams($parts);
        }

        var_dump($resolvedPath);

        $this->route = array_filter($resolvedPath) + $defaults;

        $controllerClass = ucfirst($this->route['controller']) . 'Controller';
        $controllerClass = "\\Academy\\Controllers\\{$controllerClass}";

        $controllerAction = 'action' . ucfirst($this->route['action']);

        $this->setController($controllerClass);
        $this->setAction($controllerAction);

        return  $this;
    }

    public function getController()
    {
        return $this->route['controller'];
    }

    public function getAction()
    {
        return $this->route['action'];
    }

    protected function setController($controllerClass)
    {
        $this->route['controller'] =  $controllerClass;
    }

    protected function setAction($controllerAction)
    {
        $this->route['action'] =  $controllerAction;
    }

    public function resolveParams(array $params)
    {
        if(empty($params))
            return;

        foreach ($params as $key => $value){
            if(!($key % 2))
                $this->routeParams[$value] = $params[++$key];
        }
    }

    /**
     * Returns resolved route parameters.
     *
     * @return array
     */
    public function getRouteParams()
    {
        return $this->routeParams;
    }
}