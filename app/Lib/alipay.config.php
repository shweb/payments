<?php
$alipay_public_key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQAB";
$merchant_private_key = "MIIEowIBAAKCAQEAuYzzbrCblNXsVKls5WVmwDYMD0ZFidW0FU6oD1cIGQRCQSjbQZB2udN57XcfZx7I+6oEgDOhDEM+yNUCkl8GTfstXhPFepNWCD5Mdet7uFjjiopb6XwstLf/ZaqlR/9BF9FNa2tYmbBukvJdBrJVIXiz0Qm5UO2eY/43wo6qbcaXkd/VKfijCBcLhQXcICup2HdrbAdXGgJM0d/C0UGfx+62sEuwjuSlB2ndpur1kkF5dZjJ2dvJPUqQr+xB6Mdf1Ig4tqI6JhwyTfhg7Sr+t95qx1DriXnKk3pgQDJ6yejQKZefxnbO8cLV5eUwlpUxr9JYxrjRhJwjzKCMMdUE0QIDAQABAoIBADq7KrJ2pEhQDiYeGqHhnsxoTxjmnUwroHy+EOQKID4K4w3M6Nmv6GSZU5aehgoV7Hf8MMCDlw5SmqTnB5FdEpnMT2ffyjoqOKkTTxBkIR0QxbUsZjtZWq05MFX11ascWHY5gc/mgnzjI5zPqjJccCXQFtqrwUSkceYkqXGjxr5H+9YBZs1al7lt02EO0+59aXo5CkcZnbCRu7j1j8ADx+c4iFe41UmzEAXgotuhCnR66Omgbv9NndW1jC5VmAc1kVPuLFJAlu2I7y2b2NGPIe1rhUXH58hXwsW5DF8TCUKIO35EYOcJuRvVV5IZoaICBvERtYFDLMQTeLK0tY278aECgYEA4S8glEeBR2gw5Zpn71WHCSnehe3wrD/OwtCg8glysyr3Eo8tAhNIyQfb/W1il30s76YK1401rJ4LzWBDKnS8/FF8PXFxlMjD+gkC0Mc40lmuA+Ejz2AtjRZY2qfzC3Mo0wRQfK3spzj5JSozuZXoXsF14u/sg2gKw0cW7BcSkisCgYEA0vFX7OIN2rxc25ar4fb0f5zk3GhrUPvGlwDu77ZKPFkJnWmrgPAzlQBvQuZB5ltO0dNjYyXkDJZRZinTd0IdPS/sro3K8TXa+bG4LJB5MHVSoIoyeKpwVgEVDm3mrMb8ChjwRGxs7hhgApXEX9sDyoBFrADyPaIknot+RMBn0vMCgYANt2ksnw5o4xfXZIhgM719+WbskYnPdDOL+llTZO/vqfZS0xXSwon0dN4ZmcgfoihSkLKoXpmeYiIl6G8u7t10ISKIO5jHj1Mgr9vUC86SQZQv+E7OGvWrWmkfKIvNbr5V3DVq4s0/gmDqup9b9p2o5+/eWu71Mik1q+bhiqY+8QKBgQDBmBPc6J5UeHk0YvS+vnooQGLeUcrkGR5qacXgJEm/Vuv3Fwr6m/iLMEnseQxUEMqm0b2uOhEw6CgufgaAtiHFjR1IGgP+GjIs5UklRTakHZjGk+68RZgxpm6fvodtXHXmAntIIMZcQeyjkrYWTxgMmmrW8Eth+1RmWZl6GadvtwKBgHM67cLSFZUB+PJUnSsDsXQ0T5UaF9PWlm9NkVZcD1Mb3u5A3T6sGVCG5QrSnMYgFMexD1yWmhIf72Gm0SvPdjfkcVuq7L/X+QVIlsux99sSMUKym55XhUTTE99tEWxyhtguyO/JcqRDIgNhF3W93vQdXl+H+xtKIZWF70Y+h0uy";

$config = array (
		//应用ID,您的APPID。
		'app_id' => "2019010862858609",

		//商户私钥
		'merchant_private_key' => $merchant_private_key,

		//异步通知地址
		//'notify_url' => "http://kevingates/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		'notify_url' => "http://uvbypp-mmbund-payments.com/alipay/notify",

		//同步跳转
		//'return_url' => "http://kevingates/alipay.trade.page.pay-PHP-UTF-8/return_url.php",
		'return_url' => "http://uvbypp-mmbund-payments.com/alipay/",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => $alipay_public_key,
);