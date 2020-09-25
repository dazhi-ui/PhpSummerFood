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
                    <th width="80px">产品编号</th>
                    <th width="180px">产品图片</th>
                    <th width="200px">产品名称</th>
                    <th width="90px">现价</th>
                    <th width="90px">原价</th>
                    <th width="80px">剩余数量</th>
                    <th width="100px">零食类别</th>
                    <th width="90px">检验结果</th>
                    <th width="140px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once("../../conn/conData.php");

                $sqlstr2 = "select * from food where kind='".$_GET['kind']."'order by id asc";
                $result2 = mysqli_query($register,$sqlstr2);
                while ($rows = mysqli_fetch_row($result2)){
                    echo "<tr>";
                    echo "<td width=\"25px\"><label><input type=\"checkbox\" class=\"ace\" ><span class=\"lbl\"></span></label></td>";
                    echo " <td width=\"80px\">".$rows[0]."</td>";
                    echo "<td width=\"180px\"><img width='180px' height='100px' src='".$rows[5]."'></td>";
                    echo "<td width=\"200px\"><u style=\"cursor:pointer\" class=\"text-primary\">".$rows[1]."</u></td>";
                    echo "<td width=\"90px\">".$rows[2]."</td>";
                    echo "<td width=\"90px\">".$rows[3]."</td>";
                    echo "<td width=\"80px\">".$rows[4]."</td>";
                    echo "<td width=\"100px\">".$rows[6]."</td>";
                    echo "<td class=\"td-status\"width=\"90px\"><span class=\"label label-success radius\">安检成功通过</span></td>";
                    echo "<td class=\"td-manage\" width=\"140px\">";
                    echo "<a title=\"编辑\"  href=\"updataFoodMessage.php?id=$rows[0]\"  class=\"btn btn-xs btn-info\" ><i class=\"icon-edit bigger-120\"></i></a>";
                    echo "<a title=\"删除\" href=\"javascript:;\"  onclick=\"member_del(this,'1','$rows[0]')\" class=\"btn btn-xs btn-warning\" ><i class=\"icon-trash  bigger-120\"></i></a>";
                    echo "</td></tr>";
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
    function member_del(obj,id,prodid){
        layer.confirm('确认要删除吗？',function(index){
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
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }

</script>
