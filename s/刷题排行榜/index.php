<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>
    <?php
    $script_js = "canvas";
    include_once($_SERVER['DOCUMENT_ROOT'] . "/common/scriptjs.php");
    ?>
    <title>刷题排行榜</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        #chartContainer {
            width: 100%;
            height: calc(100vh - 50px);
        }
    </style>

</head>

<body>

    <div id="chartContainer"></div>

    <script type="text/javascript">
        $.ajax({
            type: "POST",
            url: "/common/api.php",
            data: {
                op: "get_list"
            },
            success: function(str) {
                let list = JSON.parse(str)
                let list_num = list.length
                for(let i = 0; i < list_num; i++) {
                    list[i][2] = Number.parseInt(list[i][2])
                }
                for(let i = 0; i < list_num; i++) {
                    for (let j = 0; j < list_num - i - 1; j++) {
                        if (list[j][2] > list[j+1][2]) {
                            let temp = list[j]
                            list[j] = list[j+1]
                            list[j+1] = temp
                        }
                    }
                }
                let dataPoints = new Array()
                for (let i = 0; i < list_num; i++) {
                    dataPoints[i] = new Object()
                    dataPoints[i].label = list[i][1]
                    dataPoints[i].y = list[i][2]
                }
                new CanvasJS.Chart('chartContainer', {
                    theme: 'theme4', //主题
                    animationEnabled: true,
                    title: {
                        text: "刷题排行榜TOP" + list_num
                    },
                    data: [{
                        // 数据
                        type: "bar",
                        dataPoints: dataPoints
                    }]
                }).render();
            },
            error: function(str) {
                console.log("请求失败：");
                console.log(JSON.parse(JSON.stringify(str)));
                alert("请求失败：" + JSON.stringify(str));
            }
        });
    </script>

</body>

</html>