<?php
namespace app\admin\model;
use think\Model;

class GoodsInfo extends Model
{
	//查询商品信息
	public function goodsinfo()
	{
		return GoodsInfo::select();
	}
}