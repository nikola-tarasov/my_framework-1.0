<?php

namespace vendor\core;

class Router{


    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;

    }

    public static function getRoute()
    {
        return self::$route;
    }


    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {

                foreach($matches as $k => $v){
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase ($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    /**
     * 
     * вызывается метод создания класса
     */
    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'];
            if (class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::loverCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObj, $action)) {
                    $cObj -> $action();
                } else {
                    echo"Метод <b> $controller::$action </b> не найден";
                }
                
            } else {
                echo"Контроллер  <b> $controller </b> не найден";
            }
        }else{
            http_response_code(404);
            include '404.html';
        }
    }

    protected static function upperCamelCase($name)
    {
        // $name = ucwords($name); переводит первую букыу в строе в заглавную
        
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name )));
        
    }

    protected static function loverCamelCase($name)
    {
        
        
        return lcfirst(self::upperCamelCase($name));
        
    }





}