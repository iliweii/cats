// 全部变量定义

// 定义进程名称
var process = new Array("P1", "P2", "P3", "P4", "P5");
// 定义时间片大小
var q = 4;

// 当页面加载完成时执行以下代码
window.onload = function () {
    // 给Ta Ts 输入框绑定输入事件
    $(".Tinput").bind('input propertychange', function () {
        // 获取当前输入框索引
        let index = $(".Tinput").index(this);
        // 判断如果长度超过2，自动将下一个输入框聚焦
        if ($(".Tinput").eq(index).val().length >= 2) {
            $(".Tinput").eq(index + 1).focus();
        } else if ($(".Tinput").eq(index).val().length == 0) {
            // 否则如果长度等于0，自动将上一个输入框聚焦
            $(".Tinput").eq(index - 1).focus();
        }
    })
    // 点击展示参考答案按钮事件
    $(".showBtn").click(function () {
        // 初始化到达时间数组
        var arrivalTime = new Array();
        // 获取用户输入的到达时间，并写入数组
        for (let i = 0; i < $(".Ta").length; i++) {
            arrivalTime[i] = Number.parseInt($(".Ta").eq(i).val());
        }
        // 初始化服务时间数组
        var serviceTime = new Array();
        // 获取用户输入的服务时间，并写入数组
        for (let i = 0; i < $(".Ts").length; i++) {
            serviceTime[i] = Number.parseInt($(".Ts").eq(i).val());
        }
        // 获取用户输入的时间片大小
        q = Number.parseInt($(".q").eq(0).val());
        // 初始化G1 G2 数组
        var G1 = new Array(0);
        var G2 = new Array();
        // 进程个数
        var processCount = 5;
        // 初始化队列
        var queue = new Array();
        // 总服务时间
        var allServicaTime = 0;
        // 队列新增到达时间、服务时间属性
        for (let i = 0; i < processCount; i++) {
            let thisprocess = new Object();
            thisprocess.name = process[i];
            thisprocess.arrivalTime = arrivalTime[i];
            thisprocess.serviceTime = serviceTime[i];
            allServicaTime += serviceTime[i];
            // 剩余服务时间
            thisprocess.remainServiceTime = serviceTime[i];
            // 进程入队
            queue[queue.length] = thisprocess;
        }
        // 时间片大小
        var timeSlice = q;
        // 就绪队列，存放 待运行的进程
        var mReadyQueue = new Array();
        // 存放 到达时间未到的进程
        var mUnreachQueue = JSON.parse(JSON.stringify(queue));
        // 执行完毕的进程队列
        var mExecutedQueue = new Array();
        var mTotalWholeTime = 0.0;
        var mTotalWeightWholeTime = 0.0;

        // 第一个进程执行
        mReadyQueue[mReadyQueue.length] = mUnreachQueue.shift();
        let currProcess = mReadyQueue.shift();
        // 开始执行
        let currTime = 0;
        G1[0] = 0;

        if (currProcess.remainServiceTime - timeSlice <= 0) {
            // 当前进程在这个时间片内能执行完毕
            G1[G1.length] = currTime += currProcess.remainServiceTime;
            G2[G2.length] = currProcess.name;
            currProcess.finishTime = currTime;
            currProcess.remainServiceTime = 0;
            // 对周转时间进行计算
            currProcess.wholeTime = currProcess.finishTime - currProcess.arrivalTime;
            // 对带权周转时间进行计算
            currProcess.weightWholeTime = currProcess.wholeTime / (currProcess.serviceTime);
            mTotalWholeTime += currProcess.wholeTime;
            mTotalWeightWholeTime += currProcess.weightWholeTime;
            mExecutedQueue[mExecutedQueue.length] = currProcess;
        } else {
            // 不能执行完毕
            G1[G1.length] = currTime += timeSlice;
            G2[G2.length] = currProcess.name;
            currProcess.remainServiceTime = currProcess.remainServiceTime - timeSlice;
        }

        while (mReadyQueue.length != 0 || mUnreachQueue.length != 0) {
            // 把所有到达时间 到达的进程加入 运行队列 头部
            while (mUnreachQueue.length != 0) {
                if (mUnreachQueue[0].arrivalTime <= currTime) {
                    mReadyQueue[mReadyQueue.length] = mUnreachQueue.shift();
                } else {
                    break;
                }
            }

            if (currProcess.remainServiceTime > 0)
                mReadyQueue[mReadyQueue.length] = currProcess;
            // 运行队列不为空时
            if (mReadyQueue.length != 0) {
                currProcess = mReadyQueue.shift();
                if (currProcess.remainServiceTime - timeSlice <= 0) {
                    // 当前进程在这个时间片内能执行完毕
                    G1[G1.length] = currTime += currProcess.remainServiceTime;
                    G2[G2.length] = currProcess.name;
                    currProcess.finishTime = currTime;
                    currProcess.remainServiceTime = 0;
                    // 对周转时间进行计算
                    currProcess.wholeTime = currProcess.finishTime - currProcess.arrivalTime;
                    // 对带权周转时间进行计算
                    currProcess.weightWholeTime = currProcess.wholeTime / (currProcess.serviceTime);
                    mTotalWholeTime += currProcess.wholeTime;
                    mTotalWeightWholeTime += currProcess.weightWholeTime;
                    mExecutedQueue[mExecutedQueue.length] = currProcess;
                } else {
                    // 不能执行完毕
                    G1[G1.length] = currTime += timeSlice;
                    G2[G2.length] = currProcess.name;
                    currProcess.remainServiceTime = currProcess.remainServiceTime - timeSlice;
                }
            } else {
                // 当前没有进程执行，但还有别的进程为到达，时间直接跳转转到到达时间
                currTime = mUnreachQueue[0].arrivalTime;
            }
        }

        if (G1[G1.length - 1] < allServicaTime) {

            if (currProcess.remainServiceTime - timeSlice <= 0) {
                // 当前进程在这个时间片内能执行完毕
                G1[G1.length] = currTime += currProcess.remainServiceTime;
                G2[G2.length] = currProcess.name;
                currProcess.finishTime = currTime;
                currProcess.remainServiceTime = 0;
                // 对周转时间进行计算
                currProcess.wholeTime = currProcess.finishTime - currProcess.arrivalTime;
                // 对带权周转时间进行计算
                currProcess.weightWholeTime = currProcess.wholeTime / (currProcess.serviceTime);
                mTotalWholeTime += currProcess.wholeTime;
                mTotalWeightWholeTime += currProcess.weightWholeTime;
                mExecutedQueue[mExecutedQueue.length] = currProcess;
            } else {
                // 不能执行完毕
                G1[G1.length] = currTime += timeSlice;
                G2[G2.length] = currProcess.name;
                currProcess.remainServiceTime = currProcess.remainServiceTime - timeSlice;
            }
        }

        // 清空区域
        $("#G1").empty();
        $("#G2").empty();
        // 展示问题一答案
        for (let i = 0; i < G2.length; i++) {
            $("#G2").append('<span class="q1ib">' + G2[i] + '</span>');
        }
        for (let i = 0; i < G1.length; i++) {
            $("#G1").append('<span class="q1i">' + G1[i] + '</span>');
        }

        // 展示问题二答案
        for (let i = 0; i < mExecutedQueue.length; i++) {
            let a = mExecutedQueue[i];
            $(".pname").eq(i).text(a.name);
            $(".finishTime").eq(i).text(a.finishTime);
            $(".arrivalTime").eq(i).text(a.arrivalTime);
            $(".turnaroundTime").eq(i).text(a.wholeTime);
            $(".serviceTime").eq(i).text(a.serviceTime);
            $(".wr").eq(i).text(xiaoshu(a.weightWholeTime, 3));
        }
        $("#avgT").text(xiaoshu(mTotalWholeTime / processCount, 2));
        $("#avgW").text(xiaoshu(mTotalWeightWholeTime / processCount, 2));

    })
}

function xiaoshu(params, i) {
    let newpar = parseFloat(params);
    let reg = /^[0-9]+.?[0-9]*$/;
    if (reg.test(newpar)) {
        let newNum = newpar.toFixed(i);
        return newNum;
    }
}