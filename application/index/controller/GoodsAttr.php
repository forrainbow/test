<?php
namespace app\index\controller;
use app\index\model\GoodsInfo;
use app\index\model\GoodsAttributes;
use think\Db;
use think\Request;
class GoodsAttr
{
	protected $goods;
	protected $attr;
	public function __construct()
	{
		$this->goods = new GoodsInfo();
		$this->attr = new GoodsAttributes();
	}
	public function match()
	{
		// 获取商品id参数
		$goods_id = Request::instance()->param('goods_id');
		

		//查出该尺码对应的商品，根据颜色分组，结果集是一个二维数组
		$sql = 'select * from jy_goods_attributes where id in (select max(id) from jy_goods_attributes group by goods_color having goods_size="L")';
		$res = Db::query($sql);
		//用一个数组保存对应的库存颜色
		foreach ($res as  $value) {
			$color[] = $value['goods_color'];
		}
		dump($color);
	}
}