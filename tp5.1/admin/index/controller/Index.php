<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
	/**首页*/
    public function index()
    {
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    /*欢迎页*/
    public function welcome()
    {
        $this->view->engine->layout(false);
    	return $this->fetch();
    }
    /*测试方法*/
    public function test()
    {
  
    }
}
