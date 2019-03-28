<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>微博信息登记 - xumengjie.cn - 徐梦洁中文网</title>
    <meta name="Keywords" content="徐梦洁中文网,徐梦洁,xumengjie,xumengjie.cn,徐梦洁视频,创造101,火箭少女101,蜜蜂少女队">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
    <script src="/lib/jquery.min.js"></script>
    <link href="/lib/bootstrap.min.css" rel="stylesheet">
    <link href="/css/pc.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h3 class="text-center"><strong></strong></h3>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>提示</h4>
        <strong>建议使用PC端chrome浏览器，首次使用请查看下方教程，微博看板<a href="/weibo" target="_blank">点此查看</a></strong>
    </div>
    <div class="row clearfix">
        <div class="col-md-12 column">
            <form role="form">
                <div class="form-group">
                <label for="exampleInputEmail1">Cookie</label><input type="text" class="form-control" id="cookie" />
                </div>
                <a class="btn btn-default" id="submit">提交</a>
            </form>
        </div>
    </div>
    <h2 class="text-center">微博手动登陆教程</h2>
    <hr>
    <h3>准备工作</h3>
    <ul>
        <li>一台电脑</li>
        <p>手机浏览器无法查看cookie</p>
        <li>chrome浏览器或火狐浏览器</li>
        <p>官网下载chrome需要翻墙，建议前往腾讯软件中心下载windows版本：<a href="https://pc.qq.com/detail/1/detail_2661.html" target="_blank">下载链接</a></p>
        <p>火狐浏览器无需翻墙，<a href="http://www.firefox.com.cn/" target="_blank">点此下载</a></p>
    </ul>
    <h3>下面以chrome为例介绍过程，火狐的区别在最后。</h3>
    <h3>第一步</h3>
    <li><a href="https://passport.weibo.cn/signin/login?entry=mweibo&res=wel&wm=3349&r=https%3A%2F%2Fm.weibo.cn%2F" target="_blank">点击这里</a>前往微博登录，登录完就可以回来了</li>
    <h3>第二步</h3>
    <li><a href="https://weibo.cn" target="_blank">点击这里</a>前往微博网页版（这个网页一定要用电脑打开）</li>
    <li>按下F12进入浏览器的开发者模式，进入类似下图的样子</li>
    <div class="help-img">
        <img src="http://s1.xumengjie.cn:8031/pc/weibo/1.png"/>
    </div>
    <li>在右侧出现的工具栏中，选择最上方的<strong>NetWork</strong>，然后按F5刷新，如下图</li>
    <div class="help-img">
        <img src="http://s1.xumengjie.cn:8031/pc/weibo/2.png"/>
    </div>
    <li>点击<strong>weibo.cn</strong>，出现请求的详细信息，如下图</li>
    <div class="help-img">
        <img src="http://s1.xumengjie.cn:8031/pc/weibo/3.png"/>
    </div>
    <li>向下滚动，在请求中找到<strong>Request Header</strong>，复制<strong>Cookie</strong>的所有内容，如下图</li>
    <div class="help-img">
        <img src="http://s1.xumengjie.cn:8031/pc/weibo/4.png"/>
    </div>
    <li>至此，手动获取登录信息完成</li>
    <h3>第三步</h3>
    <li>将复制的cookie粘贴到上面的输入框里，提交即可。<a class="toTop" href="#top">点击此处</a>可以快速回到顶部</li>
    <li>cookie将加密存储到数据库中，除评论彩虹微博外不做他用。</li>
    <hr>
    <h3>火狐浏览器的区别</h3>
    <li>火狐浏览器会将请求头缩略显示，cookie显示不全，需要点击原始头才能完全显示，如下图所示：</li>
    <div class="help-img">
        <img src="http://s1.xumengjie.cn:8031/pc/weibo/5.png" style="max-width: 1600px"/>
    </div>
    <li><a class="toTop" href="#top">点击此处</a>可以直接回到顶部</li>
</div>
<br>
<p class="text-center"><a href="https://github.com/rucblake/xumengjie.cn" target="_blank">github</a> | 微博：<a href="http://weibo.com/u/1039990062" target="_blank">@杨文清Blake</a> | <a href="http://xumengjie.cn">xumengjie.cn</a></p>
<script src="/js/share.js"></script>
<script src="/lib/bootstrap.min.js"></script>
<script>
    $('#submit').click(function () {
        $('#submit').html("已提交，请稍候");
        var formData = {
            cookie: $('#cookie').val(),
        };
        $.ajax({
            url: '/weibo/login',
            type: 'post',
            data: formData,
            dataType: 'json',
            success: function (result) {
                if (result.code === 1) {
                    alert("用户："+result.data.nickname+"，登录成功！");
                } else {
                    alert(result.msg);
                }
            },
            error: function () {
                alert('网络异常');
            }
        });
    });
    $('.toTop').click(function () {
        $('html').scroll(0);
    });
</script>
</body>
</html>