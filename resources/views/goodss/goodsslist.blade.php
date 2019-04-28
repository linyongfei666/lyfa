<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="">
    <input type="text" name="goods_name" value="{{$goods_name}}">
    <input type="text" name="desc" value="{{$desc}}">
        <input type="submit" value="搜索">
     @foreach($res as $k=>$v)
        <table border="1">
            <div>
                <tr>
                <div>商品图片:<img src="http://upload.com/{{$v->goods_img}}" alt=""></div>
                    <td><a href="/list/{{$v->id}}">商品id:{{$v->id}}</a></td>
                    <td>商品名称:{{$v->goods_name}}</td>
                    <td>商品数量:{{$v->goods_num}}</td>
                    <td>商品描述{{$v->desc}}</td>
                    <td><a href="/del/{{$v->id}}">删除</a>
                    <a href="/goodssupdate/{{$v->id}}">修改</a></td>
                </tr>
            </div>
        </table>
        @endforeach
        {{$res->appends(['goods_name' => $goods_name,'desc'=>$desc])->links()}}
    </form>
</body>
</html>