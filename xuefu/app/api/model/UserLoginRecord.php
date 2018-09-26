<?php
namespace app\api\model;

use \app\library\base\BaseModel,
	\think\Config;

class UserLoginRecord extends BaseModel
{
	protected $autoWriteTimestamp = false;

	/**
	 * 记录登录
	 */
	public function addRecord($userid, $time, $ip)
	{
		$this->user_id = $userid;
		$this->last_login_time = $time;
		$this->last_login_ip = $ip;

		return $this->save();
	}
}