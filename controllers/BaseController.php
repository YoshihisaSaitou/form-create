<?php

namespace form-create\controllers;

require_once('../config/app.php');
require_once('../config/utility.php');

/**
* @package FormCreate
* 
*/

class BaseController{
    
    public function __construct(){
        // ページの初期化
        add_action( 'admin_init', array( $this, 'init' ) );
        
        // メニューを追加
        add_action( 'admin_menu', array( $this, 'addMenu' ) );
    }
    
    /**
     * 設定ページの初期化
     */
    public function init(){
        // 設定を登録します(入力値チェック用)。
        // register_setting( $option_group, $option_name, $sanitize_callback )
        //   $option_group      : 設定のグループ名
        //   $option_name       : 設定項目名(DBに保存する名前)
        //   $sanitize_callback : 入力値調整をする際に呼ばれる関数
        register_setting(PLUGIN_NAME, PLUGIN_NAME, array( $this, 'sanitize' ));
        
        // 入力項目のセクションを追加します。
        // add_settings_section( $id, $title, $callback, $page )
        //   $id       : セクションのID
        //   $title    : セクション名
        //   $callback : セクションの説明などを出力するための関数
        //   $page     : 設定ページのslug (add_menu_page()の$menu_slugと同じものにする)
        add_settings_section(PLUGIN_NAME.'_section_id', '', '', TOP_PAGE_NAME);

        // 入力項目のセクションに項目を1つ追加します(今回は「メッセージ」というテキスト項目)。
        // add_settings_field( $id, $title, $callback, $page, $section, $args )
        //   $id       : 入力項目のID
        //   $title    : 入力項目名
        //   $callback : 入力項目のHTMLを出力する関数
        //   $page     : 設定ページのslug (add_menu_page()の$menu_slugと同じものにする)
        //   $section  : セクションのID (add_settings_section()の$idと同じものにする)
        //   $args     : $callbackの追加引数 (必要な場合のみ指定)
        add_settings_field( 'message', 'メッセージ', array( $this, 'callbackMessage' ), TOP_PAGE_NAME, PLUGIN_NAME.'_section_id' );
        
        
    }
    
    /**
     * メニュー追加
     */
    public function addMenu(){
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        //$page_title: 設定ページの<title>部分
        //$menu_title: メニューに使用されるテキスト
        //$capability: 権限 ( 'manage_options' や 'administrator' など)
        //$menu_slug : メニューのslug
        //$function  : 設定ページの出力を行う関数
        //$icon_url  : メニューに表示するアイコン
        //$position  : メニューの位置 ( 1 や 99 など )
        add_menu_page(PLUGIN_NAME_TEXT, PLUGIN_NAME_TEXT, 'manage_options', PARENT_SLUG_NAME, array( $this, 'topPage' ) );
        
        //サブメニュー
        //$parent_slug:親メニューのスラッグ名。またはサブメニューを追加する先のトップレベルメニューを実装する標準 WordPress 管理ファイルのファイル名。またはサブメニューを追加する先のカスタムトップレベルメニューを実装するプラグインファイル
        //$page_title:サブメニューが有効化された際にHTMLページタイトルに表示されるテキスト。
        //$menu_title:サブメニューの管理画面上での名前。
        //$capability:ユーザーがこのメニュー表示する際に必要な権限。
        //$menu_slug:既存の WordPress メニューの場合、メニューページコンテンツ表示を処理する PHP ファイル。カスタムトップレベルメニューのサブメニューの場合、このサブメニューページの一意の識別子。プラグインが専用のトップレベルメニューを作成する場合、先頭のサブメニューは通常、トップレベルメニューと同じタイトルへのリンクを持つため、リンクが重複します。重複したリンクタイトルを回避するには、最初に parent_slug パラメータと menu_slug パラメータに同じ値を指定して add_submenu_page を呼び出します。
        //$function:メニューページのコンテンツを表示する関数
        add_submenu_page(PARENT_SLUG_NAME, PLUGIN_NAME_TEXT.'一覧',  '一覧', 'manage_options', LIST_PAGE_NAME, array( $this, 'listPage' ) );
        //add_action( 'load-' . $list, 'listPage' );
        add_submenu_page(PARENT_SLUG_NAME, PLUGIN_NAME_TEXT.'新規追加', '新規追加', 'manage_options', CREATE_PAGE_NAME, array( $this, 'createPage' ) );
        //add_options_page( '新規追加', '新規追加', 'manage_options', CREATE_PAGE_NAME, array( $this, 'createPage' ) );
        
    }
    
    
    /**
     * トップページ
     */
    public function topPage(){
        include_once('template/top.php');
    }
    
    /**
     * 一覧ページ
     */
    public function listPage(){
        include_once('template/list.php');
    }
    
    /**
     * 新規追加ページ
     */
    public function createPage(){
        include_once('template/create.php');
    }
 
    /**
     * 入力項目(「メッセージ」)のHTMLを出力します。
     */
    public function callbackMessage(){
        // 値を取得
        $message = isset( $this->options['message'] ) ? $this->options['message'] : '';
        // nameの[]より前の部分はregister_setting()の$option_nameと同じ名前にします。
        ?><input type="text" id="message" name="form_create[message]" value="<?php esc_attr_e( $message ) ?>" /><?php
    }

    /**
     * 送信された入力値の調整を行う
     *
     * @param array $input 設定値
     */
    public function sanitize($input){
        // DBの設定値を取得します。
        $this->options = get_option(PLUGIN_NAME);

        $new_input = array();

        // メッセージがある場合値を調整
        if( isset( $input['message'] ) && trim( $input['message'] ) !== '' ) {
            $new_input['message'] = sanitize_text_field( $input['message'] );
        }
        // メッセージがない場合エラーを出力
        else {
            // add_settings_error( $setting, $code, $message, $type )
            //   $setting : 設定のslug
            //   $code    : エラーコードのslug (HTMLで'setting-error-{$code}'のような形でidが設定されます)
            //   $message : エラーメッセージの内容
            //   $type    : メッセージのタイプ。'updated' (成功) か 'error' (エラー) のどちらか
            add_settings_error(PLUGIN_NAME, 'message', 'メッセージを入力して下さい。' );

            // 値をDBの設定値に戻します。
            $new_input['message'] = isset( $this->options['message'] ) ? $this->options['message'] : '';
        }

        return $new_input;
    }
 
}
 
// 管理画面を表示している場合のみ実行します。
if( is_admin() ) {
    $form_create_page = new FormCreate();
}
