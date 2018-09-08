<?php
namespace app\admin\controller;

use think\Controller;

/**
 * 后台控制器
 */
class Index extends Controller {
	/**
	 * 访问路径: public/admin/index/index
	 */
	public function index() {
		return "<h1>这里是后台</h1>";
	}
}