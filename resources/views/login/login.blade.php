@extends('layout.shop')
  @section('title','登录')
  @section('content')
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员登录</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="{{ URL::asset('images/head.jpg') }}" />
     </div><!--head-top/-->
     <form action="/Login/logindo" method="post" class="reg-login">
     {{csrf_field()}} 
      <h3>还没有三级分销账号？点此<a class="orange" href="/Login/reg">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" id="user_tel" name="user_tel" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList"><input type="password" id="pwd" name="user_pwd" placeholder="输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" id="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     <div class="height1"></div>
    @include('public.footer')
    @endsection
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script>
      $(function(){
        flag=false;
        $('#user_tel').blur(function(){
          var user_tel =$('#user_tel').val();
          $('#user_tel').next().remove();
          if(user_tel==''){
            $('#user_tel').after('<span style="color:red">手机号不能为空</span>');
            flag=false;
            return false;
          }else{
              flag=true;
            }
          var reg=/^1[34578]\d{9}$/;
          $('#user_tel').next().remove();
          if(!reg.test(user_tel)){
            $('#user_tel').after('<span style="color:red">手机号必须以13,14,15,17,18开头11位数字</span>');
            flag=false;
            return false;
          }else{
              flag=true;
            }
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
      $('#submit').click(function(){
        $('#user_tel').trigger('blur');
        $('#pwd').trigger('blur');
        if(flag==true){
          return true;
        }else{
          return false;
        } 
      }) 
      })
    </script>
