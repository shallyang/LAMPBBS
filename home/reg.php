<?php
if(isset($_COOKIE['inLogin'])){
    if(!$_COOKIE['inLogin']){
        header('location:index.php');
        exit;
    }
}else{
    header('location:index.php');
    exit;
}
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');

//获取网站配置信息
$webSql = 'select * from webconfig';
$webRes = mysqli_query($link, $webSql);
$webSite = mysqli_fetch_assoc($webRes);
$title = $webSite['title'];
$keywords = $webSite['keywords'];
$description = $webSite['description'];
$copyright = $webSite['conyright'];
$open = $webSite['open'];
$logoName = $webSite['logo'];
//如果open=0,直接跳转到404界面
if($open == 0){
    header('location:404.html');
    exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta name="description" content="<?php echo $description; ?>" />
		<link href="css/main.css" rel="stylesheet" type="text/css"/>
		<link href="css/reset.css" rel="stylesheet" type="text/css"/>
		<link href="css/post.css" rel="stylesheet" type="text/css"/>
		<link href="css/reg.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
	<!-- 网页主体头部设计 -->
		<div id="head">
		<!-- 顶部超链接的样式设计 -->
			<div id="top">
				<span>
					<ol id="topleft">
						<li class="litopleft" class=""><a href="#1" class="topa">设为首页</a></li>
						<li class="litopleft"><a href="#2" class="topa">收藏本站</a></li>
					</ol>
				</span>
				<span>
					<ol id="topright">
						<li class="litopright"><a href="#3" class="topa">帮助</a></li>
						<li class="litopright"><a href="#4" class="topa">推广链接</a></li>
						<li class="litopright"><a href="#5" class="topa">社区应用</a></li>
						<li class="litopright"><a href="#6" class="topa">最新帖子</a></li>
						<li class="litopright"><a href="#7" class="topa">精华区</a></li>
						<li class="litopright"><a href="#8" class="topa">社区服务</a></li>
						<li class="litopright"><a href="#9" class="topa">会员列表</a></li>
						<li class="litopright"><a href="#0" class="topa">统计排行</a></li>
						<li class="litopright"><a href="#10" class="topa">搜索</a></li>
					</ol>
				</span>
			</div>
			
			<!-- 主logo位设计 -->
			<div id="logo1" alt="兄弟连IT教育">
				<a href="index.php?id=<?php echo $id; ?>"><image src="../public/home/logo/<?php echo $logoName; ?>" width="233px" height="80px" /></a>
			</div>
			<!-- 右上角登录表单的设计 -->
			<div id="form">
				<span>
					<form action="doLogin.php?page=post" method="post">
						<input type="text" name="name" value="" placeholder="请输入用户名" />
						<label>
							<input type="checkbox" value="rempwd" value="" /><a class="formword">记住密码</a>
						</label>
						<label>
							<a href="#findpwd" class="formword">找回密码</a>
						</label>
						<br/><br/>
						<input type="password" name="pwd" value="" placeholder="请输入密码" />
						<input type="submit" value="登录" />
						<input type="button" value="注册" />
					</form>
				</span>	
			</div>	
			<!-- 副LOGO设计 -->
			<div id="logo2">
				<image src="images/wxdbjc.gif"/>
			</div>
		</div>
		<div id="content">
			<div id="banner" >
				<!-- 导航栏 -->
				<ol>
					<li  class="libanner"><a href="#ios"  class="bana">iOS培训</a></li>
					<li  class="libanner"><a href="#h5"  class="bana">HTML5培训</a></li>
					<li  class="libanner"><a href="#ui"  class="bana">UI培训</a></li>
					<li  class="libanner"><a href="#android"  class="bana">安卓培训</a></li>
					<li  class="libanner"><a href="#flyclass"  class="bana">云课堂</a></li>
					<li  class="libanner"><a href="#phpvideo"  class="bana">PHP视频</a></li>
					<li  class="libanner"><a href="#linuxvideo"  class="bana">Linux视频</a></li>
					<li  class="libanner"><a href="#home"  class="bana">战地视频</a></li>
				</ol>
			</div>
			<div id="post">
				<div>
					<p id="guide"></p>
				</div>
				<div id="topdiv">	
					<div id="regbody">
						<p id="regtitle">注册</p><hr width="98%" />
						<div id="regprompt">&nbsp;带红色*的是必填项，如果不填写将无法注册</div>
						<div id="regform">
							<form action="doReg.php" method="post">
								<p>&nbsp;用户名<span class="mustinput">*</span><input type="text" name="name" id="username" placeholder="请输入用户名" /></p><br/><br/><br/>
								<p>&nbsp;&nbsp;密码<span class="mustinput">*</span><input type="password" id="password1" name="pwd" placeholder="请输入密码" /></p><br/><br/><br/>
								<p>确认密码<span class="mustinput">*</span><input type="password" name="repwd" id="password2" placeholder="请再输入一次密码" /></p><br/><br/><br/>
								<p>电子邮箱<span class="mustinput">*</span><input type="email" name="email" id="email" placeholder="请输入电子邮箱" /></p><br/><br/>
								</p>&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="checkbox" name="agree" value="1" checked="checked"/>我已阅读并同意<a href="" id="uservalue">&lt;&lt;用户使用协议&gt;&gt;</a></label></p><br/><br/>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="注册" id="regsubmit" /></p>
							</form>
						</div>
						<div id="resrelogin">
							<span>已经拥有账号？</span><br/><br/><br/>
							<span><button>&nbsp;马上登陆&nbsp;</button></span>
						</div>
					</div>
				</div>
			</div>
			<div class="chattecho"> 
			<!-- 友情链接 -->
				<div class="bbsbanner">
					<span><p class="p">:::.友情链接.:::</p></span>
				</div>
				<!-- 单独板块的设置 -->
				<div id="otherlink">
					<span>
						<a href="#b1" class="friendlink"><p>PHP培训</p></a>
						<a href="#b2" class="friendlink"><p>PHP门户</p></a>
						<a href="#b3" class="friendlink"><p>蓝色理想</p></a>
						<a href="#b4" class="friendlink"><p>PHP美国主机</p></a>
						<a href="#b5" class="friendlink"><p>五四科学院</p></a>
						<a href="#b6" class="friendlink"><p>华章培训</p></a>
						<a href="#b7" class="friendlink"><p>KINGPHP</p></a>
						<a href="#b8" class="friendlink"><p>出国留学</p></a>
						<a href="#b9" class="friendlink"><p>中国网管论坛</p></a>
						<a href="#b10" class="friendlink"><p>PHPKNOW</p></a>
						<a href="#b11" class="friendlink"><p>PHPFriend</p></a>
						<a href="#b12" class="friendlink"><p>PHPCMS</p></a>
					</span>
				</div>
			</div>
		</div>	
		<div id="foot">
			<p class="info">Powered by scort Certificate Copyright Time now is:<?php echo date('m-d H:i:s', time())?></p>
			<p class="info"><?php echo $copyright; ?> disabled 京ICP备11018177号 京公网安备11011402000177</p>
		</div>
	</body>
</html>