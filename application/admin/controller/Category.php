<?php
namespace app\admin\controller;
use app\admin\model\Category as Cate;
class Category
{
	protected $cate;
	public function __construct()
	{
		$this->cate = new Cate();
	}
	public function add() {
		$this->cate->insert(input('.get'));
	}
}