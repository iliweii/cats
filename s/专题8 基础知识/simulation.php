<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <title>专题8 基础知识 进行模拟测试！</title>

</head>

<body>

    <div class="main shadow p-5 rounded">

        <?php if (!empty($_COOKIE['username'])) { ?>
            <p>欢迎你，<?php echo $_COOKIE['username']; ?><a href="/index.php">主页</a></p>
        <?php } else { ?>
            <p>你好，
                <a href="/index.php">登录</a>
                系统可使用全部功能。</p>
        <?php } ?>

        <p><small>tips:模拟测试不能代表真实测试数据。优点在于连续测试并展示答案。</small></p>

        <p class="time">本题时间<span class="TIME">20</span>s</p>

        <div class="JDT1">
            <div class="JDT2"></div>
        </div>

        <div class="QUES py-5">

        </div>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

    <script>
        $.ajax({
            type: "POST",
            url: "/common/api.php",
            data: {
                op: "jczs"
            },
            success: function(e) {
                var ques = JSON.parse(e)
                ques.question = ques.question.replace(/(###)/, '\
                    <input type="text" class="YouANS form-control span-input">\
                ')
                $(".QUES").empty()
                $(".QUES").append('\
                    <p><small class="chapter">随机试题：章节' + ques.chapter + '</small></p>\
                    <p class="question"><strong>' + ques.question + '</strong></p>\
                    <button type="submit" class="GO btn btn-primary mx-2">确定</button>\
                    <button type="button" class="LOOKANS btn btn-success mx-2">看答案</button>\
                    <input type="text" class="TrueANS form-control span-input">\
                ')
                let set_interval = setInterval(() => {
                    $(".TIME").text(Number($(".TIME").text()) - 1)
                    $(".JDT2").css("width", Number($(".TIME").text()) * (100 / 20) + "%")
                    if ($(".TIME").text() == '0') {
                        clearInterval(set_interval)
                        showAns(ques)
                    }
                }, 1000);
                $(".YouANS").focus()
                $("body").on("click", ".GO", function() {
                    clearInterval(set_interval)
                    showAns(ques)
                })
                $("body").on("click", ".NEXT", function() {
                    location.reload()
                })
                $("body").on("click", ".LOOKANS", function() {
                    clearInterval(set_interval)
                    showAns(ques)
                })
                $('body').bind('keydown', ".YouANS", function(event) {
                    if (event.keyCode == "13") {
                        $(".GO").click()
                    }
                });
            }
        })

        function showAns(ques) {
            // 展示答案
            if ($(".YouANS").val() == ques.answer) {
                $(".YouANS").addClass("is-valid")
            } else {
                $(".YouANS").addClass("is-invalid")
            }
            $(".TrueANS").val(ques.answer)
            $(".GO").addClass("NEXT")
            $(".GO").text("下一题")
        }
    </script>

</body>

</html>