@extends('layout.shop')
  @section('title','登录')
  @section('content')
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><a href="address.html" class="hui"><strong class="">+</strong> 新增收货地址</a></td>
       <td width="25%" align="center" style="background:#fff url(images/xian.jpg) left center no-repeat;"><a href="javascript:;" class="orange">删除信息</a></td>
      </tr>
     </table>
     
     <div class="dingdanlist">
      <table>
       @foreach($res as $k=>$v)
       <tr class="aa" address_id="{{$v->address_id}}">
        <td width="50%">
         <h3>{{$v->address_name}} {{$v->address_tel}}</h3>
         <time>{{$v->address_detail}}</time>
        </td>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     <script src="{{asset('layui/layui.js')}}"></script>
<script src="{{asset('js/jquery.spinner.js')}}"></script>
     <div class="height1"></div>
     @include('public.footer')
     <script>
         $('.aa').click(function(){
             var _this=$(this);
             var address_id=_this.attr('address_id');
             $.post(
                "/addresscheck",
                {address_id:address_id},
                function(res){
                console.log(res);
                },
            )
         })
     </script>
    @endsection