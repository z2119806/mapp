<?php
namespace app\library\tool;

class AlwaysTake
{
	// -----------------------加密解密相关--------------------------
	/**
	 * 加密数字信息
	 *
	 * key 大于16位
	 * iv 必须一致
	 */
	private function encrypt($input, $iv = '0000000000000002')
	{
		$data = openssl_encrypt($input, 'AES-128-CFB', API_NUM_KEY, OPENSSL_RAW_DATA, $iv);   
		
		$data = base64_encode($data);
		return $data; 
	}

	/**
	 * 解密数字信息
	 */
	private function decrypt($input, $iv = '0000000000000002')
	{
		$data = openssl_decrypt(base64_decode($input), 'AES-128-CFB', API_NUM_KEY, OPENSSL_RAW_DATA, $iv);

		return $data;
	}

	/**
	 * 只加密id
	 */
	public function encryptToArray(Array $input, $key)
	{
		foreach ($input as $k => $v)
		{
			$input[$k][$key] = $this->encrypt($v[$key]);
		}

		return $input;
	}

	/**
	 * 解密字符串
	 */
	public function decryptToString(String $input)
	{
		return $this->decrypt($input);
	}
	// -----------------------------------------------------
}