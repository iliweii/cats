<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <title>英语六级单词记忆 英译中</title>

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

        <p><small>tips:功能仅限于记忆英语六级考试单词。</small></p>

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
        $.ajax({
            type: "POST",
            url: "/common/api.php",
            data: {
                op: "eng6"
            },
            success: function(e) {
                var eng = JSON.parse(e)
                let mean = eng.mean
                let mean_r = mean.replace(/\([^\)]*\)/g, '')
                let mean_arr = mean_r.split(',')
                eng.list = mean_arr
                $(".QUES").empty()
                $(".QUES").append('\
                    <p class="question">The word<strong> ' + eng.word +
                    '<small>[' + eng.part + ']</small>  </strong>\
                    means<input type="text" class="YouANS form-control span-input"></p>\
                    <button type="submit" class="GO btn btn-primary mx-2">SUBMIT</button>\
                    <button type="button" class="LOOKANS btn btn-success mx-2">ANSWER</button>\
                    <input type="text" class="TrueANS form-control span-input">\
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

        function showAns(eng) {
            // 展示答案
            if (in_array($(".YouANS").val(), eng.list)) {
                $(".YouANS").addClass("is-valid")
            } else {
                $(".YouANS").addClass("is-invalid")
            }
            $(".TrueANS").val(eng.mean)
            $(".GO").addClass("NEXT")
            $(".GO").text("NEXT")
        }

        function in_array(stringToSearch, arrayToSearch) {
            for (s = 0; s < arrayToSearch.length; s++) {
                thisEntry = arrayToSearch[s].toString();
                if (thisEntry == stringToSearch) {
                    return true;
                }
            }
            return false;
        }
    </script>

</body>

</html>