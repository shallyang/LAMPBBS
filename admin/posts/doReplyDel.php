<?php
$id = $_GET['id'];
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$sql = "delete from replies where id={$id}";

//执行语句
mysqli_query($link, $sql);
mysqli_close($link);
header('location:post_list.php');
exit;