<?php
declare (strict_types=1);

namespace app\index\controller;

use app\BaseController;
use app\Request;
use think\cache\driver\Redis;
use think\facade\Db;
use think\response\View;

class index extends BaseController {
	/**
	 * 首页
	 */
	public function index() {
		$news = Db::table('news')
			->alias("n")
			->leftJoin('user u', 'n.uid = u.id')
			->field('n.*, u.username')
			->order('create_time', 'desc')
			->limit(5)
			->select();
		$ranks = Db::table('user')
			->field('username, solve_num')
			->order('solve_num', 'desc')
			->order('total_num', 'asc')
			->limit(5)
			->select();
		$data = [
			'news'  => $news,
			'ranks' => $ranks
		];
		return view("/index/index", $data);
	}

	public function login() {
		$email = input("post.user_email");
		$password = input('password');
		if ($email && $password) {
			$user = Db::table('user')->field("id,username")->where(['username|email' => $email, 'password' => md5($password)])->find();
			if ($user) {
				session("userInfo", ['username' => $user['username'], 'id' => $user['id']]);
				return self::returnJson(200, '登录成功');
			} else {
				return self::returnJson(404, '用户名或密码不正确');
			}
		}
		return view('/common/login');
	}

	public function register(Request $request): View {
		if ($request->isPost()) {
			$email = input('post.email');
			$code = input('post.code');
			$userName = input('post.username');
			$password = input('post.password');
			if (!$email || !$code || !$userName || !$password) {
				return self::returnJson(201, '参数错误');
			}
			$redis = new Redis();
			$captcha = $redis->get($email);
			if (!$captcha || $captcha != $code) {
				return self::returnJson(203, '验证码错误');
			}
			$model = Db::table('user');
			$info = $model->field('id')->where(['username|email' => $userName])->find();
			if ($info) {
				return self::returnJson(204, '用户已存在');
			}
			$data = [
				'username'    => $userName,
				'password'    => md5($password),
				'email'       => $email,
				'create_time' => time(),
				'update_time' => time()
			];
			$res = Db::table('user')->insertGetId($data);
			if ($res) {
				session("userInfo", ['username' => $userName, 'id' => $res]);
				return self::returnJson(200, '注册成功');
			} else {
				return self::returnJson(202, '注册失败');
			}
		}
		return view('/common/register');
	}

	/**
	 * 退出登录
	 * @return \think\response\Redirect
	 */
	public function exit(): \think\response\Redirect {
		session('userInfo', null);
		return redirect('/index/index');
	}

	/**
	 * 发送邮件验证码
	 * @param Request $request
	 * @return false|string
	 */
	public function sendCode(Request $request) {
		$email = $request->post('email');
		if (!$email) {
			return self::returnJson(201, '邮箱不能为空');
		}
		$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'; // 定义邮箱格式的正则表达式
		if (!preg_match($pattern, $email)) {
			return self::returnJson(202, '邮箱格式不正确');; // 否则返回false
		}
		$captcha = rand(100000, 999999);
		$content = '你的验证码:' . $captcha . '<br>十分钟内有效';
		$redis = new Redis();
		$redis->set($email, $captcha, 300);
		$res = sendCode($email, $content, '验证码');
		if ($res) {
			return self::returnJson(200, '发送成功');
		} else {
			return self::returnJson(203, '发送失败');
		}
	}

	public function rank() {
		$users = Db::table('user')->order('solve_num', 'desc')->order('total_num', 'asc')
			->paginate(20);
		return view('/rank/index', ['users' => $users]);
	}

	public function status() {
		$statuss = Db::table('commit c')
			->field('u.username, c.pid, p.title, c.status, c.create_time')
			->leftJoin('problem p', 'p.id = c.pid')
			->leftJoin('user u', 'u.id = c.uid')
			->order('c.id', 'desc')
			->paginate(20);
		return view('/judge_status/index', array('statuss' => $statuss));
	}
}
