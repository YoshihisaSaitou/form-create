<?php
namespace FormCreate\controllers\admin;

use FormCreate\config\Environment;
use FormCreate\controllers\admin\AdminController;

class ListController extends AdminController{
    
    public function __construct(){
        //メニューに追加
        $option = array(
            'page_title'=>Environment::PLUGIN_NAME_TEXT.'一覧',
            'menu_title'=>'一覧',
        );
        $this->addSubmenuPage($option);
        self::index();
    }
    
    public function index(){
        
        $this->view('list.php');
    }
}
