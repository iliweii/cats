<!-- script main js -->
<script src="./js/main.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<title>操作系统专题 答案验证 小程序</title>
</head>

<body>
    <div class="main">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">姓名</th>
                    <th scope="col">会员等级</th>
                    <th scope="col">邮箱</th>
                    <th scope="col">次数</th>
                    <th scope="col">到期日期</th>
                    <th scope="col">是否激活</th>
                </tr>
            </thead>
            <tbody id="tbody">
                
            </tbody>
        </table>
    </div>
    <script>
        $.ajax({
            type: "POST",
            url: "/common/api.php",
            data: {
                op: "query_user"
            },
            success: function(e) {
                let users = JSON.parse(e)
                for (let i = 0; i < users.length; i++) {
                    user = users[i]
                    if (user[3] == 0) user[3] = "普通"
                    else if (user[3] == 1) user[3] = "白银"
                    else if (user[3] == 2) user[3] == "黄金"
                    if (user[7] == 0) user[7] = "未激活"
                    else if (user[7] == 1) user[7] = "已激活"
                    $("#tbody").append('\
                        <tr>\
                            <th scope="row">' + user[0] + '</th>\
                            <td>' + user[1] + '</td>\
                            <td>' + user[3] + '</td>\
                            <td>' + user[4] + '</td>\
                            <td>' + user[5] + '</td>\
                            <td>' + user[6] + '</td>\
                            <td>' + user[7] + '</td>\
                        </tr>\
                    ')
                }
            }
        })
    </script>

</body>

</html>