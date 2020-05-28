<?php
use xh\library\url;
include_once (PATH_VIEW . 'common/header.php'); //头部
?>

<!-- START CONTENT -->

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/config/configList');?>">配置管理</a></li>
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
          修改配置
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">ID</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control form-control-line" value="<?php echo $result['id'];?>"  readonly="readonly">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">title</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control form-control-line" name="title"  placeholder="标题" value="<?php echo $result['title'];?>">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">键</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control form-control-line" name="cfg_key"  placeholder="请输入键" value="<?php echo $result['cfg_key'];?>"  readonly="readonly">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">值</label>
                      <div class="col-sm-10">
                          <textarea style="width: 420px;height: 120px;" name="cfg_value" placeholder="请输入值"  class="layui-input"> <?php echo trim($result['cfg_value']);?></textarea>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">状态</label>
                      <div class="col-sm-10">
                          <span style="float:left;width:60px">启用 <input style="width:20px;" type="radio" class="form-control " name="status" value="1"  <?php if ($result['status'] == 1) echo 'checked';?>></span>
                          <span style="float:left;width:60px">  禁用 <input style="width:20px;" type="radio" class="form-control" name="status" value="0" <?php if ($result['status'] == 0) echo 'checked';?>></span>
                      </div>

                  </div>
 
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="javascript:;" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="javascript:;" onclick="javascript:history.back(-1);" class="btn"><i class="fa fa-close"></i>取消</a>
                  </div>
                </div>

              </form> 

            </div>

      </div>
    </div>

  </div>
  <!-- End Row -->
    <script src="<?php echo URL_VIEW;?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>
    <script type="text/javascript">
        function edit(){
            $.ajax({
                  type: "POST",
                  dataType: "json",
                  url: "<?php echo url::s('admin/config/configEdit',"id={$result['id']}");?>",
                  data: $('#from').serialize(),
                  success: function (data) {
                      if(data.code == '200'){
                          layer.msg(data.msg, {icon:1,time:1000,end:function () {
                                  location.href = '<?php echo url::s('admin/config/configList');?>';
                              }});
                      }else{
                          layer.msg(data.msg, {icon: 2, time: 1000})
                      }
                  },
                  error: function(data) {
                      alert("error:"+data.responseText);
                   }
          });
        }
   </script>
  
</div>