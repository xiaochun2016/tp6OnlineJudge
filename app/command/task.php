<?php
declare (strict_types=1);

namespace app\command;

use think\cache\driver\Redis;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Db;
use think\facade\Log;

/**
 *执行任务
 * @desc crontab 执行 第分钟一次
 * @exec /1 * * * * /usr/local/opt/php@7.4/bin/php /Users/yuanxiaochun/Documents/git_workspce/tp6OnlineJudge/think task
 */
class task extends Command {

	protected function configure() {
		// 指令配置
		$this->setName('task')
			->setDescription('the app\command\task command');
	}

	protected function execute(Input $input, Output $output) {
		// 指令输出
		$redis = new Redis();
		$id = $redis->rPop('tp6_online_judge_queue');
		if(!$id){
			Log::info("task 暂时没有任务".$id);
			return ;
		}
		$info = Db::table('commit')->field('id,uid,pid,code_url,status')->where(['id'=>$id])->find();
		if(!$info){
			$sql = Db::table('commit')->getLastSql();
			Log::info("task 任务获取commit数据失败 sql:".$sql);
			return ;
		}
		$case = Db::table('case')->where(['pid'=>$info['pid']])->field('id,pid,in,out')->select();
		if(!$case){
			$sql = Db::table('case')->getLastSql();
			Log::info("task 任务获取case表数据失败 sql:".$sql);
			return ;
		}
		$field = 'id,uid,cid,max_time';
		$problem = Db::table("problem")->where(['id'=>$info['pid']])->field($field)->find();
		if(!$problem){
			$sql = Db::table('problem')->getLastSql();
			Log::info("task 任务获取problem表数据失败 sql:".$sql);
			return ;
		}
		$flag = 1;
		foreach ($case as $c){
			$in = str_replace(',', ' ', $c['in']);
			if(!file_exists('/Users/yuanxiaochun/Documents/git_workspce/tp6OnlineJudge/public/' . $info['code_url'])){
				Log::info("task 执行文件不存在");
				break ;
			}
			$command = "/usr/local/opt/php@7.4/bin/php /Users/yuanxiaochun/Documents/git_workspce/tp6OnlineJudge/public/" . $info['code_url'] . ' ' . $in;
			$start_time = time();
			$res = exec($command);
			$end_timm = time();
			// 超时
			if ($end_timm - $start_time >= $problem['max_time']) {
				$flag = 3;
				Db::table('user')->where('id', '=', $info['uid'])->inc('total_num', 1)->update();
				Db::table('commit')->save(['id' => $id, 'status' => 3]);
				break;
			}
			// 答案错误
			if ($res != $c['out']) {
				$flag = 2;
				Db::table('user')->where('id', '=', $info['uid'])->inc('total_num', 1)->update();
				Db::table('commit')->save(['id' => $id, 'status' => 2]);
				break;
			}
		}

		if ($flag == 1) {
			$right_commit = Db::table('commit')->where(['uid'=>$info['uid'],'pid'=>$info['pid'],'status'=>1])->find();
			if (empty($right_commit)) {
				Db::table('user')->where('id', '=', $info['uid'])->inc('total_num', 1)->inc('solve_num', 1)->update();
			} else {
				Db::table('user')->where('id', '=', $info['uid'])->inc('total_num', 1)->update();
			}

			Db::table('commit')->save(['id' => $id, 'status' => 1]);
		}
		echo 'done';
		Log::info("task 执行完成done".$id);
//		$output->writeln('app\command\task');
	}
}
