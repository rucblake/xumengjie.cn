<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>徐梦洁中文网 - xumengjie.cn - 徐梦洁</title>
    <meta name="description" content="徐梦洁中文网，收录火箭少女101成员-徐梦洁的相关视频和文章等信息。徐梦洁，2018年4月21日，以练习生的身份参加由腾讯视频出品的女团竞演节目《创造101》，最终以第11名的成绩加入火箭少女101，成功出道。">
    <meta name="Keywords" content="徐梦洁中文网,徐梦洁,xumengjie,xumengjie.cn,中文网站,徐梦洁视频,创造101,火箭少女,蜜蜂少女队">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 640) {
            location.href = "pc/";
        }
    </script>
    <script src="/lib/jquery.min.js"></script>
    <script>
        $('html').css("cssText", "font-size:"+(deviceWidth / 6.4)+"px !important;");
    </script>
    <link href="/css/mobile.css?v={{ $version }}" rel="stylesheet">
</head>
<body>
<div class="header">
    <a class="target header-link" href="#intro">简介</a>
    <span class="header-link-border"></span>
    <a class="target header-link" href="#video">视频</a>
    <span class="header-link-border"></span>
    <a class="target header-link" href="#news">盘点</a>
</div>
<section id="hello">
    <div class="hello-rainbow">
        <img class="img-title" src="{{ $title }}">
        <img class="img-border" src="{{ $border }}">
        <img class="welcome" src="{{ $welcome }}">
{{--        <a href="#intro" class="welcome target"><img class="img-welcome" src="{{ $welcome }}"></a>--}}
{{--        <a href="#intro" class="welcome target"><div class="welcome-bg"></div>“追梦不停步，笑眼里就有彩虹”<br>我是Rainbow - 徐梦洁。</a>--}}
{{--        <img class="img-zhongshou" src="{{ $cn_0619 }}">--}}
{{--        <img class="img-619bg" src="{{ $bg_0619 }}">--}}
    </div>
    <div class="rainbow-bg">
        <img src="{{ $rainbow }}">
    </div>
    <div class="front"></div>
</section>
<section id="intro">
    <div class="title">
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
        <span>徐梦洁</span>
        <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
    </div>
    <p class="p-content">徐梦洁，1994年6月19日出生于浙江省金华市，中国内地流行乐女歌手、模特、演员，中国内地女子演唱组合蜜蜂少女队、火箭少女101成员。</p>
    <p class="p-content">2015年，徐梦洁加入了蜜蜂少女队，2018年4月21日，以练习生的身份参加由腾讯视频出品的女团竞演节目《创造101》，最终以第11名的成绩加入火箭少女101，成功出道。</p>
    <p class="p-content">因为英文名为"Rainbow"，笑起来眼睛像彩虹一样弯弯的，所以被大家叫做“小彩虹”。经过后援会三轮粉丝投票，2018年7月1日，最终决定粉丝名为“彩蛋”。</p>
    <a class="a-baike" href="https://weibo.com/u/5873220619" target="_blank">♡ 徐梦洁 - 微博</a>
    <a class="a-baike" href="https://v.douyin.com/JdF1bMR/" target="_blank">♡ 徐梦洁 - 抖音</a>
    <a class="a-baike" href="https://www.xiaohongshu.com/user/profile/5ad47bb680008671255c6948" target="_blank">♡ 徐梦洁 - 小红书</a>
    <a class="a-baike" href="https://baike.baidu.com/item/%E5%BE%90%E6%A2%A6%E6%B4%81/8208274" target="_blank">♡ 徐梦洁 - 百度百科</a>
</section>
<div class="img-banner">
    <img src="{{ $banner1 }}">
</div>
<div id="app">
{{--    <section id="image">--}}
{{--        <div class="title">--}}
{{--            <span class="rainbow-icon">--}}
{{--                <img src="{{ $ico }}">--}}
{{--            </span>--}}
{{--            <span>润宝图集</span>--}}
{{--            <span class="rainbow-icon">--}}
{{--                <img src="{{ $ico }}">--}}
{{--            </span>--}}
{{--            <a class="more-link" href="/image/list">More>></a>--}}
{{--        </div>--}}
{{--        <p class="empty-line"></p>--}}
{{--        <div class="image-list">--}}
{{--            <div class="image-div" v-for="item in home.image">--}}
{{--                <img class="image" :src="getAttachUrl(item, 'small')" @click="showMidImage(item)">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="mid-image" v-if="currentImage.show" style="display: none">--}}
{{--            <div class="mid-image-bg"></div>--}}
{{--            <div class="mid-image-div" @click="hiddenMidImage()">--}}
{{--                <img :src="getAttachUrl(currentImage.data, 'mid')">--}}
{{--            </div>--}}
{{--            <div class="go-to-origin" @click="goToOrigin()">查看原图</div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section id="video">
        <div class="title">
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <span>视频</span>
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <a class="more-link" href="/video/list">More>></a>
        </div>
        <div class="list">
            <div class="item" v-for="item in home.video">
                <a class="item-title" :href="item.url" target="_blank">@{{ item.title }}</a>
                <div class="b-video">
                    <iframe :src="item.desc" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>
                </div>
            </div>
        </div>
    </section>
    <section id="news">
        <div class="title">
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <span>不一样的彩虹</span>
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <a class="more-link" href="/news/list">More>></a>
        </div>
        <div class="list">
            <div class="item">
                <div class="img-banner">
                    <img src="{{ $pandian_2019 }}">
                </div>
            </div>
            <div class="item">
                <a class="item-title" href="{{ $pandian_2018_origin }}" target="_blank">小彩虹出道元年高光时刻混剪</a>
                <div class="b-video">
                    <iframe src="{{ $pandian_2018 }}" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                </div>
            </div>
            <div class="item">
                <a class="item-title" href="{{ $letter }}" target="_blank">徐梦洁写给女团创始人的信</a>
                <p class="item-desc">"彩虹"下有大树，大树下有彩虹。彩虹的心里住着一个"彩虹"梦，你们一定也跟我一样。</p>
            </div>
        </div>
        <div class="img-banner">
            <img src="{{ $banner4 }}">
        </div>
    </section>
</div>
<p class="contact-info"><a href="https://github.com/rucblake/xumengjie.cn" target="_blank">github</a> | 微博：<a href="http://weibo.com/u/1039990062" target="_blank">@潇湘ke</a> | <a href="http://xumengjie.cn">xumengjie.cn</a></p>
</body>
<script src="/lib/vue.min.js"></script>
<script src="/js/share.js"></script>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            currentImage: {
                show: false,
                data: {},
            },
            home: {
                video: [],
                news: [],
                image: [],
            }
        },
        beforeCreate: function() {
            $(".mid-image").css('cssText', 'display: block;');
        },
        mounted:function () {
            this.home = {!! $home !!};
        },
        methods: {
            getAttachUrl: function (item, mode) {
                var imageType = 'jpg';
                if (mode == 'origin') {
                    imageType = item.type;
                }
                return item.url + '/' + mode + '/' + item.hash_key + '.' + imageType;
            },
            showMidImage: function (item) {
                this.currentImage.data = item;
                this.currentImage.show = true;
            },
            hiddenMidImage: function() {
                this.currentImage.show = false;
            },
            goToOrigin: function () {
                location.href = this.getAttachUrl(this.currentImage.data, 'origin');
            }
        }
    });
    $(".target").click(function () {
        $("html, body").animate({scrollTop: $($(this).attr("href")).offset().top + "px"}, 500);
        return false;
    });
</script>
</html>