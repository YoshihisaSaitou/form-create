<?php
namespace FormCreate\controllers\admin;

use FormCreate\controllers\admin\AdminController;

class TopController extends AdminController{
    
    public function __construct(){
        
    }
    
    public function index(){
        
        $this->view('top.php');
    }
}
