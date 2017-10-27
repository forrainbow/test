<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\BrandCategory;
use app\admin\model\GoodsInfo;
class Goods extends Controller
{
	protected $brand;
	protected $goods;
	public function __construct()
	{
		parent::__construct();
		$this->brand = new BrandCategory();
		$this->goods = new GoodsInfo();
	}
	//
	public function product_add()
	{
		return $this->fetch();
	}
	//品牌列表
	public function product_brand()
	{
		$res = $this->brand->bfind();
		$this->assign('res',$res);
		return $this->fetch();
	}
	//
	public function product_category()
	{
		return $this->fetch();
	}

	public function product_category_add()
	{
		return $this->fetch();
	}

	public function product_list()
	{
		$res = $this->goods->goodsinfo();
		$this->assign('res',$res);
		return $this->fetch();
	}

	public function add()
	{
		return $this->fetch();
	}
}