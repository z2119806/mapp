<?php
namespace app\api\model;

use \app\library\base\BaseModel,
	\app\library\constant\ReturnMessage as rm,
	\think\Config;

class Box extends BaseModel
{
	protected $visible = [
		'box_id', 'box_title', 'box_type'
	];

	/**
	 * 添加或收藏书架
	 */
	public function bookshelfAdd($title, $uid)
	{
		$bookshelf = $this->where("user_id", $uid)
			->where("box_type", 3)
			->where("box_title", $title)
			->select();

		if ($bookshelf) return rm::BOOKSHELF_IS_EXIST;

		$this->user_id = $uid;
		$this->box_title = $title;
		$this->box_type = 3;

		return $this->save() ?? false;
	}

	/**
	 * 获取我的列表
	 */
	public static function getMyBookselfList($uid)
	{
		$data = self::where("user_id", $uid)
			->where("box_type", 3)
			->select();

		$data = tool()->encryptToArray($data, 'box_id');

		return $data;
	}

	/**
	 * 获取我的格子列表
	 */
	public static function getMyChildStoragelist($uid, $pid)
	{
		$data = self::where("user_id", $uid)
			->where("box_type", 2)
			->where("box_pid", tool()->decryptToString($pid))
			->select();

		$data = tool()->encryptToArray($data, 'box_id');

		return $data;
	}
}