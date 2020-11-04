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
            let index = Memory.length;
            Memory[index] = new Object();
            if ($(".Page").eq(i).val().length != 0) {
                Memory[index].page = Number.parseInt($(".Page").eq(i).val());
            }
            if ($(".Access").eq(i).val().length != 0) {
                Memory[index].access = Number.parseInt($(".Access").eq(i).val());
            }
        }
        // 初始化指针NF初始位置 0 最低 1 最高
        var NF = 0;
        // 获取用户选择的NF位置
        NF = Number.parseInt($(".NF").eq(0).val());
        // 如果出于最高位，初始化为物理块最下面
        if (NF)
            NF = Frame - 1;
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
        // 开始Clock算法
        for (let i = 0; i < PS.length; i++) {
            // 当前访问页
            let page = PS[i];
            // 判断当前访问页是否存在内存中
            let flag = 0;
            let flagi = 0;
            for (let j = 0; j < Memory.length; j++) {
                if (Memory[j].page == page) {
                    flag = 1;
                    flagi = j;
                    break;
                }
            }
            // 若存在，则把访问位 置*，即=1
            if (flag) {
                Memory[flagi].access = 1;
            }
            // 若不存在，判断NF指针位置，访问位是否为1或0
            else {
                while (true) {
                    // 如果该位置不为空，并且访问位为1
                    if (Memory[NF].page != undefined && Memory[NF].access == 1) {
                        // 访问位置0，指针下移，直到遇见不可替换项
                        Memory[NF].access = 0;
                        // 指针下移
                        // 指针位于最高位，置于最低位（0）
                        if (NF + 1 < Frame)
                            NF += 1;
                        else NF = 0;
                        // 继续循环
                        continue;
                    }
                    // 否则，如果访问位为0，进行替换
                    else if (Memory[NF].access == 0) {
                        // 置换信息插入PR数组
                        PR[i] = Memory[NF].page;
                        // 更新内存page和访问位 置1
                        Memory[NF].page = page;
                        Memory[NF].access = 1;
                    }
                    // 否则，内存位置为空，直接替换
                    else {
                        // 更新内存page和访问位 置1
                        Memory[NF].page = page;
                        Memory[NF].access = 1;
                    }
                    // 把内存结果计入RAM数组
                    RAM[i] = JSON.parse(JSON.stringify(Memory));
                    // 指针下移
                    // 指针位于最高位，置于最低位（0）
                    if (NF + 1 < Frame)
                        NF += 1;
                    else NF = 0;
                    // 跳出循环
                    break;
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
                PR2 ++;
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
                if (RAM[i][j].page == undefined) {
                    $(".RAMarea").eq(i).append('<span class="ansspan"></span>');
                } else {
                    $(".RAMarea").eq(i).append('<span class="ansspan">' + RAM[i][j].page + '</span>');
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
        $("#List").text($("#List").text().slice(0,$("#List").text().length-1));
        // 界面打印List2
        let list2 = Memory;
        for (let i = 0; i < list2.length; i++) {
            $("#List2").append(list2[i].page + "-" + list2[i].access + ",");
        }
        $("#List2").text($("#List2").text().slice(0,$("#List2").text().length-1));

    })

}
