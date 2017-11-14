<?php
namespace FormCreate\config;

class Environment{
    
    const PLUGIN_NAME = 'form-create';
    const PLUGIN_NAME_TEXT = 'フォームクリエイト';
    
    //親メニュースラッグ名
    const PARENT_SLUG_NAME = self::PLUGIN_NAME;
    
    //管理画面のviewパス
    const ADMIN_VIEW_PATH = 'views/admin/';
    
    //管理ページ名
    const ADMIN_TOP_NAME = 'top';
    const ADMIN_LIST_NAME = 'list';
    const ADMIN_CREATE_NAME = 'create';
    const ADMIN_EDIT_NAME = 'edit';
    const ADMIN_DELETE_NAME = 'delete';
    
    //menu_slug 管理メニュースラッグ名
    const ADMIN_TOP_PAGE_NAME = self::PLUGIN_NAME.'_'.self::ADMIN_TOP_NAME;
    const ADMIN_LIST_PAGE_NAME = self::PLUGIN_NAME.'_'.self::ADMIN_LIST_NAME;
    const ADMIN_CREATE_PAGE_NAME = self::PLUGIN_NAME.'_'.self::ADMIN_CREATE_NAME;
    const ADMIN_EDIT_PAGE_NAME = self::PLUGIN_NAME.'_'.self::ADMIN_EDIT_NAME;
    const ADMIN_DELETE_PAGE_NAME = self::PLUGIN_NAME.'_'.self::ADMIN_DELETE_NAME;
    
    public function __construct(){
        
    }
    
    /**
     * WordPressルートディレクトリ取得
     */
    public static function getWordPressRootDir(){
        return dirname(dirname(dirname( self::getPluginRootDir())));
    }
    
    /**
     * プラグインルートディレクトリ取得
     */
    public static function getPluginRootDir(){
        return str_replace('config', '', __DIR__);
    }
}
