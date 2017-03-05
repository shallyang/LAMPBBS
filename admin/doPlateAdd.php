<?php
// var_dump($_POST);
// exit;
// 开启数据库
$typeName = $_POST['typename'];
$plateName = $_POST['platename'];
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');

//如果是从板块列表跳转到添加板块,那么,会有id值,
//如果存在,则直接使用,如果不存在,获取名字再查询id
// print_r($_GET);
// exit;
if(!empty($_GET)){
    $id = $_GET['id'];
}else{
    //设计sql语句将板块名对应的id取出
    $sql = "select id from type where name='{$typeName}'";
    $res = mysqli_query($link, $sql);
    // 获取id,如果有,则输出,没有显示为空
    $id = mysqli_fetch_assoc($res)['id'];
}
//获取用户上传的图像,如果上传获取新信息
//如果没有上传,使用默认值
// var_dump($_FILES);
// exit;
if($_FILES['smallimg']['error'] == 4){
    $img = 'default.jpg';
}else{
    $img = upload();
}

//如果id是空,创建新的板块
if(empty($id)){
    //插入新的板块
    $sql = "insert into type(name,path,photo)value('{$typeName}',0,null)";
    mysqli_query($link, $sql);
    //并获取到id
    $sql = "select id from type where name='{$typeName}'";
    $res = mysqli_query($link, $sql);
    $id = mysqli_fetch_assoc($res)['id'];
    // 设计sql语句插入数据
    $path = '0-' . $id;
    $sql = "insert into type(name,photo,path,pid)value('{$plateName}','{$img}','{$path}','{$id}')";
    mysqli_query($link, $sql);
    header('refresh:0;url=./types/type_list.php');
}else{
    $sql = "update type set photo='{$img}',name='{$plateName}' where id={$id}";
    $res = mysqli_query($link, $sql);
    if(mysqli_affected_rows($link) > 0){
        header('refresh:0;url=./types/type_list.php');
    }else{
        echo '修改名称不能与原名称相同';
        header('refresh:2;url=./types/plate_add.php');
    }
}    
    mysqli_free_result($res);
    mysqli_close($link);



function upload(){
	/* 
	1.判断是否上传成功
	*/
	$error = $_FILES['smallimg']['error'];
	if($error){
		switch($error){
			case 1:
				echo '上传的文件超过PHPINI允许的大小，请重新上传~';
				header('refresh:3; url=./types/plate_add.php');
				break;
			case 2:
				echo '上传的文件超过form表单允许的大小，请重新上传~';
				header('refresh:3; url=./types/plate_add.php');
				break;
			case 3:
				echo '部分文件被上传，请重新上传~';
				header('refresh:3; url=./types/plate_add.php');
				break;
			case 4:
				echo '没有文件被上传，请重新上传~';
				header('refresh:3; url=./types/plate_add.php');
				break;
			case 6:
				echo '临时目录有问题，请重新上传~';
				header('refresh:3; url=./types/plate_add.php');
				break;
			case 7:
				echo '文件写入失败，请重新上传~';
				header('refresh:3; url=./types/plate_add.php');
				break;
		}
		exit();
	}
	/* 
		2.判断是否是通过POST方式上传
	 */
	$tmpName = $_FILES['smallimg']['tmp_name'];
	if(!is_uploaded_file($tmpName)){
		echo '文件不是通过POST方式上传的,请重新上传~';
		header('refresh:3; url=./types/plate_add.php');
		exit();
	}

	/* 
		3.判断是否是允许的类型
	 */
	$mime = $_FILES['smallimg']['type'];
	//定义允许的类型
	$allowType = array(
		'image/jpeg',
		'image/png',
		'image/gif'
	);
	if(!in_array($mime, $allowType)){
		echo '上传的文件不是允许的类型';
		header('refresh:9; url=./types/plate_add.php');
		exit();
	}

	/* 
		4.获取原文件后缀名
	 */
	$ext = '.' . explode('/', $mime)[1];

	/* 
		5.定义存放目录
	 */
	$uploads = '../public/admin/';
	if(!is_dir($uploads)){
		mkdir($uploads);
	}
		
	/* 
		6.拼凑新的文件名
	 */
	$img = md5(date('Ymdhis')+rand(1, 10000000));

	/* 
		7.移动临时文件到目标位置
	 */
	if(move_uploaded_file($tmpName, $uploads . $img . $ext)){
		header('refresh:3; url=./types/type_list.php');
        //上传成功之后,返回图片的名字
        $img = $img . $ext;
        return $img;
	}else{
		echo '图片上传失败，请重新上传~';
		header('refresh:3; url=./types/plate_add.php');
		exit();
	}

}













































