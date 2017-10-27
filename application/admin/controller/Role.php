<?php
namespace app\admin\controller;
use think\Controller;
class Role extends Controller
{
	//管理权限
    public function admin_permission()
    {
        return $this->fetch();
    }
    //角色管理
    public function admin_role()
    {
        return $this->fetch();
    }
    //添加角色
    public function admin_role_add()
    {
        return $this->fetch();
    }
    //
    public function admin_add()
    {
        return $this->fetch();
    }
    //
    public function admin_list()
    {
        return $this->fetch();
    }
}