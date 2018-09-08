<?php
namespace app\index\model;

use think\Model;

/**
 * 前台模块的评论模型
 */
class Comment extends Model {
	// 时间字段的自动完成
	protected $autoWriteTimestamp = true;
	protected $updateTime = false;
	protected $createTime = 'created';

	/**
	 * 当前模型: Comment
	 *
	 * 查看评论的作者信息
	 */
	public function author() {
		return $this->belongsTo('User', 'uid');
	}
}