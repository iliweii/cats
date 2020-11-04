<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/CATS.ico" type="image/x-icon">

    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

    <?php

    if (empty($_COOKIE['username']) && empty($_POST['username'])) {
        if (!empty($_GET['verify']) && !empty($_GET['email']) && !empty($_GET['hash'])) {
            // 激活账号界面
            // 引用login-verify.php
            include_once('./common/blade/login-verify.php');
            return;
        }
        // 登录界面
        // 引用login-main.php文件
        include_once("./common/blade/login-main.php");
        return;
    }
    if (!empty($_POST['username'])) {
        setcookie("username", $_POST['name'], time() + 60 * 60 * 24 * 30);
    }
    if (!empty($_COOKIE['username'])) {
        if (!empty($_GET['timeinfo'])) {
            // 次数说明界面
            include_once('./common/blade/home-timeinfo.php');
            return;
        } else if (!empty($_GET['admin']) && strcmp($_GET['admin'], "root_liwei") == 0) {
            // 管理员界面
            include_once('./common/blade/admin-main.php');
            return;
        }
        // 主界面
        $s = './s/';
        $dirs = scandir($s);
        // 引用home-main.php文件
        include_once("./common/blade/home-main.php");
        return;
    }
    // 错误界面
    ?>