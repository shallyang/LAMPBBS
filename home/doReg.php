<?php
$name = $_POST['name'];
$pwd = $_POST['pwd'];
$repwd = $_POST['repwd'];
$email = $_POST['email'];
//判断用户是否同意用户协议
if(empty($_POST['agree'])){
    echo '请勾选同意用户注册协议';
    header('refresh:2; url=reg.php');
    exit;
}

//判断是否输入用户名以及密码
if(empty($name) || empty($pwd) || empty($repwd) || empty($email)){
    echo '用户信息输入不完整';
    header('refresh:2; url=reg.php');
    exit();
}

//判断两次密码输入是否一致
if($pwd !== $repwd){
    echo '两次密码输入不一致';
    header('refresh:2; url=users/reg.php');
    exit();
}

//连接数据库
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$pwd = md5($_POST['pwd']);

$sql = "insert into user(name,password,email)values('{$name}','{$pwd}','{$email}')";

//执行语句
mysqli_query($link, $sql);

//判断用户是否存在
if(mysqli_affected_rows($link) > 0){
    //注册成功
        echo '注册成功!';
        header('refresh:2;url=index.php');
}else{
    //注册失败
    echo '注册失败,请重试';
    header('refresh:2; url=reg.php');
}

mysqli_close($link);

exit();


































