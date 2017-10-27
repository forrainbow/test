<?php
namespace app\admin\controller;
use app\admin\model\Member;
use think\Request;
class UserManage
{
	protected $user;
	public function __construct()
	{
		$this->user = new Member();
	}
	//执行删除
	public function user_delete()
	{
		//获取所有的参数
		$request = Request::instance()->param();
		$res = $this->user->udel($request);
		if ($res) {
			return ['msg'=>'删除成功'];
		} else {
			return ['msg'=>'删除失败'];
		}
	}
	//执行添加
	public function user_add()
	{
		//获取所有的参数
		$request = Request::instance()->param();
		//$this->insert($request);
		return redirect('Admin\user\member_list');
	}
}