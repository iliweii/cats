window.onload = function () {

    var APIURL = "/common/api.php"

    // 登出按钮点击事件
    $(".LogoutBtn").click(function () {
        setCookie("username", "", 0)
        setCookie("hash", "", 0)
        window.location.reload()
    })

    // 初始化会员等级
    $.ajax({
        type: "POST",
        url: APIURL,
        data: {
            op: "get_vip",
            username: getCookie("username")
        },
        success: function (e) {
            let res = JSON.parse(e)
            $(".VIPClass").text(res['text'])
            if (res['vip'] != 0) {
                $(".userop").append('\
                    <li class="useropitem">\
                        <p class="Deadline">会员有效日期至<br>' + res['deadline'] + '</p>\
                    </li>\
                ')
            }
        }
    })

    // 修改密码按钮点击事件
    $(".SetPassword").click(function () {
        // 将用户激活状态置0，打开设置密码界面
        $.ajax({
            type: "POST",
            url: APIURL,
            data: {
                op: "deactivate",
                username: getCookie("username")
            },
            success: function (e) {
                if (e == "set_success") {
                    setCookie("hash", "", 0)
                    $.ajax({
                        type: "POST",
                        url: APIURL,
                        data: {
                            op: "get_email",
                            username: getCookie("username")
                        },
                        success: function (e) {
                            setCookie("username", "", 0)
                            if (chkEmail(e)) {
                                window.location.replace("/index.php?verify=on&email=" + e + "&hash=true")
                            }
                        }
                    })
                }
            }
        })
    })

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
     * 获取COOKIE值
     * @param {string} cname cookie名字
     * @return {string} cookie值
     * @return "" 无此cookie返回值
     */
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
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
}