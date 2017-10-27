<?php
namespace app\admin\model;
use think\Db;
use think\Model;

class ClothesCategory extends Model
{
	//查询方法
	public function cfind()
	{
		return Db::name('clothes_category')->select();
	}
}