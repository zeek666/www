<?php
namespace app\index\controller;

use think\Controller;
use app\common\controller\AuthController;
use think\Validate;
use think\Request;
	
class Admin    extends AuthController
{
	//管理员列表页
	public function admin_list(){
		 $m = db('admin');
		//$data = db('admin')->alias('a')->join('authgroupaccess b','a.uid= b.uid')->join('authgroup c','b.group_id= c.id')->order('id asc')->select();
		$count = $m->count();
	    $data = $m->alias('a')->join('authgroupaccess b','a.uid= b.uid')->join('authgroup c','b.group_id= c.id')->paginate(2);
	    // 获取分页显示
	    $page = $data->render();
	    // 模板变量赋值
	    $this->assign('data', $data);
	    $this->assign('page', $page);
	    // 渲染模板输出
	    $this->assign('datacount',$count);
		$this->assign('data',$data);
		return $this->fetch();
	}
	//权限管理页
	public function admin_permission(){
		return $this->fetch();
	}
	//角色管理页
	public function admin_role(){
		return $this->fetch();
	}
	public function admin_role_add(){
		$data = db('auth_rule')->where('id','between','2,6')->select();
		$this->assign('data',$data);
		//var_dump($data);
		return $this->fetch();
	}
	public function admin_role_add_a(){
			$data = input('post.');
			//var_dump($data);die;
			$validate = new Validate(['roleName' => 'require','note'=> 'require'],['roleName.require'=>'角色名称必填','note.require'=>'备注必填']);
			$arr = ['roleName' =>$data['roleName'],'note' => $data['note']];
			if(!$validate->check($arr)){
				$value = $validate->getError();
    			echo "<script>var aa='{$value}';alert(aa);location.href='admin_role_add';</script>";
				}
			if(!isset($data['checkbox'])){
				echo "<script>alert('网站角色必填！');parent.location.href='/admin.php/Index/admin/admin_role_add'</script>";
				}	
			//die;
			$rules = implode(',',$data['checkbox']);
			var_dump($rules);die;
			$re  = db('authgroup')->insertGetId(['note'=>$data['note'],'title'=>$data['roleName'],'rules'=>$rules] );
			//var_dump($re);
			if(!empty($re)){
				echo "<script>alert('添加角色成功！');parent.location.href='/admin.php/Index/admin/admin_role'</script>";
			}else{
				echo "<script>alert('添加角色失败！')</script>";
			}
	}
	//添加权限节点
	public function admin_permission_add(){
		if(request()->isPost()){
			$data = input('post.');
			//var_dump($data);die;
			$m = db('auth_rule')->insertGetId(['name'=>$data['name'],'title'=>$data['title']]);
			//var_dump($m);die();
			if(!empty($m)){
				foreach ($data['checkbox'] as $key => $value) {
					//echo $value;die;
					$m1 = db('authgroupaccess')->where(['uid'=>$value])->select();
					foreach ($m1 as $key => $value) {
						$m2 = db('authgroup')->field('rules')->where('id='.$value['group_id'])->select();
						//var_dump($m2[0]['rules']);die;
						$data = $m2[0]['rules'].','.$m;
						$m3 = db('authgroup')->where('id='.$value['group_id'])->update(['rules'=>$data]);
						//var_dump($m3);
						//var_dump($m2);
					}
					//var_dump($m1[0]['group_id']);die;
				}
			}else{

			}
		}else{
			$data = db('admin')->select();
			$this->assign('data',$data);
			return $this->fetch();
		}
	}
	//验证节点是否正确
	public function admin_permission_addajax(){
		$data = input('post.name');
		//$data = "index/index/index";
		$data1 = "http://www.tp5.com/admin.php/".$data;
		//var_dump($data1);
			$arr = get_headers($data1,1);
			if(preg_match('/200/',$arr[0])){
				echo "true";
			}else{
				return false;			
			}
			exit();
		//$data = 'a/index/fasas';
		/*$pattern ='/.\//';
		$aa = preg_match_all($pattern,$data);
		//var_dump($aa);
		if($aa==2){
			return true;
		}else{
			return false;
		}*/
	}
	//管理员启用停用
	public function admin_is_abled(){
		$id = input('param.id');
	    $uid = input('param.uid');
	    //$data = 1;
		if($id==1){
			$id=0;
			$data = db('admin')->where('uid='.$uid)->update(['admin_status'=>$id]);
		}else{
			$id=1;
			$data = db('admin')->where('uid='.$uid)->update(['admin_status'=>$id]);
		}
	}
	//管理员删除
	public function admin_del(){
		$uid = input('param.uid');
		$m = db('admin')->where('uid',$uid)->delete();
	}
	//管理员批量删除
	public function admin_delete(){
		$data = input('post.');
		$data = json_decode(stripslashes($data['data']));
		$count = count($data);
		//var_dump($data);die;
		$a = in_array(9,$data);
		if(!$a){
			if($count!=1){
				$where = 'uid in('.implode(',',$data).')';
				//var_dump($where);die;
			}else{
				$where = 'uid='.$data[0];
			}
			$m = db('admin')->where($where)->delete();
		}
	}
	//管理员搜索
	public function admin_search(){
		$dataall = input('post.');
		$data = input('post.name');
		//var_dump($data);
		if($dataall==null){
			echo "<script>alert('输入不能为空');parent.location.href='admin_list'</script>";
		}else{
			
			$m = db('admin')->alias('a')->join('authgroupaccess b','a.uid= b.uid')->join('authgroup c','b.group_id= c.id')->where('admin_name',$data)->paginate(2);
			$datacont = $m->count();
			$this->assign('datacount',$datacont);
			if($m!==null){
				$page = $m->render();
				$this->assign('page', $page);
				//var_dump($m);die;
				$this->assign('data',$m);
				return view('admin_list');
				//return view('admin_list','data',$m);不行
			}else{
				return view('admin_list');
			}
		}
	}
	//管理员时间搜索
	public function admin_time_search(){

	}
}