<?php
namespace app\index\controller;

use think\Controller;
	
class Review    extends Controller
{
	public function feedback_list(){
		return $this->fetch();
	}
}