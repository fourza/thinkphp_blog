<?php
namespace app\index\model;

use think\Model;

/**
 * 前台博客模型
 */
class Blog extends Model {
	// 时间字段的自动完成
	protected $autoWriteTimestamp = true;
	protected $updateTime = 'updated';
	protected $createTime = "created";

	// 普通字段的自动完成
	protected $auto = []; // 添加+新增
	protected $insert = [
		'views' => 1,
		'uid',
	]; // 添加
	protected $update = []; // 更新

	/**
	 * 修改器 设置博客作者为当前登录用户
	 * 函数名: set字段名Attr()
	 */
	protected function setUidAttr() {
		return session('user.id') ?? 1;
	}

	/**
	 * 当前模型: Blog
	 *
	 * 查询博客下的用户信息
	 */
	public function author() {
		// 相对关联模型是: User
		return $this->belongsTo('User', 'uid');
	}

	/**
	 * 当前模型: Blog
	 *
	 * 查询博客下的多个评论
	 */
	public function comments() {
		return $this->hasMany('Comment', 'bid')
			->order('created DESC')
			->paginate();
	}
}
