<!-- script main js -->
<script src="./js/main.js"></script>
<title>操作系统专题 答案验证 小程序</title>
</head>

<body>
    <div class="main">
        <h3 class="main-title">
            操作系统专题 答案验证 小程序
            <input type="checkbox" class="userbox" id="userBox">
            <div class="userinfo">
                <label class="userbutton" for="userBox">设置</label>
                <ul class="userop">
                    <li class="useropitem">
                        <a href="#" class="LogoutBtn">退出登录</a>
                    </li>
                    <li class="useropitem">
                        <a href="#" class="SetPassword">修改密码</a>
                    </li>
                    <li class="useropitem">
                        <a href="#" class="VIPBtn0">会员中心</a>
                    </li>
                    <li class="useropitem">
                        <p class="VIPClass">您还不是会员</p>
                    </li>
                </ul>
            </div>
        </h3>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/tips.php"; ?>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>

        <div class="main-content">
            <?php
            foreach ($dirs as $dir) {
                if (strcmp(".", $dir) == 0 || strcmp("..", $dir) == 0) {
                    continue;
                }
            ?>
                <div class="m-2 pl-3 main-item">
                    <a href="<?php echo $s . $dir; ?>" target="_blank">
                        <img src="<?php echo $s . $dir; ?>/img/show.jpg" class="s-bg">
                        <p><?php echo $dir; ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php include_once("./common/warn.php") ?>
    </div>

</body>

</html>