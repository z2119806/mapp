<?php
namespace app\api\library\base;

use \app\api\library\constant\ReturnMessage,
	\think\Response,
	\think\exception\HttpResponseException;

class BaseController
{
	/**
	 * 请求成功
	 */
	public function yes($data = [])
	{
		$data && $data = $this->setData($data);

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
	 * 处理返回数据为字符串
	 */
	public $res = [];
	public function setData($data)
	{
		foreach ($data as $k => $v)
		{
			if (is_array($v))
			{
				$this->setData($v);

			}else
			{
				$data[$k] = (string)$v;
				$this->res = array_merge($this->res, $data);
			}
		}

		return $this->res;
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