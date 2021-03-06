<?php 
use xh\library\url;
include_once (PATH_VIEW . 'common/header.php'); //头部
?>

<!-- START CONTENT -->

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/module/index');?>">模块管理</a></li>
        <li class="active">修改</li>
      </ol>
      
  </div>
  <!-- End Page Header -->


 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">
  
    <!-- Start Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-title">
          修改模块
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">

                 <div class="form-group">
                  <label class="col-sm-2 control-label form-label">模块名</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="module_name"  placeholder="模块名称" value="<?php echo $result['name'];?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">状态</label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="state" value="1" <?php if ($result['state'] == 1) echo 'checked';?>>
                        <label for="inlineRadio1"> 开启 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="state" value="2" <?php if ($result['state'] == 2) echo 'checked';?>>
                        <label for="inlineRadio2"> 关闭 </label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">菜单</label>
                  <div class="col-sm-10">
                    <select class="selectpicker" name="menuid">
                    <?php foreach ($menus as $me){?>
                        <option value="<?php echo $me['id'];?>" <?php if ($me['id'] == $result['menuid']) echo 'selected';?>><?php echo strip_tags($me['menu_name']);?></option>
                    <?php }?>
                      </select>                  
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">路径</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="route"  placeholder="模块路径" value="<?php echo $result['route'];?>">
                  </div>
                </div>
                
 
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/module/index');?>" class="btn"><i class="fa fa-close"></i>取消</a>
                  </div>
                </div>

              </form> 

            </div>

      </div>
    </div>

  </div>
  <!-- End Row -->
    <script src="/Public/Front/js/plugins/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.use(['layer'], function () {
            var  layer = layui.layer //弹层
        });
			function edit(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/module/edit',"id={$result['id']}");?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  layer.msg("修改成功", {icon:1,time:1000,end:function(){
                                      location.href = '<?php echo url::s('admin/module/index');?>';
                                  }});
			              }else{
                              layer.msg("修改失败", {icon:2,time:1000})
			              }
			          },
			          error: function(data) {
			              alert("error:"+data.responseText);
			           }
			  });
			}
   </script>
  
</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
