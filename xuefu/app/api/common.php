<?php
use \app\api\model\User as U;

function user($where = '', $type = 1)
{
	if (! $where) return null;
	return U::one($where, $type);
}