<?php
namespace app\api\library\constant;

class ReturnMessage
{
	const REQUEST_SUCCESS = 200;
	const REQUEST_FAIL = 404;

	const EMAIL_ERROR = 10000;

	public static $message = [
		self::REQUEST_SUCCESS => '',
		self::REQUEST_FAIL => "这个请求失败了",
		self::EMAIL_ERROR => "这种邮箱格式目前无法识别啊",
	];
}