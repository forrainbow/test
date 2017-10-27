<?php
namespace app\index\model;
use think\Model;
use think\Db;

class GoodsInfo extends Model
{
	//商品关联图片
	public function image()
	{
		return $this->hasOne('Image','img_id','img_id');
	}
	//遍历对应的商品信息
	// public function goodsinfo($brand_id,$clothes_id)
	// {
	// 	return GoodsInfo::where('goods_brand',$brand_id)->where('goods_category',$clothes_id)->select();
	// }
	//查询某一个商品的信息
	public function goodsOne($data)
	{
		return GoodsInfo::where($data)->select();
	}
	//根据条件排序遍历商品
	public function goodsinfo($brand_id,$clothes_id,$order='goods_id',$desc='asc')
	{
		return GoodsInfo::where('goods_brand',$brand_id)->where('goods_category',$clothes_id)->order($order.' '.$desc)->select();
	}
}