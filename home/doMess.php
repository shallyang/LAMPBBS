<?php
//获取修改界面用户提交的数据
$qq = $_POST['qq'];
$email = $_POST['email'];
$id = $_GET['id'];


//判断是否有没输入的项目
if(empty($qq) || empty($email)){
    echo '信息输入不完整';
    header("refresh:2;url=messige-change.php?id={$id}");
    exit;
}
//连接数据库

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

//修改信息的SQL语句
$sql = "update user set qq='{$qq}',email='{$email}' where id={$id}";

//执行语句
mysqli_query($link, $sql);

if(mysqli_affected_rows($link) > 0){
    //密码修改成功
    echo '信息修改成功!';
    header("refresh:2;url=messige-change.php?id={$id}");
}else{
    //插入失败
    echo '信息修改失败';
    header("refresh:2;url=messige-change.php?id={$id}");
}

mysqli_close($link);

exit();
















































































