<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <?php
    // $script_js = "scan";
    // include_once($_SERVER['DOCUMENT_ROOT'] . "/common/scriptjs.php");
    ?>

    <title>专题9 考研选择题</title>
</head>

<body>

    <div class="main shadow p-5 rounded">

        <div class="BAitem">
            <strong>BA-1</strong>
            <p><strong><span style="font-size: 14pt">　&nbsp;&nbsp;<em>EAT = α x λ + ( t + λ )( 1 - α ) + t</em></span></strong></p>
            <p><em><span style="font-size: 14pt"><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= 2t + λ - t x α</strong></span></em></p>
            <ul>
                <li>EAT：CPU存取一个数据时的有效访问时间</li>
                <li>λ ：一次访问快表的时间</li>
                <li>α ：从快表中能找到所需页表项的概率</li>
                <li>t ：一次访问内存的时间</li>
            </ul>
        </div>

        <div class="BAitem">
            <strong>BA-2</strong>
            <p><strong>不</strong>发生死锁 最<strong>多</strong>R1类资源X求法：<strong><em>PX&gt;=R && P(X-1)&lt;R</em></strong></p>
            <p><strong>不</strong>发生死锁 最<strong>少</strong>R1类资源R求法：<strong><em>R=P(X-1)+1</em></strong></p>
            <p>&nbsp; &nbsp;发生死锁 最<strong>少</strong>R1类资源X求法：<strong><em>P(X-1)&gt;R && P(X-2)&lt;=R</em></strong></p>
            <p>&nbsp; &nbsp;发生死锁 最<strong>多</strong>R1类资源R求法：<strong><em>R=P(X-1)</em></strong></p>
            <ul>
                <li>P：并发进程数</li>
                <li>R：R1类资源数</li>
                <li>X：每个进程需要的R1类资源数</li>
            </ul>
        </div>


        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

</body>

</html>