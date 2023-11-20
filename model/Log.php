<?php
require_once('../library/Twig.php');

class Log extends CRUD {
    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'date', 'ip', 'page', 'user'];

    //$url = isset($_SERVER['PATH_INFO'])? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';
    $url = isset($_GET["url"]) ? explode ('/', ltrim($_GET["url"], '/')) : '/';

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
                    $page = $controller->$method($url[2]);
                }else{
                    $page = $controller->$method();
                }
            }else{
                $page = $controller->index();
            }
        }else{
            require_once('controller/ControllerHome.php');
            $controller = new ControllerHome;
            RequirePage::url('home');
        }
    }

    $ip = $_SERVER['REMOTE_ADDR'];

    if($guest){
        $user = 'guest'
    }else{
        $user = $_SESSION;
    }

    public function log($date, $ip, $page, $user){
        $sql = "CREATE TRIGGER update_last_modified BEFORE UPDATE ON log
                FOR EACH ROW SET NEW.last_modified = NOW();"
        $sql = "INSERT INTO `log`(date, ip, page, user) VALUES ($date, $ip, $page, $user)";
        $stmt = $this->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $this->lastInsertId();
    }
}
?>