<?php
class Exports {
    public static function class(string $name){
        return __DIR__  .DIRECTORY_SEPARATOR  . $name . '.php';
    }
    public static function layout(string $name){
        $file =  dirname(__DIR__) . DIRECTORY_SEPARATOR  . 'layouts' . DIRECTORY_SEPARATOR  . $name . '.php';
        return $file;
    }
}
?>