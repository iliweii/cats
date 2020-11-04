// 全部变量定义

// 当页面加载完成时执行以下代码
window.onload = function () {
    // 给Ta Ts 输入框绑定输入事件
    $(".textinput").bind('input propertychange', function () {
        // 获取当前输入框索引
        let index = $(".textinput").index(this);
        // 判断如果长度超过2，自动将下一个输入框聚焦
        if ($(".textinput").eq(index).val().length >= 1) {
            $(".textinput").eq(index + 1).focus();
        } else if ($(".textinput").eq(index).val().length == 0) {
            // 否则如果长度等于0，自动将上一个输入框聚焦
            $(".textinput").eq(index - 1).focus();
        }
    })

    // 点击展示参考答案按钮事件
    $(".showBtn").click(function () {
        // 初始化访问页数组
        var pages = new Array();
        // 获取用户输入的访问页，并写入数组
        for (let i = 0; i < $(".Clock").length; i++) {
            if ($(".Clock").eq(i).val().length != 0) {
                pages[pages.length] = Number.parseInt($(".Clock").eq(i).val());
            }
        }
        // 初始化物理块数
        var Frame = 0;
        // 获取用户输入的物理块数
        Frame = Number.parseInt($(".Frame").eq(0).val());
        // 初始化内存
        var Memory = new Array();
        // 获得用户输入的已装入内存和访问位
        for (let i = 0; i < Frame; i++) {
            if ($(".Page").eq(i).val().length != 0) {
                Memory[Memory.length] = Number.parseInt($(".Page").eq(i).val());
            }
        }
        // 初始化结果答案数组
        var PR = new Array();
        var PS = new Array();
        var RAM = new Array();
        // 向PS数组中填充数据并打印
        $("#PS").empty();
        for (let i = 0; i < pages.length; i++) {
            PS[PS.length] = pages[i];
            $("#PS").append('<span class="ansspan">' + pages[i] + '</span>');
        }
        // 开始LRU算法
        for (let i = 0; i < PS.length; i++) {
            // 当前访问页
            let page = PS[i];
            // 判断当前访问页是否存在内存中
            let flag = 0;
            for (let j = 0; j < Memory.length; j++) {
                if (Memory[j] == page) {
                    flag = 1;
                    break;
                }
            }
            // 若不存在
            if (!flag) {
                // 如果内存中仍有空位
                if (Memory.length < Frame) {
                    // 将该访问页放入内存中
                    Memory[Memory.length] = page;
                    // 内存信息记录在RAM数组
                    RAM[i] = JSON.parse(JSON.stringify(Memory));
                }
                // 否则向前遍历查找并标记
                else {
                    // 定义一个标记数组
                    let LRUflag = new Array();
                    // 向前循环查找并标记
                    for (let j = i; j >= 0; j--) {
                        let index = $.inArray(PS[j], Memory);
                        if (index != -1) {
                            LRUflag[index] = j;
                        }
                    }

                    // 替换已经不使用的page
                    let isflag = 0;
                    for (let j = 0; j < Frame; j++) {
                        if (LRUflag[j] == undefined) {
                            // 替换信息记录在PR数组
                            PR[i] = Memory[j];
                            // 替换该page
                            Memory[j] = page;
                            // 内存信息记录在RAM数组
                            RAM[i] = JSON.parse(JSON.stringify(Memory));
                            // 标记
                            isflag = 1;
                            break;
                        }
                    }
                    // 如果前面没有替换，这里对最远未使用的进行替换
                    if (!isflag) {
                        let temparr = new Array();
                        for (let j = 0; j < Memory.length; j++) {
                            temparr[j] = new Object();
                            temparr[j].page = Memory[j];
                            temparr[j].flag = 0;
                        }
                        for (let j = i - 1; j >= 0; j--) {
                            let flags = 0;
                            for (let k = 0; k < temparr.length; k++) {
                                if (temparr[k].page == PS[j]) {
                                    temparr[k].flag = 1;
                                    break;
                                }
                            }
                            for (let k = 0; k < temparr.length; k++) {
                                flags += temparr[k].flag;
                            }
                            if (flags == Frame - 1) {
                                break;
                            }
                        }
                        for (let k = 0; k < temparr.length; k++) {
                            if (temparr[k].flag == 0) {
                                // 要替换的界面
                                // 替换信息记录在PR数组
                                PR[i] = temparr[k].page;
                                // 替换该page
                                Memory[k] = page;
                                // 内存信息记录在RAM数组
                                RAM[i] = JSON.parse(JSON.stringify(Memory));
                                // 标记
                                isflag = 1;
                                break;
                            }
                        }
                    }
                }
            }
        }
        // 初始化PR2
        var PR2 = 0;
        // 打印PR数组
        $("#PR").empty();
        for (let i = 0; i < pages.length; i++) {
            if (PR[i] != undefined) {
                $("#PR").append('<span class="ansspan">' + PR[i] + '</span>');
                // PR2自增
                PR2++;
            }
            else
                $("#PR").append('<span class="ansspan"></span>');
        }
        // 打印RAM数组
        $("#RAM").empty();
        // 先生成空RAM列
        for (let i = 0; i < pages.length; i++) {
            $("#RAM").append('<span class="RAMarea"></span>')
            for (let j = 0; j < Frame; j++) {
                $(".RAMarea").eq(i).append('<span class="ansspan"></span>');
            }
        }
        // 初始化PF
        var PF = 0;
        // 填充数据
        for (let i in RAM) {
            // 先清空本元素
            $(".RAMarea").eq(i).empty();
            // 界面打印数据
            for (let j = 0; j < Frame; j++) {
                if (RAM[i][j] == undefined) {
                    $(".RAMarea").eq(i).append('<span class="ansspan"></span>');
                } else {
                    $(".RAMarea").eq(i).append('<span class="ansspan">' + RAM[i][j] + '</span>');
                }
            }
            // PF自增
            PF++;
        }
        // 界面打印PF
        $("#PF").text(PF);
        // 界面打印PR2
        $("#PR2").text(PR2);
        // 界面打印PR List
        for (let i = 0; i < pages.length; i++) {
            if (PR[i] != undefined) {
                $("#List").append(PR[i] + ",");
            }
        }
        $("#List").text($("#List").text().slice(0, $("#List").text().length - 1));

    })

}
