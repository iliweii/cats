<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/filter.php"; ?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>
    
    <?php
        $script_js = "main";
        include_once($_SERVER['DOCUMENT_ROOT']."/common/scriptjs.php");
    ?>

    <title>专题2 时间片轮换</title>
</head>

<body>
    <div class="main shadow p-5 rounded">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>
        <p>
            02. (10分)设有5个进程P1, P2, P3, P4和P5；它们到达时间和要求服务时间(CPU-Service
            Time)如下表(单位为ms)，求非抢占方式(Non Preemptive)下，采用RR q=<input type="text" class="q form-control" style="width: 50px; display: inline-block;">(Round Robin
            quantum)调度算法时：
        </p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Process:</th>
                    <th>P1</th>
                    <th>P2</th>
                    <th>P3</th>
                    <th>P4</th>
                    <th>P5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">到达时间(Arrival Time)</th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ta Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ta Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ta Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ta Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ta Tinput">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">服务时间(Service Time)</th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ts Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ts Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ts Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ts Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Ts Tinput">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>[1]. （5分）给出进程调度顺序的甘特图（Gantt chart）；</p>
        <p>[2]. （5分）计算平均周转时间和平均带权周转时间W。（保留两位小数）</p>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/submit.php"; ?>

        <p class="ml-2">解：[1]. Gantt chart：</p>
        <p id="G2" class="q1area ml-4"></p>
        <p id="G1" class="q1area ml-2">

        </p>
        <p>[2]. （5分）计算平均周转时间和平均带权周转时间W。（保留两位小数）</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Process</th>
                    <th scope="col">Finish Time</th>
                    <th scope="col">Arrival Time</th>
                    <th scope="col">Turnaround Time(Tr)</th>
                    <th scope="col">Service Time(Ts)</th>
                    <th scope="col">Wr=Tr/Ts</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="pname"></td>
                    <td class="finishTime"></td>
                    <td class="arrivalTime"></td>
                    <td class="turnaroundTime"></td>
                    <td class="serviceTime"></td>
                    <td class="wr"></td>
                </tr>
                <tr>
                    <td class="pname"></td>
                    <td class="finishTime"></td>
                    <td class="arrivalTime"></td>
                    <td class="turnaroundTime"></td>
                    <td class="serviceTime"></td>
                    <td class="wr"></td>
                </tr>
                <tr>
                    <td class="pname"></td>
                    <td class="finishTime"></td>
                    <td class="arrivalTime"></td>
                    <td class="turnaroundTime"></td>
                    <td class="serviceTime"></td>
                    <td class="wr"></td>
                </tr>
                <tr>
                    <td class="pname"></td>
                    <td class="finishTime"></td>
                    <td class="arrivalTime"></td>
                    <td class="turnaroundTime"></td>
                    <td class="serviceTime"></td>
                    <td class="wr"></td>
                </tr>
                <tr>
                    <td class="pname"></td>
                    <td class="finishTime"></td>
                    <td class="arrivalTime"></td>
                    <td class="turnaroundTime"></td>
                    <td class="serviceTime"></td>
                    <td class="wr"></td>
                </tr>
            </tbody>
        </table>
        <p>The average turnaround time: T=<span id="avgT" style="font-weight: 700; text-decoration: #000 solid 1px;"></span>(ms)</p>
        <p>The average Tr/Ts: W=<span id="avgW" style="font-weight: 700; text-decoration: #000 solid 1px;"></span></p>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

</body>

</html>