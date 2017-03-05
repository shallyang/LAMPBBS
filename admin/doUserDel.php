<?php
$id = $_GET['id'];

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$sql = "delete from user where id={$id}";
//执行语句
mysqli_query($link, $sql);
//删除用户发过的回复
$delRepSql = "delete from replies where uid={$id}";
mysqli_query($link, $delRepSql);

//删除用户发过的帖子
$delPostSql = "delete from posts where uid={$id}";
mysqli_query($link, $delPostSql);

header('refresh:0;url=./users/main_list.php');
mysqli_close($link);