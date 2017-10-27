<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Member;

class User extends Controller
{
	protected $user;
	public function __construct()
	{
		parent::__construct();
		//实例化member类
		$this->user = new Member();
	}
	public function member_add()
	{
		return $this->fetch();
	}
	public function member_del()
	{
		return $this->fetch();
	}
	public function member_list()
	{
		$ures = $this->user->ufind();
		$this->assign('ures',$ures);
		return $this->fetch();
	}
	public function member_record_browse()
	{
		return $this->fetch();
	}
	public function member_record_download()
	{
		return $this->fetch();
	}
	public function member_record_share()
	{
		return $this->fetch();
	}
	public function member_show()
	{
		return $this->fetch();
	}
	//修改密码
	public function change_password()
	{
		return $this->fetch();
	}
	//意见列表
	public function msg_list()
	{
		return $this->fetch();
	}
}