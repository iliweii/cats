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

            $(".page-index").click(function () {
                window.location.replace("./index.php?date=" + datep)
            })
            $(".page-index2").click(function () {
                window.location.replace("./index2.php?date=" + datep)
            })
            $(".list-today").click(function () {
                window.location.replace("./list.php?date=" + getNowFormatDate())
            })

            $.ajax({
                type: "POST",
                url: "/common/api.php",
                data: {
                    op: "heima_chendu_list",
                    date: date
                },
                success: function(e) {
                    let list = JSON.parse(e)
                    $(".list-body").empty()
                    for (let i = 0; i < list.length; i++) {
                        $(".list-body").append(`<tr>
                            <th scope="row">${i + 1}</th>
                            <td>${list[i][1]}</td>
                            <td>${list[i][2]}</td>
                            <td>${list[i][3]}</td>
                            <td>${list[i][4]}</td>
                        </tr>`)
                    }
                    
                }
            })
        }
    </script>

</body>

</html>