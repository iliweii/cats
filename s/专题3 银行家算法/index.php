<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/filter.php"; ?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/head.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <?php
        $script_js = "main";
        include_once($_SERVER['DOCUMENT_ROOT']."/common/scriptjs.php");
    ?>

    <title>专题3 银行家算法</title>
</head>

<body>
    <div class="main shadow p-5 rounded">
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/time.php"; ?>
        <p>
            03. (10分)在银行家算法中，假设系统中有5个进程（P0, P1, P2, P3, P4）
            共享3种类型的资源（A, B, C），全部资源总量（Resource）为（
            <span class="input-group span-group">
                <input type="text" class="Page form-control Resource">，
                <input type="text" class="Page form-control Resource">，
                <input type="text" class="Page form-control Resource">
            </span>
            ）；在T0时刻的分配情况如下表：
        </p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Process</th>
                    <th colspan="3">Max</th>
                    <th colspan="3">Allocation</th>
                    <th colspan="3">Need</th>
                    <th colspan="3">Available</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th></th>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                </tr>
                <tr>
                    <th scope="row">P0</th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Available Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Available Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Available Tinput">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">P1</th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <th scope="row">P2</th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <th scope="row">P3</th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <th scope="row">P4</th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Max Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need Tinput">
                        </div>
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tbody>
        </table>
        <p>[1]. 试问To状态是否安全？若安全，给出一个安全序列（P0->P4循环扫描方法）；否则给出原因。</p>

        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/common/submit.php"; ?>

        <p class="ml-2">解：[1]. Need, Available如上表，安全性算法如下：</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Process</th>
                    <th colspan="3">Work</th>
                    <th colspan="3">Need</th>
                    <th colspan="3">Allocation</th>
                    <th colspan="3">Work+Allocation</th>
                    <th>Finish</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th></th>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td>A</td>
                    <td>B</td>
                    <td>C</td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"><input type="text" class="form-control Process Tinput"></th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Finish Tinput">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><input type="text" class="form-control Process Tinput"></th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Finish Tinput">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><input type="text" class="form-control Process Tinput"></th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Finish Tinput">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><input type="text" class="form-control Process Tinput"></th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Finish Tinput">
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><input type="text" class="form-control Process Tinput"></th>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Work Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Need2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Allocation2 Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control WA Tinput">
                        </div>
                    </td>
                    <td>
                        <div class="col">
                            <input type="text" class="form-control Finish Tinput">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>Therefore, T0 is a <span id="Safe" style="font-weight: 700; text-decoration: #000 solid 1px;"></span> state.</p>
        <p>Safe Sequence is {<span id="List" style="font-weight: 700; text-decoration: #000 solid 1px;"></span>}.</p>
        <p>List separator is comma(,).</p>

        <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/common/warn.php"); ?>

    </div>

</body>

</html>