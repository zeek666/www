<?php
namespace app\index\controller;

use think\Controller;
	
class System    extends Controller
{
	public function system_base(){
		return $this->fetch();
	}
	public function system_category(){
		return $this->fetch();
	}
	public function system_data(){
		return $this->fetch();
	}
	public function system_shielding(){
		return $this->fetch();
	}
	public function system_log(){
		return $this->fetch();
	}
}