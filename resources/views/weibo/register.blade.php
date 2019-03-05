<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>微博信息登记 - xumengjie.cn - 徐梦洁中文网</title>
    <meta name="Keywords" content="徐梦洁中文网,徐梦洁,xumengjie,xumengjie.cn,徐梦洁视频,创造101,火箭少女101,蜜蜂少女队">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
    <script src="/lib/jquery.min.js"></script>
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if (deviceWidth > 640) {
            deviceWidth = 640;
        }
        $('html').css("cssText", "font-size:"+(deviceWidth / 6.4)+"px !important;");
    </script>
    <link href="/lib/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mobile.css" rel="stylesheet">
</head>
<body>
<div class="img-banner">
    <img src="/img/banner3.jpg">
</div>
<br>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <form role="form">
                <div class="form-group">
                    <label for="exampleInputEmail1">用户名</label><input type="text" class="form-control" id="username" />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密码</label><input type="password" class="form-control" id="password" />
                </div>
                <a class="btn btn-default" id="submit">提交</a>
            </form>
        </div>
    </div>
</div>

<p class="contact-info"><a href="https://github.com/rucblake/xumengjie.cn" target="_blank">github</a> | 微博：<a href="http://weibo.com/u/1039990062" target="_blank">@杨文清Blake</a> | <a href="http://xumengjie.cn">xumengjie.cn</a></p>
<script src="/js/share.js"></script>
<script>
$('#submit').click(function () {
    var formData = {
        username: $('#username').val(),
        password: $('#password').val(),
    };
    $.ajax({
        url: '/weibo/register',
        type: 'post',
        data: formData,
        dataType: 'json',
        success: function (result) {
            alert(result);
        },
        error: function () {
            alert('网络异常');
        }
    });
});
</script>
</body>
</html>