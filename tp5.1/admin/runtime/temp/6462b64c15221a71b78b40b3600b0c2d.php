<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:62:"C:\wamp\www\tp5.1\admin\index\view\goods\product_category.html";i:1508396192;s:46:"C:\wamp\www\tp5.1\admin\index\view\layout.html";i:1508395477;s:52:"C:\wamp\www\tp5.1\admin\index\view\public/_meta.html";i:1506607034;s:54:"C:\wamp\www\tp5.1\admin\index\view\public/_header.html";i:1457695242;s:52:"C:\wamp\www\tp5.1\admin\index\view\public/_menu.html";i:1508397043;s:54:"C:\wamp\www\tp5.1\admin\index\view\public/_footer.html";i:1508397087;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!-- 第一次屏蔽！-->
<!--[if lt IE 9]>
<script type="text/javascript" src="/static/adminlib/html5.js"></script>
<script type="text/javascript" src="/static/adminlib/respond.min.js"></script>
<script type="text/javascript" src="/static/adminlib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/style.css" />
<link rel="stylesheet" href="/static/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
<!--第二次屏蔽！头部已经屏蔽完成-->
<!--[if IE 6]>
<script type="text/javascript" src="/static/adminhttp://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">H-ui.admin</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs">v2.4</span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
							<li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
							<li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li>超级管理员</li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="#">个人信息</a></li>
							<li><a href="#">切换账户</a></li>
							<li><a href="#">退出</a></li>
						</ul>
					</li>
					<li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<aside class="Hui-aside">
	<input runat="server" id="divScrollValue" type="hidden" value="" />
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/article-list.html" data-title="资讯管理" href="/static/admin/javascript:void(0)">资讯管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/picture-list.html" data-title="图片管理" href="/static/admin/javascript:void(0)">图片管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/product-brand.html" data-title="品牌管理" href="/static/admin/javascript:void(0)">品牌管理</a></li>
					<li><a _href="<?php echo U('goods/product_category'); ?>" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
					<li><a _href="<?php echo U('goods/product_list'); ?>" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/http://h-ui.duoshuo.com/admin/" data-title="评论列表" href="/static/admin/javascript:;">评论列表</a></li>
					<li><a _href="/static/admin/feedback-list.html" data-title="意见反馈" href="/static/admin/javascript:void(0)">意见反馈</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-member">
			<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/member-list.html" data-title="会员列表" href="/static/admin/javascript:;">会员列表</a></li>
					<li><a _href="/static/admin/member-del.html" data-title="删除的会员" href="/static/admin/javascript:;">删除的会员</a></li>
					<li><a _href="/static/admin/member-level.html" data-title="等级管理" href="/static/admin/javascript:;">等级管理</a></li>
					<li><a _href="/static/admin/member-scoreoperation.html" data-title="积分管理" href="/static/admin/javascript:;">积分管理</a></li>
					<li><a _href="/static/admin/member-record-browse.html" data-title="浏览记录" href="/static/admin/javascript:void(0)">浏览记录</a></li>
					<li><a _href="/static/admin/member-record-download.html" data-title="下载记录" href="/static/admin/javascript:void(0)">下载记录</a></li>
					<li><a _href="/static/admin/member-record-share.html" data-title="分享记录" href="/static/admin/javascript:void(0)">分享记录</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-admin">
			<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/admin-role.html" data-title="角色管理" href="/static/admin/javascript:void(0)">角色管理</a></li>
					<li><a _href="/static/admin/admin-permission.html" data-title="权限管理" href="/static/admin/javascript:void(0)">权限管理</a></li>
					<li><a _href="/static/admin/admin-list.html" data-title="管理员列表" href="/static/admin/javascript:void(0)">管理员列表</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-tongji">
			<dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/charts-1.html" data-title="折线图" href="/static/admin/javascript:void(0)">折线图</a></li>
					<li><a _href="/static/admin/charts-2.html" data-title="时间轴折线图" href="/static/admin/javascript:void(0)">时间轴折线图</a></li>
					<li><a _href="/static/admin/charts-3.html" data-title="区域图" href="/static/admin/javascript:void(0)">区域图</a></li>
					<li><a _href="/static/admin/charts-4.html" data-title="柱状图" href="/static/admin/javascript:void(0)">柱状图</a></li>
					<li><a _href="/static/admin/charts-5.html" data-title="饼状图" href="/static/admin/javascript:void(0)">饼状图</a></li>
					<li><a _href="/static/admin/charts-6.html" data-title="3D柱状图" href="/static/admin/javascript:void(0)">3D柱状图</a></li>
					<li><a _href="/static/admin/charts-7.html" data-title="3D饼状图" href="/static/admin/javascript:void(0)">3D饼状图</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-system">
			<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a _href="/static/admin/system-base.html" data-title="系统设置" href="/static/admin/javascript:void(0)">系统设置</a></li>
					<li><a _href="/static/admin/system-category.html" data-title="栏目管理" href="/static/admin/javascript:void(0)">栏目管理</a></li>
					<li><a _href="/static/admin/system-data.html" data-title="数据字典" href="/static/admin/javascript:void(0)">数据字典</a></li>
					<li><a _href="/static/admin/system-shielding.html" data-title="屏蔽词" href="/static/admin/javascript:void(0)">屏蔽词</a></li>
					<li><a _href="/static/admin/system-log.html" data-title="系统日志" href="/static/admin/javascript:void(0)">系统日志</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="/static/admin/javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
	<div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
		<div class="Hui-tabNav-wp">
			<ul id="min_title_list" class="acrossTab cl">
				<li class="active"><span title="我的桌面" data-href="/static/admin/welcome.html">我的桌面</span><em></em></li>
			</ul>
		</div>
		<div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="/static/admin/javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="/static/admin/javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
	</div>
	<div id="iframe_box" class="Hui-article">
		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/static/admin/static/h-ui/css/style.css" />
<link rel="stylesheet" href="/static/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>产品分类</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品分类 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

<span style="color:red;">*点击分类名称，可立即删除</span>
<table class="table">
	<tr>
		<td width="200" class="va-t"><ul id="treeDemo" class="ztree"></ul></td>
		<td class="va-t"><IFRAME ID="testIframe" Name="testIframe" FRAMEBORDER=0 SCROLLING=AUTO width=100%  height=390px SRC="<?php echo U('product_category_add'); ?>"></IFRAME></td>
	</tr>
</table>
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/admin/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/static/admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script> 
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.admin.js"></script> 
<script type="text/javascript">
var zNodes;
	$.ajax({
		url:"<?php echo U('product_category_ajax'); ?>",
		type:'get',
		dataType:'json',
		async:false,
		success:function(data){
			zNodes=data;
			console.log(data);
		}
	});
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pid",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			//console.log(treeNode.id);//打印id
			$.ajax({
				url:"product_category_del",
				type:'get',
				data:{id:treeNode.id},
				dataType:'json',
				async:false,
				success:function(data){
					/*zNodes=data;
					console.log(data);*/
					if(data==1){
						alert("删除成功！");parent.location.href = "product_category";
					}else{
						alert(data);parent.location.href = "product_category";
					}
				}
			})
		}
	},
};

/*var zNodes =[
	{ id:1, pId:0, name:"一级分类", open:true},
	{ id:11, pId:1, name:"二级分类"},
	{ id:111, pId:11, name:"三级分类"},
	{ id:112, pId:11, name:"三级分类"},
	{ id:113, pId:11, name:"三级分类"},
	{ id:114, pId:11, name:"三级分类"},
	{ id:115, pId:11, name:"三级分类"},
	{ id:12, pId:1, name:"二级分类 1-2"},
	{ id:121, pId:12, name:"三级分类 1-2-1"},
	{ id:122, pId:12, name:"三级分类 1-2-2"},
];
*/		
var code;
		
function showCode(str) {
	if (!code) code = $("#code");
	code.empty();
	code.append("<li>"+str+"</li>");
}
		
$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	demoIframe = $("#testIframe");
	demoIframe.bind("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	zTree.selectNode(zTree.getNodeByParam("id",'11'));
});
</script>
</body>
</html>
<!--<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.js"></script>-->
</div>
	</div>
</section>
<script type="text/javascript" src="/static/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/static/admin/lib/layer/2.1/layer.js"></script>
<script type="text/javascript" src="/static/admin/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/static/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/static/admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script> 
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/static/admin/static/h-ui/js/H-ui.admin.js"></script>


<script type="text/javascript" src="/static/admin/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/static/admin/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript" src="/static/admin/static/h-ui/js/comment.js"></script>
</body>
</html>



