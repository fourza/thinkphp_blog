<?php
namespace app\index\controller;

use app\index\model\Blog as BlogModel;
use think\Controller;

// 控制器基础类

class Blog extends Controller {

	/**
	 * 初始化方法, 默认第一个被调用的方法
	 * @return [type] [description]
	 */
	public function _initialize() {
		// 最新博客
		$newest = db('blog')
			->field('id,title')
			->order('created DESC')
			->limit(5)
			->select();
		// 最热博客
		$hotest = db('blog')
			->field('id,title,views')
			->order('views DESC')
			->limit(5)
			->select();

		$this->assign('hotest', $hotest);
		$this->assign('newest', $newest);
	}
	/**
	 * 访问路径: public/index.php/index/blog/index
	 */
	public function blogList() {
		$blogs = BlogModel::field('id,title,uid,created,views,content')
			->order('created DESC')
			->paginate();

		// 查询三篇带有图片的最新博客
		$slide = db('blog')
			->field('id,title,image')
			->where('image', 'neq', '')
			->order('created DESC')
			->limit(4)
			->select();
		// print_r($slide);

		$this->assign('data', $blogs);
		$this->assign('slide', $slide);
		return $this->fetch();
	}

	/**
	 * 展示博客的详情
	 *
	 * 访问路径:index/blog/view/id/数字.html
	 * @param  int $id 博客id
	 */
	public function view($id) {
		// 直接在小括号中传参 - 方案一
		// $id = request()->param()['id']; // 方案二
		$id = input('param.id'); // 方案三
		// print_r($id);

		// echo $id;
		// print_r($_GET);
		// 根据id查看博客详情
		//
		// 更新浏览量
		$res = db('blog')
			->where('id', 'eq', $id)
			->setInc('views');

		// 查看博客详情
		// $blog = db('blog')->find($id);

		// 模型查询的方式,可以使用相对关联关系
		// $blog = model('Blog')->find($id);
		// 一篇博客对应多个评论
		$blog = BlogModel::get($id);
		// print_r($blog->comments());
		// 将变量绑定到模板
		$this->assign('data', $blog);
		$this->assign('comments', $blog->comments());

		// 渲染模板
		// 默认模板路径: /index/view/blog/view.html
		return $this->fetch();
	}

	/**
	 * 添加博客展示页面
	 *
	 * 访问路径: /index.php/index/blog/add
	 */
	public function add() {
		// 模板路径: view/blog/add.html
		return $this->fetch();
	}

	public function doAdd() {
		// $data = request()->post();
		$data = request()->param();

		// 1. 获取文件
		$file = request()->file('image');
		if ($file) {
			// 2. 执行上传 ROOT_PATH
			// 上传路径 /public/static/upload
			$info = $file->move(ROOT_PATH . 'public/static/upload');
			if ($info) {
				// 3. 保存上传路径
				$data['image'] = $info->getSaveName();
			} else {
				// 报错提示
				$this->error($file->getError());
			}
		}
		$model = new BlogModel;
		$res = $model->save($data);
		if ($res) {
			$this->success('添加成功', url('index/blog/blogList'));
		} else {
			$this->error("添加失败");
		}
	}
}