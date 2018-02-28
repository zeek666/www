<?php
namespace app\Common\Controller;
use think\Controller;
use think\Request;
use think\Auth;
class AuthController extends Controller {
	protected function _initialize() {
		$sess_auth = session('auth');
		//var_dump($sess_auth[0]['uid']);die;
		if (!$sess_auth) {
			echo "<script>alert('非法访问！');parent.location.href='index/login'</script>";
		}
		if ($sess_auth[0]['uid'] == 9) {
			return  true;
		}
		$auth =  new Auth();
		$request = Request::instance();
		/*var_dump($request->module() . '/' . $request->controller() . '/' . $request->action());
		var_dump($auth->check($request->module() . '/' . $request->controller() . '/' . $request->action(),$sess_auth[0]['uid']));die();*/
		if(!$auth->check($request->module() . '/' . $request->controller() . '/' . $request->action(),$sess_auth[0]['uid'])) {
			$this->error('你没有权限',url('index/logout'));		
		}
	}
}