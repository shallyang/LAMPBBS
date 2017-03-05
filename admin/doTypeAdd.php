<?php
//判断是否输入分区名字
if(empty($_POST['typename'])){
    echo '请输入分区名';
    header('refresh:2; url=./types/type_add.php');
    exit;
}
//获取新建分区名
$typename = $_POST['typename'];

//天龙八部
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$sql = "insert into type(name,pid,path,photo)values('{$typename}',0,0,null);";

//执行语句
mysqli_query($link, $sql);
// 判断是否有影响行数
if(mysqli_affected_rows($link) > 0){
    header('refresh:0; url=./types/type_list.php');
}else{
    echo '分区插入失败';
    header('refresh:2; url=./types/type_add.php');
}
mysqli_close($link);
exit;