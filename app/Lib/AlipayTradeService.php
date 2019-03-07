<?php
/* *
 * 功能：支付宝电脑网站支付
 * 版本：2.0
 * 修改日期：2017-05-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */
namespace App\Lib;
//require_once dirname(dirname(dirname ( __FILE__ ))).'/AopSdk.php';
use App\Lib\AopClient;
class AlipayTradeService {

	//支付宝网关地址
	public $gateway_url = "https://openapi.alipay.com/gateway.do";

	//支付宝公钥
	public $alipay_public_key="MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQAB";

	//商户私钥
	public $private_key="MIIEowIBAAKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQABAoIBADq7KrJ2pEhQDiYeGqHhnsxoTxjmnUwroHy+EOQKID4K4w3M6Nmv6GSZU5aehgoV7Hf8MMCDlw5SmqTnB5FdEpnMT2ffyjoqOKkTTxBkIR0QxbUsZjtZWq05MFX11ascWHY5gc/mgnzjI5zPqjJccCXQFtqrwUSkceYkqXGjxr5H+9YBZs1al7lt02EO0+59aXo5CkcZnbCRu7j1j8ADx+c4iFe41UmzEAXgotuhCnR66Omgbv9NndW1jC5VmAc1kVPuLFJAlu2I7y2b2NGPIe1rhUXH58hXwsW5DF8TCUKIO35EYOcJuRvVV5IZoaICBvERtYFDLMQTeLK0tY278aECgYEA4S8glEeBR2gw5Zpn71WHCSnehe3wrD/OwtCg8glysyr3Eo8tAhNIyQfb/W1il30s76YK1401rJ4LzWBDKnS8/FF8PXFxlMjD+gkC0Mc40lmuA+Ejz2AtjRZY2qfzC3Mo0wRQfK3spzj5JSozuZXoXsF14u/sg2gKw0cW7BcSkisCgYEA0vFX7OIN2rxc25ar4fb0f5zk3GhrUPvGlwDu77ZKPFkJnWmrgPAzlQBvQuZB5ltO0dNjYyXkDJZRZinTd0IdPS/sro3K8TXa+bG4LJB5MHVSoIoyeKpwVgEVDm3mrMb8ChjwRGxs7hhgApXEX9sDyoBFrADyPaIknot+RMBn0vMCgYANt2ksnw5o4xfXZIhgM719+WbskYnPdDOL+llTZO/vqfZS0xXSwon0dN4ZmcgfoihSkLKoXpmeYiIl6G8u7t10ISKIO5jHj1Mgr9vUC86SQZQv+E7OGvWrWmkfKIvNbr5V3DVq4s0/gmDqup9b9p2o5+/eWu71Mik1q+bhiqY+8QKBgQDBmBPc6J5UeHk0YvS+vnooQGLeUcrkGR5qacXgJEm/Vuv3Fwr6m/iLMEnseQxUEMqm0b2uOhEw6CgufgaAtiHFjR1IGgP+GjIs5UklRTakHZjGk+68RZgxpm6fvodtXHXmAntIIMZcQeyjkrYWTxgMmmrW8Eth+1RmWZl6GadvtwKBgHM67cLSFZUB+PJUnSsDsXQ0T5UaF9PWlm9NkVZcD1Mb3u5A3T6sGVCG5QrSnMYgFMexD1yWmhIf72Gm0SvPdjfkcVuq7L/X+QVIlsux99sSMUKym55XhUTTE99tEWxyhtguyO/JcqRDIgNhF3W93vQdXl+H+xtKIZWF70Y+h0uy";

	//应用id
	public $appid="2019010862858609";

	//编码格式
	public $charset = "UTF-8";

	public $token = NULL;
	
	//返回数据格式
	public $format = "json";

	//签名方式
	public $signtype = "RSA2";

	function __construct($alipay_config){
		$this->gateway_url = $this->gateway_url;
		$this->appid = $this->appid;
		$this->private_key = $this->private_key;
		$this->alipay_public_key = $this->alipay_public_key;
		$this->charset =  "UTF-8";
		$this->signtype="RSA2";

		if(empty($this->appid)||trim($this->appid)==""){
			throw new Exception("appid should not be NULL!");
		}
		if(empty($this->private_key)||trim($this->private_key)==""){
			throw new Exception("private_key should not be NULL!");
		}
		if(empty($this->alipay_public_key)||trim($this->alipay_public_key)==""){
			throw new Exception("alipay_public_key should not be NULL!");
		}
		if(empty($this->charset)||trim($this->charset)==""){
			throw new Exception("charset should not be NULL!");
		}
		if(empty($this->gateway_url)||trim($this->gateway_url)==""){
			throw new Exception("gateway_url should not be NULL!");
		}

	}

	/**
	 * alipay.trade.page.pay
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @param $return_url 同步跳转地址，公网可以访问
	 * @param $notify_url 异步通知地址，公网可以访问
	 * @return $response 支付宝返回的信息
 	*/
	function pagePay($builder,$return_url,$notify_url) {
	
		$biz_content=$builder->getBizContent();
		//打印业务参数
		$this->writeLog($biz_content);
	
		$request = new AlipayTradePagePayRequest();
	
		$request->setNotifyUrl($notify_url);
		$request->setReturnUrl($return_url);
		$request->setBizContent ( $biz_content );
	
		// 首先调用支付api
		$response = $this->aopclientRequestExecute ($request,true);
		// $response = $response->alipay_trade_wap_pay_response;
		return $response;
	}

	/**
	 * sdkClient
	 * @param $request 接口请求参数对象。
	 * @param $ispage  是否是页面接口，电脑网站支付是页面表单接口。
	 * @return $response 支付宝返回的信息
 	*/
	function aopclientRequestExecute($request,$ispage=false) {

		$aop = new AopClient ();
		$aop->gatewayUrl = $this->gateway_url;
		$aop->appId = $this->appid;
		$aop->rsaPrivateKey =  $this->private_key;
		$aop->alipayrsaPublicKey = $this->alipay_public_key;
		$aop->apiVersion ="1.0";
		$aop->postCharset = $this->charset;
		$aop->format= $this->format;
		$aop->signType=$this->signtype;
		// 开启页面信息输出
		$aop->debugInfo=true;
		if($ispage)
		{
			$result = $aop->pageExecute($request,"post");
			echo $result;
		}
		else 
		{
			$result = $aop->Execute($request);
		}
        
		//打开后，将报文写入log文件
		$this->writeLog("response: ".var_export($result,true));
		return $result;
	}

	/**
	 * alipay.trade.query (统一收单线下交易查询)
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @return $response 支付宝返回的信息
 	*/
	function Query($builder){
		$biz_content=$builder->getBizContent();
		//打印业务参数
		$this->writeLog($biz_content);
		$request = new AlipayTradeQueryRequest();
		$request->setBizContent ( $biz_content );

		$response = $this->aopclientRequestExecute ($request);
		$response = $response->alipay_trade_query_response;
		return $response;
	}
	
	/**
	 * alipay.trade.refund (统一收单交易退款接口)
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @return $response 支付宝返回的信息
	 */
	function Refund($builder){
		$biz_content=$builder->getBizContent();
		//打印业务参数
		$this->writeLog($biz_content);
		$request = new AlipayTradeRefundRequest();
		$request->setBizContent ( $biz_content );
	
		$response = $this->aopclientRequestExecute ($request);
		$response = $response->alipay_trade_refund_response;
		return $response;
	}

	/**
	 * alipay.trade.close (统一收单交易关闭接口)
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @return $response 支付宝返回的信息
	 */
	function Close($builder){
		$biz_content=$builder->getBizContent();
		//打印业务参数
		$this->writeLog($biz_content);
		$request = new AlipayTradeCloseRequest();
		$request->setBizContent ( $biz_content );
	
		$response = $this->aopclientRequestExecute ($request);
		$response = $response->alipay_trade_close_response;
		return $response;
	}
	
	/**
	 * 退款查询   alipay.trade.fastpay.refund.query (统一收单交易退款查询)
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @return $response 支付宝返回的信息
	 */
	function refundQuery($builder){
		$biz_content=$builder->getBizContent();
		//打印业务参数
		$this->writeLog($biz_content);
		$request = new AlipayTradeFastpayRefundQueryRequest();
		$request->setBizContent ( $biz_content );
	
		$response = $this->aopclientRequestExecute ($request);
		return $response;
	}
	/**
	 * alipay.data.dataservice.bill.downloadurl.query (查询对账单下载地址)
	 * @param $builder 业务参数，使用buildmodel中的对象生成。
	 * @return $response 支付宝返回的信息
	 */
	function downloadurlQuery($builder){
		$biz_content=$builder->getBizContent();
		//打印业务参数
		$this->writeLog($biz_content);
		$request = new alipaydatadataservicebilldownloadurlqueryRequest();
		$request->setBizContent ( $biz_content );
	
		$response = $this->aopclientRequestExecute ($request);
		$response = $response->alipay_data_dataservice_bill_downloadurl_query_response;
		return $response;
	}

	/**
	 * 验签方法
	 * @param $arr 验签支付宝返回的信息，使用支付宝公钥。
	 * @return boolean
	 */
	function check($arr){
		$aop = new AopClient();
		$aop->alipayrsaPublicKey = $this->alipay_public_key;
		$result = $aop->rsaCheckV1($arr, $this->alipay_public_key, $this->signtype);

		return $result;
	}
	
	/**
	 * 请确保项目文件有可写权限，不然打印不了日志。
	 */
	function writeLog($text) {
		// $text=iconv("GBK", "UTF-8//IGNORE", $text);
		//$text = characet ( $text );
		file_put_contents ( dirname ( __FILE__ ).DIRECTORY_SEPARATOR."./../../log.txt", date ( "Y-m-d H:i:s" ) . "  " . $text . "\r\n", FILE_APPEND );
	}
}

?>