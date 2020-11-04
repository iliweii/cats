<?php include_once $_SERVER['DOCUMENT_ROOT']."/common/filter.php"; ?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT']."/common/head.php"); ?>

    <?php
        $script_js = "main";
        include_once($_SERVER['DOCUMENT_ROOT']."/common/scriptjs.php");
    ?>

    <title>专题4 Clock 页面置换算法</title>
</head>

<body>

    <div class="main shadow p-5 rounded">
        <?php include_once("nav.php"); ?>

        <p>
            04. (10分)在请求分页系统中，假设系统为进程P分配了
            <input type="text" class="Frame form-control textinput span-input">
            个物理块(Frame)，页面(Page)
            <span class="input-group span-group">
                <input type="text" class="Page form-control textinput">
                <input type="text" class="Page form-control textinput">
                <input type="text" class="Page form-control textinput">
                <input type="text" class="Page form-control textinput">
                <input type="text" class="Page form-control textinput">
            </span>

            <small>(没有可不填，有几个填写几个)</small>
            已装入内存且访问为A为
            <span class="input-group span-group">
                <input type="text" class="Access form-control textinput">
                <input type="text" class="Access form-control textinput">
                <input type="text" class="Access form-control textinput">
                <input type="text" class="Access form-control textinput">
                <input type="text" class="Access form-control textinput">
            </span>

            <small>(没有可不填，有几个填写几个)</small>
            ；页面访问串(Referencec String)如下，采用
            <strong>Clock页面置换算法</strong>。
            说明：低物理地址优先；替换指针NF(Next Frame)开始指向
            <select class="form-control span-input textinput NF" style="width: 100px;">
                <option value="1">最高</option>
                <option value="0">最低</option>
            </select>
            地址的物理块。
        </p>
        <div class="input-group">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">

            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">

            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
            <input type="text" class="form-control Clock textinput">
        </div>
        <p>[1]. (6分)求缺页中断次数PF(Page-Faults)；</p>
        <p>[2]. (4分)求页面置换次数PR(Page-Replacements)；并给出依次被置换的页面Pages。（ 并给出最后主存中的界面P及访问位A(P-a) ）</p>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/submit.php"; ?>

        <p class="ml-2">解：[1].</p>
        <div class="d-flex flex-row ml-3 pb-1">
            <span>PR：</span>
            <span id="PR" class="ansarea">
                <span class="ansspan"></span>
            </span>
        </div>
        <div class="d-flex flex-row ml-3 pb-1">
            <span>PS：</span>
            <span id="PS" class="ansarea">
                <span class="ansspan"></span>
            </span>
        </div>
        <div class="d-flex flex-row">
            <span>RAM：</span>
            <span id="RAM" class="ansarea">
                <span class="RAMarea">
                    <span class="ansspan"></span>
                </span>
            </span>
        </div>
        <p class="ml-5">Page-Faults PF=<strong id="PF"></strong></p>
        <p class="ml-3">[2]. Page-Replacements PR=<strong id="PR2"></strong></p>
        <p class="ml-5">Pages to be replaced list: <strong id="List"></strong></p>
        <p class="ml-5">Pages P and access bit A：<strong id="List2"></strong></p>
        <p class="ml-5">List separator is comma(,).</p>
        <?php include_once($_SERVER['DOCUMENT_ROOT']."/common/warn.php"); ?>
    </div>


</body>

</html>