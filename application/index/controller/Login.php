<?php
namespace app\index\controller;
use app\index\model\Member;
use think\Request;
use think\Validate;
use think\Session;

class Login
{
	protected $member;
	public function __construct()
	{
		$this->member = new Member();
	}
	//验证用户名是否存在，密码是否正确
	public function index()
	{
		//接收用户名和密码
		$username = Request::instance()->post('username');
		$password = Request::instance()->post('password');
		//判断用户名是否存在
		$flag = $this->member->exists('username',$username);
		if (!$flag) {
			echo json_encode(['msg' => '用户名不存在','status'=>'0']);
		} else {
			//用户存在，判断密码是否正确
			$dataPass = $flag['password'];
			if (md5($password) == $dataPass) {
				//把用户名和id存入session
				$user_id = Member::where('username',$username)->value('id');
				Session::set('username',$username);
				Session::set('user_id',$user_id);
				echo json_encode(['msg' => '登录成功','status'=>'1']);
			} else {
				echo json_encode(['msg' => '密码输入错误','status'=>'0']);
			}
		}
		
	}
	//验证用户名或者密码输入格式是否正确
	public function userCheck()
	{
		$request = Request::instance();
		$data = $request->param();
		$rule = [
			['username','require|max:18|min:8','用户名不能为空|用户名不能超过18个字符|用户名不能少于8个字符'],
		];
		$validate = new Validate($rule);
		$result = $validate->check($data);
		if(!$result){
			echo json_encode(['msg' => $validate->getError(),'status'=>'0']);
		} else {
			echo json_encode(['status'=>'1']);
		}
	}
}