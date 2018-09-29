<?php
use \app\api\model\User as U;

function user($where = '', $type = 1)
{
	if (! $where) return null;
	return U::one($where, $type);
}

function tool()
{
	return new \app\library\tool\AlwaysTake;
}

// 加载常量类
require_once 'constant.php';