<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 12/25/16
 * Time: 4:57 PM
 */

namespace Academy\Application\Web;




class Request
{
    /**
     * Contains GET params
     *
     * @var array
     */
    protected $queryParams = [];

    /**
     * Contains POST params
     *
     * @var array
     */
    protected $postData = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->queryParams = $_GET;
        $this->postData = $_POST;
    }

    /**
     * Resolved incoming HTTP request.
     *
     */
    public function handleRequest()
    {

        $router = new Router();
        $controllerClass = $router->resolve()->getController();
        $controllerAction = $router->getAction();
//        ??????
        $this->queryParams = $router->getRouteParams();

//        if (!class_exists($controllerClass)
//        ) {
//            header('Not found', true, 404);
//            exit;
//        }
//Взрыв мозга!!!!!!!!!


        try {
            $reflectionMethod = new \ReflectionMethod($controllerClass, $controllerAction);
        }catch (\Exception $e){
            header('Not found', true, 404);
            exit;
        }

        $actionParams = [];

//        var_dump( $reflectionMethod->getParameters() );
        foreach ($reflectionMethod->getParameters() as $param){
            $actionParams[$param->name] = $this->getParam($param->name);
        }

        $reflectionMethod->invokeArgs(new $controllerClass,$actionParams );
//        $controller = new $controllerClass();
//        call_user_func([$controller, $controllerAction]);

    }

    /**
     * Return GET params
     *
     * $name Param name
     *
     * @return array
     */
    public function getParam($name, $defaults = null)
    {
        return isset($this->queryParams[$name])
            ? $this->queryParams[$name]
            : $defaults;
    }
}