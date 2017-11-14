<?php
/*
@package FormCreate
@version 1.0

Plugin Name: FormCreate
Plugin URI: https://github.com/YoshihisaSaitou/form-create
Description: フォーム作成プラグイン
Version: 1.0
Author: Yoshihisa Saito
Author URI: https://github.com/YoshihisaSaitou/form-create
License: GPL2
Text Domain: form-create
Domain Path: /languages/
*/

namespace FormCreate;

//require_once('config/App.php');
require_once('config/Utility.php');
require_once('config/Environment.php');
require_once('controllers/BaseController.php');

//管理画面を表示している場合のみ実行
//if(is_admin()){
//require_once('controllers/admin/AdminController.php');
//require_once('controllers/admin/TopController.php');
//require_once('controllers/admin/CreateController.php');
//require_once('controllers/admin/DeleteController.php');
//require_once('controllers/admin/EditController.php');
//require_once('controllers/admin/ListController.php');
//}
use FormCreate\config\Environment;
use FormCreate\controllers\admin\AdminController;
use FormCreate\controllers\admin\TopController;
use FormCreate\controllers\admin\CreateController;
use FormCreate\controllers\admin\DeleteController;
use FormCreate\controllers\admin\EditController;
use FormCreate\controllers\admin\ListController;

// 管理画面を表示している場合のみ実行します。
//if( is_admin() ) {
//    $form_create_page = new TopController();
//}