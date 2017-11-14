<?php
namespace FormCreate\controllers\admin;

use FormCreate\controllers\admin\AdminController;

class EditController extends AdminController{
    
    public function __construct(){
        self::index();
    }
    
    public function index(){
        
        $this->view('edit.php');
    }
}
