<?php
//获取修改界面用户提交的数据
$name = $_GET['name'];
$oldPwd = $_POST['oldPwd'];
$newPwd = $_POST['newPwd'];
$rePwd = $_POST['rePwd'];
$level = $_POST['level'];
$id = $_GET['id'];
$auth = $_GET['auth'];
if($oldPwd == $newPwd){
    echo '新旧密码不能相同';
    header("refresh:2;url=./users/main_edit.php?name={$name}&leval={$level}&id={$id}&auth={$auth}");
    exit;
}
//判断是否有没输入的项目
if(empty($oldPwd) || empty($newPwd) || empty($rePwd)){
    echo '信息输入不完整';
    header("refresh:2;url=./users/main_edit.php?name={$name}&leval={$level}&id={$id}&auth={$auth}");
    exit;
}
//判断旧密码是否相等

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

//将旧密码取出的SQL语句
$sql = "select password from user where id={$id}";

//执行语句
$result=mysqli_query($link, $sql);
//获取到旧密码
foreach($result as $res){
    $sqlPwd = $res['password'];
}
//判断输入的旧密码是否和数据库中的相同
// 不相同跳转到修改界面
if(md5($oldPwd) != $sqlPwd){
    echo '旧密码错误';
    header("refresh:2;url=./users/main_edit.php?name={$name}&leval={$level}&id={$id}&auth={$auth}");
    exit;
}
$newPwd = md5($newPwd);
//设计SQL语句
$sql = "update user set password='{$newPwd}',auth={$level} where id={$id}";
//执行
mysqli_query($link, $sql);

if(mysqli_affected_rows($link) > 0){
    //密码修改成功
    echo '信息修改成功!';
    header('refresh:2;url=users/main_list.php');
}else{
    //插入失败
    echo '信息修改失败';
    header('refresh:2; url=users/main_edit.php');
}

mysqli_free_result($result);

mysqli_close($link);

exit();





















































