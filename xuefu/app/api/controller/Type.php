<?php
namespace app\api\controller;

use \think\Loader,
    \app\library\base\BaseController,
    \app\api\model\Box,
    \app\library\constant\ReturnMessage as rm;

class Type extends BaseController
{
	// 获取书架
	public function parentBookshelf()
	{
		// 返回
		$this->yesno(Box::getMyBookselfList($this->user->user_id), rm::DATA_IS_NULL);
	}

	// 操作书架名
	public function saveBookshelf()
	{
		// 获取值
		$data = input();

		// 验证
		$validate = Loader::validate("Type");
		if(! $validate->scene('bookself')->check($data)) $this->no($validate->getError());
		
		// 返回
		$this->yesno((new Box)->bookshelfAdd($data['title'], $this->user->user_id));
	}

	// 书架格子
	public function childStorage()                  
	{
		// 获取值
		$data = input();

		// 验证
		$validate = Loader::validate("Type");
		if(! $validate->scene('storage')->check($data)) $this->no($validate->getError());
		
		// 返回
		$this->yesno(Box::getMyChildStoragelist($this->user->user_id, $data['box_id']), rm::DATA_IS_NULL);
	}

	// 操作格子名
	public function saveChildStorage()
	{
		// 获取值
		$data = input();
		
		// 验证
		$validate = Loader::validate("Type");
		if(! $validate->scene('storage_add')->check($data)) $this->no($validate->getError());
		
		// 返回
		$this->yesno((new Box)->bookshelfAdd($data['title'], $this->user->user_id));
	}

	// 笔记
	public function childNotebook()
	{

	}

	// 页
	public function chlidNotepage()
	{

	}

	// 书帖
	public function extraSticker()
	{

	}
}