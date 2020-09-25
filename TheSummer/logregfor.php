<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>登录</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/sign-up-login.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/inputEffect.css" />
    <link rel="stylesheet" href="css/tooltips.css" />
    <link rel="stylesheet" href="css/spop.min.css" />

    <script src="js/jquery.min.js"></script>
    <script src="js/snow.js"></script>
    <script src="js/jquery.pure.tooltips.js"></script>
    <script src="js/spop.min.js"></script>
    <script>
        (function() {
            // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
            if (!String.prototype.trim) {
                (function() {
                    // Make sure we trim BOM and NBSP
                    var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                    String.prototype.trim = function() {
                        return this.replace(rtrim, '');
                    };
                })();
            }

            [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
                // in case the input is already filled..
                if( inputEl.value.trim() !== '' ) {
                    classie.add( inputEl.parentNode, 'input--filled' );
                }

                // events:
                inputEl.addEventListener( 'focus', onInputFocus );
                inputEl.addEventListener( 'blur', onInputBlur );
            } );

            function onInputFocus( ev ) {
                classie.add( ev.target.parentNode, 'input--filled' );
            }

            function onInputBlur( ev ) {
                if( ev.target.value.trim() === '' ) {
                    classie.remove( ev.target.parentNode, 'input--filled' );
                }
            }
        })();

        $(function() {
            $('#login #login-password').focus(function() {
                $('.login-owl').addClass('password');
            }).blur(function() {
                $('.login-owl').removeClass('password');
            });
            $('#login #register-password').focus(function() {
                $('.register-owl').addClass('password');
            }).blur(function() {
                $('.register-owl').removeClass('password');
            });
            $('#login #register-repassword').focus(function() {
                $('.register-owl').addClass('password');
            }).blur(function() {
                $('.register-owl').removeClass('password');
            });
            $('#login #forget-password').focus(function() {
                $('.forget-owl').addClass('password');
            }).blur(function() {
                $('.forget-owl').removeClass('password');
            });
        });

        function goto_register(){
            $("#register-username").val("");
            $("#register-password").val("");
            $("#register-repassword").val("");
            $("#register-code").val("");
            $("#tab-2").prop("checked",true);
        }

        function goto_login(){
            $("#login-username").val("");
            $("#login-password").val("");
            $("#tab-1").prop("checked",true);
        }

        function goto_forget(){
            $("#forget-username").val("");
            $("#forget-password").val("");
            $("#forget-code").val("");
            $("#tab-3").prop("checked",true);
        }

        function login(){//登录
            var username = $("#login-username").val(),
                password = $("#login-password").val(),
                validatecode = null,
                flag = false;
            //判断用户名密码是否为空
            if(username == ""){
                $.pt({
                    target: $("#login-username"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"用户名不能为空"
                });
                return false;
            }
            if(password == ""){
                $.pt({
                    target: $("#login-password"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"密码不能为空"
                });
                return false;
            }
            //用户名只能是15位以下的字母或数字
            var regExp = new RegExp("^[a-zA-Z0-9_]{1,15}$");
            if(!regExp.test(username)){
                $.pt({
                    target: $("#login-username"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"用户名必须为15位以下的字母或数字"
                });
                return false;
            }
            var cont = $("input").serialize();
            var wen2=false;
            $.ajax({
                url: 'check/checkLogin.php',
                type: 'post',
                dataType: 'json',
                data: {"login-username":username,"login-password":password},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="false"){

                        $.ajax({
                            url: 'check/checkLoginman.php',
                            type: 'post',
                            dataType: 'json',
                            data: {"login-username":username,"login-password":password},
                            success: function (data) {
                                wen2=data.kind2;
                                if(wen2=="false"){
                                    alert("登录失败请检查用户名和密码");
                                    flag = true;
                                    return false;
                                }
                                else
                                {
                                    alert('管理员登录成功');
                                    location="admin/indexman/indexman.php";
                                    return false;
                                }
                            }});

                        flag = true;
                        return false;
                    }
                    else
                    {
                        alert('用户登录成功');
                        location="admin/index/index.php";
                        return false;
                    }
                }});

        }

        //注册
        function register(){
            var username = $("#register-username").val(),
                password = $("#register-password").val(),
                repassword = $("#register-repassword").val(),
                code = $("#register-code").val(),
                flag = false,
                validatecode = null;
            //判断用户名密码是否为空
            if(username == ""){
                $.pt({
                    target: $("#register-username"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"用户名不能为空"
                });
                return false;
            }
            if(password == ""){
                $.pt({
                    target: $("#register-password"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"密码不能为空"
                });
                return false;
            }else{
                if(password != repassword){
                    $.pt({
                        target: $("#register-repassword"),
                        position: 'r',
                        align: 't',
                        width: 'auto',
                        height: 'auto',
                        content:"两次输入的密码不一致"
                    });
                    return false;
                }
            }
            //用户名只能是15位以下的字母或数字
            var regExp = new RegExp("^[a-zA-Z0-9_]{1,15}$");
            if(!regExp.test(username)){
                $.pt({
                    target: $("#register-username"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"用户名必须为15位以下的字母或数字"
                });
                return false;
            }
            //检查用户名是否已经存在
            //调后台代码检查用户名是否已经被注册

            //检查注册码是否正确
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if(!myreg.test($("#register-code").val()))
            {
                $.pt({
                    target: $("#register-code"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"手机号格式不正确"
                });
                return false;
            }
            //检查用户名是否注册过了
            var cont = $("input").serialize();
            var wen2=false;
            $.ajax({
                url: 'check/checkRegisterUsername.php',
                type: 'post',
                dataType: 'json',
                data: {"register-username":username},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="true"){
                        $.pt({
                            target: $("#register-username"),
                            position: 'r',
                            align: 't',
                            width: 'auto',
                            height: 'auto',
                            content:"用户名已经被注册了"
                        });
                        var txt1=document.getElementById("register-username");
                        txt1.value="";
                        txt1.focus();
                        flag = true;
                        return false;
                    }
                    else {
                        //检查手机号是否注册过了
                        // cont = $("input").serialize();
                        wen2=false;
                        $.ajax({
                            url: 'check/checkRegisterPhone.php',
                            type: 'post',
                            dataType: 'json',
                            data: {"register-code":code},
                            success: function (data) {
                                wen2=data.kind2;
                                if(wen2=="true"){
                                    $.pt({
                                        target: $("#register-code"),
                                        position: 'r',
                                        align: 't',
                                        width: 'auto',
                                        height: 'auto',
                                        content:"手机号已经被注册了"
                                    });
                                    var txt1=document.getElementById("register-code");
                                    txt1.value="";
                                    txt1.focus();
                                    flag = true;
                                    return false;
                                }
                                else {
                                    //注册
                                    //存入数据库
                                    var wen1=false;
                                    $.ajax({
                                        url: 'add/addUser.php',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {"register-password":password,"register-username":username,"register-code":code},
                                        success: function (data) {
                                            var wen1=data.kind1;
                                            if(wen1=="false")
                                            {
                                                alert("存入数据库失败");
                                                flag = true;
                                                return false;
                                            }
                                        }});

                                    if(!flag)
                                    {
                                        spop({
                                            template: '<h4 class="spop-title">注册成功</h4>即将于3秒后返回登录',
                                            position: 'top-center',
                                            style: 'success',
                                            autoclose: 3000,
                                            onOpen : function(){
                                                var second = 2;
                                                var showPop = setInterval(function(){
                                                    if(second == 0){
                                                        clearInterval(showPop);
                                                    }
                                                    $('.spop-body').html('<h4 class="spop-title">注册成功</h4>即将于'+second+'秒后返回登录');
                                                    second--;
                                                },1000);
                                            },
                                            onClose : function(){
                                                goto_login();
                                            }
                                        });
                                        return false;
                                    }
                                    return false;


                                }
                            }});

                    }
                }});

        }

        //重置密码
        function forget(){
            var username = $("#forget-username").val(),
                password = $("#forget-password").val(),
                code = $("#forget-code").val(),
                flag = false,
                validatecode = null;
            //判断用户名密码是否为空
            if(username == ""){
                $.pt({
                    target: $("#forget-username"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"用户名不能为空"
                });
                return false;
            }
            if(password == ""){
                $.pt({
                    target: $("#forget-password"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"密码不能为空"
                });
                return false;
            }
            //用户名只能是15位以下的字母或数字
            var regExp = new RegExp("^[a-zA-Z0-9_]{1,15}$");
            if(!regExp.test(username)){
                $.pt({
                    target: $("#forget-username"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"用户名必须为15位以下的字母或数字"
                });
                return false;
            }

            //检查手机号是否正确
            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if(!myreg.test($("#forget-code").val()))
            {
                $.pt({
                    target: $("#forget-code"),
                    position: 'r',
                    align: 't',
                    width: 'auto',
                    height: 'auto',
                    content:"手机号格式不正确"
                });
                return false;
            }
            //检查用户名和手机号是否存在
            //调后台方法
            var cont = $("input").serialize();
            var wen2=false;
            $.ajax({
                url: 'check/checkForgetUsername.php',
                type: 'post',
                dataType: 'json',
                data: {"forget-username":username},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="false"){
                        $.pt({
                            target: $("#forget-username"),
                            position: 'r',
                            align: 't',
                            width: 'auto',
                            height: 'auto',
                            content:"用户名不存在"
                        });
                        var txt1=document.getElementById("forget-username");
                        txt1.value="";
                        txt1.focus();
                        return false;
                    }
                    else {
                        $.ajax({
                            url: 'check/checkForgetPhone.php',
                            type: 'post',
                            dataType: 'json',
                            data: {"forget-code":code},
                            success: function (data) {
                                wen2=data.kind2;
                                if(wen2=="false"){
                                    $.pt({
                                        target: $("#forget-code"),
                                        position: 'r',
                                        align: 't',
                                        width: 'auto',
                                        height: 'auto',
                                        content:"手机号不存在"
                                    });
                                    var txt1=document.getElementById("forget-code");
                                    txt1.value="";
                                    txt1.focus();
                                    return false;
                                }
                                else
                                {

                                    //重置密码

                                    $.ajax({
                                        url: 'updata/updataPassword.php',
                                        type: 'post',
                                        dataType: 'json',
                                        data: {"forget-username":username,"forget-password":password,"forget-code":code},
                                        success: function (data) {
                                            wen2=data.kind2;
                                            if(wen2=="false"){
                                                alert("重置密码失败:数据库错误");
                                                return false;
                                            }
                                            else
                                            {
                                                spop({
                                                    template: '<h4 class="spop-title">重置密码成功</h4>即将于3秒后返回登录',
                                                    position: 'top-center',
                                                    style: 'success',
                                                    autoclose: 3000,
                                                    onOpen : function(){
                                                        var second = 2;
                                                        var showPop = setInterval(function(){
                                                            if(second == 0){
                                                                clearInterval(showPop);
                                                            }
                                                            $('.spop-body').html('<h4 class="spop-title">重置密码成功</h4>即将于'+second+'秒后返回登录');
                                                            second--;
                                                        },1000);
                                                    },
                                                    onClose : function(){
                                                        goto_login();
                                                    }
                                                });
                                                return false;
                                            }
                                        }});

                                    return false;

                                }
                            }});
                    }
                }});


        }







    </script>
    <style type="text/css">
        html{width: 100%; height: 100%;}

        body{

            background-repeat: no-repeat;

            background-position: center center #2D0F0F;

            background-color: #00BDDC;

            background-image: url(images/snow.jpg);

            background-size: 100% 100%;

        }

        .snow-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 100001; }

    </style>
</head>
<body>
<!-- 雪花背景 -->
<div class="snow-container"></div>
<!-- 登录控件 -->
<div id="login">
    <input id="tab-1" type="radio" name="tab" class="sign-in hidden" checked />
    <input id="tab-2" type="radio" name="tab" class="sign-up hidden" />
    <input id="tab-3" type="radio" name="tab" class="sign-out hidden" />
    <div class="wrapper">
        <!-- 登录页面 -->
        <div class="login sign-in-htm">
            <form class="container offset1 loginform">
                <!-- 猫头鹰控件 -->
                <div id="owl-login" class="login-owl">
                    <div class="hand"></div>
                    <div class="hand hand-r"></div>
                    <div class="arms">
                        <div class="arm"></div>
                        <div class="arm arm-r"></div>
                    </div>
                </div>
                <div class="pad input-container">
                    <section class="content">
							<span class="input input--hideo">
								<input class="input__field input__field--hideo" type="text" id="login-username"
                                       autocomplete="off" placeholder="请输入用户名" tabindex="1" maxlength="15" />
								<label class="input__label input__label--hideo" for="login-username">
									<i class="fa fa-fw fa-user icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                        <span class="input input--hideo">
								<input class="input__field input__field--hideo" type="password" id="login-password" placeholder="请输入密码" tabindex="2" maxlength="15"/>
								<label class="input__label input__label--hideo" for="login-password">
									<i class="fa fa-fw fa-lock icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                    </section>
                </div>
                <div class="form-actions">
                    <a tabindex="4" class="btn pull-left btn-link text-muted" onClick="goto_forget()">忘记密码?</a>
                    <a tabindex="5" class="btn btn-link text-muted" onClick="goto_register()">注册</a>
                    <input class="btn btn-primary" type="button" tabindex="3" onClick="login()" value="登录"
                           style="color:white;"/>
                </div>
            </form>
        </div>
        <!-- 忘记密码页面 -->
        <div class="login sign-out-htm">
            <form action="#" method="post" class="container offset1 loginform">
                <!-- 猫头鹰控件 -->
                <div id="owl-login" class="forget-owl">
                    <div class="hand"></div>
                    <div class="hand hand-r"></div>
                    <div class="arms">
                        <div class="arm"></div>
                        <div class="arm arm-r"></div>
                    </div>
                </div>
                <div class="pad input-container">
                    <section class="content">
							<span class="input input--hideo">
								<input class="input__field input__field--hideo" type="text" id="forget-username" autocomplete="off" placeholder="请输入用户名"/>
								<label class="input__label input__label--hideo" for="forget-username">
									<i class="fa fa-fw fa-user icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                        <span class="input input--hideo">
								<input class="input__field input__field--hideo" type="text" id="forget-code" autocomplete="off" placeholder="请输入手机号"/>
								<label class="input__label input__label--hideo" for="forget-code">
									<i class="fa fa-fw fa-wifi icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                        <span class="input input--hideo">
								<input class="input__field input__field--hideo" type="password" id="forget-password" placeholder="请重置密码" />
								<label class="input__label input__label--hideo" for="forget-password">
									<i class="fa fa-fw fa-lock icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                    </section>
                </div>
                <div class="form-actions">
                    <a class="btn pull-left btn-link text-muted" onClick="goto_login()">返回登录</a>
                    <input class="btn btn-primary" type="button" onClick="forget()" value="重置密码"
                           style="color:white;"/>
                </div>
            </form>
        </div>
        <!-- 注册页面 -->
        <div class="login sign-up-htm">
            <form action="#" method="post" class="container offset1 loginform">
                <!-- 猫头鹰控件 -->
                <div id="owl-login" class="register-owl">
                    <div class="hand"></div>
                    <div class="hand hand-r"></div>
                    <div class="arms">
                        <div class="arm"></div>
                        <div class="arm arm-r"></div>
                    </div>
                </div>
                <div class="pad input-container">
                    <section class="content">
							<span class="input input--hideo">
								<input class="input__field input__field--hideo" type="text" id="register-username"
                                       autocomplete="off" placeholder="请输入用户名" maxlength="15"/>
								<label class="input__label input__label--hideo" for="register-username">
									<i class="fa fa-fw fa-user icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                        <span class="input input--hideo">
								<input class="input__field input__field--hideo" type="password" id="register-password" placeholder="请输入密码" maxlength="15"/>
								<label class="input__label input__label--hideo" for="register-password">
									<i class="fa fa-fw fa-lock icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                        <span class="input input--hideo">
								<input class="input__field input__field--hideo" type="password" id="register-repassword" placeholder="请确认密码" maxlength="15"/>
								<label class="input__label input__label--hideo" for="register-repassword">
									<i class="fa fa-fw fa-lock icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                        <span class="input input--hideo">
								<input class="input__field input__field--hideo" type="text" id="register-code" autocomplete="off" placeholder="请输入手机号"/>
								<label class="input__label input__label--hideo" for="register-code">
									<i class="fa fa-fw fa-wifi icon icon--hideo"></i>
									<span class="input__label-content input__label-content--hideo"></span>
								</label>
							</span>
                    </section>
                </div>
                <div class="form-actions">
                    <a class="btn pull-left btn-link text-muted" onClick="goto_login()">返回登录</a>
                    <input class="btn btn-primary" type="button" onClick="register()" value="注册"
                           style="color:white;"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div style="text-align:center;">
    <!--<p>更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a></p>-->
</div>
</body>
</html>