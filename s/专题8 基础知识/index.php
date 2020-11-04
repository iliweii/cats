<?php include_once $_SERVER['DOCUMENT_ROOT']."/common/filter.php"; ?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT']."/common/head.php"); ?>

    <title>专题8 基础知识</title>
</head>
<body>

    <div class="main shadow p-5 rounded">

        <p><small><strong>重要提示：</strong></small></p>
        <p><small>·本页面转载自“操作系统课 课堂知识点打印材料”，侵权删。仅拥有便携性，仅用于用户方便背诵知识点，禁止传播。</small></p>
        <p><small>·本页面内容过多，查询某一条知识点请按<strong>“ctrl + F”</strong> 组合键，输入关键词搜索。</small></p>

        <button type="button" class="btn my-2 btn-info" onclick="window.location.replace('./simulation.php')">进行模拟测试！
        <small>tips:模拟测试不能代表真实测试数据。优点在于连续测试并展示答案。</small></button>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>

        <?php include_once("main.php"); ?>
        <?php include_once($_SERVER['DOCUMENT_ROOT']."/common/warn.php"); ?>

    </div>

</body>

</html>
