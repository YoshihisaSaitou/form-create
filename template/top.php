<?php
//設定値を取得
$this->options = get_option( 'test_setting' );
?>
<div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields(PLUGIN_NAME); ?>
        <?php do_settings_sections(PLUGIN_NAME); ?>
        <?php submit_button(); ?>
    </form>
</div>