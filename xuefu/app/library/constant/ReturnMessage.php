<?php
namespace app\library\constant;

class ReturnMessage
{
	const REQUEST_SUCCESS = 200;
	const REQUEST_FAIL = 404;

	const MODEL_ERROR = 1000;

	const USER_NOT_EXIST = 10000;
	const USER_IS_EXCEPTION = 10001;

	const PASSWORD_MD5_LENGTH = 10100;
	const PASSWORD_NOT_EXIST = 10101;

	const TYPE_TITLE_NULL = 10200;
	const TYPE_PID_NULL = 10201;
	const TYPE_TITLE_LENGTH = 10202;

	const EMAIL_ERROR = 10300;
	const EMAIL_NOT_EXIST = 10301;

	const BOOKSHELF_IS_EXIST = 10400;

	const DATA_IS_NULL = 10500;

	public static $message = [
		self::REQUEST_SUCCESS => '',
		self::REQUEST_FAIL => "这个请求失败了。",

		self::MODEL_ERROR => "模型错误",

		self::USER_NOT_EXIST => "好像并没有这个用户，先注册个吧。",
		self::USER_IS_EXCEPTION => "你被封号了，问问客服吧。",

		self::PASSWORD_MD5_LENGTH => "系统：md5长度不等于32位",
		self::PASSWORD_NOT_EXIST => "不输密码登陆个啥啊。",

		self::TYPE_TITLE_NULL => "名称好像没输入哦。",
		self::TYPE_PID_NULL => "该数据已经被大海带走了~",
		self::TYPE_TITLE_LENGTH => "标题有必要这么长嘛？如果需要请点击这里{tiny_click}投诉。",

		self::EMAIL_ERROR => "这种邮箱格式目前无法识别啊！",
		self::EMAIL_NOT_EXIST => "你确定输入email了？",
		self::BOOKSHELF_IS_EXIST => "这个书架已经存在了, 或许可以试试点击{click}取名",

		self::DATA_IS_NULL => "暂时没有数据哦",
	];
}