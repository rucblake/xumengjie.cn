<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>徐梦洁中文网 - xumengjie.cn - 徐梦洁</title>
    <meta name="description" content="徐梦洁中文网，收录火箭少女101成员-徐梦洁的相关视频和文章等信息。徐梦洁，2018年4月21日，以练习生的身份参加由腾讯视频出品的女团竞演节目《创造101》，最终以第11名的成绩加入火箭少女101，成功出道。">
    <meta name="Keywords" content="徐梦洁中文网,徐梦洁,xumengjie,xumengjie.cn,中文网站,徐梦洁视频,创造101,火箭少女,蜜蜂少女队">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script src="/lib/jquery.min.js"></script>
    <script src="/js/share.js"></script>
    <script src="/lib/vue.min.js"></script>
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 640) {
            // location.href = "pc/";
        }
        $('html').css("cssText", "font-size:"+(deviceWidth / 6.4)+"px !important;");
    </script>
    <link href="/css/mobile.css" rel="stylesheet">
</head>
<body>
@switch($type)
    @case('news')
        @include('list.news')
        @break
    @case('image')
        @include('list.image')
        @break
    @case('video')
        @include('list.video')
        @break
    @default
@endswitch
<a class="p-go" href="/"><p class="bottom"> << 返回首页</p></a>
<p class="contact-info"><a href="https://github.com/rucblake/xumengjie.cn" target="_blank">github</a> | 微博：<a href="http://weibo.com/u/1039990062" target="_blank">@杨文清Blake</a> | <a href="http://xumengjie.cn">xumengjie.cn</a></p>
</body>
</html>