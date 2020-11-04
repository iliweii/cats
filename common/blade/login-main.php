<!-- script md5 js -->
<script src="./js/md5.js"></script>
<!-- script login js -->
<script src="./js/login.js"></script>
<title>登录你的CTAS验证器</title>
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

                    <!-- 登录 用户名输入窗体 -->
                    <div id="usernamePage" class="page" style="opacity: 0;">

                        <div class="form-title">登录</div>

                        <!-- 用户名 -->
                        <div class="form-group my-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">@</span>
                                </div>
                                <input type="text" id="username" class="form-control" placeholder="真实姓名" aria-label="真实姓名" aria-describedby="basic-addon1">
                            </div>
                            <div id="usernameFB" class="tips">
                                *仅用于身份验证，请输入真实姓名。
                            </div>
                        </div>

                        <!-- 提交按钮 -->
                        <button type="button" class="btn btn-success btn-block" id="GO1">
                            <span class="spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                            GO CATS
                        </button>

                    </div>

                    <!-- 登录 密码输入窗体 -->
                    <div id="passwordPage" class="page">

                        <p style="margin: 0;">
                            <button class="backBtn">
                                <img src="./img/arrow_left.svg" alt="⬅">
                            </button>
                            <span class="backSpan"></span>
                        </p>

                        <div class="form-title" style="margin-top: 0;">输入密码</div>

                        <!-- 密码 -->
                        <div class="form-group mt-3 mb-2">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="密码">
                                <div id="passwordFB" class="tips"></div>
                            </div>
                            <p><a href="#" class="text-primary ForgetPwd">忘记密码？</a></p>
                        </div>

                        <!-- 提交按钮 -->
                        <button type="button" class="btn btn-success btn-block" id="GO2">
                            <span class="spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                            GO CATS
                        </button>
                    </div>

                    <!-- 登录 邮箱输入窗体 -->
                    <div id="emailPage" class="page">

                        <p style="margin: 0;">
                            <button class="backBtn">
                                <img src="./img/arrow_left.svg" alt="⬅">
                            </button>
                            <span class="backSpan"></span>
                        </p>

                        <div class="form-title" style="margin-top: 0;">输入邮箱</div>

                        <!-- 邮箱 -->
                        <div class="form-group mt-3 mb-2">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="电子邮箱">
                                <div id="emailFB" class="tips"></div>
                            </div>
                            <p><small><a href="https://mail.redcountry.top/" target="_blank" class="text-primary">申请一个红红帝国邮箱</a></small></p>
                        </div>

                        <!-- 提交按钮 -->
                        <button type="button" class="btn btn-success btn-block" id="GO3">
                            <span class="spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                            GO CATS
                        </button>
                    </div>

                    <!-- 登录 邮箱激活界面 -->
                    <div id="verifyPage" class="page">

                        <p style="margin: 0;">
                            <button class="backBtn">
                                <img src="./img/arrow_left.svg" alt="⬅">
                            </button>
                            <span class="backSpan"></span>
                        </p>

                        <div class="form-title" style="margin-top: 0;">验证你的身份</div>

                        <!-- 提示文字 -->
                        <div class="form-group mt-3 mb-4">
                            <p class="text-dark">
                                我们刚才向 <span class="userEmail"></span> 发送了一个激活链接。请查看你的电子邮件中来自 Redcountry 帐户团队的邮件，然后点击进行账号激活操作。
                                <br>
                                若没收到，请检查邮件垃圾箱或广告邮件。
                            </p>
                        </div>

                        <!-- 提交按钮 -->
                        <button type="button" class="btn btn-success btn-block" id="GO4">
                            <span class="spinner-grow-sm loading" role="status" aria-hidden="true"></span>
                            GO CATS
                        </button>
                    </div>

                    <!-- 登录 错误界面 -->
                    <div id="errorPage" class="page">

                        <p style="margin: 0;">
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