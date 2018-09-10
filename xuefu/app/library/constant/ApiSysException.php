<?php
namespace app\library\constant;

class ApiSysException
{
	const MESSAGE = '异常消息：';
	const RESULT = '为空';

	public static function exceptionMessage($key)
	{
		return self::MESSAGE . $key . self::RESULT;
	}
}