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
			->where("box_type", 4)
			->where("box_title", $title)
			->select();

		if ($bookshelf) return rm::BOOKSHELF_IS_EXIST;

		$this->user_id = $uid;
		$this->box_title = $title;
		$this->box_type = 4;

		return $this->save() ?? false;
	}

	/**
	 * 获取我的列表
	 */
	public static function getMyBoxList($type, $uid)
	{
		return self::where("user_id", $uid)
			->where("box_type", $type)
			->select();
	}
}