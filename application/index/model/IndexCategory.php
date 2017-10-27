<?php
namespace app\index\model;
use think\Model;

class IndexCategory extends Model
{
	public function find_index() 
	{
		return IndexCategory::select();
	}
	
}