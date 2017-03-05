<?php
if(isset($_COOKIE['inLogin'])){
    if(!$_COOKIE['inLogin']){
        header('location:post.php');
        exit;
    }
}else{
    header('location:post.php');
    exit;
}
$id = $_GET['id'];
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
		<link href="css/login.css" rel="stylesheet" type="text/css"/>
		<link href="css/reset.css" rel="stylesheet" type="text/css"/>
		<link href="css/post.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
	<!-- 网页主体头部设计 -->
		<div id="head">
		<!-- 顶部超链接的样式设计 -->
			<div id="top">
				<span>
					<ol id="topleft">
						<li id="litopleft" class=""><a href="#1" class="topa">设为首页</a></li>
						<li id="litopleft"><a href="#2" class="topa">收藏本站</a></li>
					</ol>
				</span>
				<span>
					<ol id="topright">
						<li id="litopright"><a href="#3" class="topa">帮助</a></li>
						<li id="litopright"><a href="#4" class="topa">推广链接</a></li>
						<li id="litopright"><a href="#5" class="topa">社区应用</a></li>
						<li id="litopright"><a href="#6" class="topa">最新帖子</a></li>
						<li id="litopright"><a href="#7" class="topa">精华区</a></li>
						<li id="litopright"><a href="#8" class="topa">社区服务</a></li>
						<li id="litopright"><a href="#9" class="topa">会员列表</a></li>
						<li id="litopright"><a href="#0" class="topa">统计排行</a></li>
						<li id="litopright"><a href="#10" class="topa">搜索</a></li>
					</ol>
				</span>
			</div>
			
			
			<!-- 主logo位设计 -->
			<div id="logo1" alt="兄弟连IT教育">
				<a href="index.php?id=<?php echo $id; ?>"><image src="../public/home/logo/<?php echo $logoName; ?>" width="233px" height="80px" /></a>
			</div>
			<!-- 右上角登陆后的设计 -->
			<div class="login" style="margin-bottom:0px">
			<?php
            // 获取头像
            $headSql = "select photo from user where id={$id}";
            $headRes = mysqli_query($link, $headSql);
            $headImg = mysqli_fetch_assoc($headRes)['photo'];
            ?>
				<div>
					<img src="../public/home/headimgs/<?php echo $headImg;?>" id="loginimg"/>
				</div>
				<!-- <div> -->
					<!-- <span> -->
						<!-- <p style="left">PHP</p> -->
					<!-- </span> -->
					<!-- <span> -->
						<!-- <p>帖子 24</p> -->
					<!-- </span> -->
					<!-- <span> -->
						<!-- <p>主题 16</p> -->
					<!-- </span> -->
					<!-- <span> -->
						<!-- <p>最后发帖:2016-05-04 15:18:04</p> -->
					<!-- </span> -->
				<!-- </div> -->
				<span>
					<table id="logintable">
						<tr>
							<td class="tablesize"><a href="#mypage1" class="topa"><?php echo $_COOKIE['inLogin'] ?></a></td>
							<td class="tablesize"><a href="#mypage2" class="topa">等级</a></td>
						</tr>
						<tr>
							<td class="tablesize"><a href="doLogOut.php" class="topa">注销</a></td>
							<td class="tablesize"><a href="messige-change.php?id=<?php echo $id; ?>" class="topa">个人中心</a></td>
						</tr>
					</table>
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
					<li  id="libanner"><a href="#ios"  class="bana">iOS培训</a></li>
					<li  id="libanner"><a href="#h5"  class="bana">HTML5培训</a></li>
					<li  id="libanner"><a href="#ui"  class="bana">UI培训</a></li>
					<li  id="libanner"><a href="#android"  class="bana">安卓培训</a></li>
					<li  id="libanner"><a href="#flyclass"  class="bana">云课堂</a></li>
					<li  id="libanner"><a href="#phpvideo"  class="bana">PHP视频</a></li>
					<li  id="libanner"><a href="#linuxvideo"  class="bana">Linux视频</a></li>
					<li  id="libanner"><a href="#home"  class="bana">战地视频</a></li>
				</ol>
			</div>
            <?php
            //获取分区名
            $banKuaiSql = "select name from type where id={$id}";
            $banKuaiResult = mysqli_query($link, $banKuaiSql);
            $banKuaiRes = mysqli_fetch_assoc($banKuaiResult);
            $banKuaiName = $banKuaiRes['name'];
            
            //获取板块id
            $plateId = $_GET['plateid'];
            //获取板块信息    
            $plateSql = "select name,photo from type where id={$plateId}";
            $plateRes = mysqli_query($link, $plateSql);
            $plateResult = mysqli_fetch_assoc($plateRes);
            $plateName = $plateResult['name'];
            $platePhoto = $plateResult['photo'];
            ?>
			<div id="post">
				<div>
					<p id="guide"><a href="#1" class="post"><?php echo $banKuaiName; ?></a> &gt; <a href="#2"  class="post"><?php echo $plateName; ?></a></p>
				</div>
				<div id="topdiv">
					<div style="background-color:#ffffff;">
                        <form method="post" action="doPostAdd.php">
                            <div style="padding-top:20px;margin-left:200px">
                                <span style="color:#AAA;font-size:1.4em">标题</span>&nbsp;&nbsp;<input type="text" name="title" style="height:28px;width:400px;font-size:1.2em" />
                                <label><input type="checkbox" name="stop" value="1" />禁止回复</label>
                            </div>
                            <div style="padding-top:20px;margin-left:200px">
                                <div style="color:#AAA;font-size:1.4em;float:left">内容</div>&nbsp;&nbsp;
                                <div style="float:left">&nbsp;&nbsp;<textarea name="content" style="width:400px;height:200px;"></textarea></div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input type="hidden" name="plateid" value="<?php echo $plateId; ?>" />
                            <div style="padding-top:10px;margin-left:200px">
                                <input type="submit" value="确认发帖" style="height:28px;margin-top:10px;width:465px" />
                            </div>
                        <form>
					</div>
					
					<hr width="98%" id="hrcss"/>
					
				</div>
			</div>
			<div class="chattecho" style="margin-top:12px;"> 
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