<?php

// 连接数据库文件
$host = '127.0.0.1';
$dbuser = 'root';
$pwd = '';
$dbname = 'czxt_honghong520';

// 创建数据库连接
$db = new mysqli($host, $dbuser, $pwd, $dbname);
if ($db->connect_errno <> 0) {
    echo "db_error";
    // echo $db->connect_error;
    $db->close();
    return;
}

//设定数据可数据传输的编码
$db->query("SET NAMES UTF8");
//矫正时间
date_default_timezone_set("prc");

// 接收支付成功参数
if (!empty($_POST['out_trade_no'])) {
    // 做标记
    $body = $_POST['body'];
    $flagfile = fopen("flag.txt", "a+");
    $txt = "get a order " . $_POST['out_trade_no'] . "\n";
    fwrite($flagfile, $txt);

    echo "success";

    // 根据用户会员级别更新数据库
    $info = json_decode($body);
    $username = $info->username;
    $vip_class = $info->vip;
    $ip = $info->ip;
    $datetime = date('Y-m-d H:i:s');
    $date = date('Y-m-d');
    if ($vip_class == 1) {
        $update = "UPDATE `czxt_user` SET `vip` = $vip_class, `time` = 20,`deadline` = IF(`deadline` > NOW(), DATE_SUB(`deadline`, INTERVAL -30 DAY), DATE_SUB(NOW(), INTERVAL -30 DAY)) WHERE `czxt_user`.`username` LIKE '$username'";
        $vip_update_time = "UPDATE `czxt_time` SET `time` = 20 WHERE `czxt_time`.`uname` LIKE '$username' AND `date` = '$date'";
        $vip_update_ip = "UPDATE `czxt_ip` SET `time` = 20 WHERE `czxt_ip`.`ip` LIKE '$ip' AND `date` = '$date'";
    } else if ($vip_class == 2) {
        $update = "UPDATE `czxt_user` SET `vip` = $vip_class, `time` = 999, `deadline` = IF(`deadline` > NOW(), DATE_SUB(`deadline`, INTERVAL -30 DAY), DATE_SUB(NOW(), INTERVAL -30 DAY)) WHERE `czxt_user`.`username` LIKE '$username'";
        $vip_update_time = "UPDATE `czxt_time` SET `time` = 999 WHERE `czxt_time`.`uname` LIKE '$username' AND `date` = '$date'";
        $vip_update_ip = "UPDATE `czxt_ip` SET `time` = 999 WHERE `czxt_ip`.`ip` LIKE '$ip' AND `date` = '$date'";
    }
    $db->query($update);
    $row = mysqli_affected_rows($db);
    $txt = "username : " . $username . " update result :" . $row . "\n";
    fwrite($flagfile, $txt);
    if ($row == 1) {
        $db->query($vip_update_time);
        $db->query($vip_update_ip);
    }

    fclose($flagfile);
    $db->close();
    die();
}

/**
 * 没有操作符
 * @return "czxt_api"
 */
if (empty($_POST['op'])) {
    echo "czxt_api";
}
/**
 * 向指定邮箱发送激活邮件
 * @param POST op 必选 操作符，值为"send_email"
 * @param POST userEmail 必选 用户的电子邮箱地址
 * 返回样例
 * @return "empty_email" 邮箱为空
 * @return json 正确返回邮件返回状态 
 */
else if (strcmp($_POST["op"], "send_email") == 0) {
    if (empty($_POST['userEmail'])) {
        echo "empty_email";
    } else {
        $userEmail = $_POST['userEmail'];
        $random = RandomStr(10);
        $url = 'http://106.13.236.185:9999/mail_sys/send_mail_http.json';
        $sl_data = array(
            'mail_from' => "czxt@redcountry.top",
            'password' => 'Redcountry123',
            "mail_to" => $userEmail,
            "subject" => "[CATS验证器] 您好，请点击邮件中的链接完成用户激活或密码修改",
            "content" => "这封信是由“CATS验证器”发出的。\n" .
                "您收到这封邮件，是由于在“CATS验证器”获取激活新用户或密码修改时，填写了当前邮箱地址。如果您并没有访问过“CATS验证器”，或没有进行上述操作，请忽略这封邮件，您不需要进行其他任何的操作！\n" .
                "您只需复制并打开后面的的链接即可进行完成用户激活或密码修改：\n" .
                "https://czxt.honghong520.xyz/index.php?verify=on&email=$userEmail&hash=$random\n\n" .
                "感谢您的使用，祝您生活愉快！\n" .
                "FROM CATS验证器"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); //要访问的地址
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0); //执行结果是否被返回，0是返回，1是不返回
        curl_setopt($ch, CURLOPT_POST, 1); // 发送一个常规的POST请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sl_data));
        $output = curl_exec($ch); //执行并获取数据
        $output = mb_substr($output, 0, strlen($output) - 2, 'utf-8');
        echo $output;
        curl_close($ch);
    }
}
/**
 * 登录方法
 * @param POST op 必选 操作符 值为"login"
 * @param POST username 必选 用户名
 * @param POST password 可选 密码
 * 返回样例
 * @return "empty_username" 用户名为空
 * @return "empty_password" 密码为空
 * @return "success" 用户名密码验证成功
 * @return "wrong_verify" 用户存在但出于未激活状态
 * @return "wrong_password" 用户存在但密码错误
 * @return "insert_username" 用户不存在，且已经新增
 * @return "error_username" 用户不存在，且没有新增
 * @return "error" 数据库故障
 */
else if (strcmp($_POST["op"], "login") == 0) {
    // 用户名为空
    if (empty($_POST['username'])) {
        echo "empty_username";
    } else {
        $user = $_POST['username'];
        // 去除空格
        $u = str_replace(" ", '', $user);
        $query = "SELECT * FROM `czxt_user` WHERE `username` LIKE '$u'";
        $result = mysqli_query($db, $query);
        $obj = mysqli_fetch_object($result);
        if (!empty($obj) && $obj->status == 1) {
            // 如果用户存在且已经激活就验证密码
            if (empty($_POST['password'])) {
                echo "empty_password";
            } else if (strcmp(md5($_POST['password']), $obj->password) == 0) {
                // 密码匹配成功
                echo "success";
            } else {
                // 密码匹配失败
                echo "wrong_password";
            }
        } else if (!empty($obj) && $obj->status == 0) {
            // 如果用户存在但未激活
            echo "wrong_verify";
        } else {
            // 否则插入新增用户数据
            $defultPwd = md5("123456");
            $datetime = date('Y-m-d H:i:s');
            $insert = "INSERT INTO `czxt_user` (`uid`, `username`, `password`, `vip`, `email`, `time`, `deadline`, `status`) VALUES (NULL, '$u', '$defultPwd', '0', NULL, '1', '$datetime', '0')";
            if ($db->query($insert) == TRUE) {
                $query = "SELECT * FROM `czxt_user` WHERE `username` LIKE '$u'";
                $result = mysqli_query($db, $query);
                $obj = mysqli_fetch_object($result);
                if (!empty($obj)) {
                    echo "insert_username";
                } else {
                    echo "error_username";
                }
            } else {
                echo "error";
            }
        }
    }
}
/**
 * 绑定邮箱
 * @param POST op 必选 操作符 值为"bind_email"
 * @param POST username 必选 用户名
 * @param POST email 必选 邮箱地址
 * 返回样例
 * @return "empty_username" 用户名为空
 * @return "empty_email" 邮箱地址为空
 * @return "repeat_email" 邮箱地址重复
 * @return "bind_success" 成功绑定邮箱
 * @return "bind_error" 未能绑定邮箱
 */
else if (strcmp($_POST['op'], "bind_email") == 0) {
    if (empty($_POST['username'])) {
        echo "empty_username";
    } else if (empty($_POST['email'])) {
        echo "empty_email";
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        // 先检查邮箱是否重复
        $query = "SELECT * FROM `czxt_user` WHERE `email` LIKE '$email'";
        $result = mysqli_query($db, $query);
        $obj = mysqli_fetch_all($result);
        if (count($obj) > 0 && strcmp($obj[0][4], $email) == 0) {
            // 邮箱重复
            echo "repeat_email";
        } else {
            $update = "UPDATE `czxt_user` SET `email` = '$email' WHERE `czxt_user`.`username` LIKE '$username'";
            if ($db->query($update) == TRUE) {
                echo "bind_success";
            } else {
                echo "bind_error";
            }
        }
    }
}
/**
 * 验证账户
 * @param POST op 必选 操作符 值为"is_verify"
 * @param POST username/email 二选一 用户名/邮箱
 * @param POST verify 可选 是否进行验证 值为任意值
 * 返回样例
 * @return "empty_value" 传值为空
 * @return "verified" 账户为激活状态
 * @return "unverified" 账户为未激活状态
 * @return "verify_success" 账户验证成功
 * @return "verify_error" 账户验证失败
 */
else if (strcmp($_POST['op'], "is_verify") == 0) {
    if (empty($_POST['username']) && empty($_POST['email'])) {
        echo "empty_value";
    } else {
        $query = "";
        // 通过用户名查询账户是否验证通过
        if (!empty($_POST['username'])) {
            $username = $_POST['username'];
            $query = "SELECT * FROM `czxt_user` WHERE `username` LIKE '$username'";
        }
        // 通过邮箱查询账户是否验证通过
        else if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $query = "SELECT * FROM `czxt_user` WHERE `email` LIKE '$email'";
        }
        $result = mysqli_query($db, $query);
        $obj = mysqli_fetch_object($result);
        if ($obj->status) {
            // 已经验证过
            echo "verified";
        } else {
            // 未验证
            if (empty($_POST['verify'])) {
                echo "unverified";
            } else {
                $update = "";
                if (!empty($_POST['username']))
                    $update = "UPDATE `czxt_user` SET `status` = '1' WHERE `czxt_user`.`username` LIKE '$username'";
                else if (!empty($_POST['email']))
                    $update = "UPDATE `czxt_user` SET `status` = '1' WHERE `czxt_user`.`email` LIKE '$email'";

                if ($db->query($update) == TRUE) {
                    echo "verify_success";
                    setrawcookie("username", $obj->username, time() + 3600 * 24 * 7, "/");
                } else {
                    echo "verify_error";
                }
            }
        }
    }
}
/**
 * 设置密码
 * @param POST op 必选 操作符 值为"set_password"
 * @param POST password 必选 账户新密码
 * @param POST username/email 二选一 用户名/邮箱
 * 返回样例
 * @return "empty_password" 密码为空
 * @return "empty_value" 用户名或邮箱为空
 * @return "set_pwd_success" 设置新密码成功
 * @return "set_pwd_error" 设置新密码失败
 * 
 */
else if (strcmp($_POST['op'], "set_password") == 0) {
    if (empty($_POST['password'])) {
        echo "empty_password";
    } else if (empty($_POST['username']) && empty($_POST['email'])) {
        echo "empty_value";
    } else {
        $update = "";
        $password = md5($_POST['password']);
        // 通过用户名修改账户密码
        if (!empty($_POST['username'])) {
            $username = $_POST['username'];
            $update = "UPDATE `czxt_user` SET `password` = '$password' WHERE `czxt_user`.`username` = '$username'";
        }
        // 通过邮箱修改账户密码
        else if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            $update = "UPDATE `czxt_user` SET `password` = '$password' WHERE `czxt_user`.`email` = '$email'";
        }

        if ($db->query($update) == TRUE) {
            echo "set_pwd_success";
        } else {
            echo "set_pwd_error";
        }
    }
}
/**
 * 获取用户剩余操作次数
 * @param POST op 必选 操作符 值为"get_time"
 * @param POST username 必选 用户名
 * @param POST ip 必选 用户访问ip地址
 * 返回样例
 * @return "empty_value" 用户名或者ip地址为空
 * @return "get_error" 获取次数失败
 * @return {int} 用户剩余操作次数
 */
else if (strcmp($_POST["op"], "get_time") == 0) {
    if (empty($_POST['username']) || empty($_POST['ip'])) {
        echo "empty_value";
    } else {
        // 如果用户今天没有操作，即分别根据username或ip查询都无数据
        // ，返回czxt_user表中数据
        // 并将ip+time记录czxt_ip表
        // 将username+time记录czxt_time表
        $date = date('Y-m-d');
        if (!empty($_POST['username'])) {
            $username = $_POST['username'];
            $query = "SELECT * FROM `czxt_time` WHERE `uname` LIKE '$username' AND `date` = '$date'";
            $result = mysqli_query($db, $query);
            $obj = mysqli_fetch_object($result);
        }

        if (!empty($_POST['ip'])) {
            $ip = $_POST['ip'];
            $query = "SELECT * FROM `czxt_ip` WHERE `ip` LIKE '$ip' AND `date` = '$date'";
            $result = mysqli_query($db, $query);
            $obj_ip = mysqli_fetch_object($result);
        }

        if (!$obj) {
            $query = "SELECT * FROM `czxt_user` WHERE `username` LIKE '$username'";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_object($result);
            $user_time = $user->time;
            // 关闭自动提交
            mysqli_autocommit($db, FALSE);
            $insert_time = "INSERT INTO `czxt_time` (`id`, `uname`, `date`, `time`) VALUES (NULL, '$username', '$date', $user_time)";
            mysqli_query($db, $insert_time);
            $ip = $_POST['ip'];
            // 如果ip同样查询不到值
            if (!$obj_ip) {
                $insert_ip = "INSERT INTO `czxt_ip` (`id`, `ip`, `date`, `time`) VALUES (NULL, '$ip', '$date', '$user_time')";
                mysqli_query($db, $insert_ip);
            } else {
                // 否则启动惩罚机制，将较低的数值记录在ip表
                $update_ip = "UPDATE `czxt_ip` SET `time` = $user_time WHERE `czxt_ip`.`ip` = '$ip' AND `czxt_ip`.`time` > $user_time AND `date` = '$date'";
            }
            if (mysqli_commit($db) == TRUE) {
                echo $user_time;
            } else {
                echo "get_error";
                mysqli_rollback($db);
            }
        }
        // 如果根据username查询到数据，并且根据ip查询到数据，
        // 返回相对低的那个数据
        else {
            $username = $_POST['username'];
            $ip = $_POST['ip'];
            $query_time = "SELECT * FROM `czxt_time` WHERE `uname` LIKE '$username' AND `date` = '$date'";
            $query_ip = "SELECT * FROM `czxt_ip` WHERE `ip` LIKE '$ip' AND `date` = '$date'";
            $result = mysqli_query($db, $query_time);
            $table_time = mysqli_fetch_object($result);
            $result = mysqli_query($db, $query_ip);
            $table_ip = mysqli_fetch_object($result);
            if (!$table_ip) {
                $query = "SELECT * FROM `czxt_user` WHERE `username` LIKE '$username'";
                $result = mysqli_query($db, $query);
                $user = mysqli_fetch_object($result);
                $user_time = $user->time;
                $insert_ip = "INSERT INTO `czxt_ip` (`id`, `ip`, `date`, `time`) VALUES (NULL, '$ip', '$date', '$user_time')";
                mysqli_query($db, $insert_ip);
            }
            $result = mysqli_query($db, $query_ip);
            $table_ip = mysqli_fetch_object($result);
            if ($table_ip && $table_time) {
                echo $table_ip->time < $table_time->time ? $table_ip->time : $table_time->time;
            } else {
                echo "get_error";
            }
            // 惩罚机制，登录账户使用次数以ip和账号中较少的为准
            $update_ip = "UPDATE `czxt_ip` SET `time` = $table_time->time WHERE `czxt_ip`.`ip` = '$ip' AND `czxt_ip`.`time` > $table_time->time AND `date` = '$date'";
            $db->query($update_ip);
            // 惩罚机制，若ip中使用次数低于账户中的，将账户中的使用次数记录最小值
            // $query_ip = "SELECT * FROM `czxt_ip` WHERE `ip` LIKE '$ip' AND `date` = '$date'";
            // $result = mysqli_query($db, $query_ip);
            // $table_ip2 = mysqli_fetch_object($result);
            // if ($table_ip2) {
            //     $update_time = "UPDATE `czxt_time` SET `time` = $table_ip2->time WHERE `czxt_time`.`uname` LIKE '$username' AND `czxt_time`.`time` > $table_ip2->time AND `date` = '$date'";
            //     $db->query($update_time);
            // }
        }
        // 如果会员到期，重置user表，并重置ip表和time表
        $date = date('Y-m-d');
        $vip_update = "UPDATE `czxt_user` SET `vip` = 0, `time` = 1 WHERE `czxt_user`.`username` LIKE '$username' AND `deadline` < NOW()";
        $db->query($vip_update);
        if (mysqli_affected_rows($db) == 1) {
            $vip_update_time = "UPDATE `czxt_time` SET `time` = 1 WHERE `czxt_time`.`uname` LIKE '$username' AND `date` = '$date'";
            $vip_update_ip = "UPDATE `czxt_ip` SET `time` = 1 WHERE `czxt_ip`.`ip` LIKE '$ip' AND `date` = '$date'";
            $db->query($vip_update_time);
            $db->query($vip_update_ip);
        }
    }
}
/**
 * 用户进行了一次生成答案，有效次数减1
 * @param POST op 必选 操作符 值为"user_time"
 * @param POST username 必选 用户名
 * @param POST ip 必选 ip地址
 * 返回样例
 * @return "empty_value" 用户名为空
 * @return "use_success" 更新数据成功
 * @return "use_error" 更新数据失败（不是
 *          错误情况，剩余次数为0后也会返回这个值）
 */
else if (strcmp($_POST["op"], "use_time") == 0) {
    if (empty($_POST['username']) || empty($_POST['ip'])) {
        echo "empty_value";
    } else {
        // 若time表和ip表中数据不为0，减1并记录
        $date = date('Y-m-d');
        $username = $_POST['username'];
        $ip = $_POST['ip'];
        $update_time = "UPDATE `czxt_time` SET `time` = `time` - 1 WHERE `time` > 0 AND `czxt_time`.`uname` = '$username' AND `date` = '$date'";
        $update_ip = "UPDATE `czxt_ip` SET `time` = `time` - 1 WHERE `time` > 0 AND `czxt_ip`.`ip` = '$ip' AND `date` = '$date'";
        if ($db->query($update_time) == TRUE && $db->query($update_ip) == TRUE) {
            echo "use_success";
        } else {
            echo "use_error";
        }
    }
}
/**
 * 获取用户会员等级
 * @param POST op 必选 操作符 值为"get_vip"
 * @param POST username 必选 用户名
 * 返回样例
 * @return "empty_value" 用户名为空
 * @return {json} 用户对应会员等级
 */
else if (strcmp($_POST["op"], "get_vip") == 0) {
    if (empty($_POST['username'])) {
        echo "empty_value";
    } else {
        $username = $_POST['username'];
        $query = "SELECT * FROM `czxt_user` WHERE `username` LIKE '$username'";
        $result = mysqli_query($db, $query);
        $obj = mysqli_fetch_object($result);
        $vip = $obj->vip;
        $deadline = $obj->deadline;
        $text = "您还不是会员";
        if ($vip == 0) {
            $text = "您还不是会员";
        } else if ($vip == 1) {
            $text = "我的白银会员";
        } else if ($vip == 2) {
            $text = "我的黄金会员";
        } else if ($vip >= 3) {
            $text = "我的终极大会员";
        }
        echo json_encode([
            "code" => "200",
            "vip" => $vip,
            "text" => $text,
            "deadline" => $deadline
        ]);
    }
}
/**
 * 根据用户名把用户激活状态置0（修改密码事件附属）
 * @param POST op 必选 操作符 值为"deactivate"
 * @param POST username 必选 用户名
 * 返回样例
 * @return "empty_value" 用户名为空
 * @return "set_success" 设置成功
 * @return "set_error" 设置失败
 */
else if (strcmp($_POST["op"], "deactivate") == 0) {
    if (empty($_POST['username'])) {
        echo "empty_value";
    } else {
        $username = $_POST['username'];
        $update = "UPDATE `czxt_user` SET `status` = '0' WHERE `czxt_user`.`username` = '$username'";
        if ($db->query($update) == TRUE) {
            echo "set_success";
        } else {
            echo "set_error";
        }
    }
}
/**
 * 根据用户名获取邮箱
 * @param POST op 必选 操作符 值为"get_email"
 * @param POST username 必选 用户名
 * 返回样例
 * @return "empty_value" 用户名为空
 * @return "empty_email" 邮箱为空
 * @return {string} 用户邮箱
 */
else if (strcmp($_POST["op"], "get_email") == 0) {
    if (empty($_POST['username'])) {
        echo "empty_value";
    } else {
        $username = $_POST['username'];
        $query = "SELECT * FROM `czxt_user` WHERE `username` LIKE '$username'";
        $result = mysqli_query($db, $query);
        $obj = mysqli_fetch_object($result);
        if ($obj) {
            echo $obj->email;
        } else {
            echo "empty_email";
        }
    }
}
/**
 * 展示支付二维码(小叮当派支付接口 暂停使用)
 * @param POST op 必选 操作符 值为"get_qrcode_xdd"
 * @param POST class 必选 会员类别 1为白银 2为黄金
 * @param POST pay_type 必选 支付类型 支付宝=43 微信支付=44
 * @param POST username 必选 用户名
 * 返回样例
 * @return "empty_value" 传值为空
 * @return {string} json字符串
 */
else if (strcmp($_POST["op"], "get_qrcode_xdd") == 0) {
    echo "stop_use";
    die($db->close());
    if (empty($_POST["class"]) || empty($_POST["pay_type"] || $_POST["username"])) {
        echo "empty_value";
    } else {
        $app_id = "11967";
        $app_secret = "4b22b2af5778488abd4d73644cff24fc";
        $order_no = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $vip_class = $_POST["class"];
        if ($vip_class == 1) {
            // 白银会员
            $subject = "CATS验证器 白银会员";
            $money = 9.99;
            // $money = 0.01;
        } else if ($vip_class == 2) {
            // 黄金会员
            $subject = "CATS验证器 黄金会员";
            $money = 14.99;
        }
        $pay_type = $_POST["pay_type"];
        $extra = json_encode([
            "title" => "czxt",
            "username" => $_POST["username"],
            "vip" => $vip_class
        ]);
        $extra = str_replace('"', '', $extra);
        $sign = strtoupper(md5("order_no=" . $order_no . "&subject=" . $subject . "&pay_type=" . $pay_type . "&money=" . $money . "&app_id=" . $app_id . "&extra=" . $extra . "&" . $app_secret));
        // 请求接口
        $returndata['order_no'] = $order_no;
        $returndata['subject'] = $subject;
        $returndata['pay_type'] = $pay_type;
        $returndata['money'] = $money;
        $returndata['app_id'] = $app_id;
        $returndata['extra'] = $extra;
        $returndata['sign'] = $sign;

        $url = 'https://gateway.xddpay.com?format=json';
        echo post_url($url, $returndata);
    }
}
/**
 * 专题一 进程同步模型
 */
else if (strcmp($_POST["op"], "jctbmx") == 0) {
    $json = $_POST['json'];
    $res = post_url_json("http://47.105.170.162:8080/osa/psm", $json);
    echo $res;
}
/**
 * 专题三 银行家算法
 */
else if (strcmp($_POST["op"], "yhjsf") == 0) {
    $json = $_POST['json'];
    $res = post_url_json("http://47.105.170.162:8080/osa/banker", $json);
    echo $res;
}
/**
 * 专题8
 */
else if (strcmp($_POST["op"], "jczs") == 0) {
    $sql = "SELECT * FROM `s8`";
    $result = mysqli_query($db, $sql);
    $obj = mysqli_fetch_all($result);
    $random = mt_rand(0, count($obj) - 1);
    $question = $obj[$random][1];
    $answer = explode(",", $obj[$random][2]);
    $ansnum = count($answer);
    if ($ansnum > 0) {
        $ansrandom = mt_rand(0, $ansnum - 1);
        for ($i = 0; $i < $ansnum; $i++) {
            $question = str_replace_once($question, "_", $answer[$i]);
        }
        $answer = $answer[$ansrandom];
        $question = str_replace_once($question, $answer, "###");
    }
    echo json_encode([
        "chapter" => $obj[$random][0],
        "question" => $question,
        "answer" => $answer
    ]);
}
/**
 * 返回所有用户数据
 * 
 */
else if (strcmp($_POST["op"], "query_user") == 0) {
    $query = "SELECT * FROM `czxt_user`";
    $result = mysqli_query($db, $query);
    $all = mysqli_fetch_all($result);
    echo json_encode($all);
}
/**
 * op 操作符错误
 * @return "op_error"
 */
else {
    echo "op_error";
}




/**
 * 返回指定长度的随机字符串
 * @param int $length 字符长度
 * @return str 返回随机字符串
 */
function RandomStr($length)
{
    // 字符组合
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $len = strlen($str) - 1;
    $randstr = '';
    for ($i = 0; $i < $length; $i++) {
        $num = mt_rand(0, $len);
        $randstr .= $str[$num];
    }
    return $randstr;
}

/**
 * 返回用户访问网站的ip地址
 * @return str ip地址
 */
function getIP()
{
    static $realip;
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
    return $realip;
}


/**
 * 模拟POST提交
 * @param string $url 地址
 * @param string $data 提交的数据
 * @return string 返回结果
 */
function post_url($url, $data)
{
    $headers = [
        "Content-Type: application/x-www-form-urlencoded"
    ];
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 模拟用户使用的浏览器
    //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    //curl_setopt($curl, CURLOPT_AUTOREFERER, 1);  // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1);       // 发送一个常规的Post请求
    // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));  // Post提交的数据包x
    curl_setopt($curl, CURLOPT_POSTFIELDS, ($data));  // Post提交的数据包x
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);     // 设置超时限制 防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0);      // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        // echo 'Errno' . curl_error($curl); //捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}

/**
 * 模拟POST提交
 * @param string $url 地址
 * @param string $data 提交的数据
 * @return string 返回结果
 */
function post_url_json($url, $data)
{
    $headers = [
        "Content-Type: application/json"
    ];
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 模拟用户使用的浏览器
    //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    //curl_setopt($curl, CURLOPT_AUTOREFERER, 1);  // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1);       // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  // Post提交的数据包x
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);     // 设置超时限制 防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0);      // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        // echo 'Errno' . curl_error($curl); //捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}
/**
 * 字符串只替换一次
 * @param string $str 替换前的字符串
 * @param string $needle 需要替换的字符串
 * @param string $replace 替换后的字符串
 */
function str_replace_once($str, $needle, $replace)
{
    $pos = strpos($str, $needle);
    if ($pos === false) {
        return $str;
    }
    $res = substr_replace($str, $replace, $pos, strlen($needle));
    return $res;
}

$db->close();
die();
