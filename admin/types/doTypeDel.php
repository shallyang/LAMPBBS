<?php
$id = $_GET['id'];

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$sql = "delete from type where id={$id}";

//执行语句
mysqli_query($link, $sql);

header('refresh:0;url=./type_list.php');
mysqli_close($link);