<?php
namespace app\api\model;

use \app\library\base\BaseModel,
	\app\library\constant\ServiceMessage as sm,
	\think\Config;

class User extends BaseModel
{
	protected $visible = [
		'user_id', 'user_email', 'user_token', 'user_name', 'user_sex', 'user_age', 'user_icon', 'status'
	];

	/**
	 * 注册
	 */
	public function add($data)
	{
		$this->startTrans();

		try
		{
		    $this->user_email = $data['email'];
		    $this->user_password = $this->setPassword($data['password']);
		    $this->user_salt = $this->setSalt();
		    $this->user_name = $data['email'];
		    $this->user_icon = '...';

		    $this->save();
		    
		    $this->user_token = $this->setToken($this->getAttr('user_id'), $this->getAttr('create_time'));

		    $this->save();
		    $this->commit();

		}catch (\Exception $e) 
		{
		    $this->rollback();

		    return false;
		}

		$this->user_age = 0;
		$this->user_sex = 0;
		$this->status = 1;

		$res['user'] = $this->toArray();

		return $res;
	}

	/**
	 * 根据邮箱查询用户是否存在
	 */
	public static function one($email)
	{
		$user = self::where('user_email', $email)->find();

		if ($user) 
		{
			$res['user'] = $user->toArray();

			return $res;

		}else 
			return false;
	}

	/**
	 * 设置密码
	 */
	public function setPassword($password)
	{
		return md5(Config::get('api_secret_key') . $this->setSalt() . $password);
	}

	/**
	 * 设置盐值
	 */
	public function setSalt()
	{
		return random_int(1000, 9999);
	}

	/**
	 * 设置token
	 */
	public function setToken($uid, $time)
	{
		cException(['uid' => $uid, 'time' => $time]);

	    $arr = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];
	    $key = Config::get('api_secret_key');
	    $str = $time . random_int(100, 999) . $uid;
	    $len = strlen($str);
	    
	    // 设置干扰
	    $interfere = $this->setInterfere($len);

	    $result = '';
	    for ($i = 0; $i < $len; $i ++)
	    {
	        $result .= $arr[$str[$i]] . $interfere[$i];
	    }

	    return $result;
	}

	/**
	 * 反解token
	 */
	public function getTokenInfo($token)
	{
	    $arr = ['a' => 0, 'b' => 1, 'c' => 2, 'd' => 3, 'e' => 4, 'f' => 5, 'g' => 6, 'h' => 7, 'i' => 8, 'j' => 9];
	    $len = strlen($token);

	    $str = '';
	    for ($i = 0; $i < $len; $i ++)
	    {
	        if (($i + 1) % 2 == 1)
	        {
	            $str .= $arr[$token[$i]];
	        }
	    }
	    
	    // 设置对象
	    $result = new \stdClass;

	    $time = substr($str, 0, 10);
	    $user_id = substr($str, 13);

	    $result->user_id = $user_id;
	    $result->time = $time;

	    return $result;
	}

	/**
	 * 设置干扰项
	 */
	public function setInterfere($len)
	{
		$str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str = str_shuffle($str);
		$res = '';

		for ($i = 0; $i < $len; $i ++)
		{
			$res .= $str[$i];
		}
		
		return $res;
	}
}