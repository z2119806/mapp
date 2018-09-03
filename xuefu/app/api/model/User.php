<?php
namespace app\api\model;

use \app\api\library\base\BaseModel;

class User extends BaseModel
{
	public function add()
	{
		$this->user_email = '12';

		$this->save();
	}

	public static function find()
	{
		return self::get(10004);
	}
}