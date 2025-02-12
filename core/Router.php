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
                $file = Application::$ROOT_PATH."\\views\\$uri[0].php";
                if(file_exists($file)){
                    Application::$app->Router->{strtolower($method)}($path, $uri[0]);
                } else {
                    Application::$app->Router->{strtolower($method)}($path, false);
                }
            } else {
                Application::$app->Router->{strtolower($method)}($path, [$controllerClass, $controllerMethod]);
            }
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
            return $this->renderView("_404", $params);
        }

        if(is_string($callback))
        {
            $class = "App\\controllers\\" . ucfirst($callback) . "Controller";
            if(class_exists($class, true) && method_exists($class, "getAll"))
            {
                $Controller = new $class;
                $params = $Controller->getAll();
            }
            return $this->renderView($callback, $params);
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
        
        return call_user_func($callback, $params);
    }

    public function renderView($views, $params)
    {
        $viewContent = $this->renderOnlyView($views, $params);

        if($views === "login" || $views === "register")
        {
            $layoutContent = $this->renderLayouts("form");
            return str_replace("{{content}}", $viewContent, $layoutContent);
        } else {
            $layoutContent = $this->renderLayouts("main");
            return str_replace("{{content}}", $viewContent, $layoutContent);
        }
    }

    public function renderLayouts($layout)
    {
        ob_start();
        include_once Application::$ROOT_PATH."\\views\\layouts\\$layout.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params)
    {
        ob_start();
        $file = Application::$ROOT_PATH."\\views\\$view.php";
        $datas['data'] = $params;
         foreach((array)$datas['data'][0] as $object)
         {
             if(gettype($object) === "object")
             {
                $className = lcfirst(explode("\\", get_class($object))[2]);
                $class = "App\\controllers\\".$className."Controller";
                $controller = new $class;
                
                $datas[$className] = $controller->getAll();
             }
         }
        include $file;
        return ob_get_clean();
    }
}