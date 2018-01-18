<?php
namespace FormCreate\controllers;

use FormCreate\config\Environment;
use FormCreate\controllers\BaseController;

class EnqueueController extends BaseController{
    
    public function __construct(){
        //add_action('admin_head', array($this, 'enqueueStyle'));
    }
    
    /**
     * アクション実行
     */
    public function addAction(){
        add_action('admin_head', array($this, 'enqueueStyle'));//wp_head admin_head
    }
    
    /**
     * CSS読み込み
     */
    public function enqueueStyle(){
        //wp_enqueue_style(Environment::PLUGIN_NAME.'-style', plugins_url(Environment::PLUGIN_NAME.'/css/style.css'));
        wp_enqueue_style('editor-style', 'http://wordpresstest01.localhost/wp-includes/css/editor.min.css');
        ///wp-includes/css/editor.min.css
    }
}
