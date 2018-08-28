<?php
namespace app\route\api;

use \think\Route,
	\app\route\base\Ali;

echo Ali::set();die;
Route::rule('/api/u', 'api/user/login');
