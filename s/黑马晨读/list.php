<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <title>黑马程序员 晨读单词列表</title>

</head>

<body>

    <div class="main shadow p-5 rounded">

        <?php if (!empty($_COOKIE['username'])) { ?>
            <p>Welcome,<?php echo $_COOKIE['username']; ?><a href="/index.php">HOME</a></p>
        <?php } else { ?>
            <p>Hello, you can
                <a href="/index.php">Log In</a>
                to the system to use all functions
            </p>
        <?php } ?>

        <p><small>tips:查看单词列表。</small></p>

        <?php include_once("nav.php"); ?>

        <div class="input-group mb-3">
            <input type="text" class="form-control search" placeholder="查找单词、音标、释义、学习日期" aria-label="查找单词、音标、释义、学习日期" aria-describedby="button-search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary dropdown-toggle study-date" type="button" data-toggle="dropdown" aria-expanded="false">学习日期</button>
                <div class="dropdown-menu date-list2">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-search">搜索</button>
            </div>
        </div>

        <table class="table table-sm">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">单词</th>
                    <th scope="col">音标</th>
                    <th scope="col">释义</th>
                    <th scope="col">学习日期</th>
                </tr>
            </thead>
            <tbody class="list-body"></tbody>
        </table>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

    <script>
        window.onload = function() {

            let date = getQueryVariable("date")
            if (date == false) {
                date = ""
            }

            let datep = getQueryVariable("date");
            if (datep == false) {
                datep = getNowFormatDate()
            }
            $(".datep").text(datep + "单词训练")

            $(".page-index").click(function() {
                window.location.replace("./index.php?date=" + datep)
            })
            $(".page-index2").click(function() {
                window.location.replace("./index2.php?date=" + datep)
            })
            $(".list-today").click(function() {
                window.location.replace("./list.php?date=" + getNowFormatDate())
            })

            $("body").on("click", ".word", function() {
                let index = $(".word").index(this)
                let word = $(".word").eq(index).text()
                var msg = new SpeechSynthesisUtterance(word);
                window.speechSynthesis.speak(msg);
            })

            let list = [];

            $(".search").keyup( function () {
                let k = $(".search").val()
                let l = []
                for (let i = 0; i < list.length; i++) {
                    if (list[i][1].indexOf(k) > -1 || list[i][2].indexOf(k) > -1 || list[i][3].indexOf(k) > -1 || list[i][4].indexOf(k) > -1) {
                        l[l.length] = list[i]
                    }
                }
                TableAppend(l)
            })

            $.ajax({
                type: "POST",
                url: "/common/api.php",
                data: {
                    op: "heima_chendu_list",
                    date: date
                },
                success: function(e) {
                    list = JSON.parse(e)
                    TableAppend(list)
                }
            })

            $.ajax({
                type: "post",
                url: "/common/api.php",
                data: {
                    op: "heima_chendu_datelist",
                },
                success: function(e) {
                    var datelist = JSON.parse(e)
                    $(".date-list2").empty()
                    for (let i = 0; i < datelist.length; i++) {
                        $(".date-list2").append(`<a class="dropdown-item" onclick='$(".search").val("${datelist[i]}")'>${datelist[i]}</a>`)
                    }
                    $(".date-list2").append(`<a class="dropdown-item" onclick='$(".search").val("")'>全部</a>`)
                    let k = $(".search").val()
                    let l = []
                    for (let i = 0; i < list.length; i++) {
                        if (list[i][1].indexOf(k) > -1 || list[i][2].indexOf(k) > -1 || list[i][3].indexOf(k) > -1 || list[i][4].indexOf(k) > -1) {
                            l[l.length] = list[i]
                        }
                    }
                }
            })
        }

        function TableAppend(list) {
            $(".list-body").empty()
            for (let i = 0; i < list.length; i++) {
                $(".list-body").append(`<tr>
                    <th scope="row">${i + 1}</th>
                    <td class="word">${list[i][1]}</td>
                    <td>${list[i][2]}</td>
                    <td>${list[i][3]}</td>
                    <td>${list[i][4]}</td>
                </tr>`)
            }
        }
    </script>

</body>

</html>