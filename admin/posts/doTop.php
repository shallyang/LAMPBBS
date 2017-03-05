<?php
$link = mysqli_connect('localhost', 'root', '');

mysqli_set_charset($link, 'utf8');

mysqli_select_db($link, 'lampbbs');
$top = $_GET['top'];
$id = $_GET['id'];
if($top == 0){
    $top = 1;
}else{
    $top = 0;
}
$sql = "update posts set top={$top} where id={$id}";
mysqli_query($link, $sql);
header('location:post_list.php');
mysqli_free_result($result);
mysqli_close($link);
exit;