<?php
namespace app\library\base;

use \app\library\constant\ReturnMessage,
	\think\exception\HttpResponseException;

class BaseController
{
	public $user; // 用户
	public $notLogin = []; // 不验证

	public function __construct()
	{
		$request = request();

		// 验证登陆
		$url = $request->url();
		$api = substr($url, strpos($url, '.') + 1);

		if (! in_array($api, $this->notLogin))
		{
			$token = $request->header('token');
			if (! $token) $this->no(ReturnMessage::USER_NOT_EXIST);

			$this->user = user($token, 2);
			if ($this->user["user"]['status'] == 0) $this->no(ReturnMessage::USER_IS_EXCEPTION);
		}
	}

	/**
	 * 返回真假
	 */
	public function yesno($data = [], $code = ReturnMessage::REQUEST_FAIL)
	{
		$data ? $this->yes($data) : $this->no($code);
	}

	/**
	 * 请求成功
	 */
	public function yes($data)
	{
		return $this->result(ReturnMessage::REQUEST_SUCCESS, $data);
	}

	/**
	 * 请求失败
	 */
	public function no($code = ReturnMessage::REQUEST_FAIL)
	{
		return $this->result($code);
	}

	/**
	 * 返回资源对象
	 */
	private function result($code, $data = [])
	{
		$json['code'] = $code;
		$code != 200 && $json['message'] = ReturnMessage::$message[$code];
		$data && $json['data'] = $data;

		$json = json($json);
		throw new HttpResponseException($json);
	}
}