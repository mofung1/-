<?php /*a:1:{s:60:"D:\PHPstudy\WWW\bike\application\admin\view\login\index.html";i:1540449176;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>thinkphp5</title>
    <meta name="description" content="login page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="/bike/public/static/admin/style/bootstrap.css" rel="stylesheet">
    <link href="/bike/public/static/admin/style/font-awesome.css" rel="stylesheet">
    <!--Beyond styles-->
    <link id="beyond-link" href="/bike/public/static/admin/style/beyond.css" rel="stylesheet">
    <link href="/bike/public/static/admin/style/demo.css" rel="stylesheet">
    <link href="/bike/public/static/admin/style/animate.css" rel="stylesheet">
</head>
<!--Head Ends-->
<!--Body-->

<body>
    <div class="login-container animated fadeInDown">
        <form action="" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">登录</div>
                <div class="loginbox-textbox">
                    <input  class="form-control" placeholder="用户名" name="name" type="text">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" placeholder="密码" name="password" type="password">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control"  name="code" type="text" style="width: 50%;float: left">
                   <!--  <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random();" style="width: 100px;height:30px;float: left;cursor: pointer;" /> -->

                    <img src="<?php echo url('Login/verify'); ?>" alt="captcha" onclick="this.src='<?php echo url('Login/verify'); ?>?'+Math.random();" style="width: 100px;height:30px;float: left;cursor: pointer;" />
                </div>
                <div class="loginbox-submit" style="margin-top: 20px">
                    <input class="btn btn-primary btn-block" value="登录" type="submit">
                </div>
            </div>
        </form>
    </div>
    <!--Basic Scripts-->
    <script src="/bike/public/static/admin/style/jquery.js"></script>
    <script src="/bike/public/static/admin/style/bootstrap.js"></script>
    <script src="/bike/public/static/admin/style/jquery_002.js"></script>
    <!--Beyond Scripts-->
    <script src="/bike/public/static/admin/style/beyond.js"></script>




</body><!--Body Ends--></html>