<?php
// var_dump($_POST);
//获取id.plateid
$postId = $_POST['postid'];
$id = $_POST['id'];
if(empty($_POST['content'])){
    echo '请输入回复内容!';
    header("refresh:2;url=reply-logined.php?id={$id}&postid={$postId}");
    exit;
}
//获取用户名,用户回复内容,当前时间
$name = $_COOKIE['inLogin'];
$content = $_POST['content'];
$time = time();

//连接数据库
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');


//获取用户id
$userSql = "select id from user where name='{$name}'";

$userRes = mysqli_query($link, $userSql);

$userId = mysqli_fetch_assoc($userRes)['id'];

// 插入回复数据
$replySql = "insert into replies(content,time,uid,pid)value('{$content}',{$time},{$userId},{$postId})";

mysqli_query($link, $replySql);

//回复加积分
$scoreSql = "update user set score=score+10 where id={$userId}";
mysqli_query($link, $scoreSql);

echo '回复成功!';
header("refresh:2;url=reply-logined.php?id={$id}&postid={$postId}");

mysqli_free_result($userRes);
mysqli_close($link);
exit;
















