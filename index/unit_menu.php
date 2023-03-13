<?php
print <<< MMENU
<div id="mmenu_left">
<ul>
	<li class="mm_user_title">ページ選択</li>
	<li><a class="mm_link_left" href="#" onclick="location='.';void(0)">リセット</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://chat.openai.com/"
			onclick="$('#mmenu_left').data('mmenu').close();"
		>ChatGPT</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://replit.com/"
			onclick="$('#mmenu_left').data('mmenu').close();"
		>Replit</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://getbootstrap.com/docs/"
			onclick="$('#mmenu_left').data('mmenu').close();"
		>Bootstrap(css)</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://vscode.dev/"
			onclick="$('#mmenu_left').data('mmenu').close();"
		>WEB VSCode</a></li>
	<li>
		<span>ロリポップ関連</span>
		<ul>
			<li><a target="_blank" href="https://mysqladmin.lolipop.jp/pma/">phpMyAdmin</a></li>
			<li><a target="_blank" href="https://tools.lolipop.jp/mail/mail/">WEBメーラー</a></li>
			<li><a target="_blank" href="https://webmail.lolipop.jp/">WEBメーラー(ベータ)</a></li>
		</ul>
	</li>		
	<li><a class="mm_link_left"
			target="_blank"
			href="https://getbootstrap.com/docs/"
			onclick="$('#mmenu_left').data('mmenu').close();"
		>Bootstrap(css)</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="http://api.jquery.com/"
			onclick="$('#mmenu_left').data('mmenu').close();"
			target="_blank"
		>jQuery ドキュメント</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://winofsql.jp/editor.html"
			target="_blank"
		>簡易オンラインエディタ</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://toolbox.winofsql.jp/run-page.php"
			target="_blank"
		>Run Page : リアルタイム html</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://u670.com/pikamap/htmlseikei.php"
			target="_blank"
		>ＨＴＭＬ整形ツール</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="http://lightbox.on.coocan.jp/html/utf8tool.php"
			target="_blank"
		>UTF8文字</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://bitly.com/"
			target="_blank"
		>URL 短縮</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://pixlr.com/x/?lang=jp-JP"
			target="_blank"
		>Photo Editor : Pixlr X</a></li>

	<li><a class="mm_link_left"
			target="_blank"
			href="https://migi.me/vsc_snippet/"
			target="_blank"
		>VSCode スニペット作成</a></li>

	<li>
		<span>ドキュメント</span>
		<ul>
			<li><a target="_blank" href="https://developer.mozilla.org/ja/docs/Web/API/Document_Object_Model">ドキュメントオブジェクトモデル</a></li>
			<li><a target="_blank" href="https://developers.google.com/apps-script/reference?hl=ja">GAS</a></li>
			<li><a target="_blank" href="https://www.php.net/manual/ja/">PHP</a></li>
		</ul>
	</li>		

</ul>
</div>
MMENU;
?>
