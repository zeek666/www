<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"C:\wamp\www\tp5.1\admin\index\view\goods\product_category_add.html";i:1508395549;}*/ ?>

<title>添加产品分类</title>
</head>
<body>
<div class="page-container">
  <form action="<?php echo U('goods_type_add'); ?>" method="post" class="form form-horizontal" id="form-user-add">
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>您要添加的分类：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="user-name" name="name">
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-2"><span class="c-red">*</span>添加到：</label>
      <div class="formControls col-5">
        <span class="select-box">
          <select class="select" size="1" name="pid">
            <option value="0" selected>顶级分类</option>
            <?php foreach($data as $vo): ?>
            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['level']; ?>级分类&nbsp;<?php echo $vo['name']; ?></option>
            <?php endforeach; ?>
            <!--<?php foreach($data  as $vo): ?>
            <option value="<?php echo $vo['id']; ?>" ><?php echo $vo['level']; ?>级分类&nbsp;<?php echo $vo['name']; ?></option>
            <?php endforeach; ?>
            -->
          </select>
        </span>
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-2">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>

<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-user-add").Validform({
		tiptype:2,
		callback:function(form){
			form[0].submit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script>
</body>
</html>