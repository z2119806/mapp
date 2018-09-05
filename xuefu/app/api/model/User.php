<?php
namespace app\api\model;

use \app\api\library\base\BaseModel,
	\think\Config;

class User extends BaseModel
{
	protected $visible = [
		'user_id', 'user_email'
	];

	/**
	 * 注册
	 */
	public function add($data)
	{
		p($this->setToken(12332, 123771263));die;
		$this->user_email = $data['email'];
		$this->user_password = $this->setPassword($data['password']);
		$this->user_salt = $this->setSalt();

		$this->save();

		$this->user_token = $this->setToken($this->getAttr('user_id'), $this->getAttr('create_time'));
		$this->save();
	}

	/**
	 * 根据邮箱查询用户是否存在
	 */
	public static function one($email)
	{
		return self::where('user_email', $email)->find() ? true : false;
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
	    $arr = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];
	    $key = Config::get('api_secret_key');
	    $str = $time . random_int(100, 999) . $uid;
	    
	    $len = strlen($str);

	    // 设置干扰
	    $interfere = rand();
	    p(mt_rand(2,4));die;

	    $md5 = substr($md5, 0, $len);
	    
	    $result = '';
	    
	    for ($i = 0; $i < $len; $i ++)
	    {
	        $result .= $arr[$str[$i]] . $md5[$i];
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

	    $type = substr($str, 0, 1);
	    $time = substr($str, 1, 10);
	    $user_id = substr($str, 14);

	    $result->user_id = $user_id;
	    $result->type = $type;
	    $result->time = $time;

	    return $result;
	}
}