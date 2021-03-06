<?php
use xh\library\url;
include_once (PATH_VIEW . 'common/header.php'); //头部
?>

<!-- START CONTENT -->

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/member/index');?>">会员管理</a></li>
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
          修改会员
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
              <form class="form-horizontal" id="from">
              
<!--                <div style="text-align: center;" class="form-group">-->
<!--                  <img id="avatar" onclick="imgSelect();" style="width: 100px;border-radius:50%;margin: 0 auto;" alt="--><?php //echo $result['username'];?><!--" src="--><?php //echo strlen($result['avatar']) > 2 ? str_replace("admin", 'index', URL_VIEW) . 'upload/avatar/' . $result['id'] . '/' . $result['avatar'] : str_replace("admin", 'index', URL_VIEW) .'static/images/avatar.png';?><!--"></td>-->
<!--                  <input type="file" name="avatar" id="avatarImg"  style="display:none;" onchange="uploadPic();">-->
<!--                </div>-->

                 <div class="form-group">
                  <label class="col-sm-2 control-label form-label">会员名</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="username"  placeholder="登录的用户名" value="<?php echo $result['username'];?>" readonly="readonly">
                  </div>
                </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label form-label">姓名</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control form-control-line" name="realname"  placeholder="请输入姓名" value="<?php echo $result['realname'];?>">
                      </div>
                  </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">密码</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="pwd"  placeholder="登录的密码，不修改请留空">
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">手机号</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="phone"  placeholder="手机号码" value="<?php echo $result['phone']=="0"?"":$result['phone'];?>">
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">权限组</label>
                  <div class="col-sm-10">
                    <select class="selectpicker" name="group_id">
                    <?php foreach ($groups as $gp){?>
                        <option value="<?php echo $gp['id'];?>" <?php if ($result['group_id'] == $gp['id']) echo 'selected';?>><?php echo $gp['name'];?></option>
                    <?php }?>
                      </select>                  
                  </div>
                </div>
                
   
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">上级ID</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control form-control-line" name="level_id"  placeholder="0" value="<?php echo $result['level_id'];?>">
                  </div>
                </div>
                
<!--                <div class="form-group">-->
<!--                  <label class="col-sm-2 control-label form-label">账户余额</label>-->
<!--                  <div class="col-sm-10">-->
<!--                  <input type="text" class="form-control form-control-line" name="balance"  placeholder="0.00" value="--><?php //echo $result['balance'];?><!--">-->
<!--                  </div>-->
<!--                </div>-->
<!--                -->
<!--                <div class="form-group">-->
<!--                  <label class="col-sm-2 control-label form-label">账户金额</label>-->
<!--                  <div class="col-sm-10">-->
<!--                  <input type="text" class="form-control form-control-line" name="money"  placeholder="0.00" value="--><?php //echo $result['money'];?><!--">-->
<!--                  </div>-->
<!--                </div>-->
                
              <p style="font-size:20px;color:red;">下面的代理，盘口，码商 选项只能选一个 不能重复选，什么都不选 默认为商户</p>
              
              <div class="form-group">
                  <label class="col-sm-2 control-label form-label">是否代理</label>
                  <div class="col-sm-10">
                    <span style="float:left;width:60px">不是 <input style="width:20px;" type="radio" class="form-control" name="is_agent" value="0" <?php if ($result['is_agent'] == 0) echo 'checked';?> ></span>
                  <span style="float:left;width:60px">  是  <input style="width:20px;" type="radio" class="form-control " name="is_agent" value="1"  <?php if ($result['is_agent'] == 1) echo 'checked';?>></span>
                  </div>
                       
                </div>
              
                  <div class="form-group">
                  <label class="col-sm-2 control-label form-label">是否盘口</label>
                  <div class="col-sm-10">
                    <span style="float:left;width:60px">不是 <input style="width:20px;" type="radio" class="form-control" name="is_pankou" value="0" <?php if ($result['is_pankou'] == 0) echo 'checked';?> ></span>
                  <span style="float:left;width:60px">  是  <input style="width:20px;" type="radio" class="form-control " name="is_pankou" value="1"  <?php if ($result['is_pankou'] == 1) echo 'checked';?>></span>
                  </div>
                       
                </div>
              
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">是否码商</label>
                  <div class="col-sm-10">
                    <span style="float:left;width:60px">不是 <input style="width:20px;" type="radio" class="form-control" name="is_mashang" value="0" <?php if ($result['is_mashang'] == 0) echo 'checked';?> ></span>
                  <span style="float:left;width:60px">  是  <input style="width:20px;" type="radio" class="form-control " name="is_mashang" value="1"  <?php if ($result['is_mashang'] == 1) echo 'checked';?>></span>
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
	        url:"<?php echo url::s('admin/member/avatarUpload','id=' . $result['id']);?>",
	        type:"post",
	        // Form数据
	        data: fd,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success:function(data){
	            if(data.code == '200'){
	            	$('#avatar').attr('src','<?php echo str_replace('admin', 'index', URL_VIEW) . '/upload/avatar/' . $result['id'] . '/';?>' + data.data.img);
                    layer.msg(data.msg, {icon: 1, time: 1000})
	            }else{
                    layer.msg(data.msg, {icon: 2, time: 1000})
	            }
	        }
	    });
	                    
	}

			function edit(){
				$.ajax({
			          type: "POST",
			          dataType: "json",
			          url: "<?php echo url::s('admin/member/editResult',"id={$result['id']}");?>",
			          data: $('#from').serialize(),
			          success: function (data) {
			              if(data.code == '200'){

                              layer.msg(data.msg, {icon:1,time:1000,end:function () {
                                      location.href = '<?php echo url::s('admin/member/'.$callback_type);?>';
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