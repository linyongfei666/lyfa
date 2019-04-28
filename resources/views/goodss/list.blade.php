<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table border="1">
        <tr>
            <td>商品名称:{{$res->goods_name}}</td>
            <td>商品图片:{{$res->goods_img}}</td>
            <td>商品数量:{{$res->goods_num}}</td>
            <td>商品介绍:{{$res->desc}}</td>
            <td><a href="/goodsslist">商品列表页</a></td>
        </tr>
    </table>
    
</body>
</html>