<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>vue购物车商品累加结算代码  </title>

    <!--css类引用-->
    <link rel="stylesheet" href="../../js/layui/css/layui.css" />
    <link rel="stylesheet" href="../../js/eleme-ui/index.css" />
    <link rel="stylesheet" href="../../css/ShoppingCart.css" />
    <script src="../../js/jquery.min.js"></script>

</head>
<body>
<?php
session_start();
$username=$_SESSION['val'];
include_once("../../conn/conData.php");
$sqlstr2 = "select * from shopping where username='".$username."'order by id";
$result2 = mysqli_query($register,$sqlstr2);
?>
<!--主要内容-->
<div class="row " id="myVue" v-cloak>
    <div class="col-lg-10 col-lg-offset-1" >
        <div class="layui-form">
            <table class="ShopCartTable layui-table">
                <thead>
                <tr>
                    <th class="selectLeft">
                        <template>
                            <el-checkbox  @change="checkedAllBtn(checkedAll)" v-model="checkedAll">全选</el-checkbox>
                        </template>
                        <span class="selectLeftGoods" style="color: blue">商品名称</span>
                    </th>
                    <th style="color: blue">商品单价</th>
                    <th style="color: blue">商品数量</th>
                    <th style="color: blue">总价（+运费）</th>
                    <th style="color: blue">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(tabledatas,index) in shopTableDatas">
                    <td  class="selectLeft">
                        <template>
                            <el-checkbox @change="checkedRadioBtn(tabledatas)" v-model="tabledatas.checked"></el-checkbox>
                        </template>
                        <span class="goodName">
								<img class="goodImg" :src="tabledatas.src" />
							</span>
                        <span class="goodName goodsName">
								<h2 class="goodname" v-text="tabledatas.name"></h2>
                               <p class="goodGary" >
									<span>购物id：</span>
									<span v-text="tabledatas.ConPlace"></span>
								</p>
                               <p class="goodGary">
									<span>库存量：</span>
									<span v-text="tabledatas.supplier"></span>
								</p>
                               <p class="goodGary" style="color: magenta">
									<span>商品运费：10元</span>
								</p>
							</span>
                    </td>
                    <td class="danPrice">{{tabledatas.price | moneyFiler}}</td>
                    <td>
                        <i @click="goodNum(tabledatas,-1)" class="fa  deleteBtn" aria-hidden="true">-</i>
                        <input v-model="tabledatas.num" type="text" class="form-control numInput" aria-label="...">
                        <i @click="goodNum(tabledatas,1)" class="fa  addBtn" aria-hidden="true">+</i>
                    </td>
                    <td>
                        <p class="totalPrice">{{tabledatas.price*tabledatas.num+10 | moneyFiler}}</p>
                    </td>
                    <td class="gongneng">
                        <p class="deletegoods" @click="alertRadio(index)" style="color: red">删除</p>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="row tablefooter">
                <template>
                    <el-checkbox style="padding-left:16px" @change="checkedAllBtn(checkedAll)" v-model="checkedAll">全选</el-checkbox>
                </template>
                <span class="removeMuch" @click="alertMuch" style="color: red">删除选中的商品</span>
                <span class="servicenum" style="color: #00a0e9">已选择<span class="goodsNum">{{goodsNum}}</span>种类别的商品</span>
                <span class="totalclassPoin">总价：<span class="totalMoneyClass">{{totalMoney | moneyFiler}}</span></span>
                <span @click="saveData" class="SettlementBtn">去结算</span>
            </div>
        </div>
    </div>
</div>
<!--js类引用-->
<script type="text/javascript" src="../../js/vue/vue.min.js" ></script>
<script type="text/javascript" src="../../js/eleme-ui/index.js" ></script>


<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
</div>
<script>
    /*模拟数据*/
    var shopCartdatas = {
        shopcartdatas:[
            <?php
            while ($rows = mysqli_fetch_row($result2)) {
                 $sqlstr33 = "select * from food where id='".$rows[2]."'order by id";
                 $result3 = mysqli_query($register,$sqlstr33);
                $rows3 = mysqli_fetch_row($result3);
                echo " {
                \"checked\":false,
                \"src\":\"$rows3[5]\",
                \"name\":\"$rows3[1]\",
                \"supplier\":\"$rows3[4]\",
                \"ConPlace\":\"$rows[0]\",
                \"id\":\"$rows[0]\",
                \"prodid\":\"$rows3[0]\",
                \"price\":$rows3[2],
                \"num\":1,
                \"saveandremove\":true,
                \"type\":\"商品\",
            },";
            }
            ?>
        ]
    }
    var addressdatas = {
        addressdata:[
            {
                "name":"吴浩然1",
                "city":"北京市",
                "area":"丰台区",
                "minarea":"嘉园一里9号楼404",
            },
            {
                "name":"吴浩然2",
                "city":"北京市",
                "area":"丰台区",
                "minarea":"嘉园一里9号楼404",
            },
            {
                "name":"吴浩然3",
                "city":"北京市",
                "area":"丰台区",
                "minarea":"嘉园一里9号楼404",
            },
            {
                "name":"吴浩然4",
                "city":"北京市",
                "area":"丰台区",
                "minarea":"嘉园一里9号楼404",
            },
            {
                "name":"吴浩然5",
                "city":"北京市",
                "area":"丰台区",
                "minarea":"嘉园一里9号楼404",
            },
        ]
    }
    var payment = {
        paymentdata:[
            {
                "name":"货到付款",
            },
            {
                "name":"在线支付",
            },
            {
                "name":"银行汇款",
            },
        ]
    }
    var invoice = {
        invoicedata:[
            {
                "name":"不要发票",
            },
            {
                "name":"需要发票",
            },
        ]
    }
    var Coupon = {
        Coupondata:[
            {
                "price":500,
                "time":"2017-08-30",
                "type":"[ 店铺类 ]",
                "types":"[ 店铺类 ]",
            },
            {
                "price":100,
                "time":"2017-08-30",
                "type":"[ 店铺类 ]",
                "types":"[ 店铺类 ]",
            },
            {
                "price":200,
                "time":"2017-08-30",
                "type":"[ 店铺类 ]",
                "types":"[ 店铺类 ]",
            },
        ]
    }
    var deliverymode = {
        deliverymodeData:[
            {
                "type":"自提",
                "name":"选择自提时，请与卖家协商取货地址。",
            },
            {
                "type":"物流",
                "name":"由卖家发货。",
            },
        ]
    }

    var vm = new Vue({
        el: "#myVue",
        data: {
            /*数据源*/
            shopTableDatas:shopCartdatas.shopcartdatas,
            moreAddressData:addressdatas.addressdata,//地址数据
            paymentdatas:payment.paymentdata,//支付类型数据
            deliverymodedatas:deliverymode.deliverymodeData,//配送类型数据
            invoicedatas:invoice.invoicedata,//发票类型数据
            Coupondatas:Coupon.Coupondata,//优惠券数据
            userBuyData:[],//用户购买数据

            /*默认选择标签*/
            checkedAll:false, //全选状态
            limitNum:3,//默认显示几个地址
            currentIndex:1,//地址默认选择
            paymentIndex:1,//支付类型默认选择
            deliverymodeIndex:1,//配送类型默认选择
            invoiceIndex:1,//发票类型默认选择
            CouponIndex:-1,//优惠券默认选择
            stopDelete:"",//定时器id(用于清空定时器)
            activeName: '支付平台',

            /*关键字段初始化*/
            moreaddressName:"",//收货人姓名
            moreaddressCity:"",//收货人所在市
            moreaddressArea:"",//收货人所在区
            moreaddressMinarea:"",//收货人所在小区
            couponPrice:0,//优惠券默认金额
            goodNums:0,    //商品或者服务总数
            totalMoney:0, //总价格
            saveandremove:true,//收藏和取消收藏的状态
            goodsNum:0,//商品的数量
            serviceNum:0,//服务的数量

        },
        methods: {
            /*商品数量增加减少函数*/
            goodNum:function(item,way){
                if(way == 1){
                    item.num++;
                    vm.countTotalMoney()
                }else{
                    if(item.num < 2){
                        item.num =1;
                    }else{
                        item.num--;
                        vm.countTotalMoney()
                    }

                }
            },
            /*单选函数*/
            checkedRadioBtn:function(tabledatas){
                this.countTotalMoney()
                /*单选计算商品或服务数量*/
                if(tabledatas.type == "商品" && tabledatas.checked == true){
                    this.goodsNum += 1;
                }else if(tabledatas.type == "服务" && tabledatas.checked == true){
                    this.serviceNum += 1;
                }else if(tabledatas.type == "商品" && tabledatas.checked == false){
                    this.goodsNum -= 1;
                }else if(tabledatas.type == "服务" && tabledatas.checked == false){
                    this.serviceNum -= 1;
                }else{
                    console.log("未知错误！")
                }
            },
            /*全选函数*/
            checkedAllBtn:function(checkedAll){
                var _this= this;
                /*全选计算商品或服务数量*/
                if(checkedAll == true){
                    for(x in this.shopTableDatas){
                        this.shopTableDatas[x].checked = true;
                        if(this.shopTableDatas[x].type == "商品" ){
                            _this.goodsNum += 1;
                        }else if(this.shopTableDatas[x].type == "服务" ){
                            _this.serviceNum += 1;
                        }
                    }
                }else{
                    for(y in this.shopTableDatas){
                        this.shopTableDatas[y].checked = false;
                        this.goodsNum = 0;
                        this.serviceNum = 0;
                    }
                }
                vm.countTotalMoney();
            },
            /*删除单个选中函数*/
            deletegoods:function(index){
                var _this = this;
                console.log(index);
               // alert(this.shopTableDatas[index].price);
                var id=this.shopTableDatas[index].id;//shopping的id
                $.ajax({
                    url: '../../delete/deleteShopping.php',
                    type: 'post',
                    dataType: 'json',
                    data: {"id":id},
                    success: function (data) {
                        wen2=data.kind2;
                        if(wen2=="false"){
                            alert("购物车商品删除失败");
                            return false;
                        }
                        else
                        {
                            _this.shopTableDatas.splice(index, 1);
                            vm.countTotalMoney();
                        }
                    }});
            },
            /*删除多个选中函数*/
            deleteSelectAll:function(){
                var _this = this;
                var id;//shopping的id

                for(var i = this.shopTableDatas.length-1 ; i >= 0 ; i--){
                    if(this.shopTableDatas[i].checked  == true){
                      //  alert(this.shopTableDatas[i].price);
                        id=this.shopTableDatas[i].id;
                        this.shopTableDatas[i].checked=false;
                        this.goodsNum -= 1;
                        $.ajax({
                            url: '../../delete/deleteShopping.php',
                            type: 'post',
                            dataType: 'json',
                            data: {"id":id},
                            success: function (data) {
                                wen2=data.kind2;
                                if(wen2=="false"){
                                    alert("购物车商品删除失败");
                                    return false;
                                }
                                else
                                {
                                    _this.shopTableDatas.splice(i, 1);

                                }
                            }});
                    }
                }
                vm.countTotalMoney();
            },
            /*计算商品总价函数*/
            countTotalMoney:function(){
                var _this = this;
                _this.totalMoney = 0;
                this.shopTableDatas.forEach(function(item,index){
                    if(item.checked == true){
                        _this.totalMoney += item.num*item.price+10;
                    }
                })
            },
            /*保存购买数据*/
            saveData:function(){
                var _this = this;
                _this.userBuyData.length = 0;
                var address = prompt("请输入收货地址：");
                if(address==""||address==null)
                {
                    return false;
                }
                else
                {
                    var id,name,number;
                    this.shopTableDatas.forEach(function(item,index){
                       id=item.id;
                       name=item.name;
                       number=item.num;
                        if(item.checked == true){
                            $.ajax({
                                url: '../../add/addFoodOrderDeleteShopping.php',
                                type: 'post',
                                dataType: 'json',
                                data: {"id":id,"number":number,"address":address},
                                success: function (data) {
                                    wen2=data.kind2;
                                    if(wen2=="false"){
                                        alert("商品名称为—————"+name+"———购买失败，原因是购买数量超过库存量。请仔细查看本产品的库存量");
                                    }
                                    else
                                    {
                                        _this.shopTableDatas.splice(index, 1);
                                    }
                                }});
                        }
                    })
                    alert("购买成功的商品，自动移除购物车，详情请查看订单");
                    vm.countTotalMoney();
                }
            },

            /*提示删除单个商品*/
            alertRadio:function(index){
                this.$confirm('此操作将永久删除该商品, 是否继续?', '提示', {
                    confirmButtonText: '确定删除',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$message({
                        type: 'success',
                        message: '删除成功!',
                        callback : vm.deletegoods(index)
                    });
                }).catch(() => {
                    this.$message({
                        type: 'warning',
                        message: '已取消删除'
                    });
                });
            },
            /*提示多个删除函数*/
            alertMuch:function(){
                this.$confirm('此操作将永久删除已选择商品或服务, 是否继续?', '提示', {
                    confirmButtonText: '确定删除',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$message({
                        type: 'success',
                        message: '删除成功!',
                        callback : vm.deleteSelectAll()
                    });
                }).catch(() => {
                    this.$message({
                        type: 'warning',
                        message: '已取消删除'
                    });
                });
            },

            /*提示单个商品移动到收藏函数*/
            alertmovesSavegoods:function(index){
                this.$confirm('此操作将已选择商品或服务移到我的收藏, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$message({
                        type: 'success',
                        message: '收藏成功!',
                        callback : vm.movesSave(index)
                    });
                }).catch(() => {
                    this.$message({
                        type: 'success',
                        message: '收藏成功!',
                    });
                });
            },
            /*提示收藏多个商品函数*/
            alertMuchgoods:function(){
                this.$confirm('此操作将已选择商品或服务移到我的收藏, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$message({
                        type: 'success',
                        message: '收藏成功!',
                        callback : vm.saveSelectAll()
                    });
                }).catch(() => {
                    this.$message({
                        type: 'success',
                        message: '收藏成功!',
                    });
                });
            }
        },
        /*金额过滤器*/
        filters:{
            moneyFiler:function(value){

                return "￥"+value.toFixed(2);
            }
        },
        /*用于过滤缓存(用于过滤地址显示几个)*/
        computed:{
            filterAddress:function(){
                return this.moreAddressData.slice(0,this.limitNum)
            }
        },
    });


</script>
</body>
</html>