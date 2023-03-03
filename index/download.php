<?php

// ***********************************************
// フォルダを全て書庫化してダウンロード
// ***********************************************
function download() {

	$_GET['download'] = str_replace('/','',$_GET['download']);
	$_GET['download'] = str_replace('..','',$_GET['download']);
	$_GET['download'] = str_replace('.','',$_GET['download']);
	if ( $_SERVER['CONTEXT_DOCUMENT_ROOT'] == $_SERVER['DOCUMENT_ROOT'] ) {
		$rpath = $_SERVER['DOCUMENT_ROOT']  . rtrim($GLOBALS['path'][0],"/") . "/" . $_GET['download'];
	}
	else {
		$rpath = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . str_replace( $_SERVER['CONTEXT_PREFIX'], "", rtrim($GLOBALS['path'][0],"/")) . "/" . $_GET['download'];
	}
	$rpath_exclude = $rpath . "/";

//	if ( rtrim($GLOBALS['path'][0],"/") == '' ) {
//		print "REQUEST_URI is Incorrect";
//	}

	// ファイルは対象外(存在チェックも行う)
	if ( !is_dir($rpath) ) {
		print rtrim($GLOBALS['path'][0],"/") . "/" . $_GET['download'] . " not found or not dir";
		return false;
	}

	// ***********************************************
	// readfile 用、バッファ解除
	// ***********************************************
	ob_end_clean();

	// ***********************************************
	// 対象フォルダ名
	// ***********************************************
	$target_dir = $rpath;

	// ***********************************************
	// 書庫ファイル名
	// ***********************************************
	$zipname = basename( $target_dir );

	// ***********************************************
	// 一時ファイルを作成 ( temp/oooooo.tmp )
	// ***********************************************
	$file = tempnam( sys_get_temp_dir(), "zip" ); 

	// ***********************************************
	// ZIP 書庫作成
	// ***********************************************
	$zip = new ZipArchive(); 

	$zip->open($file, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE ); 

	if ( $_GET['file'] != "" ) {
		$zip->addFile( $rpath_exclude . $_GET['file'] , $_GET['file'] );
	}
	else {

		$targets = recursionFiles( $target_dir );

		foreach( $targets as $target ) {
			$zip->addFile( $target, str_replace($rpath_exclude,"", $target) );
		}

	}

	$zip->close(); 

	// ***********************************************
	// ダウンロードさせる為の処理
	// ***********************************************
	header("Content-Type: application/zip"); 
	header("Connection: close");
	header("Content-Length: " . filesize($file)); 
	if ( $_GET['file'] != "" ) {
		$path_parts = pathinfo($_GET['file']);
		header("Content-Disposition: attachment; filename=\"{$path_parts['filename']}.zip\""); 
	}
	else {
		header("Content-Disposition: attachment; filename=\"{$zipname}.zip\""); 
	}
	readfile($file); 


	// ***********************************************
	// 一時ファイルを削除
	// ***********************************************
	unlink($file); 

	return true;

}

function download2() {

	$_GET['download2'] = str_replace('/','',$_GET['download2']);
	$_GET['download2'] = str_replace('..','',$_GET['download2']);
	if ( $_SERVER['CONTEXT_DOCUMENT_ROOT'] == $_SERVER['DOCUMENT_ROOT'] ) {
		$rpath = $_SERVER['DOCUMENT_ROOT']  . rtrim($GLOBALS['path'][0],"/") . "/" . $_GET['download2'];
	}
	else {
		$rpath = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . str_replace( $_SERVER['CONTEXT_PREFIX'], "", rtrim($GLOBALS['path'][0],"/")) . "/" . $_GET['download2'];
	}
	$rpath_exclude = $rpath . "/";

	// ***********************************************
	// readfile 用、バッファ解除
	// ***********************************************
	ob_end_clean();

	// ***********************************************
	// 対象ファイル名
	// ***********************************************
//	$target_file = $rpath;

	// ***********************************************
	// 一時ファイルを作成 ( temp/oooooo.tmp )
	// ***********************************************
//	$file = tempnam( sys_get_temp_dir(), "file" ); 

	// ***********************************************
	// COPY
	// ***********************************************
//	copy($rpath, $file);

	// ***********************************************
	// ダウンロードさせる為の処理
	// ***********************************************
	header("Content-Type: application/octet-stream"); 
	header("Connection: close");
	header("Content-Length: " . filesize($rpath) ); 
	header("Content-Disposition: attachment; filename=\"{$_GET['download2']}\""); 
	readfile($rpath); 


	// ***********************************************
	// 一時ファイルを削除
	// ***********************************************
//	unlink($file); 

	return true;

}

// ***********************************************
// 再帰によるファイル一覧作成
// ***********************************************
function recursionFiles( $target ) {

	$files = glob( "{$target}/*" );
	$result = array();

	foreach ( $files as $file ) {
		// ファイル
		if (is_file($file)) {
			if ( basename($file) != "filesx.php" ) {
				$result[] = $file;
			}
		}
		// フォルダ
		else {
			$result = array_merge($result, recursionFiles($file));
		}
	}

	return $result;
}


?>
