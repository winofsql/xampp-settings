<?php
// ******************************
// PHP 8用
// ******************************
$pv = explode( ".", phpversion() );
if( $pv[0]+0 >= 8 ) {
	error_reporting( E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING );
}
else {
	error_reporting( E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED );
}

// ******************************
// キャッシュクリア
// ******************************
session_cache_limiter('nocache');
session_start();

// ******************************
// パスワード
// ******************************
$GLOBALS['pass'] = 'password';

require_once("view_main.php");
?>
