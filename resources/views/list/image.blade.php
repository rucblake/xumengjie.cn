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
</div>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            image: {
                currentPage: 1,
                pageSize: 15,
            }
        }
    });
    $(function () {
        getImageList(vm.image);
    })
</script>