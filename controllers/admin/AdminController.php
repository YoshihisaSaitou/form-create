<?php
namespace FormCreate\controllers\admin;

use FormCreate\config\Environment;
//WordPressの必要ファイル読み込み
//require_once(Environment::getWordPressRootDir().'/wp-load.php');
use FormCreate\controllers\BaseController;

abstract class AdminController extends BaseController{
    
    public function __construct(){
        //CSS
        //add_action('admin_init', array($this, 'adminInit'));
        //add_action('admin_head', array($this, 'enqueueStyle'));
        
        //add_action('wp_enqueue_scripts', array($this, 'enqueueStyle'));
        
        // メニューを追加
        add_action( 'admin_menu', array(self, 'addMenuPage' ));
        
    }
    
    //abstract public function index(){
        
    //}
    
    /**
     * CSS読み込み
     */
    //public function enqueueStyle(){
        //$handle = Environment::PLUGIN_NAME.'-style';
        //wp_enqueue_style(Environment::PLUGIN_NAME.'-style', plugins_url(Environment::PLUGIN_NAME.'/css/style.css'));
        //wp_register_style(Environment::PLUGIN_NAME.'-style', plugins_url('css/style.css', __FILE__) );
        //wp_enqueue_style(Environment::PLUGIN_NAME.'-style');
        //wp_enqueue_style($handle, plugin_dir_url(__FILE__) . 'css/style.css');
    //}
    
    /**
     * トップページ
     */
    public function topPage(){
        $this->view('top.php');
    }
    
    /**
     * 
     */
    //public function adminInit(){
    //    wp_register_style(Environment::PLUGIN_NAME.'-style', plugins_url('css/style.css', __FILE__) );
    //}
    
    /**
     * メニュー追加
     * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
     * $page_title: 設定ページの<title>部分
     * $menu_title: メニューに使用されるテキスト
     * $capability: 権限 ( 'manage_options' や 'administrator' など)
     * $menu_slug : メニューのslug
     * $function  : 設定ページの出力を行う関数
     * $icon_url  : メニューに表示するアイコン
     * $position  : メニューの位置 ( 1 や 99 など )
     */
    public function addMenuPage($option = array()){
        error_log('AdminController addMenuPage');
        $set_page_title = Environment::PLUGIN_NAME_TEXT;
        if(!empty($option['page_title'])){
            $set_page_title = $option['page_title'];
        }
        
        $set_menu_title = Environment::PLUGIN_NAME_TEXT;
        if(!empty($option['menu_title'])){
            $set_menu_title = $option['menu_title'];
        }
        
        $set_capability = 'manage_options';
        if(!empty($option['capability'])){
            $set_capability = $option['capability'];
        }
        
        $set_menu_slug = Environment::PARENT_SLUG_NAME;
        if(!empty($option['menu_slug'])){
            $set_menu_slug = $option['menu_slug'];
        }
        
        $set_function = array( self, 'topPage' );
        if(!empty($option['function'])){
            $set_function = $option['function'];
        }
        
        $set_icon_url = '';
        if(!empty($option['icon_url'])){
            $set_icon_url = $option['icon_url'];
        }
        
        $set_position = null;
        if(!empty($option['position'])){
            $set_position = $option['position'];
        }
        
        add_menu_page(
            $set_page_title,
            $set_menu_title,
            $set_capability,
            $set_menu_slug,
            $set_function,
            $set_icon_url,
            $set_position
        );
    }
    
    /**
     * サブメニュー追加
     * parent_slug:親メニューのスラッグ名。またはサブメニューを追加する先のトップレベルメニューを実装する標準 WordPress 管理ファイルのファイル名。またはサブメニューを追加する先のカスタムトップレベルメニューを実装するプラグインファイル
     * page_title:サブメニューが有効化された際にHTMLページタイトルに表示されるテキスト。
     * menu_title:サブメニューの管理画面上での名前。
     * capability:ユーザーがこのメニュー表示する際に必要な権限。
     * menu_slug:既存の WordPress メニューの場合、メニューページコンテンツ表示を処理する PHP ファイル。カスタムトップレベルメニューのサブメニューの場合、このサブメニューページの一意の識別子。プラグインが専用のトップレベルメニューを作成する場合、先頭のサブメニューは通常、トップレベルメニューと同じタイトルへのリンクを持つため、リンクが重複します。重複したリンクタイトルを回避するには、最初に parent_slug パラメータと menu_slug パラメータに同じ値を指定して add_submenu_page を呼び出します。
     * function:メニューページのコンテンツを表示する関数
     */
    public function addSubmenuPage($option = array()){
        $set_parent_slug = Environment::PARENT_SLUG_NAME;
        if(!empty($option['parent_slug'])){
            $set_parent_slug = $option['parent_slug'];
        }
        
        $set_page_title = Environment::PLUGIN_NAME_TEXT.'一覧';
        if(!empty($option['page_title'])){
            $set_page_title = $option['page_title'];
        }
        
        $set_menu_title = '';
        if(!empty($option['menu_title'])){
            $set_menu_title = $option['menu_title'];
        }
        
        $set_capability = 'manage_options';
        if(!empty($option['capability'])){
            $set_capability = $option['capability'];
        }
        
        $set_menu_slug = Environment::LIST_PAGE_NAME;
        if(!empty($option['menu_slug'])){
            $set_menu_slug = $option['menu_slug'];
        }
        
        $set_function = array( $this, 'listPage' );
        if(!empty($option['function'])){
            $set_function = $option['function'];
        }
        
        add_submenu_page(
            $set_parent_slug,
            $set_page_title,
            $set_menu_title,
            $set_capability,
            $set_menu_slug,
            $set_function
        );
    }
 
}
