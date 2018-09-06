<?php
namespace app\api\library\tool;

use \app\api\library\constant\ApiSysException as ase;

class TpFiveCurrency
{
	/**
	 * 程序异常
	 */
	public function tpException($param)
	{
		foreach ($param as $k => $v)
		{
			if (! $v) 
			{
				$res = $k;
				break;
			}
		}

		exception('异常消息:' . $res . '为空');
	}
}