var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?7e1a0f0a5672c05b21e4d2953405bf3c";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
function getNewsList(model) {
    var postData = {
        currentPage: model.currentPage,
        pageSize: model.pageSize,
    };
    $.ajax({
        url: '/news/list',
        type: 'post',
        data: postData,
        dataType: 'json',
        success: function (result) {
            if (result.code === 1) {
                model = result.data;
            } else {
                alert('异常错误');
            }
        },
        error: function () {
            alert('网络异常');
        }
    });
}
function getNormalVideoList(model) {
    var postData = {
        currentPage: model.currentPage,
        pageSize: model.pageSize,
        type: 1
    };
    $.ajax({
        url: '/video/list',
        type: 'post',
        data: postData,
        dataType: 'json',
        success: function (result) {
            if (result.code === 1) {
                model = result.data;
            } else {
                alert('异常错误');
            }
        },
        error: function () {
            alert('网络异常');
        }
    });
}

function getP101VideoList(model) {
    var postData = {
        currentPage: model.currentPage,
        pageSize: model.pageSize,
        type: 0
    };
    $.ajax({
        url: '/video/list',
        type: 'post',
        data: postData,
        dataType: 'json',
        success: function (result) {
            if (result.code === 1) {
                model = result.data;
            } else {
                alert('异常错误');
            }
        },
        error: function () {
            alert('网络异常');
        }
    });
}

function getImageList(model) {
    var postData = {
        currentPage: model.currentPage,
        pageSize: model.pageSize,
    };
    $.ajax({
        url: '/video/list',
        type: 'post',
        data: postData,
        dataType: 'json',
        success: function (result) {
            if (result.code === 1) {
                model = result.data;
            } else {
                alert('异常错误');
            }
        },
        error: function () {
            alert('网络异常');
        }
    });
}