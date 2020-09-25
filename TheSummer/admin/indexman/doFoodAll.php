<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改图书信息</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="../../assets/layer/layer.js" type="text/javascript" ></script>
    <script src="../../assets/laydate/laydate.js" type="text/javascript"></script>
    <!-- style -->
    <link type="text/css" rel="stylesheet" href="../../css/style2.css">

    <!-- website behavior /public/ -->
    <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.isotope.js"></script>
    <script type="text/javascript" src="../../js/script.js"></script>

    <style type="text/css">
        .page{
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .page a, .page span{
            text-decoration: none;
            border: 1px solid #f9d52b;
            padding: 5px 7px;
            color: #767675;
            cursor: pointer;
        }
        .color{
            background-color: #00FFFF;
        }
        .page a:hover,.page:hover{
            color: red;
        }
        p{
            color: blue;
        }

    </style>
</head>
<body>
<?php
include_once("../../conn/conData.php");
?>
<table class="table table-hover table-striped table-bordered table-sm" id="resultshow">

    <?php
    $kind=$_GET['kind'];
    $sql = "select * from food  where kind='".$kind."' order by id";
    $result = mysqli_query($register, $sql);
    if($kind=="肉类零食"){
        echo"<div class=\"page\">
    <span>--</span>
    <a href=#>上一页</a>
    <a href=doFoodAll.php?kind=肉类零食 class='color'>肉类零食</a>
    <a href=doFoodAll.php?kind=素类零食 >素类零食</a>
    <a href=doFoodAll.php?kind=甘果类零食 >甘果类零食</a>
    <a href=doFoodAll.php?kind=素类零食 >下一页</a>
    <span>--</span>
    </div>";}
    else if($kind=="素类零食"){
        echo"<div class=\"page\">
    <span>--</span>
    <a href=doFoodAll.php?kind=肉类零食>上一页</a>
    <a href=doFoodAll.php?kind=肉类零食>故事书</a>
    <a href=doFoodAll.php?kind=素类零食 class='color'>素类零食</a>
    <a href=doFoodAll.php?kind=甘果类零食>甘果类零食</a>
    <a href=doFoodAll.php?kind=甘果类零食>下一页</a>
    <span>--</span>
    </div>";}
    else if($kind=="甘果类零食"){
        echo"<div class=\"page\">
    <span>--</span>
    <a href=doFoodAll.php?kind=素类零食>上一页</a>
    <a href=doFoodAll.php?kind=肉类零食>肉类零食</a>
    <a href=doFoodAll.php?kind=素类零食>素类零食</a>
    <a href=doFoodAll.php?kind=甘果类零食 class='color'>甘果类零食</a>
     <a href=#>下一页</a>
    <span>--</span>
    </div>";}
    echo "<div id=\"yhc_responsive\" class=\"main\" style='margin-top: 5px'>";
    echo " <div class=\"allProduct respl - header\">";
    echo "<ul class=\"ProductList respl-items\">";
    while ($rows = mysqli_fetch_row($result)) {
       echo "<li class=\"respl-item category-10\">";
       echo "<div class=\"unit\">";
       echo "<p class=\"hoverline\"></p>";
       echo "<a class=\"images\" href=\"\"><img src=" . $rows[5] . " height='300' width='270'></a>";
       echo "<h1><a href=\"\">" . $rows[1] . "</a></h1>";
       echo "<dl><dd>现在价格：" . $rows[2] . "&nbsp;人民币</dd><dd style='text-decoration:line-through'>原来价格：" . $rows[3] . "&nbsp;人民币</dd></dl>";
       echo "<div class=\"view\">";
       echo " <a class=\"right\" href=\"updataFoodMessage.php?id=$rows[0]\">修改<span>&gt;</span></a>";
       echo "<a class=\"right\" href=\"javascript:member_del('$rows[0]');\"  >删除<span>&gt;</span></a>";
       echo "</div></div></li>";

    }
    echo "</ul></div></div>";
    echo "<div class=\"loadMore\">";
    echo "<a href=\"javascript:;\">更多</a></div>";
    ?>
</table>
</body>
<script>
    //删除确认
    /*产品-删除*/
    function member_del(prodid){

        layer.confirm('确认要删除吗？',function(){
            //数据库删除操作
            $.ajax({
                url: '../../delete/deleteFood.php',
                type: 'post',
                dataType: 'json',
                data: {"id":prodid},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="false"){
                        alert("数据库删除失败");
                        return false;
                    }
                }});
            layer.msg('已删除!',{icon:1,time:1000});
            location="doFoodAll.php?kind=<?php echo $kind;?>";
        });
    }
</script>
</html>