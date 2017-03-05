<?php

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设置获取开始位置
$start = 0;
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
    $sql = "select id from user where name like '%{$seach}%'";
    $result = mysqli_query($link, $sql);
    $count = mysqli_affected_rows($link) ? mysqli_affected_rows($link) : 0;

    $sql = "select * from user where name like '%{$seach}%' limit {$start},5";
}else{
    //获取总行数
    $sql = "select id from user";
    $result = mysqli_query($link, $sql);
    $count = mysqli_affected_rows($link) ? mysqli_affected_rows($link) : 0;

    //若果是直接进入,无GET
    $sql = "select * from user limit {$start},5";
    
}
//获取当页显示行数
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
	         <form method="get" action="main_list.php">
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
        <th align="center" valign="middle" class="borderright">管理帐号</th>
        <th align="center" valign="middle" class="borderright">权限</th>
        <th align="center" valign="middle" class="borderright">锁定</th>
        <th align="center" valign="middle" class="borderright">最后登录</th>
        <th align="center" valign="middle">操作</th>
      </tr>
      <?php
        $i = $start + 1;
        while($res = mysqli_fetch_assoc($result)){
            // 获取用户名权限状态以及最后登录时间
            $id = $res['id'];
            $name = $res['name'];
            $auth = $res['auth'] ? '管理员' : '普通用户';
            $stauths = $res['stauths'] ? '是' : '否';
            $time = date('Y-m-d H:i:s',$res['time']);
        
      ?>
      <tr onMouseOut="this.style.backgroundColor='#ffffff'" onMouseOver="this.style.backgroundColor='#edf5ff'">
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $i;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $name;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $auth;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $stauths;?></td>
        <td align="center" valign="middle" class="borderright borderbottom"><?php echo $time;?></td>
        <td align="center" valign="middle" class="borderbottom">
            <a href="../doUserStauths.php?id=<?php echo $id;?>&stauths=<?php echo $res['stauths'];?>" target="mainFrame" onFocus="this.blur()" class="add"><?php echo $res['stauths'] ? '启用' : '禁用'; ?></a><span class="gray">&nbsp;|&nbsp;</span>
            <a href="main_edit.php?id=<?php echo $id;?>&auth=<?php echo $res['auth'];?>&name=<?php echo $res['name']; ?>" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span>
            <a href="../doUserDel.php?id=<?php echo $id;?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a>
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
        <a href="main_list.php?start=0&seach=<?php if(isset($seach)){echo $seach;} ?>" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;
        <a href="main_list.php?start=<?php if($start-5 < 0){echo 0;}else{echo $start - 5;} ?>&seach=<?php if(isset($seach)){echo $seach;} ?>" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;
        <a href="main_list.php?start=<?php if($start < $lastPage){echo $start + 5;}else{echo $lastPage;}?>&seach=<?php if(isset($seach)){echo $seach;} ?>" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;
        <a href="main_list.php?start=<?php echo $lastPage; ?>&seach=<?php if(isset($seach)){echo $seach;} ?> " target="mainFrame" onFocus="this.blur()">尾页</a>
    </td>
  </tr>
</table>
<?php
mysqli_free_result($result);
mysqli_close($link);
?>
</body>
</html>