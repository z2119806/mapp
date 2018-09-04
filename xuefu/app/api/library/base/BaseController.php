<?php
namespace app\api\library\base;

use \app\api\library\constant\ReturnMessage,
	\think\Response,
	\think\exception\HttpResponseException;

class BaseController
{
	protected $data;

	/**
	 * 返回真假
	 */
	public function yesno($code = ReturnMessage::REQUEST_FAIL)
	{
		$this->data ? $this->yes($this->data) : $this->no($code);
	}

	/**
	 * 请求成功
	 */
	public function yes()
	{
		return $this->result(ReturnMessage::REQUEST_SUCCESS, $this->data);
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