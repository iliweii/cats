<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>

<button type="button" class="btn my-2 btn-danger" onclick="window.location.replace('./index.php')">SCAN 磁盘调度算法</button>
<button type="button" class="btn my-2 btn-warning" onclick="window.location.replace('./cscan.php')">CSCAN 磁盘调度算法</button>
<button type="button" class="btn my-2 btn-info" onclick="window.location.replace('./nscan.php')">N-step-SCAN 磁盘调度算法</button>
<button type="button" class="btn my-2 btn-secondary" onclick="window.location.replace('./ncscan.php')">N-step-CSCAN 磁盘调度算法</button>
<!-- <button type="button" class="btn my-2 btn-dark" onclick="window.location.replace('./sstf.php')">SSTF 磁盘调度算法</button> -->
<button type="button" class="btn my-2 btn-dark">SSTF 磁盘调度算法</button>