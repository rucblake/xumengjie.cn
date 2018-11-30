<style>

</style>
<div id="app">
    <div class="title">
        <span class="rainbow-icon">
            <img src="http://s1.xumengjie.cn:8031/img/rainbow-ico.png">
        </span>
        <span>彩虹新鲜事</span>
        <span class="rainbow-icon">
            <img src="http://s1.xumengjie.cn:8031/img/rainbow-ico.png">
        </span>
    </div>
    <div class="list">
        <p class="loading" v-if="loading">加载中，请稍候~</p>
        <div class="item" v-for="item in news.list">
            <a class="item-title" :href="item.url" target="_blank">@{{ item.title }} - @{{ item.from }}</a>
            <p class="item-desc">@{{ item.desc }}</p>
        </div>
    </div>
    <div class="page-control">
        <span class="page-count">
            <span class="page-btn last-page" v-if="news.currentPage > 1" @click="lastPage">&lt;&lt;上一页</span>
            <span v-if="news.list">第@{{ news.currentPage }}页，共@{{ news.totalPage }}页</span>
            <span class="page-btn next-page" v-if="news.currentPage < news.totalPage" @click="nextPage">下一页&gt;&gt;</span>
        </span>
    </div>
</div>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            loading: true,
            pageSize: 10,
            news: {
                currentPage: 1,
                totalPage: 1,
            }
        },
        mounted: function() {
            this.getList();
        },
        methods: {
            getList: function () {
                this.loading = true;
                this.news.list = [];
                var postData = {
                    currentPage: this.news.currentPage,
                    pageSize: this.pageSize,
                    type: 1,
                };
                $.ajax({
                    url: '/news/list',
                    type: 'post',
                    data: postData,
                    dataType: 'json',
                    success: function (result) {
                        if (result.code === 1) {
                            vm.news = result.data;
                            vm.loading = false;
                        } else {
                            alert('异常错误');
                        }
                    },
                    error: function () {
                        alert('网络异常');
                    }
                });
            },
            nextPage: function () {
                this.news.currentPage += 1;
                this.getList();
            },
            lastPage: function () {
                this.news.currentPage -= 1;
                this.getList();
            }
        }
    });
</script>