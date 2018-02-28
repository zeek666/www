<?php
namespace app\index\controller;

use think\Controller;
	
class Picture    extends Controller
{	
	//图片列表页
	public function picture_list(){
		return $this->fetch();
	}
	//图片添加页
	public function picture_add(){
		return $this->fetch();
	}
	public function picture_show(){
		return $this->fetch();
	}
}
