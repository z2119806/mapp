<?php
namespace app\library\base;

use \app\library\constant\ReturnMessage,
	\think\exception\HttpResponseException;

class BaseController
{
	public $user = null; // 用户
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

			if (! $this->user) $this->no(ReturnMessage::USER_NOT_EXIST);
			if ($this->user->status == 0) $this->no(ReturnMessage::USER_IS_EXCEPTION);
		}
	}

	/**
	 * 处理不必要字段
	 */
	public function setReturnData($data)
	{
		if (isset($data->user_id)) unset($data->user_id);

		return $data;
	}

	/**
	 * 返回真假
	 */
	public function yesno($data = [], $code = ReturnMessage::REQUEST_FAIL)
	{
		if (is_numeric($data) && $data > 99) list($code, $data) = [$data, ''];
		
		$data ? $this->yes(is_array($data) || is_object($data) ? $data : '') : $this->no($code);
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
		$data = $this->setReturnData($data);

		$json['code'] = $code;
		$code != 200 && $json['message'] = ReturnMessage::$message[$code];
		$data && $json['data'] = $data;
		
		$json = json($json);
		throw new HttpResponseException($json);
	}
}