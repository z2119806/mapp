<?php
namespace app\library\base;

use \app\library\constant\ReturnMessage,
	\think\Response,
	\think\exception\HttpResponseException;

class BaseController
{
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