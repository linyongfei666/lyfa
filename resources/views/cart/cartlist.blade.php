@extends('layout.shop')
  @section('title','登录')
  @section('content') 
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="maincont">
<header>
<a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
<div class="head-mid">
<h1>购物车</h1>
</div>
</header>
<div class="head-top">
<img src="{{asset('images/head.jpg')}}" />
</div><!--head-top/-->
   <table class="shoucangtab">
   <tr>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;">
       <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
   </tr>
   </table>


   <div class="dingdanlist">
       <table>
           <tr>
               <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" id="allbox"/> 全选</a></td>
           </tr>
           @foreach($res as $v)
           <input type="hidden" name="_token" value="{{csrf_token()}}">
           <tr goods_num="{{$v->goods_num}}" goods_id="{{$v->goods_id}}">
               <td width="4%"><input type="checkbox" name="1" class="box"/></td>
               <td class="dingimg" width="15%"><img src="http://upload.com/{{$v->goods_img}}" /></td>
               <td width="50%">
               <h3>{{$v->goods_name}}</h3>
               <span class="hui">库存<span style="color:red;">{{$v->goods_num}}</span>件</span>
               </td>
               <td align="right">
                   <input type="button" class="car_btn_1 less" value="-" id="less"/>
                   <input type="text" value="{{$v->buy_number}}" class="car_ipt buy_number" style="width:30px;"/>
                   <input type="button" class="car_btn_2 add" value="+" id="add"/>
               </td>
           </tr>
           <tr>
               <th colspan="4">
                   <strong class="orange">¥{{$v->self_price}}</strong>
               </th>
           </tr>
        @endforeach
       </table>


     </div><!--dingdanlist/-->
   <div class="height1"></div>
   <div class="gwcpiao">
       <table>
           <tr>
               <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
               <td width="50%">商品总价：<b style="font-size:22px; color:#ff4e00;">￥ <font id="count">0</font> </b></td>
               <td width="40%"><a href="javascript:;" class="jiesuan">去结算</a></td>
           </tr>
    </table>
   </div><!--gwcpiao/-->
</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/style.js')}}"></script>
<!--jq加减-->
    <script src="{{asset('layui/layui.js')}}"></script>
<script src="{{asset('js/jquery.spinner.js')}}"></script>
<script>
 $('.spinnerExample').spinner({});
</script>
</body>
</html>
<script>
   $(function(){
    layui.use(['form','layer'],function(){
        var layer = layui.layer;
        /**csrf保护*/
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        //点击复选框
        $("#allbox").click(function(){
            var _this=$(this);
            var status=_this.prop("checked");
            $(".box").prop("checked",status);
            //调用获取商品总价方法
            countTotal();
        })
        //点击加号
        $(document).on("click",".add",function(){
            //js改变购买数量
            var _this=$(this);
            var buy_number=parseInt(_this.prev("input").val());
            var goods_num=_this.parents("tr").attr("goods_num");
            if(buy_number>=goods_num){
            _this.prop('disabled',true);
            }else{
            buy_number+=1;
            _this.prev("input").val(buy_number);
            _this.parent().children('input').first().prop('disabled',false);
            }
            //控制器更改购买数量
            var goods_id=_this.parents("tr").attr("goods_id");
            changeBuyNumber(goods_id,buy_number);
            //获取小计
            getSubTotal(goods_id,_this);
            //重新获取总价
            countTotal(goods_id);
        })
        //点击减号
        $(document).on("click",".less",function(){
            //js改变购买数量
            var _this=$(this);
            var buy_number=parseInt(_this.next("input").val());
            if(buy_number<=1){
            _this.prop('disabled',true);
            }else{
            buy_number-=1;
            _this.next("input").val(buy_number);
            _this.parent().children('input').last().prop('disabled',false);
            }
            //控制器更改购买数量
            var goods_id=_this.parents("tr").attr("goods_id");
            changeBuyNumber(goods_id,buy_number);
            //获取小计
            getSubTotal(goods_id,_this);
            //重新获取总价
            countTotal(goods_id);
        })
        //点击复选框
        $(document).on("click",".box",function(){
            //获取所有选中的复选框 、对应商品id
            var _box=$(".box");
            var goods_id='';
            // console.log(_box);
            _box.each(function(index){
            // console.log(index);
            if($(this).prop("checked")==true){
                goods_id+=$(this).parents("tr").attr("goods_id")+',';
            }
            })
            goods_id=goods_id.substr(0,goods_id.length-1);
            // alert();
            countTotal(goods_id);
        })
        //购买数量失去焦点
        $(document).on("blur",'.buy_number',function(){
            var _this=$(this);
            //改变购买数量
            var buy_number=_this.val();
            var goods_num=_this.parents("tr").attr("goods_num");
            var reg=/^\d{1,}$/;
            if(buy_number==''){
            _this.val(1);
            }else if(buy_number<=1||!reg.test(buy_number)){
            _this.val(1);
            }else if(parseInt(buy_number)>=parseInt(goods_num)){
            _this.val(goods_num);
            }else{
            _this.val(parseInt(buy_number));
            }
            var buy_number=_this.val();
            //控制器更改购买数量
            var goods_id=_this.parents("tr").attr("goods_id");
            changeBuyNumber(goods_id,buy_number);
            //获取小计
            getSubTotal(goods_id,_this);
            //重新获取总价
            countTotal(goods_id);
        })
    //获取小计
        function getSubTotal(goods_id,_this){
            $.ajax({
                method:"POST",
                url:"/getSubTotal",
                data:{goods_id,goods_id}
            }).done(function(res){
                _this.parents("tr").next("tr").find("strong").text('￥'+res);
            });
        }
    //更改购买数量
        function changeBuyNumber(goods_id,buy_number){
        $.ajax({
            url:"/changeBuyNumber",
            method:"post",
            data:{goods_id:goods_id,buy_number:buy_number},
            async:false,
            dataType:'json',
            success:function(res){
            //错误给出提示 正确不提示
            if(res.code==0){
                layer.msg(res.font,{icon:res.code});
            }
            }
        });
        }
        //获取商品总价
        function countTotal(goods_id){
            $.ajax({
                method:"POST",
                url:"/countTotal",
                data:{goods_id:goods_id}
            }).done(function(res){
                // console.log(res);
                $("#count").text(res);
            });
        }
        $('.jiesuan').click(function(){
            //获取选中的复选框商品的id
            var _box=$('.box');
            var goods_id='';
            _box.each(function(index){
                if($(this).prop('checked')==true){
                    goods_id+=$(this).parents('tr').attr('goods_id')+',';
                }
            })
            if(goods_id==''){
                layer.msg('请至少选择一件商品进行结算');
                return false;
            }else{
                goods_id=goods_id.substr(0,goods_id.length-1);
                
            }
            location.href="/bay"+goods_id;
        })
    })
})
</script>
@endsection