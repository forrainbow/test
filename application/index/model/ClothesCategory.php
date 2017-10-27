<?php
namespace app\index\model;
use think\Db;
use think\Model;

class ClothesCategory extends Model
{
	//对应关联BrandCategory
	public function brand_category()
	{
		return $this->belongsTo('BrandsCategory','cate_id','brand_id');
	}
	//查询所有分类方法
	public function cfind()
	{
		return Db::name('clothes_category')->select();
	}
	//查询上装分类方法
	public function cfind_1()
	{
		return ClothesCategory::where('pid=0')->select();
	}
	//查询T恤分类方法
	public function cfind_2()
	{
		return ClothesCategory::where('pid!=0')->select();
	}
	//该寻某品牌下的热门分类
	public function hot_cate($brand_id)
	{
		return ClothesCategory::where('brand_id',$brand_id)->limit(12)->select();
	}
	//查询该表中某一个字段的value值
	public function getValue($where,$data)
	{
		return ClothesCategory::where($where)->value($data);
	}
}