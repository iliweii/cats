<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <title>黑马程序员40期点名册</title>

    <link rel="stylesheet" href="./style.css">

</head>

<body>

    <div class="main shadow p-5 rounded">

        <div class="list-main">
            <div class="list-item">成员1</div>
            <div class="list-item">成员1</div>
        </div>

        <div class="list-bottom">
            <button class="go">点击</button>
        </div>

    </div>

    <script>
        window.onload = function() {
            $.ajax({
                type: "POST",
                url: "/common/api.php",
                data: {
                    op: "heima_list"
                },
                success: function(e) {
                    let list = JSON.parse(e)
                    $(".list-main").empty()
                    for (let i = 0; i < list.length; i++) {
                        $(".list-main").append(`<div class="list-item">${list[i][1]}</div>`)
                    }
                }
            })

            let flag = 1;
            let listInterval;
            $(".go").click(function() {
                let GO = $(".go")
                if (flag == 1) {
                    GO.addClass("go-active")
                    GO.text("停止")
                    flag = 0
                    listInterval = setInterval(getPeople, 150);
                } else {
                    GO.removeClass("go-active")
                    GO.text("点击")
                    flag = 1
                    clearInterval(listInterval);
                }
            })

        }

        function getPeople() {
            let length = $(".list-item").length
            let random = randomNum(0, length-1);
            $(".list-item").removeClass("active")
            $(".list-item").eq(random).addClass("active")
        }

        function randomNum(minNum, maxNum) {
            switch (arguments.length) {
                case 1:
                    return parseInt(Math.random() * minNum + 1, 10);
                    break;
                case 2:
                    return parseInt(Math.random() * (maxNum - minNum + 1) + minNum, 10);
                    break;
                default:
                    return 0;
                    break;
            }
        }
    </script>

</body>

</html>