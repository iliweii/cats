<!-- script md5 js -->
<script src="./js/md5.js"></script>
<!-- script login js -->
<script src="./js/login.js"></script>
<title>激活你的CTAS验证器</title>
</head>

<body>

    <section class="body">
        <div class="inner">

            <div class="form rounded-lg" id="Form">

                <div class="form-icon">
                    <img src="./img/CATS.ico">
                    <span class="lead">CATS验证器</span>
                </div>

                <div class="pages">

                    <!-- 激活 密码输入窗体 -->
                    <div id="passwordPage" class="page" style="opacity: 0;">

                        <div class="form-title">创建账户密码</div>

                        <!-- 密码 -->
                        <div class="form-group mt-3 mb-2">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="设置新密码">
                                <div id="passwordFB" class="tips"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password2" placeholder="再次输入">
                                <div id="password2FB" class="tips"></div>
                            </div>
                        </div>

                        <!-- 提交按钮 -->
                        <button type="button" class="btn btn-success btn-block" id="GO5">
                            <span class="spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                            GO CATS
                        </button>
                    </div>

                    <!-- 登录 错误界面 -->
                    <div id="errorPage" class="page">

                        <p>
                            <button class="backBtn">
                                <img src="./img/arrow_left.svg" alt="⬅">
                            </button>
                            <span class="backSpan"></span>
                        </p>

                        <div class="form-title" style="margin-top: 0;">出错了！</div>

                        <!-- 提示文字 -->
                        <div class="form-group mt-3 mb-5">
                            <p class="text-dark">
                                发生了一些错误，再试一次吧。
                            </p>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>

</body>

</html>