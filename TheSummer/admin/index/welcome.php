<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="renderer" content="webkit">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>食品购买系统</title>
		<link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css"/>
		<link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css"/>
        <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.SuperSlide.2.1.1.js"></script>
	</head>
	<body>
    <?php
    session_start();
    $username=$_SESSION['val'];
    ?>
    <style type="text/css">
        /* css 重置 */
        *{margin:0; padding:0; list-style:none; }
        body{ background:#fff; font:normal 12px/22px 宋体;  }
        img{ border:0;  }
        a{ text-decoration:none; color:#333;  }
        /* 本例子css */
        .picScroll-left{ width:1200px;  overflow:hidden; position:relative;  border:1px solid #ccc; height: 280px; margin: auto auto; top: 30px;}
        .picScroll-left .hd{ overflow:hidden;  height:30px; background:#f4f4f4; padding:0 10px;  }
        .picScroll-left .hd .prev,.picScroll-left .hd .next{ display:block;  width:5px; height:9px; float:right; margin-right:5px; margin-top:10px;  overflow:hidden;
            cursor:pointer; background:url("images/arrow.png") no-repeat;}
        .picScroll-left .hd .next{ background-position:0 -50px;  }
        .picScroll-left .hd .prevStop{ background-position:-60px 0; }
        .picScroll-left .hd .nextStop{ background-position:-60px -50px; }
        .picScroll-left .hd ul{ float:right; overflow:hidden; zoom:1; margin-top:10px; zoom:1; }
        .picScroll-left .hd ul li{ float:left;  width:9px; height:9px; overflow:hidden; margin-right:5px; text-indent:-999px; cursor:pointer; background:url("images/icoCircle.gif") 0 -9px no-repeat; }
        .picScroll-left .hd ul li.on{ background-position:0 0; }
        .picScroll-left .hd img {margin-top: 5px;}
        .picScroll-left .bd{ padding:10px;}
        .picScroll-left .bd ul{ overflow:hidden; zoom:1; }
        .picScroll-left .bd ul li{ margin:0 8px; float:left; _display:inline; overflow:hidden; text-align:center;  }
        .picScroll-left .bd ul li .pic{ text-align:center; }
        .picScroll-left .bd ul li .pic img{ width:272px; height:180px; display:block;  padding:2px; border:1px solid #ccc; }
        .picScroll-left .bd ul li .pic a:hover img{ border-color:#999;  }
        .picScroll-left .bd ul li .title{ line-height:24px; text-align: left; font-size: 14px; font-family: "微软雅黑"; text-indent: 5px;}
        .picScroll-left .bd ul li .title p {color:#bf283e;}
    </style>
<!--    展示图片滚轮-->
    <div class="picScroll-left" style="margin-bottom: 40px;">
        <div class="hd">
            <a class="next"></a>
            <ul></ul>
            <span class="pageState"></span>
            <a class="prev"></a>
        </div>
        <div class="bd">
            <ul class="picList">
                <?php
                $wen=1;
                include_once("../../conn/conData.php");
                $sql = "select * from food  order by id";
                $result = mysqli_query($register, $sql);
                while($wen<=6&&$rows = mysqli_fetch_row($result))
                {
                    echo "<li>
                    <div class=\"pic\"><a href=\"\" target=\"_blank\"><img src=\"$rows[5]\" /></a></div>
                    <div class=\"title\"><a href=\"\" target=\"_blank\">$rows[1]</a><p>￥$rows[2]</p></div>
                    </li>";
                    $wen=$wen+1;
                }
                ?>


            </ul>
        </div>
    </div>



<!--    显示数据-->
		<div class="wrap-container welcome-container" style="margin-left: 190px;margin-top: 40px">
			<div class="row">
				<div class="welcome-left-container col-lg-9">
					<div class="data-show">
						<ul class="clearfix">
							<li class="col-sm-12 col-md-4 col-xs-12">
								<a href="javascript:;" class="clearfix">
									<div class="icon-bg bg-org f-l" style="background-color: white">
                                        <img src="images/p1.png">
									</div>
									<div class="right-text-con">
										<p class="name">总的使用人数</p>
										<p><span class="color-org">
                                                <?php
                                                   include_once("../../conn/conData.php");
                                                  $sql1 = "select  COUNT(*) from user";
                                                  $result1 = mysqli_query($register, $sql1);
                                                list($num_rows) = mysqli_fetch_row($result1);
                                                  echo $num_rows;
                                                   ?>
                                            </span>数据<span class="iconfont">&#xe628;</span></p>
									</div>
								</a>
							</li>
							<li class="col-sm-12 col-md-4 col-xs-12">
								<a href="javascript:;" class="clearfix">
                                    <div class="icon-bg bg-org f-l" style="background-color: white">
                                        <img src="images/p2.png">
                                    </div>
									<div class="right-text-con">
										<p class="name">商品总数量</p>
										<p><span class="color-blue">
                                                <?php
                                                include_once("../../conn/conData.php");
                                                $sql1 = "select  COUNT(*) from food";
                                                $result1 = mysqli_query($register, $sql1);
                                                list($num_rows) = mysqli_fetch_row($result1);
                                                echo $num_rows;
                                                ?>
                                            </span>数据<span class="iconfont">&#xe628;</span></p>
									</div>
								</a>
							</li>
							<li class="col-sm-12 col-md-4 col-xs-12">
								<a href="javascript:;" class="clearfix">
                                    <div class="icon-bg bg-org f-l" style="background-color: white">
                                        <img src="images/p3.png">
                                    </div>
									<div class="right-text-con">
										<p class="name">所有用户购买商品数量</p>
										<p><span class="color-green">
                                                <?php
                                                include_once("../../conn/conData.php");
                                                $sql1 = "select  COUNT(*) from foodorder";
                                                $result1 = mysqli_query($register, $sql1);
                                                list($num_rows) = mysqli_fetch_row($result1);
                                                echo $num_rows;
                                                ?>
                                            </span>数据<span class="iconfont">&#xe60f;</span></p>
									</div>
								</a>
							</li>
						</ul>
					</div>
                    <h1 style="color: powderblue;text-align: center;font-size: 50px;margin-top: 40px"> 欢迎用户·
                        <?php echo $username;
                        //直接输出全局变量val.?> ·来到此页面</h1>
                    <h1 style="color: powderblue;text-align: center;font-size: 50px;margin-top: 40px">欢迎来到食品购买平台</h1>
                    <script type="text/javascript">
                        jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:4,trigger:"mouseover"});
                    </script>
	</body>
</html>
