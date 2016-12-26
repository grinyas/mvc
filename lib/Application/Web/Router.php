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

    public function resolve()
    {
        $defaults = [
            'controller' => App::$i->config->get('defaultController'),
            'action' => 'index',
        ];

        $resolvedPath = [];
        if($route = App::$i->request->getParam('route')){

            $parts = explode('/', $route);
            $resolvedPath = [
                'controller' => $parts[0],
                'action' => !empty($parts[1])
                    ? $parts[1]
                    : null,
            ];
        }

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
}