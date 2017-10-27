<?php
namespace app\index\controller;
use app\index\model\Collect as Coll;
use think\Request;
use think\Session;

class Collect
{
	protected $coll;
	public function __construct()
	{
		$this->coll = new Coll();
	}
	public function add()
	{
		//获取前端传过来的商品id
		$goods_id = Request::instance()->param('goods_id');
		//从session里面获取用户id
		$user_id = Session::get('user_id');
		//判断该用户是否已经收藏过了该商品
		$opt = Db::table('collect')->where('user_id',$user_id)->value('goods_id');
		if ($opt == $goods_id) {
			return ['msg'=>'收藏过了','status'=>1];
		}
		//放入数组
		$data = ['goods_id'=>$goods_id,'user_id'=>$user_id];
		//调用插入方法
		$res = $this->coll->addCollect($data);
		return ['status'=>0];
	}
	
}