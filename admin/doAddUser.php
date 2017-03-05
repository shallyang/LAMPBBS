<?php
//获取用户输入的用户名
$name = $_POST['username'];

//获取用户输入的密码
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];
$level = $_POST['level'];

//判断是否输入用户名以及密码
if(empty($name) || empty($pwd) || empty($repwd)){
    echo '请输入用户或密码';
    header('refresh:2; url=main_info.php');
    exit();
}

//判断两次密码输入是否一致
if($pwd !== $repwd){
    echo '两次密码输入不一致';
    header('refresh:2; url=users/main_info.php');
    exit();
}

//连接数据库
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$pwd = md5($_POST['pwd']);

$sql = "insert into user(name,password,auth)values('{$name}','{$pwd}','{$level}')";

//执行语句
mysqli_query($link, $sql);

//判断用户是否存在
if(mysqli_affected_rows($link) > 0){
    //插入成功
    if($level){
        echo '插入管理员成功!';
        header('refresh:2;url=users/main_list.php');
    }else{
        echo '插入用户成功!';
        header('refresh:2;url=users/main_list.php');
    }    
}else{
    //插入失败
    echo '插入失败,请重试';
    header('refresh:2; url=users/main_info.php');
}

mysqli_close($link);

exit();











































