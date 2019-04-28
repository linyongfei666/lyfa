<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/update" method="post" enctype="multipart/form-data">
        <table border="1">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$res->id}}">
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name" value="{{$res->goods_name}}"></td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td><input type="file" name="goods_img"><img src="http://upload.com/{{$res->goods_img}}" alt=""></td>
            </tr>
            <tr>
                <td>商品数量</td>
                <td><input type="text" name="goods_num" value="{{$res->goods_num}}"></td>
            </tr>
            <tr>
                <td>商品描述</td>
                <td>
                    <textarea name="desc" id="" cols="30" rows="10">{{$res->desc}}</textarea>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="修改"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>