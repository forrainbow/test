<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Db;
use app\index\model\BrandCategory;
use app\index\model\ClothesCategory;
use app\index\model\IndexCategory;
use app\index\model\Member;
class Index extends Controller
{
    public function index ()
	{
		$user_id = Session::get('user_id');
		//判断session是否赋值
		//var_dump(Session::has('user'));
		//假如session为空，渲染404页面
		$user = Member::get($user_id);
		$this->assign('user',$user);

		$brand = new BrandCategory();
		$clothes = new ClothesCategory();
		$index = new IndexCategory();
		//一级分类查询
		$cate1 = $brand->where('cate_pid',0)->select();
		//二级分类查询品牌
		$cate2 = $brand->where('cate_pid!=0')->select();
		//三级分类查询服装
		$cate3 = $clothes->cfind();
		//查询可视区的分类
		$view_cate = $index->find_index();
		//var_dump(BrandCategory::getLastSql());
		$this->assign('cate1',$cate1);
		$this->assign('cate2',$cate2);
		$this->assign('cate3',$cate3);
		$this->assign('view_cate',$view_cate);
		return $this->fetch();
	}
}
