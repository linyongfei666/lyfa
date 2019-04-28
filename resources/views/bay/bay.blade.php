@extends('layout.shop')
  @section('title','登录')
  @section('content')
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
     <img src="images/and.gif"/>
     </div><!--head-top/-->
     <div class="dingdanlist">
      <table>
       <tr>
        <td class="dingimg" width="75%" colspan="2" id="address">新增收货地址</td>
        <td align="right"><img src="images/jian-new.png" /></td>
       </tr>
       <td class="dingimg" width="75%" colspan="3">
        </td>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
       @foreach($res as $k=>$v)
       <tr>
        <td class="dingimg" width="15%"><img src="http://upload.com/{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
        </td>
        <td align="right"><span class="qingdan">X {{$v->buy_number}}</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">{{$v->self_price*$v->buy_number}}</strong></th>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/--> 
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="price">{{$price}}</strong></td>
       <td width="40%"><a href="javascript:;" class="jiesuan">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <!--jq加减-->
    <script src="js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
  <script src="{{asset('layui/layui.js')}}"></script>
<script src="{{asset('js/jquery.spinner.js')}}"></script>
</html>
<script>
  $('#address').click(function(){
    location.href="/address";
  })
  $('.jiesuan').click(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var price=$('#price').text();
          location.href="/success/"+price;
     })
</script>