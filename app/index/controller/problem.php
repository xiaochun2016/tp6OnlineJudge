<?php
declare (strict_types=1);

namespace app\index\controller;

use app\BaseController;
use app\Request;
use think\cache\driver\Redis;
use think\facade\Db;
const REDIS_KEY ='tp6_online_judge_queue';
class problem extends BaseController {
	public function index() {
		$problem = Db::table("problem p")->leftJoin('cate c', 'p.cid=c.id')->field("p.id, p.title, c.name catename, p.total_num, p.right_num")->paginate(15);
		$data = [
			'problems' => $problem
		];
		if (!empty(session('userInfo'))) {
			$ids = array_column($problem->toArray()['data'], 'id');
			$problemids = ltrim(implode(",", $ids), ',');
			$commits = Db::table('commit co')
				->field('id, pid')
				->where('status', '=', 1)
				->where('uid', '=', session('userInfo')['id'])
				->where('pid', 'in', $problemids)
				->select();
			$commit_set = [];
			foreach ($commits as $v2) {
				$commit_set[$v2['pid']] = 1;
			}
			$data['commit_set'] = $commit_set;
		}
		return view("/problem/index", $data);
	}

	public function detail(Request $request) {
		$id = input('get.id');
		if (!$id) {
			return redirect('/index.php/index/problem/index');
		}
		$problem = Db::table('problem p')
			->field('p.title, p.content, p.max_time, p.total_num, p.right_num, u.username, c.name catename')
			->leftJoin('cate c', 'c.id = p.cid')
			->leftJoin('user u', 'u.id = p.uid')
			->where('p.id', '=', $id)
			->find();
		$cate = Db::table('case c')
			->field('c.in, c.out')
			->where('c.pid', '=', $id)
			->find();
		$comments = Db::table('comment c')
			->field('u.username, c.content, c.create_time')
			->leftJoin('user u', 'u.id = c.uid')
			->where('c.pid', '=', $id)
			->order('c.create_time', 'desc')
			->limit(5)
			->select();
		return view('/problem/detail', ['problem' => $problem, 'cate' => $cate, 'comments' => $comments]);
	}

	public function detail_submit(Request $request) {
		if ($request->isPost()) {
			$pid = input('post.pid');
			$code = input('post.code');
			if (!$pid || !$code) {
				return self::returnJson(201, '参数错误');
			}
			$uid = session('userInfo')['id'];
			$fileName = 'static/commit/' . md5($uid . $pid . rand(1000, 9999) . time()) . '.php';
			$f = fopen($fileName, "x+",);
			if (!$f) {
				return self::returnJson(202, '创建文件失败');
			}
			$result = fwrite($f, $code);
			if (!$result) {
				return self::returnJson(203, "写入失败");
			}
			fclose($f);
			$data = [
				'uid'         => $uid,
				'pid'         => $pid,
				'code_url'    => $fileName,
				'status'      => 0,
				'create_time' => time(),
				'update_time' => time()];
			$commit_id = Db::table('commit')->insertGetId($data);
			// 3.将commit 中的ID存到redis队列中
			$redis = new Redis();
			$redis->lPush(REDIS_KEY, $commit_id);
			return self::returnJson(200, "成功");
		}
		return view('problem/detail_submit');
	}

	public function comment(Request $request) {
		if ($request->isPost()) {
			$uid = input('post.uid');
			$pid = input('post.pid');
			$content = input('post.content');
			Db::table('comment')
				->save(['uid' => $uid, 'pid' => $pid, 'content' => $content, 'create_time' => time(), 'update_time' => time()]);
			return self::returnJson(200, '评论提交成功');
		}
	}
}
