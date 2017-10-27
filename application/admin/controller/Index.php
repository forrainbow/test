<?php
namespace app\admin\controller;
use think\Controller;
class Index extends Controller
{
	//首页
    public function index()
    {
        return $this->fetch();
    }
    //404页面
    public function _404()
    {
    	return $this->fetch();
    }
    //空白页面
    public function _blank()
    {
    	return $this->fetch();
    }
    //开发中提示页面
     public function sorry()
    {
    	return $this->fetch();
    }
}
