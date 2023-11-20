<?php
RequirePage::model('CRUD');

class ControllerLang extends Controller{
    public function __construct(){
        if(!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = 'FR';
            exit();
        }else{
            $_SESSION['lang'] = 'EN';
            exit();  
        }
    }
}
?>