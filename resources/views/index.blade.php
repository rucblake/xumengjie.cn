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
    <a class="target header-link" href="#intro">介绍</a><span class="header-link-border"></span>
    <a class="target header-link" href="#news">帖子</a><span class="header-link-border"></span>
    <a class="target header-link" href="#video-101">创造101</a><span class="header-link-border"></span>
    <a class="target header-link" href="#video-other">视频</a>
</div>
<section id="hello">
    <div class="hello-rainbow">
        <img class="img-chu" src="{{ $word1_0619 }}">
        <img class="img-dao" src="{{ $word2_0619 }}">
        <img class="img-kuai" src="{{ $word3_0619 }}">
        <img class="img-le" src="{{ $word4_0619 }}">
        <img class="img-border" src="{{ $border_0619 }}">
        <a href="#intro" class="welcome target"><img class="img-welcome" src="{{ $welcome_0619 }}"></a>
        {{--<a href="#intro" class="welcome target"><div class="welcome-bg"></div>“追梦不停步，笑眼里就有彩虹”<br>我是Rainbow - 徐梦洁。</a>--}}
        <img class="img-zhongshou" src="{{ $cn_0619 }}">
        <img class="img-619bg" src="{{ $bg_0619 }}">
    </div>
    <div class="rainbow-bg">
        <img src="{{ $rainbow_0619 }}">
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
    <a class="a-baike" href="https://baike.baidu.com/item/%E5%BE%90%E6%A2%A6%E6%B4%81" target="_blank">- 百度百科 : 徐梦洁</a>
</section>
<div class="img-banner">
    <img src="{{ $banner1 }}">
</div>
<div id="app">
    <section id="image">
        <div class="title">
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <span>润宝图集</span>
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <a class="more-link" href="/image/list">More>></a>
        </div>
        <p class="empty-line"></p>
        <div class="image-list">
            <div class="image-div" v-for="item in home.image">
                <img class="image" :src="getAttachUrl(item, 'small')" @click="showMidImage(item)">
            </div>
        </div>
        <div class="mid-image" v-if="currentImage.show" style="display: none">
            <div class="mid-image-bg"></div>
            <div class="mid-image-div" @click="hiddenMidImage()">
                <img :src="getAttachUrl(currentImage.data, 'mid')">
            </div>
            <div class="go-to-origin" @click="goToOrigin()">查看原图</div>
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
            <div class="item" v-for="item in home.news">
                <a class="item-title" :href="item.url" target="_blank">@{{ item.title }} - @{{ item.from }}</a>
                <p class="item-desc">@{{ item.desc }}</p>
            </div>
        </div>
        <div class="img-banner">
            <img src="{{ $banner2 }}">
        </div>
    </section>
    <section id="video-101">
        <div class="title">
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <span>创造101直拍</span>
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
        </div>

        <div class="list">
            <div class="item" v-for="item in home.video.p101">
                <a class="item-title" :href="item.url" target="_blank">@{{ item.title }} - @{{ item.from }}</a>
                <p class="item-desc">@{{ item.desc }}</p>
            </div>
        </div>
        <div class="img-banner">
            <img src="{{ $banner3 }}">
        </div>
    </section>
    <section id="video-other">
        <div class="title">
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <span>其他视频</span>
            <span class="rainbow-icon">
                <img src="{{ $ico }}">
            </span>
            <a class="more-link" href="/video/list">More>></a>
        </div>

        <div class="list">
            <div class="item" v-for="item in home.video.normal">
                <a class="item-title" :href="item.url" target="_blank">@{{ item.title }} - @{{ item.from }}</a>
                <p class="item-desc">@{{ item.desc }}</p>
            </div>
        </div>
    </section>
</div>
<div class="img-banner">
    <img src="{{ $banner4 }}">
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
                video: {
                    p101: [],
                    normal: [],
                },
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