window.onload = function () {

    // 定义常量
    var name = "#username"
    var pwd = "#password"
    var pwd2 = "#password2"
    var email = "#email"
    var namePage = "#usernamePage"
    var pwdPage = "#passwordPage"
    var emailPage = "#emailPage"
    var verifyPage = "#verifyPage"
    var errorPage = "#errorPage"
    var tip1 = "*仅用于身份验证，请输入真实姓名。"
    var tip2 = "*姓名不能为空！请重新输入姓名。"
    var tip3 = "*密码不能为空！请重新输入密码。"
    var tip4 = "*电子邮箱不能为空！请重新输入电子邮箱。"
    var tip5 = "*电子邮件格式不正确"
    var tip6 = "*这个电子邮件已经被注册过了，换一个吧。"
    var tip7 = "*密码错误。请重试。"
    var tip8 = "*密码长度应至少为6位。"
    var tip9 = "*两次输入的密码不一致。"
    var APIURL = "./common/api.php"

    // 初始化用户名，邮箱
    var username, useremail
    // 初始化密码
    var password
    // 初始化入场动画
    if ($(namePage).length) {
        setTimeout(() => {
            $(namePage).css("opacity", 1)
        }, 200);
        $(namePage).addClass("active")

        $(pwd).keyup(function () {
            DefultValid(pwd, '')
        })

        $(".backBtn").click(function () {
            let index = $(".backBtn").index(this)
            if (index == 0)
                NextPage(pwdPage, namePage, '+')
            else if (index == 1)
                NextPage(emailPage, namePage, '+')
            else if (index == 2)
                NextPage(verifyPage, namePage, '+')
            else if (index == 3) {
                NextPage(errorPage, namePage, '+')
            }
        })
    } else {
        setTimeout(() => {
            $(pwdPage).css("opacity", 1)
        }, 200);
        $(pwdPage).addClass("active")

        $(pwd).keyup(function () {
            if ($(pwd).val().length < 6) {
                InValid(pwd, tip8)
            } else {
                Valid(pwd, '')
                password = $(pwd).val()
            }
            if ($(pwd).val() != $(pwd2).val()) {
                InValid(pwd2, tip9)
            }
        })
        $(pwd2).keyup(function () {
            if ($(pwd2).val().length == 0) {
                true
            } else if ($(pwd).val() != $(pwd2).val()) {
                InValid(pwd2, tip9)
            } else if ($(pwd).val() == $(pwd2).val()) {
                Valid(pwd2, '')
            }
        })

        $(".backBtn").click(function () {
            let index = $(".backBtn").index(this)
            if (index == 0)
                NextPage(errorPage, pwdPage, '+')
        })

        // 检查用户激活状态
        $.ajax({
            type: "POST",
            url: APIURL,
            data: {
                op: "is_verify",
                email: getQueryVariable("email")
            },
            success: function (e) {
                if (e == "empty_value") {
                    NextPage(pwdPage, errorPage, '-')
                } else if (e == "verified") {
                    // 用户已经验证过，直接跳转主页面
                    window.location.replace("./")
                }
            },
            error: function () {
                NextPage(pwdPage, errorPage, '-')
            }
        })
    }

    $("#GO1").click(function () {
        if ($(name).val().length == 0) {
            InValid(name, tip2)
            return
        }
        $('.loading').eq(0).addClass("spinner-border")
        $("#GO1").attr("disabled", true)
        username = $(name).val()
        $(".backSpan").text(username)
        $.ajax({
            type: "POST",
            url: APIURL,
            data: {
                op: "login",
                username: username
            },
            success: function (e) {
                if (e == "empty_username") {
                    // 姓名为空
                    InValid(name, tip2)
                } else if (e == "empty_password") {
                    // 密码为空
                    NextPage(namePage, pwdPage, '-')
                } else if (e == "wrong_verify" || e == "insert_username") {
                    // 用户未激活
                    // 若已设置邮件，则为修改密码情况，跳转验证界面
                    $.ajax({
                        type: "POST",
                        url: APIURL,
                        data: {
                            op: "get_email",
                            username: username
                        },
                        success: function (e) {
                            if (chkEmail(e)) {
                                NextPage(namePage, verifyPage, '-')
                            } else {
                                NextPage(namePage, emailPage, '-')
                            }
                        }
                    })
                } else if (e == "error_username" || e == "error" || e) {
                    // 出现了一些错误
                    NextPage(namePage, errorPage, '-')
                }
                $('.loading').eq(0).removeClass("spinner-border")
                $("#GO1").attr("disabled", false)
            },
            error: function () {
                // 出现了一些错误
                NextPage(namePage, errorPage, '-')
            }
        })
    })

    $("#GO2").click(function () {
        if ($(pwd).val().length == 0) {
            InValid(pwd, tip3)
            return
        }
        $('.loading').eq(1).addClass("spinner-border")
        $("#GO2").attr("disabled", true)
        password = $(pwd).val()
        $.ajax({
            type: "POST",
            url: APIURL,
            data: {
                op: "login",
                username: username,
                password: password
            },
            success: function (e) {
                if (e == "empty_username") {
                    InValid(pwd, tip2)
                } else if (e == "empty_password") {
                    InValid(pwd, tip3)
                } else if (e == "success") {
                    // 用户名密码正确
                    setCookie("username", username, 7)
                    setCookie("hash", md5(md5(password)), 7)
                    // 延时跳转界面
                    let url = getQueryVariable("url")
                    setTimeout(() => {
                        if (!url)
                            window.location.href = "./"
                        else
                            window.location.replace("http://" + url)
                    }, 400);
                } else if (e == "wrong_password") {
                    // 密码错误
                    InValid(pwd, tip7)
                } else if (e == "error" || e) {
                    // 出现错误
                    NextPage(pwdPage, errorPage, '-')
                }
                $('.loading').eq(1).removeClass("spinner-border")
                $("#GO2").attr("disabled", false)
            },
            error: function () {
                NextPage(pwdPage, errorPage, '-')
            }
        })
    })

    $("#GO3").click(function () {
        if ($(email).val().length == 0) {
            InValid(email, tip4)
            return
        }
        $('.loading').eq(2).addClass("spinner-border")
        $("#GO3").attr("disabled", true)
        useremail = $(email).val()
        $(".userEmail").text(useremail)
        $.ajax({
            type: "POST",
            url: APIURL,
            data: {
                op: "bind_email",
                username: username,
                email: useremail
            },
            success: function (e) {
                if (e == "empty_username") {
                    InValid(email, tip2)
                } else if (e == "empty_email") {
                    InValid(email, tip4)
                } else if (e == "repeat_email") {
                    // 邮箱地址重复
                    InValid(email, tip6)
                } else if (e == "bind_success") {
                    // 成功绑定邮箱
                    // 发送邮件
                    $.ajax({
                        type: "POST",
                        url: APIURL,
                        data: {
                            op: "send_email",
                            userEmail: useremail
                        },
                        success: function (e) {
                            NextPage(emailPage, verifyPage, '-')
                        }
                    })
                } else if (e == "bind_error" || e) {
                    // 出现问题
                    NextPage(emailPage, errorPage, '-')
                }
                $('.loading').eq(2).removeClass("spinner-border")
                $("#GO3").attr("disabled", false)
            },
            error: function (e) {
                NextPage(emailPage, errorPage, '-')
                $('.loading').eq(2).removeClass("spinner-border")
                $("#GO3").attr("disabled", false)
            }
        })
    })

    $("#GO4").click(function () {
        var strs = new Array()
        strs = useremail.split("@")
        let emailweb = "http://mail." + strs[1]
        window.open(emailweb)
    })

    $("#GO5").click(function () {
        if ($(pwd).val().length == 0) {
            InValid(pwd, tip3)
            return
        } else if ($(pwd).val().length < 6) {
            InValid(pwd, tip8)
            return
        } else if ($(pwd).val() != $(pwd2).val()) {
            InValid(pwd2, tip9)
            return
        }
        $('.loading').eq(0).addClass("spinner-border")
        $("#GO5").attr("disabled", true)
        // 先判断用户是否激活，已激活跳转主界面，未激活进行下一步
        $.ajax({
            type: "POST",
            url: APIURL,
            data: {
                op: "is_verify",
                email: getQueryVariable("email"),
                verify: true
            },
            success: function (e) {
                if (e == "empty_value") {
                    NextPage(pwdPage, errorPage, '-')
                } else if (e == "verified") {
                    // 用户已经验证过，直接跳转主页面
                    window.location.replace("./")
                } else if (e == "verify_success") {
                    // 账户验证成功
                    // 调用密码修改接口
                    $.ajax({
                        type: "POST",
                        url: APIURL,
                        data: {
                            op: "set_password",
                            password: password,
                            email: getQueryVariable("email")
                        },
                        success: function (e) {
                            if (e == "empty_password" || e == "empty_value") {
                                NextPage(pwdPage, errorPage, '-')
                            } else if (e == "set_pwd_success") {
                                // 密码设置成功
                                setCookie("hash", md5(md5(password)), 7)
                                // 跳转界面
                                window.location.href = "./"
                            } else if (e == "set_pwd_error" || e) {
                                NextPage(pwdPage, errorPage, '-')
                            }
                        }
                    })
                } else if (e == "verify_error" || e) {
                    // 账户验证失败
                    NextPage(pwdPage, errorPage, '-')
                }
                $('.backSpan').text("返回重试")
                $('.loading').eq(0).removeClass("spinner-border")
                $("#GO5").attr("disabled", false)
            },
            error: function () {
                NextPage(pwdPage, errorPage, '-')
            }
        })
    })

    // 忘记密码
    $(".ForgetPwd").click(function () {
        // 将用户激活状态置0，并发送设置密码邮件
        $.ajax({
            type: "POST",
            url: APIURL,
            data: {
                op: "deactivate",
                username: username
            },
            success: function (e) {
                if (e == "set_success") {
                    $.ajax({
                        type: "POST",
                        url: APIURL,
                        data: {
                            op: "get_email",
                            username: username
                        },
                        success: function (e) {
                            if (e == "empty_value" || e == "empty_email") {
                                NextPage(pwdPage, errorPage, '-')
                            } else if (chkEmail(e)) {
                                // 发送邮件
                                $.ajax({
                                    type: "POST",
                                    url: APIURL,
                                    data: {
                                        op: "send_email",
                                        userEmail: e
                                    },
                                    success: function () {
                                        NextPage(pwdPage, verifyPage, '-')
                                    }
                                })
                            } else {
                                NextPage(pwdPage, errorPage, '-')
                            }
                        }
                    })
                } else if (e == "empty_value" || e == "set_error" || e) {
                    NextPage(pwdPage, errorPage, '-')
                }
            },
            error: function () {
                NextPage(pwdPage, errorPage, '-')
            }
        })
    })



    $(name).keyup(function () {
        DefultValid(name, tip1)
    })

    $(email).keyup(function () {
        if ($(email).val().length == 0) {
            InValid(email, tip4)
        } else if (chkEmail($(email).val())) {
            Valid(email, '')
        } else {
            InValid(email, tip5)
        }
    })

    /**
     * 输入框错误标记
     * @param {string} name 输入框选择器字符串 
     * @param {string} tip 错误提示信息
     */
    function InValid(name, tip) {
        $(name).removeClass("is-valid")
        $(name).addClass("is-invalid")
        name += "FB"
        $(name).removeClass("valid-feedback")
        $(name).addClass("invalid-feedback")
        $(name).text(tip)
    }

    /**
     * 输入框正确标记
     * @param {string} name 输入框选择器字符串 
     * @param {string} tip 正确提示信息
     */
    function Valid(name, tip) {
        $(name).removeClass("is-invalid")
        $(name).addClass("is-valid")
        name += "FB"
        $(name).removeClass("invalid-feedback")
        $(name).addClass("valid-feedback")
        $(name).text(tip)
    }

    /**
     * 输入框默认标记
     * @param {string} name 输入框选择器字符串
     * @param {string} tip 默认提示信息
     */
    function DefultValid(name, tip) {
        $(name).removeClass("is-invalid")
        name += "FB"
        $(name).removeClass("invalid-feedback")
        $(name).text(tip)
    }

    /**
     * 页面切换
     * @param {string} page1 要移动的界面选择器字符串
     * @param {string} page2 要显示的界面选择器字符串
     * @param {char} d 字符 +表示向前移动 -表示向后移动
     */
    function NextPage(page1, page2, d) {
        $(page1).css({ "left": d + "150%" })
        $(page2).css({ "left": 0 })
        $(page1).removeClass("active")
        $(page2).addClass("active")
    }

    /**
     * 检查邮箱格式是否正确
     * @param {email} email 邮箱
     * @return {boolean} 返回一个布尔值 
     */
    function chkEmail(email) {
        reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/
        return reg.test(email)
    }

    /**
     * 设置COOKIE
     * @param {string} cname cookie名字
     * @param {string} cvalue cookie值
     * @param {int} exdays 有效天数
     */
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    /**
     * 获取GET传值
     * @param {string} variable GET名字
     * @return {string} GET名字对应的值
     * @return {boolean} false
     */
    function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            if (pair[0] == variable) {
                return pair[1];
            }
        }
        return (false);
    }
}

