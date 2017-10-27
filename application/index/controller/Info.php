<?php
namespace app\index\controller;
use app\index\model\Member;
use think\Session;
use think\Request;
use think\Validate;

class Info
{
	protected $user;
	protected $user_id;
	protected $username;
	public function __construct()
	{
		//实例化用户表
		$this->user = new Member();
		//获取session里面的信息
		$this->user_id = Session::get('user_id');
		$this->username = Session::get('username');
	}
	//修改个人信息基本资料
	public function info()
	{
		//获取所有的参数
		$request = Request::instance()->param();
		$res = $this->user->allowField(true)->save($request,['id' => $this->user_id]);
		//var_dump(Member::getLastSql());
		if ($res) {
			return ['msg' => "修改成功"];
		} else {
			return ['msg' => "修改失败"];
		}
	}
	//修改密码
	public function repass()
	{
		//获取所有的参数
		$request = Request::instance();
		$request = $request->param();
		//var_dump($request);
		//执行验证规则判断密码是否合格
		$res = $this->passCheck($request);
		if ($res != 'success') {
			return ['msg'=>$res];
		}
		if ($request['newpass'] != $request['newpass1']) {
			return ['msg' => '两次输入新密码不一致'];
		}
		//判断旧密码是否正确
		$oldpass = md5($request['oldpass']);
		$res = $this->user->exists('password',$oldpass);
		if (!$res) {
			return ['msg' => '旧密码输入错误'];
		}
		//修改密码
		$newpass1 = $request['newpass1'];
		$res = $this->user->allowField(true)->save(['password'=>$newpass1],['id' => $this->user_id]);
		if ($res) {
			return ['msg' => "修改成功"];
		} else {
			return ['msg' => "修改失败"];
		}
	}
	//定义规则判断密码是否合格
	protected function passCheck($data)
	{
		$rule = [
			['newpass','require|max:18|min:8','新密码不能为空|新密码不能超过18个字符|新密码不能少于8个字符'],
		];
		$validate = new Validate($rule);
		$result = $validate->check($data);
		if(!$result){
			return $validate->getError();
		} else {
			return 'success';
		}
	}
}