<?php 
use xh\library\url;
use xh\unity\cog;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">人工充值</li>
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
            人工充值
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">
              
               <div class="form-group">
                  <label class="col-sm-2 control-label form-label">码商账号</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control form-control-line" name="username" placeholder="码商用户名" value="">
                  </div>
                </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">金额</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control form-control-line" name="money" placeholder="给码商充值或者扣除的金额" value="">
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">备注</label>
                      <div class="col-sm-10">
                          <textarea class="form-control form-control-line" rows="3"  name="remark"  placeholder="备注信息"></textarea>
                      </div>
                  </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">充值状态</label>
                  <div class="col-sm-10">
                    <div class="radio radio-info radio-inline">
                        <input type="radio" id="inlineRadio1" name="open" value="1" checked>
                        <label for="inlineRadio1"> 增加 </label>
                    </div>
                    <div class="radio radio-inline">
                        <input type="radio" id="inlineRadio2" name="open" value="2">
                        <label for="inlineRadio2"> 扣除 </label>
                    </div>
                  </div>
                </div>
                
 
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/index/home');?>" class="btn"><i class="fa fa-close"></i>取消</a>
                  </div>
                </div>

              </form> 

            </div>

      </div>
    </div>

  </div>
  <!-- End Row -->
  
    <script type="text/javascript">
			function edit(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/member/manualRechargeResult');?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
			            	  swal("操作提示", data.msg, "success");
			              }else{
			            	  swal("操作提示", data.msg, "error");
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

<?php include_once (PATH_VIEW . 'common/footer.php');?>

</div>
<!-- End Content -->

<?php include_once (PATH_VIEW . 'common/chat.php');?>

<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/jquery.min.js"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="<?php echo URL_VIEW;?>/static/console/js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/plugins.js"></script>

<!-- ================================================
Sweet Alert
================================================ -->
<script src="<?php echo URL_VIEW;?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>

</body>
</html>