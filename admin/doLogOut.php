<?php
//销毁cookie
setcookie('isLogin','',time()-1);
header('location:login.php');