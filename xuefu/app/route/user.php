<?php
namespace app\route\api;
use \think\Route;

Route::$routePrefix = 'user';
Route::post("exist", "exist"); // 用户是否存在
Route::post("login", "login"); // 登陆