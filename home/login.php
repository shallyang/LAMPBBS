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

$name = $_COOKIE['inLogin'];
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
			<div class="login">
				<?php
                // 获取头像
                $headSql = "select photo,id from user where name='{$name}'";
                
                $headRes = mysqli_query($link, $headSql);
                $headImg = mysqli_fetch_assoc($headRes)['photo'];
                $id = mysqli_fetch_assoc($headRes)['id'];
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
							<td class="tablesize"><a href="messige-change.php?id=1" class="topa">个人中心</a></td>
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
			<div id="photo">
				<!--  图片位置-->
				<div id="photoleft">
					<div id="video">
						<a href="">
							<img src="images/php-video.png" />
						</a>
					</div>
					<div id="history">
						<a href="">
							<img src="images/history.jpg" />
						</a>
					</div>
				</div>	
				<div id="active">
					<a href="">
						<img src="images/active.jpg" />
					</a>
				</div>
				<div id="photoright">
					<div id="wechat">
						<a href="">
							<img src="images/wechat.jpg" />
						</a>
					</div>
					<div id="qqchat">
						<a href="">
							<img src="images/qqchat.jpg" />
						</a>
					</div>
				</div>	
			</div>
            <?php
            //搜索一遍遍历分区

            //设计sql语句

            $sql = "select * from type where pid=0";

            //执行语句
            $result = mysqli_query($link, $sql);
            while($res = mysqli_fetch_assoc($result)){
                // var_dump($res);
                // echo '<hr/>';
                $id = $res['id'];
                $name = $res['name'];
            ?>
			<!--  技术交流 -->
			<div class="chattecho">
                <!--  技术交流条 -->
				<div class="bbsbanner">
					<span><p class="p">:::.<?php echo $name; ?>.:::</p></span>
				</div>
				<div class="bbsplate">
                <?php
                //遍历一遍,遍历分区的板块
                $plateSql = "select * from type where pid={$id}";
                $plateResult = mysqli_query($link,$plateSql);
                while($plateRes = mysqli_fetch_assoc($plateResult)){
                    $plateId = $plateRes['id'];
                    $plateName = $plateRes['name'];
                    $platePhoto = $plateRes['photo'];
                
                ?>
				<!-- 单独板块的设置 -->
                    <div class="onlyplate">
                    <!-- <php> -->
                        <div>
                            <img src="../public/admin/<?php echo $platePhoto; ?>" class="platehead" />
                        </div>
                        <div>
                            <?php
                            $tieZiShuSql = "select id,time from posts where pid={$plateId}";
                            $tieZiRes = mysqli_query($link, $tieZiShuSql);
                            $tieZiCount = mysqli_affected_rows($link);
                            $tieZiTime = mysqli_fetch_assoc($tieZiRes)['time'];
                            ?>
                            <span>
                                <a href="post-login.php?plateid=<?php echo $plateId; ?>&id=<?php echo $id; ?>&tiezi=<?php echo $tieZiCount; ?>&time=<?php echo $tieZiTime; ?>"><p class="bbsname"><?php echo $plateName; ?></p></a>
                            </span><br/><br/>
                            <span>
                                <p class="bbsword">帖子 <?php echo $tieZiCount; ?></p>
                            </span>
                            <span>
                                <p class="theme">主题 <?php echo $tieZiCount; ?></p>
                            </span>
                            <span>
                                <p  class="inputtime">最后发帖:<?php echo date('Y-m_d H:i:s',$tieZiTime); ?></p>
                            </span>
                        </div>
                    </div>
				<?php
                    }
                ?>
                </div>	
			</div>
            <?php
                }
            ?>
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
    <?php
    mysqli_free_result($result);
    mysqli_free_result($plateResult);
    mysqli_close($link);
    ?>
</html>