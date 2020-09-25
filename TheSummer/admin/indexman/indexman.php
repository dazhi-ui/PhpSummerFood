<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>网站后台管理模版</title>
    <link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css"/>
</head>
<body>
<div class="main-layout" id='main-layout'>
    <!--侧边栏-->
    <div class="main-layout-side">
        <div class="m-logo">
        </div>
        <ul class="layui-nav layui-nav-tree" lay-filter="leftNav">
            <li class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;"><i class="iconfont">&#xe608;</i>食品管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" data-url="doFoodSomething.php?kind=肉类零食" data-id='3' data-text="肉类零食信息"><span class="l-line"></span>肉类零食信息</a></dd>
                    <dd><a href="javascript:;" data-url="doFoodSomething.php?kind=素类零食" data-id='9' data-text="素类零食信息"><span class="l-line"></span>素类零食信息</a></dd>
                    <dd><a href="javascript:;" data-url="doFoodSomething.php?kind=甘果类零食" data-id='7' data-text="甘果类零食信息"><span class="l-line"></span>甘果类零食信息</a></dd>
                    <dd><a href="javascript:;" data-url="doFoodAll.php?kind=肉类零食" data-id='8' data-text="全部零食信息"><span class="l-line"></span>全部零食信息</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;"  data-url="doUserAll.php" data-id='6' data-text="用户信息管理"><i class="iconfont">&#xe600;</i>用户信息管理</a>
            </li>
            <li class="layui-nav-item ">
                <a href="javascript:;"><i class="iconfont">&#xe607;</i>快递情况显示</a>
                <dl class="layui-nav-child">
                    <dd><a href="javascript:;" data-url="showFoodOrderOneman.php?kind=未发货" data-id='2' data-text="未发货商品"><span class="l-line"></span>未发货商品</a></dd>
                    <dd><a href="javascript:;" data-url="showFoodOrderOneman.php?kind=运输中" data-id='1' data-text="运输中商品"><span class="l-line"></span>运输中商品</a></dd>
                    <dd><a href="javascript:;" data-url="showFoodOrderOneman.php?kind=已送达" data-id='4' data-text="已送达商品"><span class="l-line"></span>已送达商品</a></dd>
                    <dd><a href="javascript:;" data-url="showFoodOrderAllman.php" data-id='10' data-text="全部商品"><span class="l-line"></span>全部商品</a></dd>
                </dl>
            </li>
            <!---->
            <!--            <li class="layui-nav-item">-->
            <!--                <a href="javascript:;"><i class="iconfont">&#xe604;</i>推荐位管理</a>-->
            <!--            </li>-->
            <!--            <li class="layui-nav-item">-->
            <!--                <a href="javascript:;"><i class="iconfont">&#xe60c;</i>友情链接</a>-->
            <!--            </li>-->
            <!--            <li class="layui-nav-item">-->
            <!--                <a href="javascript:;"><i class="iconfont">&#xe60a;</i>RBAC</a>-->
            <!--            </li>-->
            <!--            <li class="layui-nav-item">-->
            <!--                <a href="javascript:;" data-url="email.html" data-id='4' data-text="邮件系统"><i class="iconfont">&#xe603;</i>邮件系统</a>-->
            <!--            </li>-->
            <!--            <li class="layui-nav-item">-->
            <!--                <a href="javascript:;"><i class="iconfont">&#xe60d;</i>生成静态</a>-->
            <!--            </li>-->
            <!--            <li class="layui-nav-item">-->
            <!--                <a href="javascript:;"><i class="iconfont">&#xe600;</i>备份管理</a>-->
            <!--            </li>-->
            <li class="layui-nav-item">
                <a href="javascript:;" data-url="ownMessageman.php" data-id='5' data-text="个人信息"><i class="iconfont">&#xe606;</i>个人信息</a>
            </li>
        </ul>
    </div>
    <!--右侧内容-->
    <div class="main-layout-container">
        <!--头部-->
        <div class="main-layout-header">
            <div class="menu-btn" id="hideBtn">
                <a href="javascript:;">
                    <span class="iconfont">&#xe60e;</span>
                </a>
            </div>
            <ul class="layui-nav" lay-filter="rightNav">
                <li class="layui-nav-item"><a href="javascript:;" data-url="ownMessageman.php" data-id='5' data-text="个人信息"><i class="iconfont">&#xe606;</i></a></li>

                <li class="layui-nav-item"><a href="../../logregfor.php">退出</a></li>
            </ul>
        </div>
        <!--主体内容-->
        <div class="main-layout-body">
            <!--tab 切换-->
            <div class="layui-tab layui-tab-brief main-layout-tab" lay-filter="tab" lay-allowClose="true">
                <ul class="layui-tab-title">
                    <li class="layui-this welcome" data-url="welcome.php">后台主页</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show" style="background: #f5f5f5;">
                        <!--1-->
                        <iframe src="../index/welcome.php" width="100%" height="100%" name="iframe" scrolling="auto" class="iframe" framborder="0"></iframe>
                        <!--1end-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--遮罩-->
    <div class="main-mask">

    </div>
</div>
<script type="text/javascript">
    var scope={
        link:'./welcome.html'
    }
</script>
<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
<script src="../../static/admin/js/main.js" type="text/javascript" charset="utf-8"></script>

</body>
</html>