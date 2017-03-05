<?php
//判断是否输入分区名字
if(empty($_POST['typename'])){
    echo '请输入新分区名';
    header('refresh:2; url=./types/type_change.php');
    exit;
}
//获取新建分区名
$typeName = $_POST['typename'];

//天龙八部
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
// 获取输入的分区名称的id
$id = $_GET['id'];

//设计sql语句
$sql = "update type set name='{$typeName}' where id = {$id}";

//执行语句
mysqli_query($link, $sql);
// 判断是否有影响行数
if(mysqli_affected_rows($link) > 0){
    header('refresh:0; url=./types/type_list.php');
}else{
    echo '分区修改失败';
    header('refresh:2; url=./types/type_change.php');
}
mysqli_close($link);
exit;