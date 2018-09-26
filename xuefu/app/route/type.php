<?php
namespace app\route\api;
use \think\Route;

Route::$routePrefix = 'type';
Route::get("bookshelf", "parentBookshelf"); // 书架
Route::get("storage", "childStorage"); // 格子
Route::get("notebook", "childNotebook"); // 笔记
Route::get("notepage", "chlidNotepage"); // 笔记页
Route::get("sticker", "extraSticker"); // 书帖
Route::post("save.bookshelf", "saveBookshelf"); // 操作书架
Route::post("save.storage", "saveChildStorage"); // 操作格子