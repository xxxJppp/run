<?php 
use xh\library\url;
include_once (PATH_VIEW . 'common/header.php'); //头部
?>

<!-- START CONTENT -->

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/employee/index');?>">员工管理</a></li>
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
          修改员工
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">

<!--                <div style="text-align: center;" class="form-group">-->
<!--                  <img id="avatar" onclick="imgSelect();" style="width: 100px;border-radius:50%;margin: 0 auto;" alt="--><?php //echo $result['username'];?><!--" src="--><?php //echo URL_VIEW . '/upload/avatar/' . $result['id'] . '/' . $result['avatar'];?><!--"></td>-->
<!--                  <input type="file" name="avatar" id="avatarImg"  style="display:none;" onchange="uploadPic();">-->
<!--                </div>-->

                 <div class="form-group">
                  <label class="col-sm-2 control-label form-label">用户名</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="username"  placeholder="员工用作于登录的用户名" value="<?php echo $result['username'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">密码</label>
                  <div class="col-sm-10">
                  <input type="password" class="form-control form-control-line" name="pwd"  placeholder="员工用作于登录的密码，不修改请留空">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">口令</label>
                  <div class="col-sm-10">
                  <input type="password" class="form-control form-control-line" name="pwd_safe"  placeholder="6位安全口令,部功能操作需要安全口令认证，不修改请留空">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">权限组</label>
                  <div class="col-sm-10">
                    <select class="selectpicker" name="group_id">
                    <?php foreach ($groups as $gp){?>
                        <option value="<?php echo $gp['id'];?>" <?php if ($result['group_id'] == $gp['id']) echo 'selected';?>><?php echo $gp['mgt_name'];?></option>
                    <?php }?>
                      </select>                  
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">手机号</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码" value="<?php echo $result['phone'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">邮箱</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="email"  placeholder="邮箱账号" value="<?php echo $result['email'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">备注</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="remarks"  placeholder="员工备注" value="<?php echo $result['remarks'];?>">
                  </div>
                </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">google密钥</label>
                      <div class="col-sm-3">
                          <input type="text" class="form-control form-control-line" name="google_auth" id="google_auth"   value="<?php echo $result['google_auth'];?>" placeholder="员工用作于登录的google密钥" readonly="readonly">
                      </div>
                      <div class="col-sm-3">
                          <a href="#" onclick="shua()" class="btn btn-success"><i class="fa fa-refresh"></i>刷新google密钥</a> &nbsp;&nbsp;
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">goole二维码</label>
                      <div class="col-sm-3">
                          <img src="<?php echo $result['qrcodeurl'];?>" height="200" width="200" id="qrcode" id="goole_image"/>
                      </div>
                  </div>
 
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label"></label>
                  <div class="col-sm-10">
                   	<a href="#" onclick="edit()" class="btn btn-success"><i class="fa fa-refresh"></i>保存更新</a> &nbsp;&nbsp;
                   	<a href="<?php echo url::s('admin/employee/index');?>" class="btn"><i class="fa fa-close"></i>取消</a>
                  </div>
                </div>

              </form> 

            </div>

      </div>
    </div>

  </div>
  <!-- End Row -->
    <script type="text/javascript">
        layui.use(['layer'], function () {
            var  layer = layui.layer //弹层
        });
    //选择头像
	function imgSelect(){
	        document.getElementById('avatarImg').click(); 
	}

	//上传头像
	function uploadPic(){
	    var pic = $('#avatarImg')[0].files[0];
	    var fd = new FormData();
	    fd.append('avatar', pic);
	    $.ajax({
	        url:"<?php echo url::s('admin/employee/avatarUpload','id=' . $result['id']);?>",
	        type:"post",
	        // Form数据
	        data: fd,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success:function(data){
                $('#avatar').attr('src','<?php echo URL_VIEW . '/upload/avatar/' . $result['id'] . '/';?>' + data.data.img);
	            if(data.code == '200'){
                    layer.msg("上传成功", {icon:1,time:1000});

	            }else{
                    layer.msg("修改失败", {icon:2,time:1000})
	            }
	        }
	    });
	                    
	}

			function edit(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/employee/edit',"id={$result['id']}");?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){
                              layer.msg("修改成功", {icon:1,time:1000,end:function(){
                                      location.href = '<?php echo url::s('admin/employee/index');?>';
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

        function shua(){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo url::s('admin/employee/google',"");?>",
                data: $('#from').serialize(),
                success: function (data) {
                    if(data.code == '200'){
                        layer.msg("刷新成功", {icon:1,time:1000,end:function(){
                                $('#google_auth').val(data.secret);
                                $('#qrcode').attr('src', '');
                                $('#qrcode').attr('src', data.qrcode);
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
