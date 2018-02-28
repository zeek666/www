<?php
namespace app\index\controller;
use think\Controller;
use think\Paginator;
class goods extends Controller
{
	/**商品分类管理页*/
    public function product_category()
    {
    	$m = M('goods_type');
    	//var_dump($m);
    	$data = $m->select();
    	//var_dump($data);
        return $this->fetch();
    }
    /*商品分类添加页*/
    public function product_category_add(){
        $m = M('goods_type');
        //var_dump($m);
        $data = $m->field("*,concat(path,',',id) as paths")->order('paths')->select();
        //var_dump($data);
        foreach ($data as $k => $v) {
            $data[$k]['name']=str_repeat("|---", $v['level']).$v['name'];
        }
        $this->assign('data',$data);
        $this->view->engine->layout(false);
    	return $this->fetch();
    }
    /*添加分类*/
    public function goods_type_add(){
        $m=M('goods_type');
        $data['name'] = $_POST['name'];
        $data['pid'] = $_POST['pid'];
        if($data['name']!="" && $data['pid']==0){
            $data['name'] = $_POST['name'];
            $data['pid']  = 0;
            $data['path'] = 0;
            $data['level'] = 1;
            $re = $m->add($data);
            $path['id'] = $re;
            $path['path'] = "0".",".$re;
            $res = $m->save($path);
            if($res){
                echo '<script>alert("添加成功！");parent.location.href="product_category"</script>';
            }else{
                echo '<script>alert("添加失败！");parent.location.href="product_category"</script>';
            }
            //var_dump($re);
        }elseif($data['name']!="" && $data['pid']!=0){
            //$paths = $m->where('pid='.$data['pid'])->select();
            $paths =$m->field("path")->find($data['pid']);
            //var_dump($paths);
            $data['path'] = $paths['path'];
            //var_dump($data);
            $data['level'] =substr_count($data['path'],',')+1;//根据“，”计数并赋值给level；
            $re = $m->add($data);
            $path['id'] = $re;
            $path['path'] = $data['path'].",".$re;
            $res = $m->save($path);
            if($res){
                echo '<script>alert("添加成功！");parent.location.href="product_category"</script>';
            }else{
                echo '<script>alert("添加失败！");parent.location.href="product_category"</script>';
            }
            //var_dump($path['path']);
        }else{
            echo "<script>alert('内容不能为空！');parent.location.href='product_category'</script>";
        }
    }
    /*ajax获取分类值*/
    public function product_category_ajax(){
        $m = M('goods_type');
        $data = $m->field('id,pid,name')->select();
        echo json_encode($data);//对变量进行JSON编码;
    }
    /*分类删除*/
    public function  product_category_del(){
        $id = $_GET['id'];
        //var_dump($id);
        $m = M('goods_type');
        $data = $m->where('pid='.$id)->find();
        if($data){
           $str = "分类下面还有子分类，不能删除！";
           echo json_encode($str);

        }else{
            $re = $m->delete($id);
            if($re){
                echo 1;
            }
        }
    }
    /*商品管理页*/
    public function product_list(){
        $m = M('goods');
        $data = $m->select();
        $count = $m->count();

       /* $list = $m->where('status',1)->paginate(10);
        // 获取分页显示
        $page = $list->render();
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('page', $page);*/
        // 渲染模板输出
        $this->assign('datacount',$count);
        $this->assign('data',$data);
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    /*商品添加页面*/  
    public function  product_add(){
        $m = M('goods_type');
        $data = $m->field("*,concat(path,',',id) as paths")->order('paths')->select();
        foreach ($data as $k => $v) {
            $data[$k]['name']=str_repeat("|---", $v['level']).$v['name'];
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    /*添加商品*/
    public function goods_add(){
        $m = M('goods');
        $data['goodsname'] = $_POST['goodsname'];
        $data['title'] = $_POST['title'];
        $data['unit'] = $_POST['unit'];
        //var_dump($data['unit']);
        $data['attributes'] = $_POST['attributes'];
        //var_dump($data['attributes']);
        $data['number'] = $_POST['number'];
        $data['barcode'] = $_POST['barcode'];
        $data['curprice'] = $_POST['curprice'];
        $data['oriprice'] = $_POST['oriprice'];
        $data['cosprice'] = $_POST['cosprice'];
        $data['inventory'] = $_POST['inventory'];
        $data['restrict'] = $_POST['restrict'];
        $data['already'] = $_POST['already'];
        $data['freight'] = $_POST['freight'];
        $data['status'] = $_POST['status'];
        $data['reorder'] = $_POST['reorder'];
        $tid = explode(',', $_POST['tid']);
        $data['tid'] = $tid[0];
        $data['tpid'] = $tid[1];
        $re = $m->add($data);
        //$a[''] = $_POST[''];
        //var_dump($_POST);
        if($re){
            echo "<script>alert('添加成功！');parent.location.href='product_list'</script>";
        }else{
            echo "<script>alert('添加失败！');parent.location.href='product_list'</script>";
        }
       
    }
    /*ajax获取分类值*/
    public function product_list_ajax(){
        $m = M('goods_type');
        $data = $m->field('id,pid,name')->select();
        echo json_encode($data);//对变量进行JSON编码;
    }
    /*商品编辑页面*/
    public function product_edit(){
        $id = $_GET['id'];
        //var_dump($id);
        return $this->fetch();
    }
    /*商品上架*/
    public function product_shenqing(){
        $m = M('goods');
        $status['status'] = $_GET['status'];
        $status['id'] = $_GET['id'];
        //var_dump($status['status']);die();
        if($status['status']==0){
            $status['status']=1;
            //var_dump($status['status']);
            $data = $m->save($status);
            //var_dump($data);
            echo "<script>alert('上架成功！');parent.location.href='/admin.php/Index/Goods/product_list'</script>";
        }elseif ($status['status']==1) {
            $status['status']=0;
            $data = $m->save($status);
            echo "<script>alert('下架成功！');parent.location.href='/admin.php/Index/Goods/product_list'</script>";
        }
        /*switch ($status['status']) {
            case '1':
                $status['status']=0;
                //var_dump($status['status']);
                $data = $m->save($status);
                return $this->('goods/product_list');
                break;
            default:
                 $status['status']=1;
                //var_dump($status['status']);
                $data = $m->save($status);
                return $this->redirect('goods/product_list');
                break;
        }*/
    }
    /*批量删除*/
    public function product_del(){
        $m = M('goods');
        //$a = input('post.');
        $data = I('');
        //var_dump($data['checkbox']);
        if(!empty($data['checkbox'])){
            $idarr = $data['checkbox'];
            var_dump($idarr);
            if(is_array($idarr)){
                $where = 'id in('.implode(',',$idarr).')';
                var_dump($where);
            }else{
                $where = 'id='.$idarr;
            }
            $res = $m->where($where)->delete();
            echo "<script>alert('删除成功！');parent.location.href='product_list'</script>";
        }else{
            echo "<script>alert('未选中目标值！');parent.location.href='product_list'</script>";
        }
    }
    /*public function product_list_page(){
        $user = D('goods');
        $count = $user->count();
        var_dump($count);
        $page = new Page($count, 5);
        $show = $page->show();
        $list = $user->order('date')->
        limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }*/
}
