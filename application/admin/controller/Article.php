<?php
namespace app\admin\controller;
use think\Controller;
class Article extends Controller
{
	public function article_add()
    {
        return $this->fetch();
    }
    public function article_list()
    {
        return $this->fetch();
    }

}
