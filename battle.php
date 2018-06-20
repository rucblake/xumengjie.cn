<?php
$urls = array(
    'fj' => "39925",
    'ycy' => "39911",
    'wxy' => "39909",
    'xmj' => "39908",
    'lry' => "39917",
    'gyx' => "39865"
);

$referurl = "https://www.owhat.cn/index.html";
$result = array(
    'fj' => array(),
    'ycy' => array(),
    'wxy' => array(),
    'xmj' => array(),
    'lry' => array(),
    'gyx' => array()
);
foreach($urls as $key => $value) {
    echo "<tr>";
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
    $result[$key]['name'] = $data->data->owner->nickname;
    $result[$key]['money'] = $data->data->fundingdto->saleamount;
    $result[$key]['people'] = $people[0];
    $result[$key]['dealNum'] = $data->data->paystock;
    $result[$key]['peopleAverage'] = round($data->data->fundingdto->saleamount/$people[0], 2);
    $result[$key]['dealAverage'] = round($data->data->fundingdto->saleamount/$data->data->paystock, 2);
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
            <h3>6月21日12:00 Final Battle 数据实时更新表</h3>
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
                        <td class="name">{{ item.name }}</td>
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
    </body>
    <script src="http://test.eibook.com.cn:8088/rainbow/dep/echarts.min.js"></script>
    <script src="http://test.eibook.com.cn:8088/rainbow/dep/vue.js"></script>
    <script>
        var jsonData = '<?php echo json_encode($result); ?>';
        var data = JSON.parse(jsonData);
        var vmData = {
            mmq: {
                name: '孟美岐',
                data: [["12:00",116],["12:10",129],["12:20",135]]
            },
            xmj: {
                name: '徐梦洁',
                data: [["12:00",116],["12:10",129],["12:30",135]]
            },
            cyh: {
                name: '陈意涵',
                data: [["12:00",116],["12:10",129],["12:30",135]]
            },
            lzt: {
                name: '李紫婷',
                data: [["12:00",116],["12:10",129],["12:30",135]]
            },
            gqz: {
                name: '高秋梓',
                data: [["12:00",116],["12:10",129],["12:30",135]]
            },
            lry: {
                name: '刘人语',
                data: [["12:00",116],["12:10",129],["12:30",135]]
            }
        }
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
                    startValue: '2014-06-01'
                }, {
                    type: 'inside'
                }],
                
                series:[
                    {
                        name: '孟美岐',
                        type: 'line',
                        data: vmData.mmq.data.map(function (item) {
                            return item[1];
                        })
                    },
                    {
                        name: '徐梦洁',
                        type: 'line',
                        data: vmData.xmj.data.map(function (item) {
                            return item[1];
                        })
                    },
                    {
                        name: '陈意涵',
                        type: 'line',
                        data: vmData.cyh.data.map(function (item) {
                            return item[1];
                        })
                    },
                    {
                        name: '李紫婷',
                        type: 'line',
                        data: vmData.lzt.data.map(function (item) {
                            return item[1];
                        })
                    },
                    {
                        name: '高秋梓',
                        type: 'line',
                        data: vmData.gqz.data.map(function (item) {
                            return item[1];
                        })
                    },
                    {
                        name: '刘人语',
                        type: 'line',
                        data: vmData.lry.data.map(function (item) {
                            return item[1];
                        })
                    }
                ]
            };
        var vm = new Vue({
            el: '#actual',
            data: {
                actual: data
            }
        });
        myChart.setOption(option);
    </script>
</html>