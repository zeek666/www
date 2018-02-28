<?php
namespace app\index\controller;

use think\Controller;
	
class Member    extends Controller
{
	//会员管理页
	public function member_list(){
		return $this->fetch();
	}
	public function member_del(){
		return $this->fetch();
	}
	public function member_level(){
		return $this->fetch();
	}
	public function member_scoreoperation(){
		return $this->fetch();
	}
	public function member_record_browse(){
		return $this->fetch();
	}
	public function member_record_download(){
		return $this->fetch();
	}
	public function member_record_share(){
		return $this->fetch();
	}
	public function member_show(){
		return $this->fetch();
	}
}   