<?php
//销毁cookie
setcookie('inLogin','',time()-1);
header('location:index.php');