<?php
namespace app\api\controller;

use \think\Loader,
    \app\library\base\BaseController,
    \app\library\constant\ReturnMessage;

class Type extends BaseController
{
	// 获取书架
	public function parentBookshelf()
	{
		halt($this->user);
	}

	// 操作书架名
	public function saveBookshelf()
	{
		
	}

	// 书架格子
	public function parentStorage()
	{

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