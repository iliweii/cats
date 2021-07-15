<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <title>黑马程序员 晨读单词 中译英</title>

</head>

<body>

    <div class="main shadow p-5 rounded">

        <?php if (!empty($_COOKIE['username'])) { ?>
            <p>Welcome,<?php echo $_COOKIE['username']; ?><a href="/index.php">HOME</a></p>
        <?php } else { ?>
            <p>Hello, you can
                <a href="/index.php">Log In</a>
                to the system to use all functions</p>
        <?php } ?>

        <p><small>tips: 快速高强度记忆单词！加油</small></p>

        <?php include_once("nav.php"); ?>

        <p class="time">Question Time<span class="TIME">20</span>s</p>

        <div class="JDT1">
            <div class="JDT2"></div>
        </div>

        <div class="QUES py-5">

        </div>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

    <script>
        window.onload = function () {

            let datep = getQueryVariable("date");
            if (datep == false) {
                datep = getNowFormatDate()
            }
            $(".datep").text(datep + "单词训练")

            $(".page-index").click(function () {
                window.location.replace("./index.php?date=" + datep)
            })
            $(".page-index2").click(function () {
                window.location.replace("./index2.php?date=" + datep)
            })
            $(".list-today").click(function () {
                window.location.replace("./list.php?date=" + getNowFormatDate())
            })

            if (datep == "all") {
                datep = ""
            }

            $.ajax({
                type: "POST",
                url: "/common/api.php",
                data: {
                    op: "heima_chendu",
                    date: datep
                },
                success: function(e) {
                    var eng = JSON.parse(e)
                    $(".QUES").empty()
                    $(".QUES").append('\
                        <p class="question">中文<strong> ' + eng.mean +
                        '<small>[' + eng.yinbiao + ']</small>  </strong>\
                        对应的英文应该是<input type="text" class="YouANS form-control span-input"></p>\
                        <button type="submit" class="GO btn btn-primary mx-2">确定</button>\
                        <button type="button" class="LOOKANS btn btn-success mx-2">看答案</button>\
                        <span class="TrueANS form-control span-input" style="width: auto;"></span>\
                    ')
                    let set_interval = setInterval(() => {
                        $(".TIME").text(Number($(".TIME").text()) - 1)
                        $(".JDT2").css("width", Number($(".TIME").text()) * (100 / 20) + "%")
                        if ($(".TIME").text() == '0') {
                            clearInterval(set_interval)
                            showAns(eng)
                        }
                    }, 1000);
                    $(".YouANS").focus()
                    $("body").on("click", ".GO", function() {
                        clearInterval(set_interval)
                        showAns(eng)
                    })
                    $("body").on("click", ".NEXT", function() {
                        location.reload()
                    })
                    $("body").on("click", ".LOOKANS", function() {
                        clearInterval(set_interval)
                        showAns(eng)
                    })
                    $('body').bind('keydown', ".YouANS", function(event) {
                        if (event.keyCode == "13") {
                            $(".GO").click()
                        }
                    });
                }
            })
        }

        function showAns(eng) {
            // 展示答案
            if ($(".YouANS").val() == eng.word) {
                $(".YouANS").addClass("is-valid")
            } else {
                $(".YouANS").addClass("is-invalid")
            }
            $(".TrueANS").text(eng.word)
            $(".GO").addClass("NEXT")
            $(".GO").text("下一题")
        }
    </script>

</body>

</html>