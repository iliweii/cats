window.onload = function () {
    $(".Need").attr("readonly", true)
    $(".Available").attr("readonly", true)
    $(".Process").attr("readonly", true)
    $(".Work").attr("readonly", true)
    $(".Need").attr("readonly", true)
    $(".Allocation2").attr("readonly", true)
    $(".Need2").attr("readonly", true)
    $(".WA").attr("readonly", true)
    $(".Finish").attr("readonly", true)

    $(".showBtn").click(function () {
        var Resource = new Array();
        var Max = new Array();
        var Allocation = new Array();
        for (let i = 0; i < $(".Resource").length; i++) {
            Resource[i] = $(".Resource").eq(i).val()
        }
        for (let i = 0; i < $(".Max").length; i++) {
            Max[i] = $(".Max").eq(i).val()
        }
        for (let i = 0; i < $(".Allocation").length; i++) {
            Allocation[i] = $(".Allocation").eq(i).val()
        }
        $.ajax({
            type: "POST",
            url: "/common/api.php",
            data: {
                op: "yhjsf",
                json: JSON.stringify({
                    resource: Resource,
                    max: Max,
                    allocation: Allocation
                })
            },
            success: function (e) {
                console.log(e)
                let res = JSON.parse(e)
                let Need = res['need']
                for (let i = 0; i < Need.length; i++) {
                    $(".Need").eq(i).val(Need[i])
                }
                let Available = res['available']
                for (let i = 0; i < Available.length; i++) {
                    $(".Available").eq(i).val(Available[i])
                }
                let Process = res['process']
                for (let i = 0; i < Process.length; i++) {
                    $(".Process").eq(i).val(Process[i])
                }
                let Work = res['work']
                for (let i = 0; i < Work.length; i++) {
                    $(".Work").eq(i).val(Work[i])
                }
                let Need2 = res['need2']
                for (let i = 0; i < Need2.length; i++) {
                    $(".Need2").eq(i).val(Need2[i])
                }
                let Allocation2 = res['allocation']
                for (let i = 0; i < Allocation2.length; i++) {
                    $(".Allocation2").eq(i).val(Allocation2[i])
                }
                let WA = res['wa']
                for (let i = 0; i < WA.length; i++) {
                    $(".WA").eq(i).val(WA[i])
                }
                let Finish = "true"
                for (let i = 0; i < $(".Finish").length; i++) {
                    $(".Finish").eq(i).val(Finish)
                }
                $("#Safe").text("safe")
                for (let i = 0; i < Process.length; i++) {
                    $("#List").append(Process[i] + ",");
                }
                $("#List").text($("#List").text().slice(0, $("#List").text().length - 1));
            },
            error: function (e) {
                console.log(e)
            }
        })
    })
}