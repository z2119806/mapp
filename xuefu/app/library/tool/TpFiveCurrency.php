<?php
namespace app\library\tool;

use \app\library\constant\ApiSysException as ase;

class TpFiveCurrency
{
	/**
	 * 程序异常
	 */
	public function tpException($param)
	{
		$res = false;
		foreach ($param as $k => $v)
		{
			if (! $v) 
			{
				$res = $k;
				break;
			}
		}
		
		$res && exception(ase::exceptionMessage($res));
	}
}