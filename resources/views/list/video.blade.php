<style>

</style>
<div id="app">
    <div class="title">
        <span class="rainbow-icon">
            <img src="http://img.xumengjie.cn/common/rainbow-ico.png">
        </span>
        <span>发现彩虹</span>
        <span class="rainbow-icon">
            <img src="http://img.xumengjie.cn/common/rainbow-ico.png">
        </span>
    </div>
    <div class="list">
        <p class="loading" v-if="loading">加载中，请稍候~</p>
        <div class="item" v-for="item in video.list">
            <a class="item-title" :href="item.url" target="_blank">@{{ item.title }}</a>
            <div class="b-video">
                <iframe :src="item.desc" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"></iframe>
            </div>
        </div>
    </div>
    <div class="page-control">
        <span class="page-count">
            <span class="page-btn last-page" v-if="video.currentPage > 1" @click="lastPage">&lt;&lt;上一页</span>
            <span v-if="video.list">第@{{ video.currentPage }}页，共@{{ video.totalPage }}页</span>
            <span class="page-btn next-page" v-if="video.currentPage < video.totalPage" @click="nextPage">下一页&gt;&gt;</span>
        </span>
    </div>
</div>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            loading: true,
            pageSize: 10,
            video: {
                currentPage: 1,
                totalPage: 2,
            }
        },
        mounted: function() {
            this.getList();
        },
        methods: {
            getList: function () {
                this.loading = true;
                this.video.list = [];
                var postData = {
                    currentPage: this.video.currentPage,
                    pageSize: this.pageSize,
                    type: 2,
                };
                $.ajax({
                    url: '/video/list',
                    type: 'post',
                    data: postData,
                    dataType: 'json',
                    success: function (result) {
                        if (result.code === 1) {
                            vm.video = result.data;
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
                if (this.video.currentPage < this.video.totalPage) {
                    this.video.currentPage += 1;
                    this.getList();
                }
            },
            lastPage: function () {
                if (this.video.currentPage > 1) {
                    this.video.currentPage -= 1;
                    this.getList();
                }
            }
        }
    });
</script>