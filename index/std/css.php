<style>
#hamburger {
	vertical-align: bottom;
	border: 1px solid #999;
	display: inline-block;
	width: 50px;
	padding: 5px 10px;
	margin: 0 20px 0 8px;
}
#hamburger span {
	background: #999;
	display: block;
	height: 3px;
	margin: 5px 0;
}

html.mm-opened #hamburger span.top-bar {
	transform: rotate( 45deg );
	top: 8px;
}
html.mm-opened #hamburger span.middle-bar {
	opacity: 0;
	left: -40px;
}
html.mm-opened #hamburger span.bottom-bar {
	transform: rotate( -45deg );
	top: -8px;
}

#hamburger {
	overflow: hidden;
}
#hamburger span {
	position: relative;
	transform: rotate( 0 );
	top: 0;
	left: 0;
	opacity: 1;

	transition: none 0.5s ease;
	transition-property: transform, top, left, opacity;
}


.mm-menu {
	background-color: #DAEEF2;
	color: #444444;
}
.mm-title {
	color: #222222!important;
	font-size: 16px;
	font-weight: bold;
}
.mm_user_title {
	padding: 20px!important;
}




* {
	font-family: Arial, Helvetica, Verdana, "ヒラギノ角ゴPro W3", "Hiragino Kaku Gothic Pro", Osaka, "メイリオ", Meiryo, "ＭＳ Ｐゴシック", sans-serif!important;
}

#head {
	background-color: #404040;
}
#title {
	color: white;
	display: inline-block;
	line-height:40px;
}

#body {
	margin: 20px 0 0 0;
}

td {
	word-break: break-all;
}

.error {
	background-color: #FFE8EC;
}

#comment {
	padding: 20px;
	border: solid 1px #ccc;
	margin: 40px;
	border-radius: 10px;
}

@-ms-viewport {
	width: auto;
}

</style>
