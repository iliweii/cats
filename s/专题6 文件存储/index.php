<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/filter.php"; ?>
<?php
$url_agree = "./database/0";
$url_disagree = "./database/1";
$file_agree = file($url_agree)[0];
$agree = (int)$file_agree;
$file_disagree = file($url_disagree)[0];
$disagree = (int)$file_disagree;
if (isset($_GET['agree'])) {
    if (strcmp($_GET['agree'], '0') == 0) {
        $agree += 1;
        $file = fopen($url_agree, "w");
        fwrite($file, (string)$agree);
        fclose($file);
    } else {
        $disagree += 1;
        $file = fopen($url_disagree, "w");
        fwrite($file, (string)$disagree);
        fclose($file);
    }
    header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>

    <?php
    // $script_js = "scan";
    // include_once($_SERVER['DOCUMENT_ROOT'] . "/common/scriptjs.php");
    ?>

    <title>专题6 文件存储</title>
</head>

<body>

    <div class="main shadow p-5 rounded">

        <div class="agree">
            <div>这个专题这么简单还需要做一个算法吗？</div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary" onclick="window.location.replace('./?agree=0')">做一个！<?php echo '+' . (string)$agree ?></button>
                <button type="button" class="btn btn-secondary" onclick="window.location.replace('./?agree=1')">太简单不需要<?php echo '+' . (string)$disagree ?></button>
            </div>
        </div>

        <p>
            06.(10分)设混合索引文件索引节点(i_node)中有
            <strong>N(N=N1+N2+N3)</strong>
            个地址项，其中
            <strong>N1</strong>
            个地址项为直接地址索引，
            <strong>N2</strong>
            个地址项是一级间接地址索引，
            <strong>N3</strong>
            个地址项是二级间接地址索引，每个地址项大小为
            <strong>D</strong>
            Byte(磁盘ID占
            <strong>X</strong>
            位)。若磁盘索引块和磁盘数据块大小均为
            <strong>S</strong>
            Byte。
        </p>
        <p>[1]. 求全部地址索引可表示的单个文件最大长度MaxL；</p>
        <p>[2]. 求该文件系统支持的最大分区长度MaxPartition。</p>

        <?php // include_once $_SERVER['DOCUMENT_ROOT'] . "/common/submit.php"; 
        ?>

        <p class="ml-2 font-weight-bold">解：[1]. Results Note: K=1024，M=1024K，G=1024M</p>
        <div class="d-flex flex-row ml-4 pb-1 font-weight-bold">
            L0=<span class="bg-light p-1">L0*S</span><small class="ml-2">(这里把变量替换为具体数值)</small>
            =<span class="bg-light p-1">&emsp;</span><small class="ml-2">(这里计算并带单位)</small>
            <strong>(Byte)</strong>
        </div>
        <div class="d-flex flex-row ml-4 pb-1 font-weight-bold">
            L1=<span class="bg-light p-1">L1*S/D*S</span><small class="ml-2">(这里把变量替换为具体数值)</small>
            =<span class="bg-light p-1">&emsp;</span><small class="ml-2">(这里计算并带单位)</small>
            <strong>(Byte)</strong>
        </div>
        <div class="d-flex flex-row ml-4 pb-1 font-weight-bold">
            L2=<span class="bg-light p-1">L1*S/D*S/D*S</span><small class="ml-2">(这里把变量替换为具体数值)</small>
            =<span class="bg-light p-1">&emsp;</span><small class="ml-2">(这里计算并带单位)</small>
            <strong>(Byte)</strong>
        </div>
        <div class="d-flex flex-row ml-3 font-weight-bold">
            MaxL=<span class="bg-light p-1">L0+L1+L2</span>
        </div>
        <div class="d-flex flex-row ml-4 pb-1 font-weight-bold">
            =<span class="bg-light p-1">&emsp;</span><small class="ml-2">(这里填写上面计算的三个值以+连接的表达式)</small>
            <strong>(Byte)</strong>
        </div>


        <p class="ml-2 font-weight-bold">[2]. 求该文件系统支持的最大分区长度MaxPartition。</p>
        <div class="d-flex flex-row ml-3 pb-1 font-weight-bold">
            MaxP=<span class="bg-light p-1">pow(2,D*8-X)*S</span><small class="ml-2">(这里把变量替换为具体数值)</small>
            <strong>Note:pow(2,3)=8</strong>
        </div>
        <div class="d-flex flex-row ml-4 pb-1 font-weight-bold">
            =<span class="bg-light p-1">&emsp;</span><small class="ml-2">(这里计算并带单位)</small>
            <strong>(Byte)</strong>
        </div>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>
    </div>


</body>

</html>