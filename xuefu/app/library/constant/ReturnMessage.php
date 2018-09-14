<?php
namespace app\library\constant;

class ReturnMessage
{
	const REQUEST_SUCCESS = 200;
	const REQUEST_FAIL = 404;

	const USER_NOT_EXIST = 10000;
	const USER_IS_EXCEPTION = 10001;

	const PASSWORD_MD5_LENGTH = 10100;
	const PASSWORD_NOT_EXIST = 10101;

	const EMAIL_ERROR = 10300;
	const EMAIL_NOT_EXIST = 10301;

	public static $message = [
		self::REQUEST_SUCCESS => '',
		self::REQUEST_FAIL => "这个请求失败了。",

		self::USER_NOT_EXIST => "好像并没有这个用户，先注册个吧。",
		self::USER_IS_EXCEPTION => "你被封号了，问问客服吧。",

		self::PASSWORD_MD5_LENGTH => "系统：md5长度不等于32位",
		self::PASSWORD_NOT_EXIST => "不输密码登陆个啥啊。",

		self::EMAIL_ERROR => "这种邮箱格式目前无法识别啊！",
		self::EMAIL_NOT_EXIST => "你确定输入email了？",
	];
}