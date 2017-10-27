<?php
namespace app\admin\model;
use think\Model;

class BrandCategory extends Model
{
	//关联分类
	public function clothes_category()
	{
		return 123;
		//return $this->hasMany('ClothesCategory');
	}
	//查询品牌
	public function bfind()
	{
		return BrandCategory::where('cate_pid!=0')->select();
	}
}