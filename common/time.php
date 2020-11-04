<h6 class="ownTimeArea">
    您的今天剩余使用次数：
    <span class="ownTime">0</span>
    次
    <a href="/index.php?timeinfo=true" class="timeinfo">
        <span class="wenhao">?</span>
        次数说明
    </a>
    <style>
        .timeinfo {
            font-size: 14px;
            padding: 0 16px;
        }

        .wenhao {
            display: inline-block;
            width: 14px;
            height: 14px;
            text-align: center;
            line-height: 14px;
            border: dodgerblue solid 1px;
            border-radius: 20px;
        }
    </style>
</h6>

<!-- vip-center -->
<div class="vip-center">
    <div class="vip-bg"></div>
    <div class="vip-main">
        <div class="vip-qr">
            <div class="vip-qrcode"></div>
            <p class="vip-menoy text-danger"></p>
            <small class="vip-tip"></small>
            <small class="vip-die"></small>
        </div>
        <div class="vip-select">
            <div class="vip-baiyin vip-class active">
                <h3 class="vip-title">白银会员</h3>
                <ul class="vip-list">
                    <li>最快更新最新专题算法</li>
                    <li>每天20次使用次数</li>
                </ul>
            </div>
            <div class="vip-huangjin vip-class">
                <h3 class="vip-title">黄金会员</h3>
                <ul class="vip-list">
                    <li>最快更新最新专题算法</li>
                    <li>每天无限制次使用次数</li>
                </ul>
            </div>
        </div>
    </div>
    <style>
        .vip-center {
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: -10;
            opacity: 0;
            transform: scale(0);
            overflow: hidden;
            transition: 400ms;
        }

        .vip-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .vip-main {
            width: 500px;
            height: 350px;
            background-color: rgba(255, 255, 255, 0.8);
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .vip-qr {
            width: 150px;
            height: auto;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            flex-direction: column;
        }

        .vip-qrcode {
            width: 100%;
            min-height: 150px;
        }

        .vip-select {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-direction: column;
            height: 100%;
        }

        .vip-select>.active {
            background-color: aliceblue;
            box-shadow: rgba(0, 0, 0, 0.5) 0 0 5px 1px;
        }

        .vip-class {
            cursor: pointer;
            padding: 5px 20px;
            transition: 400ms;
            border: rgba(0, 0, 0, 0.5) solid 1px;
            background-color: whitesmoke;
        }

        .vip-class:hover {
            box-shadow: rgba(0, 0, 0, 0.5) 0 0 5px 1px;
        }

        .vip-title {
            font-size: 22px;
            font-family: "YouYuan";
        }

        .vip-list {
            font-size: 14px;
        }
        @media screen and (max-width: 700px) {
            .vip-main {
                width: 100%;
                flex-direction: column-reverse;
                height: 60%;
            }
            .vip-select {
                flex-direction: row;
                width: 80%;
            }
            .vip-class {
                width: 45%;
            }
        }
    </style>

</div>

<script src="/js/jquery.qrcode.min.js"></script>
<script>
    $.ajax({
        type: "POST",
        url: "/common/api.php",
        data: {
            op: "get_time",
            username: "<?php echo $_COOKIE['username']; ?>",
            ip: "<?php echo getIP(); ?>"
        },
        success: function(e) {
            if (e == "empty_value" || e == "get_error") {
                $("html").empty()
                $("html").text("403 FORBIDDEN:身份验证错误")
            } else {
                let time = Number.parseInt(e)
                $(".ownTime").text(time)
                // 如果没有次数
                if (time == 0) {
                    $(".ownTime").css("color", "red")
                    $("input").attr("readonly", true)
                    $("button").attr("readonly", true)
                }
            }
        },
        error: function() {
            $("html").empty()
            $("html").text("403 FORBIDDEN:身份验证错误")
        }
    })
    $(".VIPBtn").click(function() {
        VIPShow()
        QRShow(1)
    })
    $(".vip-baiyin").click(function() {
        QRswitch("baiyin")
        QRShow(1)
    })
    $(".vip-huangjin").click(function() {
        QRswitch("huangjin")
        QRShow(2)
    })

    Date.prototype.format = function(fmt) {
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        }
        for (var k in o) {
            if (new RegExp("(" + k + ")").test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ?
                    (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            }
        }
        return fmt;
    }

    function QRShow(pay_class) {
        var date = new Date()
        date.setMinutes(date.getMinutes() + 90)
        let deadline = date.format("hh:mm:ss")
        $(".vip-qrcode").empty()
        $.ajax({
            type: "POST",
            url: "/common/f2fpay/qrpay_test.php",
            data: {
                class: pay_class,
                username: "<?php echo $_COOKIE['username'] ?>"
            },
            success: function(e) {
                let res = JSON.parse(e)
                if (res["code"] == "10000") {
                    let outTradeNo = res["out_trade_no"]
                    let qrCode = res["qr_code"]
                    $(".vip-qrcode").qrcode({
                        width: 150,
                        height: 150,
                        text: qrCode
                    });
                    $(".vip-tip").text("")
                    if (pay_class == 1) {
                        // $(".vip-menoy").text("支付宝￥" + "内测价0.01")
                        $(".vip-menoy").text("支付宝￥" + "9.99")
                    } else if (pay_class == 2) {
                        $(".vip-menoy").text("支付宝￥" + "14.99")
                    }
                    $(".vip-die").text("二维码将于" + deadline + "过期，支付成功请刷新界面")
                } else {
                    $(".vip-tip").text("付款二维码加载失败！")
                    $(".vip-die").text("错误码：" + res["code"])
                }
            },
            error: function() {
                $(".vip-main").empty()
                $(".vip-main").text("出错了，刷新一下吧");
            }
        })
    }

    function QRswitch(select) {
        $(".vip-class").removeClass("active")
        $(".vip-" + select).addClass("active")
        $(".vip-tip").text("付款二维码加载中...")
        $(".vip-menoy").text("")
        $(".vip-qrcode").attr("src", "")
        $(".vip-die").text("")
    }

    /**展示会员中心界面 */
    function VIPShow() {
        $(".vip-center").css({
            "z-index": 1000,
            "opacity": 1,
            "transform": "scale(1)"
        })
        $(".vip-bg").click(function() {
            $(".vip-center").css({
                "z-index": -10,
                "opacity": 0,
                "transform": "scale(0)"
            })
        })
        $(".vip-tip").text("付款二维码加载中...")
    }
</script>

<?php

/**
 * 返回用户访问网站的ip地址
 * @return str ip地址
 */
function getIP()
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

?>