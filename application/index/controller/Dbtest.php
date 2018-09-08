<?php
namespace app\index\controller;

use app\index\model\Blog;
use app\index\model\User;
use think\Db;

class Dbtest {

	/**
	 * 访问路径: public/index.php/index/dbtest/index
	 * @return [type] [description]
	 */
	public function index() {
		// return "<h1>这里是数据库测试控制器</h1>";

		// 获取数据库对象
		// $db = Db::table('tedu_user');

		// $db = Db::name('user');

		// 通过助手函数获取对象
		$db = db('user');
		print_r($db);
	}

	/**
	 * 验证数据添加
	 *
	 * 访问路径: public/index.php/index/dbtest/add
	 */
	public function add() {
		// 1. 获取数据库对象
		$db = Db::table('tedu_user');

		$user = [
			'username' => 'TP_' . mt_rand(10000, 99999),
			'password' => md5('abc123'),
			'email' => 'test@qq.com',
			'phone' => '17712345678',
			'created' => time(),
		];

		// 2. 添加数据
		// $res = $db->insert($user);
		//
		// $res = $db->insertGetId($user);
		// echo $res;

		$users = [
			[
				'username' => 'TP_' . mt_rand(10000, 99999),
				'password' => md5('abc123'),
				'email' => 'test@qq.com',
				'phone' => '17712345678',
				'created' => time(),
			], [
				'username' => 'TP_' . mt_rand(10000, 99999),
				'password' => md5('abc123'),
				'email' => 'test@qq.com',
				'phone' => '17712345678',
				'created' => time(),
			],
		];

		//     tedu_user数据表
		$res = db('user')->insertAll($users);
		echo $res;

		return $res ? "添加成功" : "添加失败";
	}

	/**
	 * 验证数据库的删除操作
	 *
	 * 访问路径: public/index.php/index/dbtest/remove
	 */
	public function remove() {
		// 1.获取数据库对象
		// $db = Db::name('user'); // tedu_user

		// 删除一条记录
		// $res = $db->delete(10); // id=10
		// 删除多条记录
		// $res = db('user')->delete([6, 11]);
		// echo $res;

		// $b = Blog::get(23);
		// $res = $b->delete();

		$res = Blog::destroy([24, 25]);

		return $res ? "删除成功" : "删除失败";
	}

	/**
	 * 验证数据库的更新操作
	 *
	 * 访问路径: public/index.php/index/dbtest/update
	 */
	public function update() {
		$data = [
			'balance' => 100000000,
			'admin' => 1,
		];

		// $res = db('user')->where('id=8')
		// 	->update($data);

		// 访问博客详情,更新当前博客的浏览量
		// $res = db('blog')->where('id=10')
		// 	->setInc('views');

		// $res = db('user')->where('id=8')
		// 	->setInc('balance', 8000000);

		// $res = db('user')->where('id=8')
		// 	->setField('balance', 116000000);

		// 直接使用update,必须有id字段
		// $res = User::update(
		// 	[
		// 		'id' => 5,
		// 		'balance' => 100000000,
		// 		'admin' => 1,
		// 	]
		// );

		$u = new User;
		// $res = $u->save(
		// 	['balance' => 900],
		// 	['id' => 1]
		// );
		$res = $u->saveAll([
			[
				'id' => 1,
				'balance' => 20000,
			],
			[
				'id' => 7,
				'balance' => 20000,
			],
		]);
		print_r($res);

		return $res ? "更新成功" : "更新失败";
	}

	/**
	 * 验证数据库的查询操作
	 *
	 * 访问路径: public/index.php/index/dbtest/query
	 */
	public function query() {
		// 获取用户表中的所有管理员
		// $super = db('user')->where('admin=1')->select();

		// print_r($super);

		// 查询id=8的记录
		// $user = db('user')
		// 	->field('id,username,balance')
		// 	// ->where('id=8') // 一个参数
		// 	// ->where('id', 8) // 两个参数
		// 	->where('id', 'eq', 8) // 三个参数
		// 	->where('admin', 'eq', 1)
		// 	// ->find(8);
		// 	->find();

		// print_r($user);
		//
		// 查询博客列表,按照创建时间倒叙排列
		// $blogs = db('blog')
		// 	->field(['id', 'created'])
		// 	->order('created DESC')
		// 	// ->limit(5)
		// 	// ->limit(0, 5)
		// 	->limit(5, 5)
		// 	->select();

		// print_r($blogs);

		// $res = User::get(1);
		// // print_r($res);
		// echo $res->username;

		// print_r($res->toArray());
		// print_r($res->toJson());

		$admin = User::all(['admin' => 1]);
		print_r($admin);

	}
}