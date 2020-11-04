<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/filter.php"; ?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <?php
    $script_js = "scan";
    include_once($_SERVER['DOCUMENT_ROOT'] . "/common/scriptjs.php");
    ?>

    <title>专题5 SCAN 磁盘算法</title>
</head>

<body>

    <div class="main shadow p-5 rounded">
        <?php include_once("nav.php"); ?>

        <p>
            05. (10分)设系统已完成某进程对
            <input type="text" class="Track0 form-control textinput span-input">
            #磁道的访问请求，正在为访问
            <input type="text" class="Track1 form-control textinput span-input">
            #磁道的请求者服务，还有若干进程在等待服务，他们依次请求访问的磁道号队列(FIFO)如下：
        </p>
        <div class="input-group">
            <?php for ($i = 0; $i < 24; $i++) { ?>
                <input type="text" class="form-control Track textinput">
            <?php } ?>
        </div>
        <p>[1]. (5分)采用<strong>SCAN（Elevator Algorithm）</strong>磁盘调度算法时，写出磁道访问序列；</p>
        <p>[2]. (5分)计算平均寻道长度ASL（Average Seek Length）。（保留两位小数）</p>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/submit.php"; ?>

        <p class="ml-2">解：[1]. 磁道访问序列如下：（List separator is comma(,).）</p>
        <div class="d-flex flex-row ml-3 pb-1 font-weight-bold">
            <div>
                <div>
                    <span class="track0"></span>#->
                    <span class="track1"></span>#,
                </div>
                <div class="TrackDri">(磁道方向)</div>
            </div>
            <span class="Tracks"></span>
        </div>

        <p class="ml-3">[2]. (5分)计算平均寻道长度ASL（Average Seek Length）。（保留两位小数）</p>
        <div class="d-flex flex-row ml-3 pb-1 font-weight-bold">
            <div>ASL=</div>
            <div class="ASL">
                <div class="ASLT text-center"></div>
                <div class="ASLM"></div>
                <div class="ASLB text-center"></div>
            </div>
        </div>
        <div class="d-flex flex-row ml-3 pb-1 font-weight-bold">
            <div class="ml-4">=</div>
            <div class="ASLans"></div>
        </div>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>
    </div>


</body>

</html>