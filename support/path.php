<?php

// Public Path Function
function public_path($str){
    return "public/" .$str;
}

// App Path Function
function app_path($str){
    return "app/" . $str;
}

// Web Path Function
function web_path($str){
    return "web/" . $str;
}

// Resource View Path
function resource_view($title, $ext=".php"){
    return __DIR__ . "/../" . "resources/views/" . $title . $ext;
}

// Resource Admin Path
function resource_admin($title, $ext=".php"){
    return "resources/admin/" . $title . $ext;
}

// Resources Partials Path Function
function resource_partial($title, $ext=".php"){
    return __DIR__ . "/../" . "resources/partials/" . $title . $ext;
}

// Resources Assets Path Function
function resource_asset($title){
    return 'http://' . $_SERVER['HTTP_HOST'] . "/assets/" . $title;
}

// Url Function
function url($title){
    return 'http://' . $_SERVER['HTTP_HOST'] . "/" . $title;
}

function requireFiles($file){

}
