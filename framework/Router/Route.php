<?php

namespace Framework\Router;

use Framework\View\View;
use Framework\Helper\Helper;

class Route {

    private $routes;

    public function __construct(){
        include($_SERVER['DOCUMENT_ROOT'] . Helper::getUrlRoot() . "/config/Routes.php");

        $this->routes = $routes;

        $error = false;

        foreach($this->routes as $r){
            if($r[1] == 'get'){
                if(!self::get($r[0], $r[2])){
                    $error = true;
                } else {
                    $error = false;
                    break;
                }
            } else if($r[1] == 'post'){
                if(!self::post($r[0], $r[2])){
                    $error = true;
                } else {
                    $error = false;
                    break;
                }
            }
        }

        if($error == true){
            http_response_code(404);

            return View::make("404");
        }
    }

    public static function getURI(){
        return str_replace(Helper::getUrlRoot(), '', $_SERVER['REQUEST_URI']);
    }

    public static function getRoot(){
        return $_SERVER['HTTP_HOST'];
    }

    public static function get($URI, $callback){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $urlVar = strpbrk($URI, '{');

            if($urlVar){
                $urlVar = str_replace(['{','}'], '', $urlVar);
                $urlVar = strrchr(self::getURI(), '/');
                $urlVar = str_replace('/', '', $urlVar);
            }

            $urlSub = strpbrk($URI, '{');

            $URI = str_replace($urlSub, $urlVar, $URI);

            if($URI == self::getURI()){
                $explode = explode('@', $callback);

                $controller = $explode[0];
                $acao = $explode[1];

                $path = $_SERVER['DOCUMENT_ROOT'] . Helper::getUrlRoot() . "/app/Controller/" . $controller . ".php";

                if(file_exists($path)){
                    require $path;

                    $controller = "App\\Controller\\" . $controller;

                    if($urlVar){
                        $controller::$acao($urlVar);
                        return true;
                    }
                    $controller::$acao();
                    return true;

                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function post($URI, $callback){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($URI == self::getURI()){
                if(empty($_POST)){
                    return false;
                } else {
                    $explode = explode('@', $callback);

                    $controller = $explode[0];
                    $acao = $explode[1];

                    $path = $_SERVER['DOCUMENT_ROOT'] . Helper::getUrlRoot() . "/app/Controller/" . $controller . ".php";

                    if(file_exists($path)){
                        require $path;

                        $controller = "App\\Controller\\" . $controller;

                        $args = (object) $_POST;

                        $controller::$acao($args);
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function redirect($route){
        $route = self::route($route);

        return header("location: $route");
    }

    public static function getRoute($route){
        $error = true;
        if($route[1] == 'get'){
            if(!self::get($r[0], $r[2])){
                $error = true;
            } else {
                $error = false;
                return $r[0];
            }
        } else if($route[1] == 'post'){
            if(!self::post($r[0], $r[2])){
                $error = true;
            } else {
                $error = false;
                return $r[0];
            }
        }

        if($error == true){
            return View::make("404");
        }
    }

    public static function route($route){
        include($_SERVER['DOCUMENT_ROOT'] . Helper::getUrlRoot() . "/config/Routes.php");

        foreach($routes as $r){
            if($r[3] == $route){
                $route = $r[0];
            }
        }

        $urlVar = strpbrk($route, '{');

        if($urlVar){
            $urlVar = str_replace(['{','}'], '', $urlVar);
            $urlVar = strrchr(self::getURI(), '/');
            $urlVar = str_replace('/', '', $urlVar);
        }

        $urlSub = strpbrk($route, '{');

        $route = str_replace($urlSub, $urlVar, $route);

        return Helper::getUrlRoot() . $route;
    }
}