<?php
namespace app\index\controller;

use think\Controller;
use think\Validate;
use think\Request;
	
class Index     extends Controller
{
    public function index(){

    	
        return  $this->fetch();
    }

    public function welcome(){

    	
        return  $this->fetch();
    }
    //登录页面
    Public function login(){
    	if(request()->isPost()){
    		$data = input('post.');
    		$re = db('admin')->where('admin_name',$data['name'])->field('admin_name','admin_pwd')->select();
    		//var_dump($re);die();
    		if(!empty($re)){
    			$re = db('admin')->where('admin_pwd',$data['pwd'])->field('uid,admin_name,admin_pwd')->select();
    			if(!empty($re)){
    				echo "<script>alert('登录成功！');parent.location.href='index'</script>";
    				session('auth', $re);
    			}else{
     				echo "<script>alert('登录失败！');parent.location.href='login'</script>";   				
    			}
    		}else{
            	echo "<script>alert('用户名不存在！');parent.location.href='login'</script>";
    		}
    	}else{
			return $this->fetch();	
    	}
    } 
    public function register(){
    	if(request()->isPost()){
    		$data = input('post.');
    		//var_dump($data);die;
    		$validate = new Validate([
								'name' => 'require|max:25',
								'pwd'  =>  'require|alphaDash|min:8',
								'admin_phone' => 'require|number|length:11',
								'email' => 'require|email',
								],
								[
								'name.require' => '名称必须',
								'name.max' => '名称最多不能超过25个字符',
								'pwd.require' =>  '密码不能为空',
								'pwd.alphaDash' => '密码不能是汉字',
								'pwd.min' => '密码设置过于简单',
								'admin_phone' => '电话号码不能为空',
								'admin_phone.number' => '电话号码必须是数字',
								'admin_phone.length' => '电话号码错误',
								'email.require' => '邮箱必填',
								'email' => '邮箱格式错误',
								]
							);
	    	$arr = [
					'name' => $data['name'],
					'pwd' => $data['pwd'],
					'admin_phone' =>$data['admin_phone'],
					'email' => $data['admin_mail'],
					];
    		//var_dump($arr);die;
    		//var_dump($validate->check($data));die;
    		if (!$validate->check($arr)) {
    			$value = $validate->getError();
    			echo "<script>var aa='{$value}';alert(aa);location.href='';</script>";
			}else{
				$re = db('admin')->where('admin_name',$data['name'])->select();
	    		if(empty($re)){
	    			$re = db('admin')->where('admin_phone',$data['admin_phone'])->select();
	    			if(empty($re)){
	    				$re = db('admin')->where('admin_mail',$data['admin_mail'])->select();
	    				if(empty($re)){
	    					$con = [
	    							'admin_name' => $data['name'],
	    							'admin_pwd' => $data['pwd'],
	    							'admin_phone' => $data['admin_phone'],
	    							'admin_mail' => $data['admin_mail'],
	    							'admin_regist_time' => date( "Y-m-d   h:i:s ")
	    					];
	    					$add = db('admin')->insert($con);
	    					//var_dump($add);
	    					if($add=1){
	    						echo "<script>alert('添加数据成功！');parent.location.href='login'</script>";
	    					}else{
	    						echo "<script>alert('添加数据失败！');parent.location.href='register'</script>";
	    					}
	    				}else{
	    					echo "<script>alert('电话号码已被注册！');parent.location.href='register'</script>";	    					
	    				}
	    			}else{
	    				echo "<script>alert('电话号码已被注册！');parent.location.href='register'</script>";
	    			}
	    		}else{
	    			echo "<script>alert('用户名存在！');parent.location.href='register'</script>";
	    		}
			}
    	}else{
    		return $this->fetch();

    	}
    }
    public  function logout() {
		session('[destroy]');
		//echo "<script>alert('退出成功！');parent.location.href='login'</script>";
		$this->redirect('login');
	}
	public function test(){
		//$aa = $this->http_request('post','www.tp5.com/index/index/index');
		$arr = get_headers('http://www.tp5.com/admin.php/inde/index/index',1);
		if(preg_match('/200/',$arr[0])){
			echo "aaa";
		}else{
			return $this->fetch();			
		}
	}
	public function testajax(){
		$data = input('param.');
		//var_dump($data);die();
			//var_dump($data);
		if($data=="2491589782@qq.com"){
			echo false;
		}else{
			echo true;
		}
		exit();
	}
	public function validatecodeajax(){
		$data = input('post.validatecode');
		//$obj = json_decode($data);

		//var_dump($data);die;
		if(!captcha_check($data)){
			echo "false";
 		}else{
 			echo "true";
 		}
 		exit();
	}
	/*public function guanggao(){
		return $this->fetch();
	}*/
	public function ajax(){
		if(request()->isPost()){
			echo "<div style='color:blue;'>today is very good</div>";
		}else{
			return $this->fetch();
		}
	}
}
