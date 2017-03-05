<?php
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
$id = $_GET['id'];
$recycle = $_GET['recycle'];
if($recycle == 0){
    $recycle = 1;
}else{
    $recycle = 0;
}
$sql = "update posts set recycle={$recycle} where id={$id}";
mysqli_query($link, $sql);
header('location:post_list.php');
mysqli_free_result($result);
mysqli_close($link);