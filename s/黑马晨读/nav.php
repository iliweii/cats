
<div style="display: flex;" class="my-2">
    <button type="button" class="btn mx-2 btn-outline-danger page-index2">英译中</button>
    <button type="button" class="btn mx-2 btn-outline-warning page-index">中译英</button>
    <button type="button" class="btn mx-2 btn-outline-info" onclick="window.location.replace('./index.php')">回到今日</button>

    <div class="dropdown">
        <button class="btn btn-outline-success dropdown-toggle datep" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
            今日单词训练
        </button>

        <div class="dropdown-menu date-list" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </div>
    <button type="button" class="btn mx-2 btn-outline-info list-today">今日单词表</button>
    <button type="button" class="btn mx-2 btn-outline-success" onclick="window.location.replace('./list.php')">全部单词表</button>

    <script>
        $.ajax({
            type: "post",
            url: "/common/api.php",
            data: {
                op: "heima_chendu_datelist",
            },
            success: function(e) {
                var datelist = JSON.parse(e)
                $(".date-list").empty()
                let pathname = window.location.pathname;
                
                for(let i = 0; i < datelist.length; i++) {
                    $(".date-list").append(`<a class="dropdown-item" href="${pathname}?date=${datelist[i]}">${datelist[i]}</a>`)
                }

                $(".date-list").append(`<a class="dropdown-item" href="${pathname}?date=all">全部</a>`)
            }
        })

        function getNowFormatDate() {
            var date = new Date();
            var seperator1 = "-";
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var strDate = date.getDate();
            if (month >= 1 && month <= 9) {
                month = "0" + month;
            }
            if (strDate >= 0 && strDate <= 9) {
                strDate = "0" + strDate;
            }
            var currentdate = year + seperator1 + month + seperator1 + strDate;
            return currentdate;
        }
        function getQueryVariable(variable)
        {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                    var pair = vars[i].split("=");
                    if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }
    </script>
</div>