<?php
namespace FormCreate\controllers\admin;

use FormCreate\config\Environment;
use FormCreate\controllers\admin\AdminController;

class DeleteController extends AdminController{
    
    public function __construct(){
        self::index();
    }
    
    public function index(){
        
        $this->view('delete.php');
    }
}
