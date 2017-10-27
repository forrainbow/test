<?php
namespace app\index\model;
use think\Model;

class BrandCategory extends Model
{
	//关联商品分类表
	public function clothes_category()
	{
		return $this->hasMany('ClothesCategory','brand_id','cate_id');
	}
	//查询该表中某一个字段的value值
	public function getValue($where,$data)
	{
		return BrandCategory::where($where)->value($data);
	}
	
}