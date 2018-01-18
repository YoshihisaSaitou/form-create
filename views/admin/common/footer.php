<?php 
use FormCreate\config\Environment;
?>
<link rel="stylesheet" href="<?php echo plugins_url(Environment::PLUGIN_NAME.'/css/style.css?1'); ?>" type="text/css" media="all">
<div id="popup">
<button type="button" class="close_btn"><span class="icon"><span class="text">閉じる</span></span></button>
<div class="content"></div>
</div>
<div id="popup_background"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$('.button').on('click',function(){
    $('#popup').show();
    $('#popup_background').show();
});
$('.close_btn').on('click',function(){
    $('#popup').hide();
    $('#popup_background').hide();
});
$('#popup_background').on('click',function(){
    $('#popup').hide();
    $('#popup_background').hide();
});
</script>