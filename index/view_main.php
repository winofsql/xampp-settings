<?php
// REQUEST_URI は呼び出し元のパス
$GLOBALS['path'] = explode("?", $_SERVER['REQUEST_URI']);
require_once("download.php");

// *************************************
// フォルダ内を全て zip でダウンロード
// *************************************
if ( $_GET['download'] != "" ) {
//	if ( $_SESSION['login'] == 'yes' ) {
		$result = download();
//	}
//	else {
//		header( "Content-Type: text/html; charset=utf-8" );
//		print "ログインされていません";
//	}
	exit();
}
if ( $_GET['download2'] != "" ) {
	$result = download2();
	exit();
}

// *************************************
// ログイン処理
// 1) ダウンロード可能
// 2)パスを DOCUMENT_ROOT で表示
// *************************************
if ( $_GET['login'] == "yes" ) {
	header( "Content-Type: application/json; charset=utf-8" );
	if ( $_POST['pass'] == $GLOBALS['pass'] && $GLOBALS['pass'] != "" ) {
		$_SESSION['login'] = 'yes';
		$_POST['login'] = 'yes';
	}
	else {
		if ( $_POST['pass'] == 'logout' ) {
			$_SESSION = array();
			$_POST['login'] = 'logout';
		}
		else {
			$_POST['login'] = 'no';
		}
	}
	print json_encode($_POST);
	exit();
}

if ( $_GET['src'] != "" ) {
	ob_end_clean();
	header("Content-Type: charset=utf-8"); 
	header("Connection: close");
	header("Content-Length: " . filesize($_POST["path"]) ); 
	readfile($_POST["path"]); 
	exit();
}

header( "Content-Type: text/html; charset=utf-8" );

// *************************************
// 表示コントロール
// *************************************
$GLOBALS['title'] = "インデックス";
if ( $_SERVER['CONTEXT_DOCUMENT_ROOT'] == $_SERVER['DOCUMENT_ROOT'] ) {
	$GLOBALS['comment'] = $_SERVER['DOCUMENT_ROOT'] . rtrim($GLOBALS['path'][0],"/");
}
else {
	$GLOBALS['comment'] = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . str_replace( $_SERVER['CONTEXT_PREFIX'], "", rtrim($GLOBALS['path'][0],"/"));
}
$GLOBALS['root_script'] = "files.php";

// 表示するファイルの一覧は DOCUMENT_ROOT + REQUEST_URI
$handle = opendir($GLOBALS['comment']);
$files = array();	// 全ての一覧をソートしたものが入る
$files2 = array();	// ファイルのみが入る
while( $target = readdir( $handle ) ) {
	$files[] = $target;
}
sort($files);
foreach ( $files as $file ) {

    $ttl = "";

	// 対象外は読み飛ばし
	if ( $file == '.' || $file == '..' ) {
		continue;
	}
	if ( $file == ".htaccess" || $file == ".title" ) {
		continue;
	}
	// フォルダ
	if ( is_dir($GLOBALS['comment'] . "/" .$file) ) {

        if ( file_exists( $GLOBALS['comment'] . "/" .$file . "/.title" ) ) {
            $ttl = file_get_contents( $GLOBALS['comment'] . "/" .$file . "/.title" );
        }
		// ダウンロード用のフォルダパス
		//$path = urlencode($_SERVER['REQUEST_URI']);

		if ( $_SESSION['login'] == 'yes' ) {
			$GLOBALS["data"] .= <<< FILES

				<tr>
					<td><a class="link" href="./{$file}/">[{$file}]</a></td>
					<td></td>
					<td><a class="link" href="./?download={$file}">ダウンロード</a></td>
                    <td>{$ttl}</td>
				</tr>

FILES;
		}
		else {
			$GLOBALS["data"] .= <<< FILES

				<tr>
					<td><a class="link" href="./{$file}/">[{$file}]</a></td>
					<td></td>
					<td></td>
                    <td>{$ttl}</td>
				</tr>

FILES;
		}
	}
	else {
		$files2[] = $file;
	}
}

// ファイルのタイプの取得用
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$ttl2 = "";
foreach ( $files2 as $file ) {

	$size = filesize($GLOBALS['comment'] . "/" . $file);
	$type = finfo_file($finfo, $GLOBALS['comment'] . "/" . $file);

    if ( file_exists( $GLOBALS['comment'] . "/.title" ) ) {
        $tt2 = file_get_contents( $GLOBALS['comment'] . "/.title" );
    }

	// urlencode されたファイル名の対応(元々は日本語ファイル名)
	$file_e = urlencode($file);

	if ( $_SESSION['login'] == 'yes' ) {
		// ファイル一覧用 HTML
		if ( $size <= 50000 ) {
			$GLOBALS["data"] .= <<< FILES

					<tr>
						<td><a href="{$file_e}">{$file}</a></td>
						<td>{$size}</td>
						<td colspan="2"><a class="link" href="./?download2={$file}">file</a> <input class="src" type="button" value="src" title="{$file}" style="margin-left:5px;"></td>
					</tr>

FILES;
		}
		else {
			$GLOBALS["data"] .= <<< FILES

					<tr>
						<td><a href="{$file_e}">{$file}</a></td>
						<td>{$size}</td>
						<td colspan="2"><a class="link" href="./?download2={$file}">file</a></td>
					</tr>

FILES;
		}
	}
	else {
		// ファイル一覧用 HTML
		$GLOBALS["data"] .= <<< FILES

				<tr>
					<td><a href="{$file_e}">{$file}</a></td>
					<td>{$size}</td>
					<td colspan="2">{$type}</td>
                    </tr>
FILES;
	}


}
finfo_close($finfo);



?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
<meta charset="utf-8">
<title><?= $GLOBALS['title'] ?></title>

<?php require_once("std/libs.php") ?>

<?php require_once("std/css.php") ?>

<style>
legend {
	font-size: 18px;
	padding-left: 6px;
}

.table-responsive td, .table-responsive th {
	white-space: nowrap;
}

#data {
	margin-bottom: 20px;
}
#comment {
	word-break: break-all;
}

#pass {
	padding: 20px;
	margin: 40px;
}
#system {
	width: 200px;
	margin-right: 8px;
}
</style>

<script>
<?php require_once("std/js.php") ?>

$(function(){

	// スマホでロード時の処理のチラつき防止用
	$("#wrapper").css("visibility","visible");

	$("#system_login").on("click", function(){
		var formData = new FormData();
		formData.append("pass", $("#system").val() );
		$.ajax({
			url: "./?login=yes",
			type: "POST",
			data: formData,
			processData: false,  // jQuery がデータを処理しないよう指定
			contentType: false   // jQuery が contentType を設定しないよう指定
		})
		.done(function( data, textStatus ){
			console.log( "status:" + textStatus );
			console.log( "data:" + JSON.stringify(data, null, "    ") );

			if ( data.login == 'yes' || data.login == 'logout' ) {
				location.reload(true);
			}

		})
		.fail(function(jqXHR, textStatus, errorThrown ){
			console.log( "status:" + textStatus );
			console.log( "errorThrown:" + errorThrown );

		})
	});

	$(".src").on("click", function(){
		var target = $(this).prop("title");
		var path = "<?= str_replace("\\", "/", $GLOBALS['comment']) . "/" ?>" + target;
		var formData = new FormData();
		formData.append("path", path);
		$.ajax({
			url: "./?src=" + target,
			type: "POST",
			data: formData,
			processData: false,  // jQuery がデータを処理しないよう指定
			contentType: false   // jQuery が contentType を設定しないよう指定
		})
		.done(function( data, textStatus ){
			console.log( "status:" + textStatus );
			console.log( "data:" + JSON.stringify(data, null, "    ") );
			
			data = data.replace(/<\/textarea>/g, '&lt;/textarea>');
			
			//$("#test").val(data);
			var w = ( screen.width-1100 ) / 2;
			var h = ( screen.height-600 ) / 2;
			var wnd = window.open('about:blank', '_blank', 'width=1100, height=600, left=' + w + ',top=' + h + ', location=0, resizable=1, menubar=0, scrollbars=1');
var str="";
str+="<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> ";
str+="<"+"script src=\"https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js\"></"+"script> \n";
str+="<"+"script src=\"https://lightbox.sakura.ne.jp/homepage/jquery/plugins/jquery-linedtextarea.js\"></"+"script> \n";
str+="<link id=\"link\" rel=\"stylesheet\" href=\"https://lightbox.sakura.ne.jp/homepage/jquery/plugins/jquery-linedtextarea.css\"> \n";
			wnd.document.write(str);

			wnd.document.write('<t'+ 'extarea readonly style="width:100%;height:550px">' + data + '</' + 'textarea>');

str="";
str+="<"+"script> \n";
str+="$(function() { \n";
str+="	$(\"textarea\").linedtextarea(); \n";
str+="	$(\".linedwrap\").css({\"width\":\"calc(100% - 20px\"}); \n";
str+="	$(\".lines\").css({\"height\":\"calc(100% - 20px)\"}); \n";
str+="	$(\"textarea\").css({\"width\":\"calc(100% - 80px)\", \"padding-left\":\"10px\"}); \n";
str+="	$(\"textarea\").css({\"height\":\"calc(100% - 20px)\"}); \n";
str+="	$(\"head\").append($(\"<title>\").text(\"\u30bd\u30fc\u30b9\u306e\u8868\u793a\")); \n";
str+="	$(\".codelines\").on(\"click\", function(){ $(\"textarea\").select() } ); \n";
str+="	$(\"textarea\").focus(); \n";
str+="	$(\"body\").css({\"overflow-y\":\"hidden\"}); \n";
str+="}); \n";
str+="</"+"script> ";
			wnd.document.write(str);
			wnd.document.close();

		})
		.fail(function(jqXHR, textStatus, errorThrown ){
			console.log( "status:" + textStatus );
			console.log( "errorThrown:" + errorThrown );

		})
	});
	

	// **************************************
	// mmenu
	// **************************************
	$("#mmenu_left").mmenu({
		navbar: {
			title: "メニュー"
		},
		offCanvas: {
			position  : "left",
			zposition : "next"
		},
		slidingSubmenus: true
	});

	var clipboard = new ClipboardJS('.clip' , {
		text: function(trigger) {
			return clipbpardText;
		}
	});

	$(".clip").on("click", function(){
		clipbpardText = $(this).text();
		toastr.info("クリップボッドにコピーされました");
		targetObj = this;
		window.setTimeout(function(){ textSelect(targetObj) }, 1);
	})

});

var targetObj = null;
function textSelect(obj) {
	var range,sel;
	if (window.getSelection) {
		range = document.createRange();
		range.setStart(obj.firstChild,0);
		range.setEnd(obj.firstChild,obj.firstChild.nodeValue.length);
		sel = getSelection();
		sel.removeAllRanges();
		sel.addRange(range);
	}
}


</script>
</head>
<body>

<div id="wrapper">
<script>
// スマホでロード時の処理のチラつき防止用
$("#wrapper").css( "visibility", "hidden" );
</script>

	<div id="head">
		<?php require_once("std/view_hamburger.php") ?>
		<div id="title"><?= $GLOBALS['title'] ?></div>
	</div>

	<div id="body">
		<form id="frm" class="form-inline">

			<div style='margin:10px;'>
				<a href="../">親フォルダ</a>
			</div>

			<div id="data" class="table-responsive">

				<table class="table table-condensed table-hover">
					<tr>
						<th style='width:200px;'>ファイル名</th>
						<th style='width:80px;'>サイズ</th>
						<th style='width:250px;'>ＭＩＭＥ</th>
						<th><?= $tt2 ?></th>
					</tr>

					<?= $GLOBALS["data"] ?>

				</table>
			</div>

			<fieldset>
				<legend></legend>
				<table class="table table-condensed">

					<tr><td class="fields result error" id="erow1"><?= $GLOBALS['error'] ?></td></tr>
					<tr><td class="fields result error" id="erow2"></td></tr>

				</table>

			</fieldset>

		</form>
	</div>

	<div id="comment" style='width:70%'>
<?php
if ( $_SESSION['login'] == 'yes' ) {
	print '<span class="clip">' . $GLOBALS['comment'] . '</span>';
	print '<br><span class="clip">' . str_replace($_SERVER['DOCUMENT_ROOT'],"",$GLOBALS['comment']) . "</span>";
}
else {
	print '<span class="clip">' .str_replace($_SERVER['DOCUMENT_ROOT'],"",$GLOBALS['comment']) . "</span>";
}

?>
	</div>

	<div id="pass" class="input-group" style='width:auto'>
		<input type="password" id="system" >
		<input type="button" value="管理者" id="system_login" class="btn">
	</div>

</div>


<?php require_once("unit_menu.php") ?>

<!--textarea id="test" style='width:100%;height:900px;' readonly></textarea-->
</body>
</html>
