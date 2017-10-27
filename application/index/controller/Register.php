<?php
namespace app\index\controller;
use app\index\model\Member;
use think\Request;
use Msg;

//use Msg;
class Register
{

	protected $member;
	public function __construct()
	{
		$this->member = new Member();
	}
	//通过手机号码注册
	public function phone()
	{
		//接收用户名
		$username = Request::instance()->post('username');
		$password = Request::instance()->post('password');

		//判断用户名是否存在
		$flag = $this->member->exists('username',$username);
		if ($flag) {
			echo json_encode(['msg' => '用户名已存在','status'=>'0']);
		} else {
			$res = $this->member->insert(input('post.'));
			if ($res) {
				echo json_encode(['msg' => '注册成功','status'=>'1']);
			} else {
				echo json_encode(['msg' => '注册失败','status'=>'1']);
			}
		}
	}
	//发送短信
	public function sendMsg()
	{
		$massege = Request::instance()->get('msg');
		//初始化必填
		$options['accountsid']='255f52fb3941c7742b000bb11e0226c7';
		$options['token']='c3b6ffcc8ef497e2462404fec3d67e53';
		//初始化 $options必填
		$msg = new Msg($options);
		//开发者账号信息查询默认为json或xml
		header("Content-Type:text/html;charset=utf-8");
		//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
		$appId = "2a005ebf76af48b99eb38e53c4a8330c";
		$to = $massege;
		$templateId = "182506";
		$a = mt_rand(100000,999999);
		//$b = mt_rand(100000,999999);
		$param="$a";
		$code = $msg->templateSMS($appId,$to,$templateId,$param);
		//把短信验证码写入文件中
		file_put_contents('1.txt', $param);
	}
	//短信验证
	public function msgCheck()
	{
		//从1.txt中取出验证码
		$param = file_get_contents('1.txt');
		//接收前端massege验证码
		$massege = Request::instance()->post('msg');
		if ($massege != $param) {
			echo json_encode(['msg' => '短信验证码错误','status'=>'0']);
		} else {
			echo json_encode(['msg' => '验证成功','status'=>'1']);
		}
	}
	//通过邮箱注册
	public function email()
	{
		//接收用户名
		$username = Request::instance()->post('username');
		$password = Request::instance()->post('password');
		//判断用户名是否存在
		$flag = $this->member->exists($username);
		if ($flag) {
			echo json_encode(['msg' => '用户名已存在','status'=>'0']);
		} else {
			$_POST['email'] = $username;
			$res = $this->member->insert($_POST);
			if ($res) {
				echo json_encode(['msg' => '注册成功','status'=>'1']);
			} else {
				echo json_encode(['msg' => '注册失败','status'=>'0']);
			}
		}
	}
}