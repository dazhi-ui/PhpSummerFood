<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/style.css"/>
    <link rel="stylesheet" href="../../assets/css/ace.min.css" />
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../Widget/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
    <link href="../../Widget/icheck/icheck.css" rel="stylesheet" type="text/css" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="../../assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="../../assets/css/ace-ie.min.css" />
    <![endif]-->
    <script src="../../js/jquery-1.9.1.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/typeahead-bs2.min.js"></script>
    <!-- page specific plugin scripts -->
    <script src="../../assets/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="../../js/H-ui.js"></script>
    <script type="text/javascript" src="../../js/H-ui.admin.js"></script>
    <script src="../../assets/layer/layer.js" type="text/javascript" ></script>
    <script src="../../assets/laydate/laydate.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../Widget/zTree/js/jquery.ztree.all-3.5.min.js"></script>
    <script src="../../js/lrtk.js" type="text/javascript" ></script>
    <title>产品列表</title>
</head>
<body>
<div class=" page-content clearfix">
    <div id="products_style">
        <div class="table_menu_list" id="testIframe" >
            <table class="table table-striped table-bordered table-hover" id="sample-table">
                <thead>
                <tr>
                    <th width="25px"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
                    <th width="80px">用户名</th>
                    <th width="180px">产品图片</th>
                    <th width="200px">产品名称</th>
                    <th width="90px">总的交易金额</th>
                    <th width="90px">运输地址</th>
                    <th width="80px">物品数量</th>
                    <th width="100px">食品类别</th>
                    <th width="90px">通货状态</th>
                    <th width="140px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once("../../conn/conData.php");
                //查询该用户订单
                $kind=$_GET['kind'];
                $sqlstr2 = "select * from foodorder order by id asc";
                $result2 = mysqli_query($register,$sqlstr2);
                while ($rows = mysqli_fetch_row($result2)){
                    $sqlstr3 = "select * from food where id='".$rows[2]."'order by id asc";
                    $result3 = mysqli_query($register,$sqlstr3);
                    $rows3 = mysqli_fetch_row($result3);

                    $sqlstr4 = "select * from user where id='".$rows[1]."'order by id asc";
                    $result4 = mysqli_query($register,$sqlstr4);
                    $rows4 = mysqli_fetch_row($result4);

                    if($rows[6]=="已送达"&&$kind=="已送达")
                    {
                        echo "<tr>";
                        echo "<td width=\"25px\"><label><input type=\"checkbox\" class=\"ace\" ><span class=\"lbl\"></span></label></td>";
                        echo " <td width=\"80px\">".$rows4[1]."</td>";
                        echo "<td width=\"180px\"><img width='180px' height='100px' src='".$rows3[5]."'></td>";
                        echo "<td width=\"200px\"><u style=\"cursor:pointer\" class=\"text-primary\">".$rows3[1]."</u></td>";
                        echo "<td width=\"90px\">".$rows[4]."</td>";
                        echo "<td width=\"90px\">".$rows[3]."</td>";
                        echo "<td width=\"80px\">".$rows[5]."</td>";
                        echo "<td width=\"100px\">".$rows3[6]."</td>";
                        echo "<td class=\"td-status\"width=\"90px\"><span style='background-color: magenta' class=\"btn btn-xs btn-warning\" >".$rows[6]."</span></td>";
                        echo "<td class=\"td-manage\" width=\"140px\">";
                        echo "<a title=\"删除\" href=\"javascript:;\"  onclick=\"member_del(this,'1','$rows[0]')\" class=\"btn btn-xs btn-warning\" ><i class=\"icon-trash  bigger-120\"></i></a>";
                        echo "</td></tr>";

                    }
                    else if($rows[6]=="未发货"&&$kind=="未发货")
                    {
                        echo "<tr>";
                        echo "<td width=\"25px\"><label><input type=\"checkbox\" class=\"ace\" ><span class=\"lbl\"></span></label></td>";
                        echo " <td width=\"80px\">".$rows4[1]."</td>";
                        echo "<td width=\"180px\"><img width='180px' height='100px' src='".$rows3[5]."'></td>";
                        echo "<td width=\"200px\"><u style=\"cursor:pointer\" class=\"text-primary\">".$rows3[1]."</u></td>";
                        echo "<td width=\"90px\">".$rows[4]."</td>";
                        echo "<td width=\"90px\">".$rows[3]."</td>";
                        echo "<td width=\"80px\">".$rows[5]."</td>";
                        echo "<td width=\"100px\">".$rows3[6]."</td>";
                        echo "<td class=\"td-status\"width=\"90px\"><span style='background-color: magenta' class=\"btn btn-xs btn-danger\" >".$rows[6]."</span></td>";
                        echo "<td class=\"td-manage\" width=\"140px\">";
                        echo "<a title=\"进行发货\" href=\"javascript:;\"  onclick=\"member_del1(this,'1','$rows[0]')\" class=\"btn btn-xs btn-warning\" ><i class=\"icon-edit bigger-120\">发货</i></a>";
                        echo "</td></tr>";

                    }
                    else if($rows[6]=="运输中"&&$kind=="运输中")
                    {
                        echo "<tr>";
                        echo "<td width=\"25px\"><label><input type=\"checkbox\" class=\"ace\" ><span class=\"lbl\"></span></label></td>";
                        echo " <td width=\"80px\">".$rows4[1]."</td>";
                        echo "<td width=\"180px\"><img width='180px' height='100px' src='".$rows3[5]."'></td>";
                        echo "<td width=\"200px\"><u style=\"cursor:pointer\" class=\"text-primary\">".$rows3[1]."</u></td>";
                        echo "<td width=\"90px\">".$rows[4]."</td>";
                        echo "<td width=\"90px\">".$rows[3]."</td>";
                        echo "<td width=\"80px\">".$rows[5]."</td>";
                        echo "<td width=\"100px\">".$rows3[6]."</td>";
                        echo "<td class=\"td-status\"width=\"90px\"><span style='background-color: magenta' class=\"btn btn-xs btn-success\" >".$rows[6]."</span></td>";
                        echo "<td class=\"td-manage\" width=\"140px\">";
                        echo "<a title=\"已送达\" href=\"javascript:;\"  onclick=\"member_del2(this,'1','$rows[0]')\" class=\"btn btn-xs btn-warning\" ><i class=\"icon-edit bigger-120\">签收</i></a>";
                        echo "</td></tr>";

                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
</html>
<script>
    jQuery(function($) {
        var oTable1 = $('#sample-table').dataTable( {
            "aaSorting": [[ 1, "desc" ]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                {"orderable":false,"aTargets":[0,2,3,4,5,8,9]}// 制定列不参与排序
            ] } );


        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
    });
    laydate({
        elem: '#start',
        event: 'focus'
    });
    $(function() {
        $("#products_style").fix({
            float : 'left',
            //minStatue : true,
            skin : 'green',
            durationTime :false,
            spacingw:30,//设置隐藏时的距离
            spacingh:260,//设置显示时间距
        });
    });
</script>
<script type="text/javascript">
    //初始化宽度、高度
    $(".widget-box").height($(window).height()-215);
    $(".table_menu_list").width($(window).width()-260);
    $(".table_menu_list").height($(window).height()-215);
    //当文档窗口发生改变时 触发
    $(window).resize(function(){
        $(".widget-box").height($(window).height()-215);
        $(".table_menu_list").width($(window).width()-260);
        $(".table_menu_list").height($(window).height()-215);
    })



    var code;

    function showCode(str) {
        if (!code) code = $("#code");
        code.empty();
        code.append("<li>"+str+"</li>");
    }

    $(document).ready(function(){
        var t = $("#treeDemo");
        t = $.fn.zTree.init(t, setting, zNodes);
        demoIframe = $("#testIframe");
        demoIframe.bind("load", loadReady);
        var zTree = $.fn.zTree.getZTreeObj("tree");
        zTree.selectNode(zTree.getNodeByParam("id",'11'));
    });
    /*产品-删除*/
    function member_del(obj,id,theid){
        layer.confirm('确认删除此接收订单吗？',function(index){
            //数据库删除操作
            $.ajax({
                url: '../../delete/deleteFoodOrder.php',
                type: 'post',
                dataType: 'json',
                data: {"id":theid},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="false"){
                        alert("订单删除失败，仍保留为已送达状态");
                        return false;
                    }
                }});
            $(obj).parents("tr").remove();
            layer.msg('订单已成功删除!',{icon:1,time:1000});
        });
    }

    function member_del1(obj,id,theid){
        var state="运输中";
        layer.confirm('确认对此订单进行发货处理吗？',function(index){
            //数据库删除操作
            $.ajax({
                url: '../../updata/updataFoodOrder.php',
                type: 'post',
                dataType: 'json',
                data: {"id":theid,"state":state},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="false"){
                        alert("商品发货失败，仍处于未发货状态");
                        return false;
                    }
                }});
            $(obj).parents("tr").remove();
            layer.msg('恭喜商品成功发货!',{icon:1,time:1000});
        });
    }

    function member_del2(obj,id,theid){
        var state="已送达";
        layer.confirm('确认签收此订单吗？',function(index){
            //数据库删除操作
            $.ajax({
                url: '../../updata/updataFoodOrder.php',
                type: 'post',
                dataType: 'json',
                data: {"id":theid,"state":state},
                success: function (data) {
                    wen2=data.kind2;
                    if(wen2=="false"){
                        alert("商品接收失败。仍处于运输状态");
                        return false;
                    }
                }});
            $(obj).parents("tr").remove();
            layer.msg('商品成功接收!详情查看已送达目录',{icon:1,time:1000});
        });
    }

</script>
