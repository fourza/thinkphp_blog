<?php
namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;
use think\Request;
use think\Validate;

/**
 * 前台用户控制器
 */
class User extends Controller {
	/**
	 * 登录表单展示页面
	 *
	 * 访问路径: public/index.php/index/user/login
	 * @return [type] [description]
	 */
	public function login() {
		// 模板路径: index/view/user/login.html
		return $this->fetch();
	}

	/**
	 * 执行表单提交
	 *
	 * 访问路径: url('index/user/doLogin')
	 * public/index.php/index/user/doLogin
	 */
	public function doLogin(Request $request) {
		// print_r($_POST); // 方案一
		// $data = request()->post(); // 方案二
		// $data = request()->param(); // 方案三 $_GET(get请求) 或者 $_POST(post请求)
		// $data = $request->param(); // 方案四
		$data = $request->post(); // 方案五
		// print_r($data);
		// exit;

		if (!captcha_check($data['captcha'])) {
			$this->error("验证码非法");
		};

		// 1. 获取验证器对象
		$rule = [
			'username' => 'require',
			'password' => 'require',
		];
		$message = [
			'username.require' => '用户名不能为空',
			'password.require' => '密码不能为空',
		];
		$v = new Validate($rule, $message);

		// 2.执行验证
		if (!$v->check($data)) {
			// 3. 报错提示
			$this->error($v->getError());
		}

		$username = $data['username'];
		$password = md5($data['password']);

		$user = db('user')
			->where('username', 'eq', $username)
			->where('password', 'eq', $password)
			->find();
		print_r($user);
		if ($user) {
			// 将查询到的用户信息,赋值给session
			session('user', $user);
			$this->success('登录成功');
		} else {
			$this->error('登录失败');
		}
	}

	/**
	 * 用户注册表单展示
	 *
	 * 访问路径: index.php/index/user/register
	 */
	public function register() {
		// 模板路径: view/user/register.html
		return $this->fetch();
	}

	/**
	 * 注册表单执行
	 */
	public function doRegister(Request $request) {
		// $data = request()->param();
		$data = $request->param();

		if (empty($data['captcha']) || !captcha_check($data['captcha'])) {
			$this->error("验证码非法");
		};

		// // 验证规则
		// $rule = [
		// 	// '字段名' => '规则1|规则2|...'
		// 	'username' => 'require|length:2,100|unique:user',
		// 	'password' => 'require|min:6',
		// 	'repassword' => 'confirm:password',
		// ];
		// // 提示消息
		// $message = [
		// 	// '字段名.规则1' => "消息1",
		// 	// '字段名.规则2' => "消息2",
		// 	// ......
		// 	'username.require' => '用户名不能为空',
		// 	'username.length' => '用户名长度非法,2-100位',
		// 	'username.unique' => '用户名已被占用,请换一个',
		// 	'password.require' => "密码不能为空",
		// 	'password.min' => "密码长度非法,最小是6位",
		// 	'repassword.confirm' => "两次输入的密码不一致,请重新输入",

		// ];

		// // 获取验证器对象
		// $v = new Validate($rule, $message);

		// // 执行验证
		// if (!$v->check($data)) {
		// 	// 报错
		// 	$this->error($v->getError());
		// }

		// print_r($data);
		// if ($data['password'] != $data['repassword']) {
		// 	$this->error("两次输入的密码不一致,请重新输入");
		// }
		// unset($data['repassword']);
		// unset($data['captcha']);
		// 将明文转换为密文
		// $data['password'] = md5($data['password']);

		$model = new UserModel;
		$res = $model
			->allowField(true) // 过滤非数据表字段
			->validate(true) // 默认调用自定义验证器(验证器名称与模型名称一致)
			->save($data);
		if ($res) {
			$this->success("注册成功", url('index/user/login'));
		} else {
			// $this->error("注册失败");
			$this->error($model->getError());
		}
	}

	/**
	 * 用户退出
	 */
	public function logout() {
		// 删除登录时赋值的session
		session('user', null);
		// 跳转到首页
		$this->redirect(url('index/index/index'));
	}

	/**
	 * 用户中心
	 * @return [type] [description]
	 */
	public function center() {
		// session的赋值方式不同,取值方式也不一样
		// $_SESSION['user']['id'];
		$uid = session('user.id') ?? 0;
		if ($uid) {
			// 查询当前用户的博客
			// $blogs = model('Blog')
			// 	->where("uid=$uid")
			// 	->order('created DESC')
			// 	->paginate();

			$u = UserModel::get($uid);
			// print_r($u);exit;
			$blogs = $u->blogs();
			// print_r($blogs);
			$this->assign('blogs', $blogs);

			// 模板路径: view/user/center.html
			return $this->fetch();
		} else {
			// 跳转到登录页面,先登录
			$this->redirect(url('index/user/login'));
		}
	}
}