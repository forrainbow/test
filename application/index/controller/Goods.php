<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\index\model\BrandCategory;
use app\index\model\ClothesCategory;
use app\index\model\GoodsInfo;
use app\index\model\Image;
use app\index\model\IndexCategory;
use app\index\model\Member;
class Goods extends Controller
{
	protected $brand;
	protected $clothes;
	protected $goods;
	protected $image;
	protected $index;
	public function __construct()
	{
		parent::__construct();
		$this->brand = new BrandCategory();
		$this->clothes = new ClothesCategory();
		$this->goods = new GoodsInfo();
		$this->image = new Image();
		$this->index = new IndexCategory();
	}
	//商品详情
	public function details()
	{
		// 获取商品id参数
		$goods_id = Request::instance()->param('goods_id');
		$brand_id = Request::instance()->param('brand_id');
		$clothes_id = Request::instance()->param('clothes_id');
		//获取品牌名字
		$brand_name = $this->brand->getValue(['cate_id'=>$brand_id],'cate_name');
		//查询分类的名字
		$clothes_name = $this->clothes->getValue(['clothes_id'=>$clothes_id],'name');
		//查询该商品的详细信息
		$goods = $this->goods->goodsOne(['goods_id'=>$goods_id])[0];
		//查询该商品的图片信息
		$img = GoodsInfo::get($goods_id)->image;
		// 查询该品牌下的热门分类
		$hot_cate = $this->clothes->hot_cate($brand_id);
		//dump($hot_cate);
		$this->assign('goods_id',$goods_id);
		$this->assign('clothes_id',$clothes_id);
		$this->assign('brand_id',$brand_id);
		$this->assign('goods',$goods);
		$this->assign('img',$img);
		$this->assign('hot_cate',$hot_cate);
		$this->assign('brand_name',$brand_name);
		$this->assign('clothes_name',$clothes_name);
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}
	//品牌店铺列表
	public function goods_list()
	{
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}
	//购物车
	public function shop_car()
	{
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}
	//搜索后的商品展示
	public function search()
	{
		//获取搜索的内容
		$search = Request::instance()->param('search');
		//三表联合模糊查询,把相关的字段都查询出来，很方便
		$res = Db::name('brand_category')
		->alias('b')
		->join('clothes_category c','b.cate_id=c.brand_id','left')
		->join('goods_info g','c.clothes_id=g.goods_category')
		->join('image','g.img_id=image.img_id')
		->where('c.name|b.cate_name|g.goods_introduce|g.goods_name','like','%'.$search.'%')
		->select();
		$this->assign('res',$res);
		//调用头部展示部分方法
		$this->top_list();
		return $this->fetch();
	}
	//商品分类
	public function category()
	{
		// 获取品牌id和分类id参数
		$brand_id = Request::instance()->param('brand_id');
		$clothes_id = Request::instance()->param('clothes_id');
		//判断是否进行排序
		if (!empty(Request::instance()->param('order'))) {
			$order = Request::instance()->param('order');
			$desc = Request::instance()->param('desc');
		} else {
			$order = 'goods_id';
			$desc = 'asc';
		}

		//查询商品信息
		$goods = $this->goods->goodsinfo($brand_id,$clothes_id,$order,$desc);
		//获取品牌名字
		$brand_name = $this->brand->getValue(['cate_id'=>$brand_id],'cate_name');
		//查询分类的名字
		$clothes_name = $this->clothes->getValue(['clothes_id'=>$clothes_id],'name');

		//调用头部展示部分方法
		$this->top_list();
		//调用遍历左侧导航
		$this->left_list();
		//查询图片信息
		$image = $this->image->getImage();
		$this->assign('brand_id',$brand_id);
		$this->assign('clothes_id',$clothes_id);
		$this->assign('image',$image);
		$this->assign('goods',$goods);
		$this->assign('brand_name',$brand_name);
		$this->assign('clothes_name',$clothes_name);
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
	//遍历左侧导航
	protected function left_list()
	{
		$left1 = $this->clothes->cfind_1();
		$left2 = $this->clothes->cfind_2();
		$this->assign('left1',$left1);
		$this->assign('left2',$left2);
	}
}