<?php
namespace app\index\controller;

use think\Controller;
use think\Paginator;
	
class Goods    extends Controller
{
   
    //分类页
    public function product_category(){
        return  $this->fetch();
    }
    //商品分类页
    public function product_category_add(){
        $m=db('goods_type');
        $data=$m->field(['*','concat(path,",",id)' => 'paths'])->order('paths')->select();
        
        foreach($data as $k=>$v){
            $data[$k]['name']=str_repeat("|------",$v['level']).$v['name'];
        }
        
        $this->assign('data',$data);
     
        return  $this->fetch();
    }
     //添加分类信息到数据库
    public function goods_type_add(){
            $data['name']=$_POST['name'];
            $data['pid']=$_POST['pid'];
            $m=db('goods_type');
            if($data['name'] !=" "  && $data['pid'] !=0){
                
                $path=$m->field("path")->find($data['pid']);
                $data['path']=$path['path'];
                $data['level']=substr_count($data['path'],",");
                $re=$m->insertGetId($data);//返回插入id
                $path['id']=$re;
                $path['path']=$data['path'].','.$re;
                $path['level']=substr_count($path['path'],",");
                $res=$m->update($path);
                if($res){
                    echo '<script>alert("添加成功");parent.location.href="product_category"</script>';
                }else{
                    echo '<script>alert("添加失败");parent.location.href="product_category"</script>';

                }
            }else if($data['name'] !="" && $data['pid'] ==0){
                
                //$path=$m->field("path")->find($data['pid']);
                $data['path']=$data['pid'];
                $data['level']=1;
                $re=$m->insertGetId($data);//返回插入id
                //var_dump($re);die;
                $path['id']=$re;
                $path['path']=$data['path'].','.$re;
                $res=$m->update($path);
                if($res){
                    echo '<script>alert("添加成功");parent.location.href="product_category"</script>';
                }else{
                    echo '<script>alert("添加失败");parent.location.href="product_category"</script>';

                }

            }else{
                echo '<script>alert("添加失败,内容不能为空");parent.location.href="product_category"</script>';

            }
            

    }
    //获取分类数据
    public function product_category_ajax(){
            $m=db('goods_type');
            $data=$m->field('id,pid,name')->select();
            echo  json_encode($data);

    }

    //删除分类信息
    public function product_category_del(){
        $id=$_GET['id'];
        $m=db('goods_type');
        $data=$m->where("pid=".$id)->find();

        if($data){
            $str="分类下面还子分类,不允许删除";
            echo json_encode($str);
        }else{
            $re=$m->delete($id);
            if($re){
                echo 1;
            }
        }
    }
   
 /*商品管理页*/
public function product_list(){
    $m = db('goods');
    //$data = $m->select();
    $count = $m->count();

    $data = $m->paginate(1);
    // 获取分页显示
    $page = $data->render();
    // 模板变量赋值
    $this->assign('data', $data);
    $this->assign('page', $page);
    // 渲染模板输出
    $this->assign('datacount',$count);
    $this->assign('data',$data);
    //$this->view->engine->layout(false);
    return $this->fetch();
} 
/*商品添加页面*/  
    public function  product_add(){
        $m = db('goods_type');
        $data = $m->field(['*','concat(path,",",id)'=>'paths'])->order('paths')->select();
        foreach ($data as $k => $v) {
            $data[$k]['name']=str_repeat("|---", $v['level']).$v['name'];
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    /*添加商品*/
    public function goods_add(){
        $m = db('goods');
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
        $re = $m->insert($data);
        //$a[''] = $_POST[''];
        //var_dump($_POST);
        if($re==1){
            echo "<script>alert('添加成功！');parent.location.href='product_list'</script>";
        }else{
            echo "<script>alert('添加失败！');parent.location.href='product_list'</script>";
        }
       
    }
    /*ajax获取分类值*/
    public function product_list_ajax(){
        $m = db('goods_type');
        $data = $m->field('id,pid,name')->select();
        echo json_encode($data);//对变量进行JSON编码;
    }
    /*商品编辑页面*/
    public function product_edit(){
        $m = db('goods');
        $id = input('param.id');
        $arr = $m->where('id',$id)->field('tid')->select();
        //var_dump($arr[0]['tid']);die();
        $ma = db('goods_type');
        $data = $ma->field(['*','concat(path,",",id)'=>'paths'])->order('paths')->select();
        foreach ($data as $k => $v) {
            $data[$k]['name']=str_repeat("|---", $v['level']).$v['name'];
        }
        $this->assign('data',$data);
        $this->assign('arr',$arr[0]['tid']);
        //var_dump($id);
        return $this->fetch();
    }
    /*商品上架*/
    public function product_shenqing(){
        $m = db('goods');
        $arr = input('param.');
        //这个地方用get为什么不行？
        if($arr['status']==0){
            $arr['status']=1;
           //var_dump($status['status']);
            $data = $m->update($arr);
            //var_dump($data);
            //echo "<script>alert('上架成功！');parent.location.href='/admin.php/Index/Goods/product_list'</script>";
            $this->success("上架成功！",'product_list');
        }elseif ($arr['status']==1) {
            $arr['status']=0;
            $data = $m->update($arr);
            //echo "<script>alert('下架成功！');parent.location.href='/admin.php/Index/Goods/product_list'</script>";
            $this->success("下架成功！",'product_list');
        }
    }
    /*批量删除*/
    public function product_del(){
        $m = db('goods');
        $data = input('post.');
        //var_dump($data['checkbox']);
        if(!empty($data['checkbox'])){
            $idarr = $data['checkbox'];
            //var_dump($idarr);
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
    //品牌管理页面
    public function product_brand(){
        return $this->fetch();
    }
    
    
}
