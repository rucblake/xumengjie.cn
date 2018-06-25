<?php
$urls = array(
    'mmq' => "40567",
    'xmj' => "40572",
    'cyh' => "40571",
    'lzt' => "40575",
    'gqz' => "40577",
    'lry' => "40578"
);

$referurl = "https://www.owhat.cn/index.html";
$result = array(
    'mmq' => array(),
    'xmj' => array(),
    'cyh' => array(),
    'lzt' => array(),
    'gqz' => array(),
    'lry' => array()
);
foreach($urls as $key => $value) {
    $fields = "cmd_s=shop.goods&cmd_m=findgoodsbyid&v=4.4.5&client=%7B%22platform%22%3A%22pc%22%2C%22version%22%3A%224.4.5%22%2C%22deviceid%22%3A%22f4e85b09-8133-ee7b-114f-877d3ec05fb1%22%2C%22channel%22%3A%22owhat%22%7D&data=%7B%22goodsid%22%3A%22".$value."%22%7D";
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://www.owhat.cn/api?requesttimestap=".time(),
        CURLOPT_POSTFIELDS => $fields,
        // CURLOPT_COOKIE => $cookie,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        // CURLOPT_HTTPHEADER => $header,
    ));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $page_content = curl_exec($ch);
    $data = json_decode($page_content);
    $num = explode("总参与人数", $data->data->content);
    $people = explode("人", $num[1]);
    $result[$key]['id'] = $value;
    $result[$key]['name'] = $data->data->owner->nickname;
    $result[$key]['money'] = $data->data->fundingdto->saleamount;
    $result[$key]['people'] = $people[0];
    $result[$key]['dealNum'] = $data->data->paystock;
    if ($people[0] > 0) {
        $result[$key]['peopleAverage'] = round($data->data->fundingdto->saleamount/$people[0], 2);
        $result[$key]['dealAverage'] = round($data->data->fundingdto->saleamount/$data->data->paystock, 2);
    } else {
        $result[$key]['peopleAverage'] = 0;
        $result[$key]['dealAverage'] = 0;
    }
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>6月21日12:00 Final Battle</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
        <script src="http://test.eibook.com.cn:8088/rainbow/dep/jquery.min.js"></script>
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?7e1a0f0a5672c05b21e4d2953405bf3c";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
        <style>
            html {
                width: 100%;
                height: 100%;
            }
            h3 {
                font-size: 20px;
                text-align: center;
            }
            table {
                width: 100%;
                text-align: center;
            }
            td {
                font-size: 16px;
                border: solid 1px #333;
            }
            #data-echarts {
                margin: 20px 0;
                width: 100%;
                height: 600px;
            }
        </style>
    </head>
    <body>
        <div id="actual">
            <h3>6月21日12:00 Final Battle</h3>
            <p>6月13日“黑白人格”battle数据<a href="battle-0613.php">点击此处</a>查看 </p>
            <table class="actual-table">
                <thead>
                    <tr>
                        <th>后援会</th>
                        <th>当前金额</th>
                        <th>参与人数</th>
                        <th>总笔数</th>
                        <th>人均</th>
                        <th>笔均</th>
                    </tr>
                </thead>
                <tbody class="actual-tbody">
                    <tr v-for="item in actual">
                        <td class="name"><a :href="'https://m.owhat.cn/shop/supportdetail.html?id='+ item.id" target="_blank">{{ item.name }}</a></td>
                        <td class="money">{{ item.money }}元</td>
                        <td class="people">{{ item.people }}人</td>
                        <td class="dealNum">{{ item.dealNum }}笔</td>
                        <td class="peopleAverage">{{ item.peopleAverage }}元/人</td>
                        <td class="dealAverage">{{ item.dealAverage }}元/笔</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="data-echarts"></div>
        <p>每10分钟抓取一次数据。点击图表可查看详情。使用PC看图效果更佳。</p>
        <p>微博：<a href="http://weibo.com/u/1039990062" target="_blank">@杨文清Blake</a> | 彩虹糖一枚~</p>
        <p><a href="http://xumengjie.cn" target="_blank">xumengjie.cn</a> | <a href="https://github.com/rucblake/xumengjie.cn" target="_blank">github</a> | 作图工具：<a href="http://echarts.baidu.com/" target="_blank">百度Echarts</a></p>
    </body>
    <script src="http://test.eibook.com.cn:8088/rainbow/dep/echarts.min.js"></script>
    <script src="http://test.eibook.com.cn:8088/rainbow/dep/vue.js"></script>
    <script>
        var jsonData = '<?php echo json_encode($result); ?>';
        var data = JSON.parse(jsonData);
        var vmData = {
            mmq: {
                name: '孟美岐',
                data: [["2018-06-21 12:00","0"]]
            },
            xmj: {
                name: '徐梦洁',
                data: [["2018-06-21 12:00","0"]]
            },
            cyh: {
                name: '陈意涵',
                data: [["2018-06-21 12:00","0"]]
            },
            lzt: {
                name: '李紫婷',
                data: [["2018-06-21 12:00","0"]]
            },
            gqz: {
                name: '高秋梓',
                data: [["2018-06-21 12:00","0"]]
            },
            lry: {
                name: '刘人语',
                data: [["2018-06-21 12:00","0"]]
            }
        }
        $.get("data/battle0621.json", function(result){
            vmData = result;
            console.log(vmData);
            var myChart = echarts.init(document.getElementById('data-echarts'));
            var option = {
                    title: {
                        text: '集资金额趋势图'
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    xAxis: {
                        data: vmData.xmj.data.map(function (item) {
                            return item[0];
                        })
                    },
                    yAxis: {
                        splitLine: {
                            show: false
                        }
                    },
                    toolbox: {
                        left: 'center',
                        feature: {
                            dataZoom: {
                                yAxisIndex: 'none'
                            },
                            restore: {},
                            saveAsImage: {}
                        }
                    },
                    dataZoom: [{
                        startValue: '2018-06-21 12:00'
                    }, {
                        type: 'inside'
                    }],
                    series: [
                    {
                        name: '孟美岐',
                        type: 'line',
                        data: vmData.mmq.data.map(function (item) {
                            return parseFloat(item[1]);
                        })
                    },
                    {
                        name: '徐梦洁',
                        type: 'line',
                        data: vmData.xmj.data.map(function (item) {
                            return parseFloat(item[1]);
                        })
                    },
                    {
                        name: '陈意涵',
                        type: 'line',
                        data: vmData.cyh.data.map(function (item) {
                            return parseFloat(item[1]);
                        })
                    },
                    {
                        name: '李紫婷',
                        type: 'line',
                        data: vmData.lzt.data.map(function (item) {
                            return parseFloat(item[1]);
                        })
                    },
                    {
                        name: '高秋梓',
                        type: 'line',
                        data: vmData.gqz.data.map(function (item) {
                            return parseFloat(item[1]);
                        })
                    },
                    {
                        name: '刘人语',
                        type: 'line',
                        data: vmData.lry.data.map(function (item) {
                            return parseFloat(item[1]);
                        })
                    }
                ]
                };
            myChart.setOption(option);
        });
        var vm = new Vue({
            el: '#actual',
            data: {
                actual: data
            }
        });
    </script>
</html>