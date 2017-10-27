<?php
namespace app\index\model;
use think\Model;
class Collect extends Model
{
	//添加收藏
	public function addCollect($data)
	{
		return Collect::data($data)->save();
	}
}