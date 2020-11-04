<?php

// $username = $_COOKIE['username'];
// $ip = getIP2();
// $url = "/api.php";
// $data = [
//     "op" => "get_time",
//     "username" => $username,
//     "ip" => $ip
// ];
// $time = post_url($url, $data);


// if ((int)$time > 0) {
?>
    <script src="./js/<?php echo $script_js; ?>.js"></script>
<?php
// }

/**
 * 返回用户访问网站的ip地址
 * @return str ip地址
 */
function getIP2()
{
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}


/**
 * 模拟POST提交
 * @param string $url 地址
 * @param string $data 提交的数据
 * @return string 返回结果
 */
function post_url($url, $data)
{
    $headers = [
        "Content-Type: application/x-www-form-urlencoded"
    ];
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 模拟用户使用的浏览器
    //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    //curl_setopt($curl, CURLOPT_AUTOREFERER, 1);  // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1);       // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));  // Post提交的数据包x
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);     // 设置超时限制 防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0);      // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        // echo 'Errno' . curl_error($curl); //捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}

?>