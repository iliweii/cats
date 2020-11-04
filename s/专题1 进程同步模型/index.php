<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/filter.php"; ?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>
    
    <?php
        $script_js = "main";
        include_once($_SERVER['DOCUMENT_ROOT']."/common/scriptjs.php");
    ?>

    <title>专题1 进程同步模型</title>
</head>
<body>
    <div class="main shadow p-5 rounded">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>
        <p>
            01. (10分)设有两个进程
            <input type="text" class="Process1 form-control inline-input">
            ，
            <input type="text" class="Process2 form-control inline-input">
            ；
            <input type="text" class="Process3 form-control inline-input">
            的优先级（权）高于
            <input type="text" class="Process4 form-control inline-input">
            ，同时进入就绪队列；各自运行的程序段如下：
        </p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="3">进程<span class="_process1"></span>：</th>
                    <th colspan="3">进程<span class="_process2"></span>：</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="__process1"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process1s">
                    </td>
                    <td><span class="__process2"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process2s">
                    </td>
                </tr>
                <tr>
                    <td><span class="__process1"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process1s">
                    </td>
                    <td><span class="__process2"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process2s">
                    </td>
                </tr>
                <tr>
                    <td><span class="__process1"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process1s">
                    </td>
                    <td><span class="__process2"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process2s">
                    </td>
                </tr>
                <tr>
                    <td><span class="__process1"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process1s">
                    </td>
                    <td><span class="__process2"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process2s">
                    </td>
                </tr>
                <tr>
                    <td><span class="__process1"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process1s">
                    </td>
                    <td><span class="__process2"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process2s">
                    </td>
                </tr>
                <tr>
                    <td><span class="__process1"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process1s">
                    </td>
                    <td><span class="__process2"></span></td>
                    <td colspan="2">
                        <input type="text" class="form-control Process2s">
                    </td>
                </tr>
            </tbody>
        </table>

        <p>
            已知
            <input type="text" class="Semaphore1 form-control inline-input">
            ，
            <input type="text" class="Semaphore2 form-control inline-input">
            为信号量（Semaphore）和P，V操作；
            <span class="semaphore1"></span>
            ，
            <span class="semaphore2"></span>
            的初值为
            <input type="text" class="Semaphore1-val form-control inline-input">
            ，
            <input type="text" class="Semaphore2-val form-control inline-input">
            ；
            <input type="text" class="Shared1 form-control inline-input">
            ，
            <input type="text" class="Shared2 form-control inline-input">
            ，
            <input type="text" class="Shared3 form-control inline-input">
            ；
            <span class="shared1"></span>
            的初值为
            <input type="text" class="Shared1-val form-control inline-input">
            ，
            <span class="shared2"></span>
            的初值为
            <input type="text" class="Shared2-val form-control inline-input">
            ，
            <span class="shared3"></span>
            的初值为
            <input type="text" class="Shared3-val form-control inline-input">
            ；求进程调度采用
            <select class="form-control inline-input Preemptive" style="width: 100px;">
                <option value="1">抢占式</option>
                <option value="0">非抢占式</option>
            </select>
            优先级调度算法时：
        </p>

        <p>
            [1]. （5分）进程
            <span class="_process1"></span>
            ，
            <span class="_process2"></span>
            并发执行的语句序列；（用代码
            <span class="_process1"></span>
            i，
            <span class="_process2"></span>
            i表示，i=1……6）
        </p>
        <p>
            [2]. （5分）并发执行过程中，变量
            <span class="shared1"></span>
            ，
            <span class="shared2"></span>
            ，
            <span class="shared3"></span>
            的中间值及运行结果。
        </p>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/submit.php"; ?>

        <p class="ml-2">[1]. Order：</p>
        <p class="Order-area">
            <span class="order"></span>
        </p>

        <p>[2].</p>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Instruction</th>
                    <th scope="col"><span class="shared1"></span>.Value</th>
                    <th scope="col"><span class="shared2"></span>.Value</th>
                    <th scope="col"><span class="shared3"></span>.Value</th>
                </tr>
            </thead>
            <tbody id="ansBody">
                
            </tbody>
        </table>
        
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

</body>

</html>