<?php
$plateId = $_GET['plateid'];
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
		<link href="css/main.css" rel="stylesheet" type="text/css"/>
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
				<a href="index.php"><image src="../public/home/logo/<?php echo $logoName; ?>" width="233px" height="80px" /></a>
			</div>
			<!-- 右上角登录表单的设计 -->
			<div id="form">
				<span>
					<form action="doLogin.php?page=post.php&plateid=<?php echo $plateId; ?>" method="post">
						<input class="login" type="text" name="name" value="" placeholder="请输入用户名" />
						<label>
							<input type="checkbox" value="rempwd" value="" /><a class="formword">记住密码</a>
						</label>
						<label>
							<a href="#findpwd" class="formword">找回密码</a>
						</label>
						<br/><br/>
						<input class="login" type="password" name="pwd" value="" placeholder="请输入密码" />
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
					<div style="background-color:#ffffff;height:100px">
						<p id="bbstitle"><?php echo $plateName; ?><p>
						<div id="onlyplate">
						<!-- <板块名> -->
							<div>
								<img src="../public/admin/<?php echo $platePhoto; ?>" class="platehead" />
							</div>
							<div>
								<span>
									<p id="bbsword">今日:0|主题:<?php echo $_GET['tiezi']; ?>|贴数:<?php echo $_GET['tiezi']; ?></p>
								</span>
								<span>
									<p  id="inputtime">PHP基础编程、疑难解答、学习和开发过程的经验总结等。</p>
								</span>
							</div>
						</div>
					</div>
					<div style="background-color:#ffffff">
						<span>
							<form action="post-login.php" method="get">
								<input type="text" name="search" id="bbssearch" value="<?php if(!empty($_GET['search'])){echo $_GET['search'];} ?>" placeholder="请输入需要查询的帖子" />
								<input type="submit" value="搜索" id="bbssearchbt" />
                                <input type="hidden" name="plateid" value="<?php echo $plateId; ?>" />
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            </form>
						</span>
					</div>
					<hr width="98%" id="hrcss"/>
					<div style="background-color:#FFFFFF">
						<table>
							
							<tr style="background-color:#F4F4F4;line-height:35px;">
								<td width="90px" height="35px"></td>
								<td width="450px" height="35px">标题</td>
								<td width="125px" height="35px" style="text-align:center">作者</td>
								<td width="100px" height="35px">回复</td>
								<td width="320px" height="35px" class="lastpush">最后发表</td>
							</tr>
                            <?php
                                if(empty($_GET['search'])){
                                    //无搜索条件为空
                                    $seach = '';
                                }else{
                                    //如果有搜索条件,sql语句添加搜索条件
                                    $search = $_GET['search'];
                                    $seach = "and title like '%{$search}%'";
                                    }
                                    //分页及行数
                                $countSql = "select * from posts where recycle=0 and pid={$plateId} {$seach}";
                                $countResult = mysqli_query($link, $countSql);
                                // 总数
                                $count = mysqli_affected_rows($link);
                                // 上一页
                                $nowPage = isset($_GET['page']) ? $_GET['page'] : 1;
                               
                                if($nowPage == 1){
                                    $prevPage = $nowPage;
                                }else{
                                    $prevPage = $nowPage - 1;
                                }
                                /* 定义下一页 */
                                $offset = 7;
                                $start  = ($nowPage-1) * $offset;
                                $totalPage = ceil($count / $offset);
                                if($nowPage == $totalPage){
                                    $nextPage = $nowPage;
                                }else{
                                    $nextPage = $nowPage + 1;
                                }
                                $limit = "limit {$start},{$offset}"; 
                                // 限制行数
                                $limit = "limit {$start},{$offset}";
                                $postSql = "select * from posts where recycle=0 and pid={$plateId} {$seach} {$limit}";
                                $postResult = mysqli_query($link, $postSql);
                                    //获取帖子列表
                                if(mysqli_fetch_assoc($postResult) == 0){
                                ?>
								<td colspan="5" class="valigncenter" style="text-align:center">
                                    <h2>此版块还没有帖子,赶紧去发一个吧~~~~</h2>
                                </td>
								<td colspan="5" class="valigncenter" style="text-align:center">
                                </td>
								<td colspan="5" class="valigncenter" style="text-align:center">
                                </td>
                                <?php    
                                }    
                                while($postRes = mysqli_fetch_assoc($postResult)){
                                    $postId = $postRes['id'];
                                    $postTitle = $postRes['title'];
                                    $postUid = $postRes['uid'];
                                    $postTime = $postRes['time'];
                                    $postTop = $postRes['top'];
                                    $postHot = $postRes['hot'];
                                    $postReplay = $postRes['reply'];
                                    $postCount = $postRes['count'];
                            ?>
							<tr style="border-bottom:1px dotted #000;">
								<td width="90px" height="35px">
                                <?php
                                //是否加精
                                if($postHot == 1){
                                ?>
									<img src="images/home/topichot.gif" />
                                <?php
                                }
                                if($postTop == 1){
                                    //是否置顶
                                ?>    
									<img src="images/home/headtopic_3.gif" />
                                <?php
                                }
                                ?>
								</td>
								<td width="450px" class="valigncenter"><a href="reply.php?id=<?php echo $id; ?>&postid=<?php echo $postId; ?>"><?php echo $postTitle; ?></a></td>
                                <?php
                                $userNameSql = "select name from user where id={$postUid}";
                                
                                $userNameResult = mysqli_query($link, $userNameSql);
                                $userNameRes = mysqli_fetch_assoc($userNameResult);
                                
                                $userName = $userNameRes['name'];
                                ?>
								<td width="125px"><p style="text-align:center"><?php echo $userName; ?></p><p class="timeintable"><?php echo date('Y-m-d H:i:s',$postTime);?></p></td>
								<td width="100px"><?php echo $postReplay; ?>/<?php echo $postCount; ?></td>
								<td width="320px" class="lastpush"><p>wangyuee</p><p class="timeintable">2016-05-03</p></td>
							</tr>
							<?php
                                }
                            ?>
							<tr>
								<td colspan="5" class="valigncenter">
									<ol >
										<li class="lipage"><a href="post-login.php?id=<?php echo $id; ?>&tiezi=<?php echo $_GET['tiezi']; ?>&plateid=<?php echo $plateId; ?>&page=1&search=<?php if(!empty($_GET['search1'])){echo $search1;} ?>" class="pagea">首页</a></li>
										<li class="lipage"><a href="post-login.php?id=<?php echo $id; ?>&tiezi=<?php echo $_GET['tiezi']; ?>&plateid=<?php echo $plateId; ?>&page=<?php echo $prevPage;?>&search=<?php if(!empty($_GET['search'])){echo $search;} ?>" class="pagea">上一页</a></li>
										<li class="lipage"><a href="post-login.php?id=<?php echo $id; ?>&tiezi=<?php echo $_GET['tiezi']; ?>&plateid=<?php echo $plateId; ?>&page=<?php echo $nextPage;?>&search=<?php if(!empty($_GET['search'])){echo $search;} ?>" class="pagea">下一页</a></li>
										<li class="lipage"><a href="post-login.php?id=<?php echo $id; ?>&tiezi=<?php echo $_GET['tiezi']; ?>&plateid=<?php echo $plateId; ?>&page=<?php echo $totalPage;?>&search=<?php if(!empty($_GET['search'])){echo $search;} ?>" class="pagea">尾页</a></li>
									</ol>
								</td>
							</tr>
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