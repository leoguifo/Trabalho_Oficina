<?php

namespace Framework\Helper;

class Helper {
    public static function asset($path){
        $asset = self::getUrlRoot() . "/public/" . $path;

        return $asset;
    }

    public static function responseJson($json){
        header('Content-Type: application/json');

        echo json_encode($json);
    }

    public static function getUrlRoot(){
        require('./config/App.php');

        return $app['app_url'];
    }
}