<?php
//webdev与localhost设置区别：
//1） index.php 网址
//2） index.php URL
//3） .htaccess 
//4） CRUD.php 数据库入口

session_start();
// print_r($_SESSION);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//define('PATH_DIR', 'http://localhost:8000/w/php2/XuyingWu-SQL-TP3/');
//define('PATH_DIR', 'http://localhost:8888/php2/TP3-3/');
define('PATH_DIR', 'https://e2296789.webdev.cmaisonneuve.qc.ca/XuyingWu-SQL-TP3/');

require_once('controller/Controller.php');
require_once('library/RequirePage.php');
require_once __DIR__.'/vendor/autoload.php';
require_once('library/Twig.php');

//$url = isset($_SERVER['PATH_INFO'])? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/'; //localhost
$url = isset($_GET["url"]) ? explode ('/', ltrim($_GET["url"], '/')) : '/'; //webdev

if($url == '/'){
    require_once('controller/ControllerHome.php');
    $controller = new ControllerHome;
    echo $controller->index(); 
}else{
    $requestURL = $url[0];
    $requestURL = ucfirst($requestURL);
    $controllerPath = __DIR__."/controller/Controller".$requestURL.".php";

    if(file_exists($controllerPath)){
        require_once($controllerPath);
        $controllerName = 'Controller'.$requestURL;
        $controller = new $controllerName;
        if(isset($url[1])){
            $method = $url[1];
            if(isset($url[2])){
                echo $controller->$method($url[2]);
            }else{
                echo $controller->$method();
            }
        }else{
            echo $controller->index();
        }
    }else{
        require_once('controller/ControllerHome.php');
        $controller = new ControllerHome;
        RequirePage::url('home');
    }
}
?>
