<?php
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');

$id = $_GET['id'];
//获取post表中楼主发帖内容
$topSql = "select posts.*, user.name, user.photo, user.score from posts, user where posts.id={$id} and posts.uid=user.id";
// var_dump($topSql);
// die;
$topResult = mysqli_query($link, $topSql);
$topRes = mysqli_fetch_assoc($topResult);
// var_dump($topRes);
// var_dump($topRes);
$topId = $topRes['id'];
$topTitle = $topRes['title'];
$topContent = $topRes['content'];
$topTime = date('Y-m-d H:i:s',$topRes['time']);
$topUsername = $topRes['name'];
$topPhoto = $topRes['photo'];
$topScore = $topRes['score'];
$topReply = $topRes['reply'];
?>
<html>
<head>
		<link href="../../home/css/login.css" rel="stylesheet" type="text/css"/>
		<link href="../../home/css/reset.css" rel="stylesheet" type="text/css"/>
		<link href="../../home/css/post.css" rel="stylesheet" type="text/css"/>
		<link href="../../home/css/reply-logined.css" rel="stylesheet" type="text/css"/>
</head>
<body>
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
        <p><img src="../../public/home/headimgs/<?php echo $topPhoto ;?>" class="bbsarticlereplayuserhead" /></p>
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
$replySql = "select r.*,u.name,u.photo,u.score from replies as r,user as u where r.pid={$id} and u.id=r.uid";

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
$sql = "select r.*,u.name,u.photo,u.score from replies as r,user as u where r.pid={$id} and u.id=r.uid {$limit}";

$result = mysqli_query($link, $sql);

$i = $start + 1;

while($res = mysqli_fetch_assoc($result)){
    //获取回帖的用户的数据
    $id = $res['id'];
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
        <p><img src="../../public/home/headimgs/<?php echo $userPhoto;?>" class="bbsarticlereplayuserhead" /></p>
        <p class="bbsarticlereplayusername"><?php echo $userName;?></p>
        <p class="bbsarticlereplayuserlevel">积分(<?php echo $userScore;?>)</p>
    </div>
    <div class="bbsarticlereplaylistright">
        <div class="bbsarticlereplayhead">
            <p class="bbsarticlereplayinfo">
                <span class="bbsarticlereplayorder"><?php echo $louceng;?></span>
                <span class="bbsarticlereplaytime">&nbsp;发表于<?php echo $time;?></span>
                <span style="text-align:right"><a href="doReplyDel.php?id=<?php echo $id;?>">删除</a></span>
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
                
                    <li class="lipage"><a href="reply-list.php?page=1&id=<?php echo $id;?>" class="pagea">首页</a></li>
                    <li class="lipage"><a href="reply-list.php?page=<?php echo $prevPage;?>&id=<?php echo $id;?>" class="pagea">上一页</a></li>
                    <li class="lipage"><a href="reply-list.php?page=<?php echo $nextPage;?>&id=<?php echo $id;?>" class="pagea">下一页</a></li>
                    <li class="lipage"><a href="reply-list.php?page=<?php echo $totalPage;?>&id=<?php echo $id;?>" class="pagea">尾页</a></li>
                </ol>
            </td></tr>
        </table>
    </div>
</div>
<div style="padding-top:10px">
    <form method="post" action="doReply.php">
        <div style="float:left">
            <textarea name="content" style="height:50px;width:800px" ></textarea>
        </div>
        
        <input type="hidden" name="id" value="<?php echo $id;?>" />
        <div style="float:left">
            <input type="submit" value="确认回复" style="height:50px;width:110px" />
        </div>
    </form>    
</div>

</div>
<body>
</html>