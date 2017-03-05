<?php
// var_dump($_POST);

// 启用session服务
session_start();

if(empty($_POST['code'])){
    echo '请输入验证码';
    header('refresh:2; url=login.php');
    exit;
}
if($_POST['code'] != $_SESSION['code']){
    echo '验证码错误';
    header('refresh:2; url=login.php');
    exit;
}
//获取用户输入的用户名
$name = $_POST['username'];

//获取用户输入的密码
$pwd = $_POST['pwd'];

// echo $username, $pwd;
//判断是否输入用户名以及密码
if(empty($name) || empty($pwd)){
    if(empty($name) && empty($pwd)){
        echo '用户名或密码不能为空';
        header('refresh:2; url=login.php');
        exit;
    } if(empty($pwd)){
        echo '密码不能为空';
        header('refresh:2; url=login.php');
        exit;
    }else{
        echo '用户名不能为空';
        header('refresh:2; url=login.php');
        exit;
    } 
}
//连接数据库
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$pwd = md5($_POST['pwd']);

$sql = "select id,name,time,count from user where name='{$name}' and password='{$pwd}' and auth=1 and stauths=0";

//执行语句
$res = mysqli_query($link, $sql);

//判断用户是否存在
if(mysqli_affected_rows($link) > 0){
    //存在,跳转成功
    $res = mysqli_fetch_assoc($res);
    // 获取时间,id和名字
    $id = $res['id'];
    $lastTime = $res['time'];
    $name = $res['name'];
    $count = $res['count'] + 1;
    setcookie('isLogin', 1);
    setcookie('name', $name);
    setcookie('lastTime', $lastTime);
    setcookie('count', $count);
    //获取当前时间
    $now = time();
    $sql = "update user set time={$now},count=count+1 where id={$id}";
    //更改时间
    mysqli_query($link, $sql);
    header('location:index.php');
}else{
    //不存在,跳转失败
    echo '用户不存在,请检查用户名密码';
    header('refresh:2; url=login.php');
}

mysqli_free_result($res);
mysqli_close($link);

exit();


