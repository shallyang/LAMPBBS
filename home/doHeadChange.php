<?php
$id = $_GET['id'];
//上传文件,并获取上传后的文件名
$desName = upload($id);

$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
//设计sql语句

$sql = "select photo from user where id={$id}";

//执行语句
$res = mysqli_query($link, $sql);

//获取出数据库内的文件名
$oldName = mysqli_fetch_assoc($res)['photo'];
//设置旧文件的文件路径以及文件名
$oldImgFile = '../public/home/headimgs/' . $oldName;
$newImgFile = '../public/home/headimgs/' . $desName;
if($oldName != 'default.jpg'){
// 如果文件名是默认,直接修改,不删除文件
    unlink($oldImgFile);
}

$sql = "update user set photo='{$desName}' where id={$id}";
mysqli_query($link,$sql);
if(mysqli_affected_rows($link) > 0){
    echo '修改成功';
    header("refresh:3; url=./photo-change.php?id={$id}");
    exit;
}else{
    echo '修改失败,请重试!';
    // 如果上传失败,删除刚刚上传的图片
    unlink($newImgFile);
    header("refresh:3; url=./photo-change.php?id={$id}");
    exit;
}


function upload($id){
    
	/* 
	1.判断是否上传成功
	*/
	$error = $_FILES['newphoto']['error'];
	if($error){
		switch($error){
			case 1:
				echo '上传的文件超过PHPINI允许的大小，请重新上传~';
				header("refresh:3; url=./photo-change.php?id={$id}");
				break;
			case 2:
				echo '上传的文件超过form表单允许的大小，请重新上传~';
				header("refresh:3; url=./photo-change.php?id={$id}");
				break;
			case 3:
				echo '部分文件被上传，请重新上传~';
				header("refresh:3; url=./photo-change.php?id={$id}");
				break;
			case 4:
				echo '没有文件被上传，请重新上传~';
				header("refresh:3; url=./photo-change.php?id={$id}");
				break;
			case 6:
				echo '临时目录有问题，请重新上传~';
				header("refresh:3; url=./photo-change.php?id={$id}");
				break;
			case 7:
				echo '文件写入失败，请重新上传~';
				header("refresh:3; url=./photo-change.php?id={$id}");
				break;
		}
		exit();
	}
	/* 
		2.判断是否是通过POST方式上传
	 */
	$tmpName = $_FILES['newphoto']['tmp_name'];
	if(!is_uploaded_file($tmpName)){
		echo '文件不是通过POST方式上传的,请重新上传~';
		header("refresh:3; url=./photo-change.php?id={$id}");
		exit();
	}

	/* 
		3.判断是否是允许的类型
	 */
	$mime = $_FILES['newphoto']['type'];
	//定义允许的类型
	$allowType = array(
		'image/jpeg',
		'image/png',
		'image/gif'
	);
	if(!in_array($mime, $allowType)){
		echo '上传的文件不是允许的类型';
        header("refresh:3; url=./photo-change.php?id={$id}");
		exit();
	}

	/* 
		4.获取原文件后缀名
	 */
	$ext = '.' . explode('/', $mime)[1];

	/* 
		5.定义存放目录
	 */
	$uploads = '../public/home/headimgs/';
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
		//上传成功之后,返回图片的名字
        $img = $img . $ext;
        return $img;
	}else{
		echo '图片上传失败，请重新上传~';
		header("refresh:3; url=./photo-change.php?id={$id}");
		exit();
	}

}

