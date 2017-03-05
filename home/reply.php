<?php

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
		<link href="css/reply-logined.css" rel="stylesheet" type="text/css"/>
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
			
			<!-- 副LOGO设计 -->
			<span id="logo2" style="top:47px;left:0px">
				<image src="images/wxdbjc.gif"/>
			</span>
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
			<div id="bbspage">
				<div>
					<p id="guide"><a href="#1" class="post">技术交流</a> &gt; <a href="#2"  class="post">PHP</a></p>
				</div>
				<?php
                $postId = $_GET['postid'];
                //获取post表中楼主发帖内容
                $topSql = "select posts.*, user.name, user.photo, user.score from posts, user where posts.id={$postId} and posts.uid=user.id";
                // var_dump($topSql);
                // die;
                $topResult = mysqli_query($link, $topSql);
                $topRes = mysqli_fetch_assoc($topResult);
                // var_dump($res);
                $topId = $topRes['id'];
                $topTitle = $topRes['title'];
                $topContent = $topRes['content'];
                $topTime = date('Y-m-d H:i:s',$topRes['time']);
                $topUsername = $topRes['name'];
                $topPhoto = $topRes['photo'];
                $topScore = $topRes['score'];
                ?>
				<div id="bbspagelisttop">
					<div class="bbspagelisttopchild">
						<p class="readreplynum">1</p>
						<p class="readreplytitle">阅读</p>
					</div>
					<div class="bbspagelisttopchild">
						<p class="readreplynum">8</p>
						<p class="readreplytitle">回复</p>
					</div>
					<div id="bbspagename">
						<p id="bbsarticletitle"><?php echo $topTitle;?></p>
					</div>
				</div>
				<div class="bbsarticlereplaylist">
					<div class="bbsarticlereplaylistleft">
						<p><img src="../public/home/headimgs/<?php echo $topPhoto ;?>" class="bbsarticlereplayuserhead" /></p>
						<p class="bbsarticlereplayusername"><?php echo $topUsername;?></p>
						<p class="bbsarticlereplayuserlevel"><?php echo $topScore;?></p>
					</div>
					<div class="bbsarticlereplaylistright">
						<div class="bbsarticlereplayhead">
							<p class="bbsarticlereplayinfo">
								<span class="bbsarticlereplayorder">楼主</span>
								<span class="bbsarticlereplaytime">&nbsp;发表于<?php echo $topTime;?></span>
							</p>
						</div>
						<div class="bbsarticlereplaybody">
							<p class="bbsarticlereplaybodyinfo"><?php echo $topContent;?></p>
						</div>
						<div class="bbsnet">
							<p class="bbsnetinfo">兄弟连Linux云计算教育&nbsp;http://www.lampborther.net/linux<p>
						</div>
					</div>
				</div>
                <?php
					$replySql = "select r.*,u.name,u.photo,u.score from replies as r,user as u where r.pid={$postId} and u.id=r.uid";
					
                    $replyResult = mysqli_query($link, $replySql);
                    //总条数
					$count = mysqli_num_rows($replyResult);
					mysqli_free_result($replyResult);
					$nowPage = isset($_GET['page']) ? $_GET['page'] : 1;
					//上一页 
					if($nowPage == 1){
						$prevPage = $nowPage;
					}else{
						$prevPage = $nowPage - 1;
					}
                    //每页显示的条数
					$offset = 5;
                    //每页开始的位置
					$start  = ($nowPage-1) * $offset;
					$totalPage = ceil($count / $offset);
					//下一页
					if($nowPage == $totalPage){
						$nextPage = $nowPage;
					}else{
						$nextPage = $nowPage + 1;
					}
					$limit = "limit {$start},{$offset}";
					
				?>
				<!--以下是回复表内容-->
				<?php
					$sql = "select r.*,u.name,u.photo,u.score from replies as r,user as u where r.pid={$postId} and u.id=r.uid {$limit}";
					
					$result = mysqli_query($link, $sql);
					
					$i = $start + 1;
					
					while($res = mysqli_fetch_assoc($result)){
                        //获取回帖的用户的数据
						$content = $res['content'];
						$time = date('Y-m-d H:i:s', $res['time']);
						$userName = $res['name'];
						$userPhoto = $res['photo'];
						$userScore = $res['score'];
						
					switch($i){
						case 1:
							$louceng = '沙发';
							break;
						case 2:
							$louceng = '板凳';
							break;
						case 3:
							$louceng = '地板';
							break;
						default:
							$louceng = "第{$i}楼";
					}
				
				
				?>
				<div class="bbsarticlereplaylist">
					<div class="bbsarticlereplaylistleft">
						<p><img src="../public/home/headimgs/<?php echo $userPhoto;?>" class="bbsarticlereplayuserhead" /></p>
						<p class="bbsarticlereplayusername"><?php echo $userName;?></p>
						<p class="bbsarticlereplayuserlevel"><?php echo $userScore;?></p>
					</div>
					<div class="bbsarticlereplaylistright">
						<div class="bbsarticlereplayhead">
							<p class="bbsarticlereplayinfo">
								<span class="bbsarticlereplayorder"><?php echo $louceng;?></span>
								<span class="bbsarticlereplaytime">&nbsp;发表于<?php echo $time;?></span>
							</p>
						</div>
						<div class="bbsarticlereplaybody">
							<p class="bbsarticlereplaybodyinfo"><?php echo $content;?></p>
						</div>
						<div class="bbsnet">
							<p class="bbsnetinfo">兄弟连Linux云计算教育&nbsp;http://www.lampborther.net/linux<p>
						</div>
					</div>
				</div>
				<?php
					$i++;
					}
				?>	
				<div class="skiplist">
					<div style="background-color:#FFFFFF">
						<table>
							<tr><td colspan="5" class="valigncenter">
								<ol >
									<li class="lipage"><a href="reply-logined.php?page=1&postid=<?php echo $postId;?>&id=<?php echo $id;?>" class="pagea">首页</a></li>
									<li class="lipage"><a href="reply-logined.php?page=<?php echo $prevPage;?>&postid=<?php echo $postId;?>&id=<?php echo $id;?>" class="pagea">上一页</a></li>
									<li class="lipage"><a href="reply-logined.php?page=<?php echo $nextPage;?>&postid=<?php echo $postId;?>&id=<?php echo $id;?>" class="pagea">下一页</a></li>
									<li class="lipage"><a href="reply-logined.php?page=<?php echo $totalPage;?>&postid=<?php echo $postId;?>&id=<?php echo $id;?>" class="pagea">尾页</a></li>
								</ol>
							</td></tr>
						</table>
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