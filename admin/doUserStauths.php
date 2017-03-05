<?php
$id = $_GET['id'];
$stauths = $_GET['stauths'];

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句
$stauths = $stauths ? 0 : 1;

$sql = "update user set stauths ={$stauths}  where id={$id}";

//执行语句
mysqli_query($link, $sql);
header('refresh:0,url=./users/main_list.php');
mysqli_close($link);