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
            <h1>产品详情</h1>
        </div>
    </header>
    @foreach($data as $k=>$v)
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" value="{{$v->goods_id}}" id="goods_id">
        <div id="sliderA" class="slider">
        <img src="http://upload.com/{{$v->goods_img}}" />
    </div><!--sliderA/-->


    <table class="jia-len">
        <tr>
            <th><strong class="orange">￥{{$v->self_price}}</strong></th>
            <td>
                <input type="button" class="n_btn_1" id="less" value="-"/>
                <input type="text" value="1" name="" class="n_ipt" id="buy_number"/>
                <input type="button" class="n_btn_2" id="more" value="+"/>
            </td>
        </tr>
        <tr>
            <td>
                <strong>{{$v->goods_name}}</strong>
                <p class="hui">库存共<font color="red" id="goods_num"> {{$v->goods_num}}</font>件</p>
            </td>
            <td align="right">
                <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
            </td>
        </tr>
    </table>
    <div class="height2"></div>
    <div class="zhaieq">
        <a href="javascript:;" class="zhaiCur">商品简介</a>
        <a href="javascript:;">商品参数</a>
        <a href="javascript:;" style="background:none;">订购列表</a>
        <div class="clearfix"></div>
    </div><!--zhaieq/-->
    <div class="proinfoList">
        <img src="http://upload.com/{{$v->goods_img}}"  width="536" height="520" />
    </div><!--proinfoList/-->
    @endforeach
    <div class="proinfoList">
        暂无信息....
    </div><!--proinfoList/-->
    <div class="proinfoList">
        暂无信息......
    </div><!--proinfoList/-->
    <table class="jrgwc">
        <tr>
            <th>
                <a href="/Index/index"><span class="glyphicon glyphicon-home"></span></a>
            </th>
            <td><a href="javascript:;" id="cartAdd">加入购物车</a></td>
        </tr>
    </table>
</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/style.js')}}"></script>
<!--焦点轮换-->
<script src="{{asset('js/jquery.excoloSlider.js')}}"></script>
<script>
    $(function () {
        $("#sliderA").excoloSlider();
    });
</script>
<!--jq加减-->
<script src="{{asset('js/jquery.spinner.js')}}"></script>
<script src="{{asset('layui/layui.js')}}"></script>
<script>
    $('.spinnerExample').spinner({});
</script>
</body>
</html>
<script>
    $(function(){
        layui.use(['form','layer'],function(){
            var form = layui.form;
            var layer = layui.layer;
            var goods_num = parseInt($('#goods_num').text());
            //+号点击事件
            $("#more").click(function()
            {
                var buy_number = parseInt($('#buy_number').val());
                if(buy_number>=goods_num){
                    $(this).prop('disabled',true);
                    $(this).next('input').prop('disabled',false);
                }else{
                    buy_number = buy_number + 1;
                    $("#buy_number").val(buy_number);
                    $(this).next('input').prop('disabled',false);
                }
            });
            //-号点击事件
            $("#less").click(function(){
                var buy_number = parseInt($('#buy_number').val());
                if(buy_number<=1){
                    $(this).prop('disabled',true);
                    $(this).prev('input').prop('disabled',false);
                }else{
                    buy_number = buy_number - 1;
                    $("#buy_number").val(buy_number);
                    $(this).prev('input').prop('disabled',false);
                }
            });
            //文本框失去焦点事件
            $("#buy_number").blur(function(){
                var buy_number = parseInt($('#buy_number').val());
                var reg = /^[1-9]\d*$/;
                if(!reg.test(buy_number)){
                    $("#buy_number").val(1);
                }else if(buy_number<=1){
                    $("#buy_number").val(1);
                }else if(buy_number>=goods_num){
                    $("#buy_number").val(goods_num);
                }
            });
            //加入购物车
            $("#cartAdd").click(function(){
              var goods_id = $("#goods_id").val();
              var buy_number = $('#buy_number').val();
              // alert(buy_number);
              /** csrf保护*/
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  method:"POST",
                  url:"/addcart",
                  data:{goods_id:goods_id,buy_number:buy_number},
                  dataType:'json'
              }).done(function(res){
                layer.msg(res.font,{icon:res.code});
                  if(res.code == 1){
                      location.href="/cartlist";
                  }
              });
          });
        })
  })
</script>