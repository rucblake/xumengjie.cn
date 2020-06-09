<style>

</style>
<div id="app">
    <div class="title">
        <span class="rainbow-icon">
            <img src="http://s1.xumengjie.cn:8031/img/rainbow-ico.png">
        </span>
        <span>润宝图集</span>
        <span class="rainbow-icon">
            <img src="http://s1.xumengjie.cn:8031/img/rainbow-ico.png">
        </span>
    </div>
    <div class="image-list">
        <p class="loading" v-if="loading">加载中，请稍候~</p>
        <div class="image-div" v-for="item in image.list">
            <img class="image" :src="getAttachUrl(item, 'small')" @click="showMidImage(item)">
        </div>
    </div>
    <div class="mid-image" v-if="currentImage.show">
        <div class="mid-image-bg"></div>
        <div class="mid-image-div" @click="hiddenMidImage()">
            <img :src="getAttachUrl(currentImage.data, 'mid')">
        </div>
        <div class="go-to-origin" @click="goToOrigin()">查看原图</div>
    </div>
    <div class="page-control">
        <span class="page-count">
            <span class="page-btn last-page" v-if="image.currentPage > 1" @click="lastPage">&lt;&lt;上一页</span>
            <span v-if="image.list">第@{{ image.currentPage }}页，共@{{ image.totalPage }}页</span>
            <span class="page-btn next-page" v-if="image.currentPage < image.totalPage" @click="nextPage">下一页&gt;&gt;</span>
        </span>
    </div>
</div>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            loading: true,
            pageSize: 15,
            image: {
                currentPage: 1,
                totalPage: 1,
                list: []
            },
            currentImage: {
                show: false,
                data: {}
            }
        },
        mounted: function() {
            this.getList();
        },
        methods: {
            getList: function () {
                this.loading = true;
                this.image.list = [];
                var postData = {
                    currentPage: this.image.currentPage,
                    pageSize: this.pageSize,
                };
                $.ajax({
                    url: '/image/list',
                    type: 'post',
                    data: postData,
                    dataType: 'json',
                    success: function (result) {
                        if (result.code === 1) {
                            vm.image = result.data;
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
                this.image.currentPage += 1;
                this.getList();
            },
            lastPage: function () {
                this.image.currentPage -= 1;
                this.getList();
            },
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
</script>