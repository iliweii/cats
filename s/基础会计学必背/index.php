<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <title>基础会计学必背知识点</title>

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

        <p><small>tips:本基础知识不能代表《会计基础》全部知识点。仅供参考</small></p>

        <p class="time">本题时间<span class="TIME">30</span>s</p>

        <div class="JDT1">
            <div class="JDT2"></div>
        </div>

        <div class="QUES py-5">

        </div>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

    <script>
        let chapter = getQueryVariable("chapter")
        if (!chapter) {
            chapter = ""
        } else {
            $("title").text(chapter + "-基础会计学必背知识点")
        }
        $.ajax({
            type: "POST",
            url: "/common/api.php",
            data: {
                chapter: chapter,
                op: "acct"
            },
            success: function(e) {
                if (e == "empty") {
                    $(".QUES").empty()
                    $(".QUES").text("暂时没有本章的题目数据")
                    return
                }
                var ques = JSON.parse(e)
                ques.question = ques.question.replace(/(###)/, '\
                    <input type="text" class="YouANS form-control span-input">\
                ')
                $(".QUES").empty()
                $(".QUES").append('\
                    <p><small class="chapter">随机试题：' + ques.chapter + ques.section + ques.exampoint + '</small></p>\
                    <p class="question"><strong>' + ques.question + '</strong></p>\
                    <button type="submit" class="GO btn btn-primary mx-2">确定</button>\
                    <button type="button" class="LOOKANS btn btn-success mx-2">看答案</button>\
                    <input type="text" class="TrueANS form-control span-input">\
                ')
                let set_interval = setInterval(() => {
                    $(".TIME").text(Number($(".TIME").text()) - 1)
                    $(".JDT2").css("width", Number($(".TIME").text()) * (100 / 30) + "%")
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

        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == variable) {
                    return decodeURI(pair[1]);
                }
            }
            return (false);
        }
    </script>

</body>

</html>