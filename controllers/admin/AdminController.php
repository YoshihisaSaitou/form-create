<?php
namespace FormCreate\controllers\admin;

use FormCreate\config\Environment;
use FormCreate\controllers\BaseController;

abstract class AdminController extends BaseController{
    
    public function __construct(){
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        //$page_title: 設定ページの<title>部分
        //$menu_title: メニューに使用されるテキスト
        //$capability: 権限 ( 'manage_options' や 'administrator' など)
        //$menu_slug : メニューのslug
        //$function  : 設定ページの出力を行う関数
        //$icon_url  : メニューに表示するアイコン
        //$position  : メニューの位置 ( 1 や 99 など )
        add_menu_page(
            Environment::PLUGIN_NAME_TEXT,
            Environment::PLUGIN_NAME_TEXT,
            'manage_options',
            Environment::PARENT_SLUG_NAME,
            array( $this, 'topPage' )
        );
    }
    
    //abstract public function index(){
        
    //}
    
    /**
     * トップページ
     */
    public function topPage(){
        $this->view('top.php');
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
        $parent_slug = Environment::PARENT_SLUG_NAME;
        if(!empty($option['parent_slug'])){
            $parent_slug = $option['parent_slug'];
        }
        
        $page_title = Environment::PLUGIN_NAME_TEXT.'一覧';
        if(!empty($option['page_title'])){
            $page_title = $option['page_title'];
        }
        
        $menu_title = '';
        if(!empty($option['menu_title'])){
            $menu_title = $option['menu_title'];
        }
        
        $capability = 'manage_options';
        if(!empty($option['capability'])){
            $capability = $option['capability'];
        }
        
        $menu_slug = Environment::LIST_PAGE_NAME;
        if(!empty($option['menu_slug'])){
            $menu_slug = $option['menu_slug'];
        }
        
        $function = array( $this, 'listPage' );
        if(!empty($option['function'])){
            $function = $option['function'];
        }
        
        add_submenu_page(
            $parent_slug,
            $page_title,
            $menu_title,
            $capability,
            $menu_slug,
            $function
        );
    }
 
}
