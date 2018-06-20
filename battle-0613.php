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
</style>
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
echo "<h3>6月13日18:00 黑白人格Battle 数据实时更新表</h3>";
echo "<table><thead><tr><th>后援会</th><th>当前金额</th><th>参与人数</th><th>总笔数</th><th>人均</th><th>笔均</th></tr></thead><tbody>";
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
    echo "<td>".$data->data->owner->nickname."</td>";
    echo "<td>".$data->data->fundingdto->saleamount."元</td>";
    echo "<td>".$people[0]."人</td>";
    echo "<td>".$data->data->paystock."笔</td>";
    echo "<td>".round($data->data->fundingdto->saleamount/$people[0], 2)."元/人</td>";
    echo "<td>".round($data->data->fundingdto->saleamount/$data->data->paystock, 2)."元/笔</td>";
    // $saleamount = explode("saleamount",$page_content,1);
    // echo $saleamount[0]."<br>";
    // echo $page_content;
    $err = curl_error($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo $err;
    curl_close($ch);
    echo "</tr>";
}
echo '<p>ps：增加了人均和笔均计算。</p><p>微博@杨文清Blake</a> | 一枚彩虹糖</p>';
?>