<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller {
	/**
	 * 首页
	 */
	public function index() {
		// return "<h1>Hello ThinkPHP!</h>";
		psd1803();
		// 模板路径: view/index/index.html
		return $this->fetch();
	}

	/**
	 * 访问路径: public/index.php/index/index/hello
	 *
	 * @return [type] [description]
	 */
	public function hello() {
		return "<h1>你好TP</h1>";
	}

	/**
	 * 输出常用路径的常量
	 *
	 * 访问路径:public/index.php/index/index/path
	 */
	public function path() {
		echo 'APP_PATH:' . APP_PATH . '<br />';
		echo 'THINK_PATH:' . THINK_PATH . '<br />';
		echo 'CORE_PATH:' . CORE_PATH . '<br />';
		echo 'VENDOR_PATH:' . VENDOR_PATH . '<br />';
	}

	/**
	 * 验证Think模板引擎
	 *
	 * 访问路径: public/index.php/index/index/tpl
	 */
	public function tpl() {
		$hi = "hello, World";
		$user = db('user')->find(8);
		// print_r($user);
		$obj = json_decode(json_encode($user));

		$blogs = db('blog')
			->field('id,title')
			->order('created DESC')
			->limit(10)
			->select();

		// 将PHP变量绑定到模板上
		// $this->assign('hi', $hi);
		$this->assign([
			'hi' => $hi,
			'user' => $user,
			'obj' => $obj,
			'blogs' => $blogs,
		]);

		// 渲染模板(模板输出)
		// 模板路径: index/view/index/tpl.html
		return $this->fetch();
	}
}
