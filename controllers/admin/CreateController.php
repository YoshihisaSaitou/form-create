<?php
namespace FormCreate\controllers\admin;

use FormCreate\config\Environment;
use FormCreate\controllers\admin\AdminController;

class CreateController extends AdminController{
    
    public function __construct(){
        //メニューに追加
        $option = array(
            'page_title'=>Environment::PLUGIN_NAME_TEXT.'新規追加',
            'menu_title'=>'新規追加',
        );
        $this->addSubmenuPage($option);
        self::index();
    }
    
    public function index(){
        
        $this->view('create.php');
    }
}
