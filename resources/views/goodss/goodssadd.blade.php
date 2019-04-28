<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/goodssadddo" method="post" enctype="multipart/form-data">
        <table border="1">
        {{csrf_field()}}
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="goods_name"></td>
            </tr>
            <tr>
                <td>商品图片</td>
                <td><input type="file" name="goods_img"></td>
            </tr>
            <tr>
                <td>商品数量</td>
                <td><input type="text" name="goods_num"></td>
            </tr>
            <tr>
                <td>商品描述</td>
                <td>
                    <textarea name="desc" id="" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>