@extends('layout.shop')
  @section('title','登录')
  @section('content')
  <body>
    <div class="maincont">
     <div class="head-top">
      <img src="images/head.jpg" />
      <dl>
       <dt><a href="/user"><img src="images/touxiang.jpg" /></a></dt>
       <dd>
       @foreach($res as $k=>$v)
        <h1 class="username">{{$v->user_tel}}</h1>
        @endforeach
        <!-- <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul> -->
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      <li><a href="/Login/login">登录</a></li>
      <li><a href="/Login/reg" class="rlbg">注册</a></li>
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      <img src="images/image1.jpg" />
      <img src="images/image2.jpg" />
      <img src="images/image3.jpg" />
      <img src="images/image4.jpg" />
      <img src="images/image5.jpg" />
     </div><!--sliderA/-->
     <ul class="pronav">
     @foreach($cate as $k=>$v)
      <li><a href="/goodslist">{{$v->cate_name}}</a></li>
      @endforeach
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
       @foreach($data as $k=>$v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="/cart/{{$v->goods_id}}"><img src="http://upload.com/{{$v->goods_img}}" style="height:300px" /></a></dt>
         <dd class="ip-text"><a href="/cart/{{$v->goods_id}}">{{$v->goods_name}}</a><span>积分:{{$v->goods_score}}</span></dd>
        <dd class="ip-price"><strong>{{$v->self_price}}</strong> <span>{{$v->self_price*1.2}}</span></dd>
       </dl>
      </div>
      @endforeach
     </div><!--index-pro1/-->
     <div class="joins"><a href="fenxiao.html"><img src="images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     <div class="height1"></div>
     @include('public.footer')
     @endsection