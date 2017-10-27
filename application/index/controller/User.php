<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Member;
use app\index\model\BrandCategory;
use app\index\model\ClothesCategory;
use app\index\model\GoodsInfo;
use app\index\model\IndexCategory;
use think\Session;
use think\Db;

class User extends Controller
{
	protected $brand;
	protected $clothes;
	protected $goods;
	protected $index;
	public function __construct()
	{
		parent::__construct();
		$this->brand = new BrandCategory();
		$this->clothes = new ClothesCategory();
		$this->goods = new GoodsInfo();
		$this->index = new IndexCategory();
	}
	
	//登录方法
	public function login()
	{
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}
	//注册方法
	public function register()
	{
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}
	//个人中心
	public function people()
	{
		//查询我的收藏数据
		$coll = Db::name('member')->alias('m')
		->join('collect c','m.id=c.user_id','left')
		->join('goods_info g','c.goods_id=g.goods_id','left')
		->join('image','g.img_id=image.img_id')
		->select();
		//假如session为空，渲染404页面
		$user_id = Session::get('user_id');
		//获取用户收藏的商品总数
		$count = Db::table('jy_collect')->where('user_id',$user_id)->count();
		
		//查询我的优惠卷
		$coupon = Db::name('coupon')->where('user_id',$user_id)->select();
		//获取用户优惠券总数
		$coupon_sum = Db::name('coupon')->where('user_id',$user_id)->count();
		//调用头部展示部分方法
		$this->top_list();
		$this->assign('coll',$coll);
		$this->assign('count',$count);
		$this->assign('coupon',$coupon);
		$this->assign('coupon_sum',$coupon_sum);
		return $this->fetch();
	}
	//抽奖页面
	public function reward()
	{
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}
	//意见与建议
	public function msg()
	{
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}

	//公共遍历头部的方法
	protected function top_list()
	{
		//一级分类查询
		$cate1 = $this->brand->where('cate_pid',0)->select();
		//二级分类查询,品牌
		$cate2 = $this->brand->where('cate_pid!=0')->select();
		//三级分类查询,服装分类
		$cate3 = $this->clothes->cfind();
		//查询可视区的分类
		$view_cate = $this->index->find_index();
		$this->assign('view_cate',$view_cate);
		$this->assign('cate1',$cate1);
		$this->assign('cate2',$cate2);
		$this->assign('cate3',$cate3);

		//用户信息
		//判断session是否赋值
		//假如session为空，渲染404页面
		$user_id = Session::get('user_id');
		$user = Member::get($user_id);
		$this->assign('user',$user);
	}
}