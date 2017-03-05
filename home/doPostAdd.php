<?php

if(empty($_POST['title']) || empty($_POST['content'])){
    echo 
    header('');
}

$name = $_COOKIE['inLogin'];
//获取用户输入的内容,以及分区&板块的id
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];
$banKuaiId = $_POST['plateid'];
//判断是否为空

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');

// title
// content
// uid
// pid
// time
// reply
//获取发帖用户的id
$nameSql = "select id from user where name='{$name}'";


$nameRes = mysqli_query($link, $nameSql);
$nameResult = mysqli_fetch_assoc($nameRes);
$uid = $nameResult['id'];

$time = time();

if(empty($_POST['stop'])){
$postsSql = "insert into posts(title,content,uid,pid,time)values('{$title}','{$content}','{$uid}','{$banKuaiId}','{$time}')";
}else{
    $stop = $_POST['stop'];
$postsSql = "insert into posts(title,content,uid,pid,time,reply)values('{$title}','{$content}',{$uid},{$banKuaiId},{$time},{$stop})";
}
//插入数据库
mysqli_query($link, $postsSql);

if(mysqli_affected_rows($link) > 0){
    echo '添加成功!正在跳转到帖子页!';
    header("refresh:2;url=post-login.php?id={$id}&plateid={$banKuaiId}");
}else{
    echo '网站异常,请稍后重试!';
    setcookie('inLogin','',time()-1);
    header("refresh:2;url=index.php");
}

// mysqli_free_result($nameResult);
mysqli_close($link);

exit;


