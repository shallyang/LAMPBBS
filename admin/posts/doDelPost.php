<?php
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//获取帖子id
$id = $_GET['id'];


$sql = "delete from posts where id={$id}";

mysqli_query($link, $sql);
header('location:post_list.php');
mysqli_free_result($result);
mysqli_close($link);