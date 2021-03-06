<?php 
use xh\library\url;
include_once (PATH_VIEW . 'common/header.php'); //头部
?>

<!-- START CONTENT -->

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/menu/index');?>">菜单管理</a></li>
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
          修改菜单
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">

                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">菜单名</label>
                  <div class="col-sm-10">
                   <textarea class="form-control form-control-line" rows="3"  name="menu_name"  placeholder="菜单名称，支持html" ><?php echo trim($result['menu_name']);?></textarea>
                  </div>
                  
                 
                  
              
                </div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">默认</label>
                  <div class="col-sm-10">
                    <div class="checkbox checkbox-success checkbox-circle">
                        <input id="checkbox55" type="checkbox" name="opened" value="1" <?php if ($result['opened'] == 1) echo 'checked';?>>
                        <label for="checkbox55">
                            默认打开
                        </label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">显示</label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="hide" value="1" <?php if ($result['hide'] == 1) echo 'checked';?>>
                        <label for="inlineRadio1"> 显示 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="hide" value="2" <?php if ($result['hide'] == 2) echo 'checked';?>>
                        <label for="inlineRadio2"> 隐藏 </label>
                    </div>
                  </div>
                </div>
                
 
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/menu/index');?>" class="btn"><i class="fa fa-close"></i>取消</a>
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
			          url: "<?php echo url::s('admin/menu/edit',"id={$result['id']}");?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
                              layer.msg("修改成功", {icon:1,time:1000,end:function(){
                                      location.href = '<?php echo url::s('admin/menu/index');?>';
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
