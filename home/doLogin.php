<?php
// var_dump($_POST);
//获取用户输入的用户名
$name = $_POST['name'];

//获取用户输入的密码
$pwd = $_POST['pwd'];

// echo $username, $pwd;
//判断是否输入用户名以及密码
if(empty($name) || empty($pwd)){
    if(empty($name) && empty($pwd)){
        echo '用户名或密码不能为空';
        header('refresh:2; url=index.php');
        exit;
    } if(empty($pwd)){
        echo '密码不能为空';
        header('refresh:2; url=index.php');
        exit;
    }else{
        echo '用户名不能为空';
        header('refresh:2; url=index.php');
        exit;
    } 
}
//连接数据库
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$pwd = md5($_POST['pwd']);

$sql = "select id from user where name='{$name}' and password='{$pwd}' and stauths=0";

//执行语句
$res = mysqli_query($link, $sql);
$id = mysqli_fetch_assoc($res)['id'];

//判断用户是否存在
if(mysqli_affected_rows($link) > 0){
    //存在,跳转成功
    setcookie('inLogin', $name);
    setcookie('loginId', $id);
    //判断是从哪一个页面跳转到本脚本,然后跳转回去
    if($_GET['page'] == 'index.php'){
        header("location:login.php?id={$id}");
    }else if($_GET['page'] == 'post.php'){
        $plateId = $_GET['plateid'];
        header("location:post-login.php?id=${id}&plateid={$plateId}");
    }else{
        header("location:reply-logined.php?id=${id}");
    }
}else{
    //不存在,跳转失败
    echo '用户名或密码错误,请检查用户名密码';
    header('refresh:2; url=index.php');
}

mysqli_close($link);

exit();


