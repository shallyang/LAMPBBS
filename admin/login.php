<!DOCTYPE html>
<html>
<head runat="server">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理登录界面</title>
    <link href="../css/reset.css" type="text/css" rel="stylesheet" />
    <style>
        
        #div{
            margin:0 auto;
            border-top-width:1px;
            background-image:url('./images/login/login1.jpg');
            height:545px;
            text-align:center;
            padding-top:100px;
        }
        #form{
            margin:0 auto;
            background-image:url('./images/login/login.jpg');
            opacity:.8;
            width:500px;
            height:300px;
            text-align:center;
            padding:50px;
        }
        #h1{
            margin-top:50px;
            font-size:30px;
            font-style:bold;
        }
        #name{
            line-height:50px;
        }
        #pwd{
           margin-bottom:10px;
        }
        #code{
            width:80px;
        }
        #codeimg{
           margin-left:5px;
           margin-top:15px;
        }
        #button{
           margin-top:15px; 
        }
    </style>
</head>
<body>
    <div id="div">
        <div id="form">
            <p id="h1"><b>LAMPBBS系统后台登录</b></p>
            <form runat="server" action="doLogin.php" method="post" />
                        <div id="name">
                            <label>用户名:<input type="text" name="username" /></label>
                        </div>  
                        <div id="pwd">
                            <label>密&nbsp;码:<input type="password" name="pwd" /></label>
                        </div>  
                        
                        <div>
                            <label>验证码:<input type="text" name="code" maxlength="4" id="code"/></label>
                            <span id="codeimg"><a href="" alter="点击获取验证码"><img src="./code.php" /></a></span>
                        </div>
                        <div class="button">
                            <input type="submit" id="button" />
                        </div>  
            </form>
        </div>
    </div>    
</body>
</html>