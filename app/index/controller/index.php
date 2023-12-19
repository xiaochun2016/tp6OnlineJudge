<?php
declare (strict_types=1);

namespace app\index\controller;

use app\BaseController;
use app\Request;
use think\facade\Db;
use think\response\View;

class index extends BaseController {
	/**
	 * 首页
	 */
	public function index(): View {
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
			'news' => $news,
			'ranks' => $ranks
		];
		return view("/index/index",$data);
	}

	public function login(Request $request) {
		$email = input("post.user_email");
		$password = input('password');
		if ($email && $password){
			$user = Db::table('user')->field("id,username")->where(['username|email'=>$email,'password'=>md5($password)])->find();
			if($user){
				session("username",['username' => $user['username'], 'id' => $user['id']]);
				return self::returnJson(200, '登录成功');
			}else{
				return self::returnJson(404,  '用户名或密码不正确');
			}
		}
		return view('/common/login');
	}

	public function register(): View {
		return view('/common/register');
	}

	public function exit(): \think\response\Redirect {
		session('username',null);
		return redirect('/index/index');
	}
}
