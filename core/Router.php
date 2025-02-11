<?php

namespace App\core;

use App\controllers\AuthController;

class Router
{
    private array $routes = [];

    private Request $Request;
    private Response $Response;
    
    public function __construct(Request $request, Response $response)
    {
        $this->Request = $request;
        $this->Response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function setCallback()
    {
        $path = $this->Request->getPath();
        $method = $this->Request->getMethod();

        $uri = explode('/', trim($path, "/"));

        $controllerClass = "";
        $controllerMethod = "";

        if(isset($uri[0]) && !empty($uri[0])) {
            $controllerClass = "App\\controllers\\" . ucfirst($uri[0]) . "Controller";
        }

        if(isset($uri[1]) && !empty($uri[1])) {
            $controllerMethod = ucfirst($uri[1]);
        }

        if (class_exists($controllerClass, true)) {

            if(!method_exists($controllerClass, $controllerMethod)) {
              $controllerMethod = ucfirst($uri[0]);
            }
            Application::$app->Router->{strtolower($method)}($path, [$controllerClass, $controllerMethod]);
        } else {
            $file = Application::$ROOT_PATH."\\views\\$uri[0].php";
            if(file_exists($file)){
                Application::$app->Router->{strtolower($method)}($path, $uri[0]);
            } else {
                Application::$app->Router->{strtolower($method)}($path, false);
            }
        }
    }


    public function Resolve()
    {
        $this->setCallback();
        $path = $this->Request->getPath();
        $method = $this->Request->getMethod();
        $params = $this->Request->getData();

        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false)
        {
            $this->Response->SetStatusCode(404);
            return $this->renderView("_404");
        }

        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        
        if(is_array($callback))
        {
            Application::$app->Controller = new $callback[0]();
            $callback[0] = Application::$app->Controller;
            $method = $callback[1];

            if(isset($params) && is_array($params))
            {   
                return $callback[0]->$method($params);
            }

            return $callback[0]->$method();
        }

        return call_user_func($callback);
    }

    public function renderView($views)
    {
        $viewContent = $this->renderOnlyView($views);
        $layoutContent = $this->renderLayouts();

        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    public function renderLayouts()
    {
        ob_start();
        include_once Application::$ROOT_PATH."\\views\\layouts\\main.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view)
    {
        ob_start();
        $file = Application::$ROOT_PATH."\\views\\$view.php";
        include $file;
        return ob_get_clean();
    }
}