<div class="d-flex flex-row">
    <button type="submit" class="btn btn-primary mx-2 showBtn">展示参考答案</button>
    <button type="button" class="btn btn-success mx-2 resetBtn" onclick="window.location.reload()">重做</button>
</div>
<script>
    $(".showBtn").click(function() {
        let ownTime = $(".ownTime")
        let time = ownTime.text()
        time = Number.parseInt(time)
        if (time > 0) {
            time -= 1
            // 页面上展示次数直接减一
            ownTime.text(time)
            // 将数据保存到数据库
            $.ajax({
                type: "POST",
                url: "/common/api.php",
                data: {
                    op: "use_time",
                    username: "<?php echo $_COOKIE['username']; ?>",
                    ip: "<?php echo getIP(); ?>"
                }
            })
            // 查询数据库保证用户没有修改页面
            // 页面展示页面数据与数据库数据中较小的数据（数据库查询有延迟）
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
                        let dbtime = Number.parseInt(e)
                        $(".ownTime").text(dbtime)
                        // 如果没有次数
                        if (dbtime == 0) {
                            $(".ownTime").css("color", "red")
                            $("input").attr("readonly", true)
                            $("button").attr("readonly", true)
                        } else {
                            // 展示较小的数据
                            let stime = dbtime < time ? dbtime : time
                            ownTime.text(stime)
                        }
                    }
                },
                error: function() {
                    $("html").empty()
                    $("html").text("403 FORBIDDEN:身份验证错误")
                }
            })
        } else {
            ownTime.text(0)
            // TODO 展示充值界面
            VIPShow()
        }
    })
</script>