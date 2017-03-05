<?php
$id = $_GET['id'];

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
// 获取图片名称
$sql = "select photo from type where id={$id}";
$res = mysqli_query($link, $sql);
$img = mysqli_fetch_assoc($res)['photo'];
//判断是不是默认图片,如果是不删除
$imglen = strlen($img);
if($imglen > 20){
    $path = '../../public/admin/' . $img;
    unlink($path);
}
//设计sql语句

$sql = "delete from type where id={$id}";


//执行语句
mysqli_query($link, $sql);
header('refresh:0;url=./type_list.php');
mysqli_close($link);