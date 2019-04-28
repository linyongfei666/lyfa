@extends('layout.shop')
@section('title','登录')
@section('content')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <bod  y>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="{{ URL::asset('images/head.jpg') }}" />
     </div><!--head-top/-->
     <form action="/Login/regdo" method="post" class="reg-login">
      <h3>已经有账号了？点此<a class="orange" href="/Login/login">登陆</a></h3>
      {{csrf_field()}} 
      <div class="lrBox">
       <div class="lrList"><input type="text" name="user_tel" id="tel" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="user_code" id="code" placeholder="输入短信验证码" /> 
       <input type="button" value="获取验证码" id="num"></div><br>
       <div class="lrList"><input type="password" name="user_pwd" id="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="user_password" id="password" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" id="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
     @include('public.footer')
     @endsection
</body>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('layui/layui.js')}}"></script>
<script>
  $(function(){
    layui.use(['layer','form'],function(){
			var form=layui.form;
			var layer=layui.layer;
      var flag=false;
    $('#tel').blur(function(){
      $('#tel').next().remove();
    })
    $('#num').click(function(){
      var tel =$('#tel').val();
      $('#tel').next().remove();
      if(tel==''){
        $('#tel').after('<span style="color:red">手机号不能为空</span>');
        flag=false;
        return false;
      }else{
          flag=true;
        }
      var reg=/^1[34578]\d{9}$/;
      $('#tel').next().remove();
      if(!reg.test(tel)){
        $('#tel').after('<span style="color:red">手机号必须以13,14,15,17,18开头11位数字</span>');
        flag=false;
        return false;
      }else{
          flag=true;
        }
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        method: "POST",
        url: "/Login/sends",
        data: { tel: tel },
        dataType:"json",
        }).done(function( msg ){
          // alert(msg);
          if(msg.code==1){
							layer.msg(msg.font,{icon:msg.code});
              flag=true;
            }
        }); 
      })
      //验证密码
      $('#pwd').blur(function(){
        var pwd=$('#pwd').val();
        $('#pwd').next().remove();
        if(pwd==''){
          $('#pwd').after('<span style="color:red">密码不能为空</span>');
          flag=false;
          return false;
        }else{
          flag=true;
        }
        var reg=/^[a-z0-9]{6,18}$/;
        $('#pwd').next().remove();
        if(!reg.test(pwd)){
          $('#pwd').after('<span style="color:red">密码是6-18位数字或字母</span>');
          flag=false;
          return false;
        }else{
          flag=true;
        }
      })
      //验证确认密码
      $('#password').blur(function(){
        var password=$(this).val();
        var pwd=$('#pwd').val();
        $('#password').next().remove();
        if(password==''){
          $('#password').after('<span style="color:red">重新输入密码不能为空</span>');
          flag=false;
          return false;
        }else{
          flag=true;
        }
        $('#password').next().remove();
        if(password!=pwd){
          $('#password').after('<span style="color:red">重新输入密码必须跟密码保持一致</span>');
          flag=false;
          return false;
        }else{
          flag=true;
        }
      })
      $('#submit').click(function(){
        $('#tel').trigger('blur');
        $('#pwd').trigger('blur');
        $('#password').trigger('blur');
        if(flag==true){
          return true;
        }else{
          alert('必填项不能为空');
          return false;
        } 
      })   
    })
  })
  
</script>
