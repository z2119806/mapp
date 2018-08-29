<?php

// 处理url
$url = explode('.', $_SERVER['REQUEST_URI']);
$work = $url[0];

// 转到
try
{   
	require_once 'route/' . $work . '.php';

} catch (\Exception $e)
{   
	echo 'route error';die;
}