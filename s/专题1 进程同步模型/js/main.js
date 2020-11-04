window.onload = function () {

    var Process1
    var Process2

    $(".Process1").bind('input propertychange', function () {
        Process1 = $(".Process1").val()
        $("._process1").text(Process1)
        for (let i = 1; i <= $(".__process1").length; i++) {
            $(".__process1").eq(i - 1).text(Process1 + i)
        }
    })
    $(".Process2").bind('input propertychange', function () {
        Process2 = $(".Process2").val()
        $("._process2").text(Process2)
        for (let i = 1; i <= $(".__process2").length; i++) {
            $(".__process2").eq(i - 1).text(Process2 + i)
        }
    })

    var Semaphore1
    var Semaphore2

    $(".Semaphore1").bind('input propertychange', function () {
        Semaphore1 = $(".Semaphore1").val()
        $(".semaphore1").text(Semaphore1)
    })
    $(".Semaphore2").bind('input propertychange', function () {
        Semaphore2 = $(".Semaphore2").val()
        $(".semaphore2").text(Semaphore2)
    })

    var Shared1
    var Shared2
    var Shared3

    $(".Shared1").bind('input propertychange', function () {
        Shared1 = $(".Shared1").val()
        $(".shared1").text(Shared1)
    })
    $(".Shared2").bind('input propertychange', function () {
        Shared2 = $(".Shared2").val()
        $(".shared2").text(Shared2)
    })
    $(".Shared3").bind('input propertychange', function () {
        Shared3 = $(".Shared3").val()
        $(".shared3").text(Shared3)
    })

    $(".showBtn").click(function () {
        let P3 = $(".Process3").val()
        let P4 = $(".Process4").val()
        let processName = new Array(Process1, Process2)
        let priority = 0
        if (P3 == Process2) {
            priority = 1
        }
        let processExpressionArrayA = new Array()
        for (let i = 0; i < $(".Process1s").length; i++) {
            processExpressionArrayA[i] = $(".Process1s").eq(i).val()
        }
        let processExpressionArrayB = new Array()
        for (let i = 0; i < $(".Process2s").length; i++) {
            processExpressionArrayB[i] = $(".Process2s").eq(i).val()
        }
        let initVariableValueStrArr = new Array()
        initVariableValueStrArr[0] = Semaphore1 + "=" + $(".Semaphore1-val").val()
        initVariableValueStrArr[1] = Semaphore2 + "=" + $(".Semaphore2-val").val()
        initVariableValueStrArr[2] = Shared1 + "=" + $(".Shared1-val").val()
        initVariableValueStrArr[3] = Shared2 + "=" + $(".Shared2-val").val()
        initVariableValueStrArr[4] = Shared3 + "=" + $(".Shared3-val").val()
        let preemptive = $(".Preemptive").val()
        $.ajax({
            type: "POST",
            url: "/common/api.php",
            data: {
                op: "jctbmx",
                json: JSON.stringify({
                    processName: processName,
                    priority: priority,
                    processExpressionArrayA: processExpressionArrayA,
                    processExpressionArrayB: processExpressionArrayB,
                    initVariableValueStrArr: initVariableValueStrArr,
                    preemptive: preemptive,
                })
            },
            success: function (e) {
                let res = JSON.parse(e)
                let order = res["order"]
                let initialization = res["initialization"]
                let values = res["values"]
                // 展示第一问答案
                $(".Order-area").empty()
                for (let i = 0; i < order.length; i++) {
                    $(".Order-area").append('\
                        <span class="order">' + order[i] + '</span>\
                    ')
                }
                // 展示第二问答案
                $("#ansBody").empty()
                showAns("Instruction", [
                    $(".Shared1-val").val(),
                    $(".Shared2-val").val(),
                    $(".Shared3-val").val()
                ])
                for (let i = 0; i < values.length; i++) {
                    showAns(initialization[i], values[i])
                }
                showAns("Final Value:", values[values.length - 1])
            }
        })
    })

    function showAns(Instruction, values) {
        $("#ansBody").append('\
            <tr>\
                <td>' + Instruction + '</td>\
                <td>' + values[0] + '</td>\
                <td>' + values[1] + '</td>\
                <td>' + values[2] + '</td>\
            </tr>\
        ')
    }
}