<?php 
header("Content-type: text/html; charset=utf-8");
require_once 'model/builder/AlipayTradePrecreateContentBuilder.php';
require_once 'service/AlipayTradeService.php';

$money_baiyin = 9.99;
$money_huangjin = 14.99;

if (!empty($_POST['username'])&& trim($_POST['username'])!=""){
	// (必填) 商户网站订单系统中唯一订单号，64个字符以内，只能包含字母、数字、下划线，
	// 需保证商户系统端不能重复，建议通过数据库sequence生成，
	$outTradeNo = "CATS".date('Ymdhis').mt_rand(100,1000);
	// $outTradeNo = $_POST['out_trade_no'];

	// (必填) 订单标题，粗略描述用户的支付目的。如“xxx品牌xxx门店当面付扫码消费”
	$subject = "";

	// (必填) 订单总金额，单位为元，不能超过1亿元
	// 如果同时传入了【打折金额】,【不可打折金额】,【订单总金额】三者,则必须满足如下条件:【订单总金额】=【打折金额】+【不可打折金额】
	$totalAmount = 0;


	// (不推荐使用) 订单可打折金额，可以配合商家平台配置折扣活动，如果订单部分商品参与打折，可以将部分商品总价填写至此字段，默认全部商品可打折
	// 如果该值未传入,但传入了【订单总金额】,【不可打折金额】 则该值默认为【订单总金额】- 【不可打折金额】
	//String discountableAmount = "1.00"; //

	// (可选) 订单不可打折金额，可以配合商家平台配置折扣活动，如果酒水不参与打折，则将对应金额填写至此字段
	// 如果该值未传入,但传入了【订单总金额】,【打折金额】,则该值默认为【订单总金额】-【打折金额】
	$undiscountableAmount = "0.01";

	// 卖家支付宝账号ID，用于支持一个签约账号下支持打款到不同的收款账号，(打款到sellerId对应的支付宝账号)
	// 如果该字段为空，则默认为与支付宝签约的商户的PID，也就是appid对应的PID
	//$sellerId = "";

	// 订单描述，可以对交易或商品进行一个详细地描述，比如填写"购买商品2件共15.00元"
	$vip_class = $_POST["class"];
	if ($vip_class == 1) {
		// 白银会员
		$subject = "CATS验证器 白银会员";
		// $subject = "CATS yanzhwngqi baiyin vip";
		$totalAmount = $money_baiyin;
	} else if ($vip_class == 2) {
		// 黄金会员
		$subject = "CATS验证器 黄金会员";
		// $subject = "CATS yanzhengqi huangjin vip";
		$totalAmount = $money_huangjin;
	}
	$body = json_encode([
		"title" => "czxt",
		"username" => $_POST["username"],
		"vip" => $vip_class,
		"ip" => getIP()
	]);

	//商户操作员编号，添加此参数可以为商户操作员做销售统计
	// $operatorId = "test_operator_id";

	// (可选) 商户门店编号，通过门店号和商家后台可以配置精准到门店的折扣信息，详询支付宝技术支持
	// $storeId = "test_store_id";

	// 支付宝的店铺编号
	// $alipayStoreId= "test_alipay_store_id";

	// 业务扩展参数，目前可添加由支付宝分配的系统商编号(通过setSysServiceProviderId方法)，系统商开发使用,详情请咨询支付宝技术支持
	// $providerId = ""; //系统商pid,作为系统商返佣数据提取的依据
	// $extendParams = new ExtendParams();
	// $extendParams->setSysServiceProviderId($providerId);
	// $extendParamsArr = $extendParams->getExtendParams();

	// 支付超时，线下扫码交易定义为5分钟
	$timeExpress = "90m";

	// 商品明细列表，需填写购买商品详细信息，
	// $goodsDetailList = array();

	// 创建一个商品信息，参数含义分别为商品id（使用国标）、名称、单价（单位为分）、数量，如果需要添加商品类别，详见GoodsDetail
	// $goods1 = new GoodsDetail();
	// $goods1->setGoodsId("apple-01");
	// $goods1->setGoodsName("iphone");
	// $goods1->setPrice(3000);
	// $goods1->setQuantity(1);
	// //得到商品1明细数组
	// $goods1Arr = $goods1->getGoodsDetail();

	// 继续创建并添加第一条商品信息，用户购买的产品为“xx牙刷”，单价为5.05元，购买了两件
	// $goods2 = new GoodsDetail();
	// $goods2->setGoodsId("apple-02");
	// $goods2->setGoodsName("ipad");
	// $goods2->setPrice(1000);
	// $goods2->setQuantity(1);
	// //得到商品1明细数组
	// $goods2Arr = $goods2->getGoodsDetail();

	// $goodsDetailList = array($goods1Arr,$goods2Arr);

	//第三方应用授权令牌,商户授权系统商开发模式下使用
	// $appAuthToken = "";//根据真实值填写

	// 创建请求builder，设置请求参数
	$qrPayRequestBuilder = new AlipayTradePrecreateContentBuilder();
	$qrPayRequestBuilder->setOutTradeNo($outTradeNo);
	$qrPayRequestBuilder->setTotalAmount($totalAmount);
	$qrPayRequestBuilder->setTimeExpress($timeExpress);
	$qrPayRequestBuilder->setSubject($subject);
	$qrPayRequestBuilder->setBody($body);
	$qrPayRequestBuilder->setUndiscountableAmount($undiscountableAmount);
	// $qrPayRequestBuilder->setExtendParams($extendParamsArr);
	// $qrPayRequestBuilder->setGoodsDetailList($goodsDetailList);
	// $qrPayRequestBuilder->setStoreId($storeId);
	// $qrPayRequestBuilder->setOperatorId($operatorId);
	// $qrPayRequestBuilder->setAlipayStoreId($alipayStoreId);

	// $qrPayRequestBuilder->setAppAuthToken($appAuthToken);


	// 调用qrPay方法获取当面付应答
	$qrPay = new AlipayTradeService($config);
	$qrPayResult = $qrPay->qrPay($qrPayRequestBuilder);

	//	根据状态值进行业务处理
	switch ($qrPayResult->getTradeStatus()){
		case "SUCCESS":
			$response = $qrPayResult->getResponse();
			// $qrcode = $qrPay->create_erweima($response->qr_code);
			// echo $qrcode;
			echo json_encode($response);

			break;
		case "FAILED":
			// echo "支付宝创建订单二维码失败!!!"."<br>--------------------------<br>";
			// if(!empty($qrPayResult->getResponse())){
			// 	print_r($qrPayResult->getResponse());
			// }
			echo json_encode($qrPayResult->getResponse());
			break;
		case "UNKNOWN":
			// echo "系统异常，状态未知!!!"."<br>--------------------------<br>";
			// if(!empty($qrPayResult->getResponse())){
			// 	print_r($qrPayResult->getResponse());
			// }
			echo json_encode($qrPayResult->getResponse());
			break;
		default:
			echo "不支持的返回状态，创建订单二维码返回异常!!!";
			break;
	}
	return ;
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