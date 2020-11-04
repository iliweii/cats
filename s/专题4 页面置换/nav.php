<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>

<button type="button" class="btn my-3 btn-danger" onclick="window.location.replace('./index.php')">Clock 页面置换算法</button>
<button type="button" class="btn m-3 btn-warning" onclick="window.location.replace('./lru.php')">LRU 页面置换算法</button>
<button type="button" class="btn m-3 btn-info" onclick="window.location.replace('./optimal.php')">Optimal 页面置换算法</button>