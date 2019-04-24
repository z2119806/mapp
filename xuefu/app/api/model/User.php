<?php
namespace app\api\model;

use \app\library\base\BaseModel,
	\app\library\constant\ReturnMessage as rm,
	\think\Config;

class User extends BaseModel
{
	protected $visible = [
		'user_id', 'email', 'token', 'name', 'sex', 'age', 'icon', 'status'
	];

	/**
	 * 更新token
	 */
	public function saveToken($user)
	{
		$id = $user->getAttr('user_id');
	
		$user->token = $this->setToken($id, $user->getAttr('create_time'));

		if ($user->save())
			(new UserLoginRecord)->addRecord($id, time(), request()->ip());
		else
			return false;

		return true;
	}

	/**
	 * 注册
	 */
	public function add($data)
	{
		$this->startTrans();

		try
		{
			$ip = request()->ip();

		    $this->email = $data['email'];
		    $this->password = $this->setPassword($data['password']);
		    $this->salt = $this->setSalt();
		    $this->name = $data['email'];
		    $this->icon = '...';
		    $this->create_ip = $ip;
		    $this->save();
		    
		    $id = $this->getAttr('user_id');
		    $time = $this->getAttr('create_time');

		    $this->token = $this->setToken($id, $time);
		    $this->save();

		    (new UserLoginRecord)->addRecord($id, $time, $ip);

		    $this->commit();

		}catch (\Exception $e) 
		{
		    $this->rollback();

		    return false;
		}

		$this->age = 0;
		$this->sex = 0;
		$this->status = 1;

		$res['user'] = $this->toArray();

		return $res;
	}

	/**
	 * 根据type查询用户是否存在
	 *
	 * @param $param 参数
	 * @param $type  1 邮箱 2 token
	 */
	public static function one($param, $type = 1)
	{
		switch ($type) 
		{
			case 1:
				list($key, $value) = ['email', $param];
				break;

			case 2:
				list($key, $value) = ['token', $param];
				break;

			default:
				return rm::MODEL_ERROR;
				break;
		}

		$user = self::where($key, $value)->find();
		
		return $user ?? false;
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