<?php
namespace app\api\model;

use \app\api\library\base\BaseModel;

class User extends BaseModel
{
	protected $visible = [
		'user_id', 'user_email'
	];

	public function add()
	{
		$this->user_email = '12';

		$this->save();
	}

	/**
	 * 根据邮箱查询用户是否存在
	 */
	public static function one($email)
	{
		return self::where('user_email', $email)->find() ? true : false;
	}
}