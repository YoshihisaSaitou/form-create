<?php
namespace FormCreate\controllers;

use FormCreate\config\Environment;

abstract class BaseController{
    
    public function __construct(){
        
    }
    
    public function view($name){
        include_once(Environment::getPluginRootDir().Environment::ADMIN_VIEW_PATH.$name);
    }
}
