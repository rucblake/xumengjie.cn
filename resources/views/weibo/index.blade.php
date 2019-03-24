<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>微博看板 - xumengjie.cn - 徐梦洁中文网</title>
    <meta name="Keywords" content="徐梦洁中文网,徐梦洁,xumengjie,xumengjie.cn,徐梦洁视频,创造101,火箭少女101,蜜蜂少女队">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
    <script src="/lib/jquery.min.js"></script>
    <link href="/lib/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mobile.css" rel="stylesheet">
</head>
<body>
<div class="container" id="app">
    <h3 class="text-center">微博自动化评论看板</h3>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>提示</h4>
        <strong>手动登陆</strong>请点击此处：<a href="/weibo/login" target="_blank">xumengjie.cn/weibo/login</a>
    </div>
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>用户名</th>
                    <th>上次登录</th>
                    <th>累计</th>
                    <th>当前状态</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="user in users">
                    <td>@{{ user.id }}</td>
                    <td>@{{ user.nickname }}</td>
                    <td>@{{ user.login_at }}</td>
                    <td>@{{ user.comment_count }}</td>
                    <td>@{{ user.status }}</td>
                </tr>
                <tr class="info">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>总计：{{ $count }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <ul>
        <li>累计评论数每半小时更新一次</li>
        <li>只有状态正常时会正常评论</li>
        <li>密码错误、未启用状态均可通过手动登陆解决</li>
        <li>手动登录请<a href="/weibo/login" target="_blank">点击此处</a></li>
        <li>账户封禁和账户登录保护请登录微博APP解决</li>
        <li>网页版微博的登录状态容易失效，记得隔几天检查一次。本页编号是不会变的，记住自己的编号能够更快找到。</li>
        <li>本页链接：<a href="/weibo">xumengjie.cn/weibo</a> 简单易记</li>
    </ul>
</div>
<p class="text-center"><a href="https://github.com/rucblake/xumengjie.cn" target="_blank">github</a> | 微博：<a href="http://weibo.com/u/1039990062" target="_blank">@杨文清Blake</a> | <a href="http://xumengjie.cn">xumengjie.cn</a></p>
<script src="/lib/bootstrap.min.js"></script>
<script src="/js/share.js"></script>
<script src="/lib/vue.min.js"></script>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            users: {!! $users !!},
        },
        mounted: function() {
        },
        methods: {
        }
    });
</script>
</body>
</html>