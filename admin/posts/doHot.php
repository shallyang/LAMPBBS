<?php
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
$hot = $_GET['hot'];
$id = $_GET['id'];
if($hot == 0){
    $hot = 1;
}else{
    $hot = 0;
}
$sql = "update posts set hot={$hot} where id={$id}";
mysqli_query($link, $sql);
header('location:post_list.php');
mysqli_free_result($result);
mysqli_close($link);