<?php

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设置获取开始位置
$start = 0;
if(empty($_GET['bankuaiid'])){
    $banKuaiMing = "";
}else{
    $banKuaiFenQu = $_GET['bankuaiid'];
    $banKuaiMing = " and pid={$banKuaiFenQu}";
}
if(!empty($_GET)){
    //如果是本页跳转,有GET
 
    if(empty($_GET['start'])){
        //搜索数据时,重置start;
        $start = 0;
        $seach = $_GET['seach'];
    }else{
        //继续使用start
        $seach = $_GET['seach'];
        $start = $_GET['start'];
    }
    //获取总行数
    $sql = "select user.name,posts.* from user,posts where posts.recycle=0 $banKuaiMing and uid=user.id and posts.title like '%{$seach}%' ";
    $result = mysqli_query($link, $sql);
    $count = mysqli_affected_rows($link) ? mysqli_affected_rows($link) : 0;

    $sql = "select user.name,posts.* from user,posts where posts.recycle=0 $banKuaiMing and uid=user.id and posts.title like '%{$seach}%' limit {$start},5";
}else{
    //获取总行数
    $sql = "select user.name,posts.* from user,posts where posts.recycle=0 $banKuaiMing and uid=user.id";
    $result = mysqli_query($link, $sql);
    $count = mysqli_affected_rows($link) ? mysqli_affected_rows($link) : 0;

    //若果是直接进入,无GET
    $sql = "select user.name,posts.* from user,posts where posts.recycle=0 $banKuaiMing and uid=user.id limit {$start},5";
    
}
//获取当页显示行数

//    select user.name,posts.* from user,posts where posts.recycle=0 and uid=user.id and posts.title like '%a%' limit 0,5

$result = mysqli_query($link, $sql);
$showCount = mysqli_affected_rows($link) ? mysqli_affected_rows($link) : 0;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="../css/css.css" type="text/css" rel="stylesheet" />
<link href="../css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<body>
<!--main_top-->
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：用户管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <form method="get" action="post_list.php">
	         <span>搜索用户&nbsp;&nbsp;</span>
	         <input type="text" name="seach" value="<?php if(!empty($_GET['seach'])){echo $_GET['seach'];} ?>" class="text-word">
	         <input name="" type="submit" value="查询" class="text-but">
	         </form>
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright">编号</th>
        <th align="center" valign="middle" class="borderright">板块</th>
        <th align="center" valign="middle" class="borderright">主题</th>
        <th align="center" valign="middle" class="borderright">发帖人</th>
        <th align="center" valign="middle" class="borderright">发帖时间</th>
        <th align="center" valign="middle" class="borderright">状态</th>
        <th align="center" valign="middle" class="borderright">操作</th>
      </tr>
      <?php
        $i = $start + 1;
        while($res = mysqli_fetch_assoc($result)){
            // 获取用户名权限状态以及最后登录时间
            // var_dump($res);
            $id = $res['id'];
            $pid = $res['pid'];
            $uid = $res['name'];
            $title = $res['title'];
            $top= $res['top'];
            $hot= $res['hot'];
            $recycle= $res['recycle'];
            $reply= $res['reply'];
            $pcount= $res['count'];
            $time = date('Y-m-d H:i:s',$res['time']);
            //获取板块名
            $banKuaiSql = "select name from type where id={$pid}";
            $banKuaiResult = mysqli_query($link, $banKuaiSql);
            $banKuaiRes = mysqli_fetch_assoc($banKuaiResult);
            $pidName = $banKuaiRes['name'];
        
      ?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $i;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $pidName;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $title;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $uid;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $time;?></td>
        <td align="center" valign="middle" class="borderbottom">
            <a href="doTop.php?id=<?php echo $id; ?>&top=<?php echo $top; ?>" target="mainFrame" onFocus="this.blur()" class="add"><?php echo $res['top'] ? '取消置顶' : '置顶'; ?></a><span class="gray">&nbsp;|&nbsp;</span>
            <a href="doHot.php?id=<?php echo $id; ?>&hot=<?php echo $hot; ?>" target="mainFrame" onFocus="this.blur()" class="add"><?php echo $res['hot'] ? '取消加精' : '加精'; ?></a><span class="gray">&nbsp;|&nbsp;</span>
            <a href="doStop.php?id=<?php echo $id; ?>&reply=<?php echo $reply; ?>" target="mainFrame" onFocus="this.blur()" class="add"><?php echo $res['reply'] ? '允许回复' : '禁止回复'; ?></a>
        </td>
        <td align="center" valign="middle" class="borderbottom">
            <?php
            //判断帖子下是否有回复,有回复可以查看不能删除,没有可以删除不能查看
            $tieZiSql = "select * from replies where pid={$id}";
            $tieZiResult = mysqli_query($link, $tieZiSql);
            $tieZiCount = mysqli_num_rows($tieZiResult);
            if($tieZiCount > 0){
            ?>
            
            <a href="reply-list.php?id=<?php echo $id;?>" target="mainFrame" onFocus="this.blur()" class="add">管理回复(<?php echo $tieZiCount; ?>)</a><span class="gray">&nbsp;|&nbsp;</span>
            <?php
            }else{
            ?>
            <a href="doDelPost.php?id=<?php echo $id;?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a><span class="gray">&nbsp;|&nbsp;</span>
            <?php
            }
            ?>
            <a href="#" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span>
            <a href="doRec.php?id=<?php echo $id; ?>&recycle=<?php echo $recycle; ?>" target="mainFrame" onFocus="this.blur()" class="add">放入回收站</a>
        </td>
      </tr>
      <?php
        $i++;
        }
      ?>
    </table></td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye">
        <?php
            //总页数
            $count = ceil($count/5);
            $lastPage = $count - 1;
            $lastPage *= 5;
            $nextPage = $lastPage;
            // $lastPage -= 1;
            $nowPage = $start/5;
            // 当前页
            $nowPage += 1;
        ?>
        <?php if(empty($_GET['search'])){echo $showCount;} ?> 条数据 <?php echo $nowPage; ?>/<?php echo $count; ?> 页&nbsp;&nbsp;
        <a href="post_list.php?start=0&seach=<?php if(isset($seach)){echo $seach;} ?>&bankuaiid=<?php if(isset($banKuaiFenQu)){echo $banKuaiFenQu;} ?>" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;
        <a href="post_list.php?start=<?php if($start-5 < 0){echo 0;}else{echo $start - 5;} ?>&seach=<?php if(isset($seach)){echo $seach;} ?>&bankuaiid=<?php if(isset($banKuaiFenQu)){echo $banKuaiFenQu;} ?>" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;
        <a href="post_list.php?start=<?php if($start < $lastPage){echo $start + 5;}else{echo $lastPage;}?>&seach=<?php if(isset($seach)){echo $seach;} ?>&bankuaiid=<?php if(isset($banKuaiFenQu)){echo $banKuaiFenQu;} ?>" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;
        <a href="post_list.php?start=<?php echo $lastPage; ?>&seach=<?php if(isset($seach)){echo $seach;} ?>&bankuaiid=<?php if(isset($banKuaiFenQu)){echo $banKuaiFenQu;} ?> " target="mainFrame" onFocus="this.blur()">尾页</a>
    </td>
  </tr>
</table>
<?php
mysqli_free_result($result);
mysqli_close($link);
?>
</body>
</html>