<?php
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
$reply = $_GET['reply'];
$id = $_GET['id'];
if($reply == 0){
    $reply = 1;
}else{
    $reply = 0;
}
$sql = "update posts set reply={$reply} where id={$id}";
// echo $sql;
// die;
mysqli_query($link, $sql);
header('location:post_list.php');
mysqli_free_result($result);
mysqli_close($link);
exit;