<?php
namespace app\index\controller;
use app\index\model\GoodsInfo;
use think\Controller;
use think\Request;

class Sort extends Controller 
{
	protected $goods;
	public function __construct()
	{
		parent::__construct();
		$this->goods = new GoodsInfo();
	}
	//根据发布时间排序
	public function create_time()
	{
		// 获取品牌id和分类id参数
		$brand_id = Request::instance()->param('brand_id');
		$clothes_id = Request::instance()->param('clothes_id');
		$order = Request::instance()->param('order');
		$goods = $this->goods->goodsinfo($brand_id,$clothes_id,$order,'desc');
		$this->assign('goods',$goods);
		return $this->fetch()
	}
}