<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$title}} - xumengjie.cn - 徐梦洁中文网</title>
    <meta name="description" content="{{$desc}}">
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
    <link href="/css/mobile.css" rel="stylesheet">
</head>
<body>
<div class="img-banner">
    <img src="/img/banner3.jpg">
</div>
<section id="article">
{!! $content !!}
</section>
<a class="p-go" href="/"><p class="bottom"> << 返回首页</p></a>
<p class="contact-info"><a href="https://github.com/rucblake/xumengjie.cn" target="_blank">github</a> | 微博：<a href="http://weibo.com/u/1039990062" target="_blank">@潇湘ke</a> | <a href="http://xumengjie.cn">xumengjie.cn</a></p>
<script src="/js/share.js"></script>
</body>
</html>