<?php
$file = file_get_contents('data/express.json');
$data = json_decode($file, true);
$info = array();
if (isset($_GET['phone'])) {
    for($i = 0; $i < count($data); $i++) {
        if ($data[$i]['phone'] == $_GET['phone']) {
            $info = $data[$i];
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>徐梦洁中文首站 - 周边快递查询</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
    <link href="pc/dep/bootstrap.min.css" rel="stylesheet">
    <script src="pc/dep/jquery.min.js"></script>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?7e1a0f0a5672c05b21e4d2953405bf3c";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>
<div class="container" id="vm">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <h4 class="text-center">
                快递信息查询 - 徐梦洁中文首站
            </h4>
            <form class="form-horizontal" role="form" action="express.php">
                <div class="form-group">
                    <label for="inputPhone" class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputPhone" name="phone" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">查询</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered" v-if="info">
                <tbody>
                <tr>
                    <td>收件人</td>
                    <td>{{ info.name }}</td>
                </tr>
                <tr class="info">
                    <td>手机号</td>
                    <td>{{ info.phone }}</td>
                </tr>
                <tr>
                    <td>地址</td>
                    <td>{{ info.address }}</td>
                </tr>
                <tr class="info">
                    <td>快递类型</td>
                    <td>{{ info.type }}</td>
                </tr>
                <tr>
                    <td>快递单号</td>
                    <td>{{ info.number }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <p class="contact-info">微博：<a href="http://weibo.com/u/1039990062" target="_blank">@杨文清Blake</a> | <a href="http://xumengjie.cn">xumengjie.cn</a></p>
</div>
<script src="pc/dep/bootstrap.min.js"></script>
<script src="pc/dep/vue.min.js"></script>
<script>
    var vm = new Vue({
        el: '#vm',
        data: {
            info: <?php $text = empty($info) ? print('null') : print(json_encode($info)) ?>
        }
    })
</script>
</body>