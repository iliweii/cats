<body>
    <div class="main">
        <h3 class="main-title">
            操作系统专题 答案验证 小程序 次数说明
        </h3>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>

        <ul class="timeinfo-ul">
            <li class="timeinfo-item">1. 基础条件：非会员用户每天享受一次免费试用次数；白银会员用户每天享受20次使用次数；黄金会员每天享受(999)无限制使用次数。</li>
            <li class="timeinfo-item">2. IP限制：同一IP下，用户使用次数以最低账户的次数计算。例如：你的浏览器已经登录了非会员账户（1次使用次数），再登录其他会员账号，使用次数仍然只有1次，并影响其他账户的正常使用。所以建议使用本人账户登录本平台。</li>
            <li class="timeinfo-item">3. 升级说明：已开通白银会员用户续费黄金会员，会员级别自动由白银会员升级为黄金会员。已开通黄金会员用户，续费白银会员，会员等级会降为白银等级。</li>
            <li class="timeinfo-item font-weight-bold">4. 出现异常？今日剩余次数出现异常？次数突然变0？有可能与其他使用者IP地址冲突，请更换WiFi或热点即可。</li>
            <li class="timeinfo-itme">5. 咨询问题：如有使用问题，充值问题，或者反馈意见等请加QQ <strong>2096116064</strong>  。</li>
        </ul>

        <style>
            .timeinfo-ul {
                width: 80%; margin: 0 auto; padding: 50px 0;
            }
            .timeinfo-item {
                padding-bottom: 20px;
            }
        </style>
        
        <?php include_once("./common/warn.php") ?>
    </div>

</body>

</html>