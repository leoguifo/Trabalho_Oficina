<?php

namespace Framework\View;

use Framework\Helper\Helper;
use Framework\Router\Route;

class View {

    public static function make($view, $data = null){
        $path = $_SERVER['DOCUMENT_ROOT'] . Helper::getUrlRoot() . "/resource/views/" . $view . ".php";

        if($data){
            extract($data);
        }

        if(file_exists($path)){
            require $path;
        } else {
            return false;
        }
    }

    public static function asset($path){
        return Helper::Asset($path);
    }

    public static function route($route){
        return Route::route($route);
    }
}