<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧导航menu</title>
<link href="css/css.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/sdmenu.js"></script>
<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
</script>
<style type=text/css>
html{ SCROLLBAR-FACE-COLOR: #538ec6; SCROLLBAR-HIGHLIGHT-COLOR: #dce5f0; SCROLLBAR-SHADOW-COLOR: #2c6daa; SCROLLBAR-3DLIGHT-COLOR: #dce5f0; SCROLLBAR-ARROW-COLOR: #2c6daa;  SCROLLBAR-TRACK-COLOR: #dce5f0;  SCROLLBAR-DARKSHADOW-COLOR: #dce5f0; overflow-x:hidden;}
body{overflow-x:hidden; background:url(images/main/leftbg.jpg) left top repeat-y #f2f0f5; width:194px;}
</style>
</head>
<body onselectstart="return false;" ondragstart="return false;" oncontextmenu="return false;">
<div id="left-top">
	<div><img src="images/main/member.gif" width="44" height="44" /></div>
    <span>用户：<?php echo $_COOKIE['name']?><br>角色：管理员</span>
</div>
    <div style="float: left" id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span>用户管理</span>
        <a href="users/main_info.php" target="mainFrame" onFocus="this.blur()">添加用户</a>
        <a href="users/main_list.php" target="mainFrame" onFocus="this.blur()">用户列表</a>
      </div>
      <div>
        <span>分区&版块管理</span>
        <a href="types/type_list.php" target="mainFrame" onFocus="this.blur()">板块列表</a>
        <a href="types/type_add.php" target="mainFrame" onFocus="this.blur()">添加分区</a>
        <a href="types/plate_add.php" target="mainFrame" onFocus="this.blur()">添加板块</a>
      </div>
      <div>
        <span>帖子管理</span>
        <a href="posts/post_list.php" target="mainFrame" onFocus="this.blur()">帖子列表</a>
        <a href="posts/post_rec.php" target="mainFrame" onFocus="this.blur()">回收站</a>
      </div>
      <div>
        <span>系统管理</span>
        <a href="webset/webset.php" target="mainFrame" onFocus="this.blur()">站点配置</a>
      </div>
    </div>
</body>
</html>