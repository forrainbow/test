<?php
namespace app\index\controller;
use think\Session;
class Quit
{
	public function index()
	{
		Session::clear();
		return redirect('Index/index/index');
	}
}