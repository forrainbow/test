<?php
namespace app\index\model;
use think\Model;
class Image extends Model
{
	//对应关联GoodsInfo
	public function goods_info()
	{
		return $this->belongsTo('GoodsInfo');
	}
	//查询所有图片
	public function getImage()
	{
		return Image::select();
	}
}