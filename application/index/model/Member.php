<?php
namespace app\index\model;
use think\Model;
class Member extends Model
{
	//判断一个字段是否存在
	public function exists($filed,$name)
	{
		return Member::where($filed, $name)->find();
	}
	//插入函数
	public function insert($data)
	{
		return Member::allowField(true)->save($data);
	}	
	//设置修改器
	public function setPasswordAttr($value)
    {
        return MD5($value);
    }
}