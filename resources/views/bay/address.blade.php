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
      <img src="images/timg.gif"/>
     </div><!--head-top/-->
     <form action="login.html" method="get" class="reg-login">
      <div class="lrBox">
       <div class="lrList"><input type="text" name="address_name" id="address_name" placeholder="收货人" /></div>
       <div class="lrList"><input type="text" id="address_detail" name="address_detail" placeholder="详细地址" /></div>
       <div class="lrList">
        <select name="province"  class="changearea" id="province">
        <option value="0" selected="selected">请选择...</option>
        @foreach($provinceInfo as $k=>$v)
         <option value="{{$v->id}}">{{$v->name}}</option>
         @endforeach
        </select>
       </div>
       <div class="lrList">
        <select name="city"  class="changearea" id="city">
        <option value="0" selected="selected">请选择...</option>
        </select>
       </div>
       <div class="lrList">
        <select name="area"  class="changearea" id="area">
        <option value="0" selected="selected">请选择...</option>
        </select>
       </div>
       <div class="lrList"><input type="text" name="address_tel" id="address_tel" placeholder="手机" /></div>
       <div class="lrList2"><input type="text" placeholder="设为默认地址" is_default="2" /><input type="button" id="def" value="设为默认"></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="button" id="add" value="保存" />
      </div>
     </form><!--reg-login/-->
     
     <div class="height1"></div>
     @include('public.footer')
     <script src="{{asset('layui/layui.js')}}"></script>
<script src="{{asset('js/jquery.spinner.js')}}"></script>
<script>
  $(function(){
    layui.use(['layer'],function(){
      var layer=layui.layer;
      //内容改变
      $(document).on('change','.changearea',function(){
        var _this=$(this);
        var _option="<option value='0' selected='selected'>请选择...</option>";
        _this.nextAll('select').html(_option);
        var id=_this.val();
        // console.log(id);
        $.post(
          "/getArea",
          {id:id},
          function(res){
            var _option="<option value='0' selected='selected'>请选择...</option>";
            for(var i in res){
              _option+="<option value='"+res[i]['id']+"'>"+res[i]['name']+"</option>";
            }
            _this.parent('div').next('div').find('select').html(_option);
          },
          "json"
        )
      })
      $('#def').click(function(){
          var val=$(this).text();
          if(val=='设为默认'){
            $(this).prev().attr('is_default','1');
            $(this).text('取消默认');
          }else{
            $(this).prev().attr('is_default','2');
            $(this).text('设为默认');
          }
          alert(val);
        })
      //点击添加
      $('#add').click(function(){
      var obj={};
      obj.province=$('#province').val();
      obj.city=$('#city').val();
      obj.area=$('#area').val();
      obj.address_name=$('#address_name').val();
      obj.address_tel=$('#address_tel').val();
      obj.address_detail=$('#address_detail').val();
      var is_default=$('#is_default').prop('checked');
      if(is_default==true){
        obj.is_default=1;
      }else{
        obj.is_default=2;
      }
      //console.log(obj);
      $.post(
        "/addressdo",
        obj,
        function(res){
          if(res.code==1){
            location.href="/bay";
          }
        },
        "json"
      )
    })
    })
  }) 
</script>
    @endsection
