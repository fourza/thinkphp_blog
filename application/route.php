<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

// 注册路由 - 方案三
Route::rule('blog/:id', 'index/blog/view', 'get', ['id' => '[1-9]\d*']);
Route::rule('blog', 'index/blog/bloglist');

return [
	'__pattern__' => [
		'name' => '\w+',
	],
	'[hello]' => [
		':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
		':name' => ['index/hello', ['method' => 'post']],
	],
	// 直接声明 - 方式一
	// 路由表达式  地址表达式
	// blog      index/blog/bloglist
	// blog/数字  index/blog/view/id/数字
	// 'blog/:id' => ['index/blog/view', ['method' => 'get'], ['id' => '\d+']],
	// 'blog' => ['index/blog/bloglist', ['method' => 'get']],

	// 路由分组 - 方式二
	// 简介: 将带有共同前缀的路由放在一个配置数组中
	// '[blog]' => [
	// 	":id" => ['index/blog/view', ['method' => 'get'], ['id' => '\d+']],
	// 	"/" => ['index/blog/bloglist', ['method' => 'get']],
	// ],

];
