<?php
/**
 * Created by PhpStorm.
 * User: grinyas
 * Date: 26.12.2016
 * Time: 19:53
 */

namespace Academy\Controllers;


abstract class BaseController
{

    abstract public function actionIndex();

    public function render($view, array $params = [])
    {
        $content = $this->renderPartial($view, $params);
        ob_start();
        echo $content;
        $result = ob_get_contents();
        ob_clean();
        echo $result;
    }

    /**
     *
     * @param $view Filename for render.
     * @param array $params View rendered params.
     */
    public function renderPartial($view, array $params = [])
    {
        $filename = $this->resolveViewFileName($view);

        ob_start();
        extract($params, EXTR_OVERWRITE);
        require $filename;
        $contents = ob_get_contents();
        ob_clean();

        return $contents;
    }

    protected function resolveViewFileName($view)
    {
        $nsPosition = explode('\\', static::class);
        $viewPath = strtolower(strstr($nsPosition[2], 'Controller', true));
//        $viewPath = ROOT_PATH . "/Views/{$viewPath}/$view.php";
        $viewPath = implode(DIRECTORY_SEPARATOR,
            [ROOT_PATH,
            'Views',
            $viewPath,
            "{$view}.php"
            ]);

        return $viewPath;

    }
}