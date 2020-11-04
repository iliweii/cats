<?php
if (empty($_COOKIE['username'])) {
    $host = $_SERVER['HTTP_HOST'];
    $url = $host . $_SERVER['REQUEST_URI'];
    echo "403 FORBIDDEN:没有登录";
    header('Location: http://' . $host . '/index.php?url=' . $url);
    die();
}