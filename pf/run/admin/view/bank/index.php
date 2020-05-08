<?php 
use xh\library\url;
use xh\library\model;
use xh\library\ip;
include_once (PATH_VIEW . 'common/header.php'); //头部
include_once (PATH_VIEW . 'common/nav.php'); //导航
$fix = DB_PREFIX;
?>

<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">Automatic管理</li>
      </ol>
  </div>
  <!-- End Page Header -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTAINER -->
<div class="container-padding">


  <!-- Start Row -->
  <div class="row">
    <!-- Start Panel -->
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          账号 Automatic 管理
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <td>信息</td>
                <td>状态</td>
                <td>账户</td>
                <td>操作  <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                        <input id="checkboxAll" type="checkbox">
                        <label for="checkboxAll">
                        </label>
                        
                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>
                        
                    </div></td>
              </tr>
            </thead>
            <tbody>
            <?php  foreach ($result['result'] as $ru){?>
              <tr>
               <td>
                    <p><b>ID: </b> <?php echo $ru['id'];?></p>
                    <p>备注: <?php echo $ru['name'] == '0' ? '<span style="color:red">Unused</span>' : '<span style="color:red">'.$ru['name'].'</span>';?>   ( <a href="<?php echo url::s('admin/nxys/automaticOrder',"sorting=alipay&code={$ru['id']}");?>">交易订单</a> )</p>
                    <p><b>APP登录用户名: </b> <?php echo $ru['app_user'];?></p>
                    <p><b>带*卡号：<?php echo $ru['account_no']; ?></p>
                    <p><b>卡ID：<?php echo $ru['cardid']; ?></p>
                    <p><b>卡名：<?php echo $ru['gathering_name']; ?></p>
                    <p><b>银行：<?php echo $ru['bank_id']; ?></p>
                      
                </td>

                 <td>
                    <p><b>轮训开关: </b><?php echo $ru['training'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticRb('.$ru['id'].');">关闭轮训 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticRb('.$ru['id'].');">启动轮训 </a>)</span>';?></p>

                </td>
                
                <td>
                        <b>今日收入:</b> <?php //查询今日收入
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_bank_automatic_orders where alipay_id={$ru['id']} and creation_time > {$nowTime} and status=4");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?><br>
                        <b>昨日收入:</b> <?php 
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
  
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_bank_automatic_orders where alipay_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?><br>
                        <b>全部收入:</b> <?php 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_bank_automatic_orders where alipay_id={$ru['id']} and status=4");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>  ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?>
                        </td>
               
                <td>
                <p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $ru['id'];?>">
                            勾选,准备操作!
                        </label>
                    </div></p>
                <p><a href="#" onclick="del('<?php echo $ru['id'];?>');" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>移除账号</a></p>

                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
          
          <div style="float:right;">
          <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
          </div>
          <div style="clear: both"></div>
          
        </div>

      </div>
    </div>
    <!-- End Panel -->  
            <script type="text/javascript">
            function startAutomaticRb(id){
            	  swal({
                      title: "账号提醒", 
                      text: "当前操作是更改账号轮训状态,您是否继续?", 
                      type: "warning", 
                      showCancelButton: true, 
                      confirmButtonColor: "#DD6B55", 
                      confirmButtonText: "确认", 
                      closeOnConfirm: false 
                    },
                    function(){
                       $.get("<?php echo url::s('admin/bank/startAutomaticRb',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("账号提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("账号提示", result.msg, "error");
            	              }
                      	  });
                    });	
              }

            function startAutomaticGateway(id){
            	  swal({
                      title: "账号提醒", 
                      text: "当前操作是更改网关状态,您是否继续?", 
                      type: "warning", 
                      showCancelButton: true, 
                      confirmButtonColor: "#DD6B55", 
                      confirmButtonText: "是的,继续!", 
                      closeOnConfirm: false 
                    },
                    function(){
                       $.get("<?php echo url::s('admin/bank/startAutomaticGateway',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("账号提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("账号提示", result.msg, "error");
            	              }
                      	  });
                    });	
              }

            function startAutomaticLogOut(id){
            	  swal({
                      title: "账号提醒", 
                      text: "您是否要退出当前账号?", 
                      type: "warning", 
                      showCancelButton: true, 
                      confirmButtonColor: "#DD6B55", 
                      confirmButtonText: "是的,我要退出!", 
                      closeOnConfirm: false 
                    },
                    function(){
                       $.get("<?php echo url::s('admin/bank/startAutomaticLogOut',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("账号提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("账号提示", result.msg, "error");
            	              }
                      	  });
                    });	
              }

			function del(id){
		              swal({
		                title: "账号提醒", 
		                text: "你确定要删除该账号吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除该账号!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/bank/automaticDelete','id=');?>" + id, function(result){

		                	 if(result.code == '200'){
				            	swal("操作提示", result.msg, "success");
				              	setTimeout(function(){location.href = '';},1500);
				              }else{
				            	  swal("操作提示", result.msg, "error");
				              }
		                	  });

						  
		              });		
			}


			function deletes(){ 
		           swal({
		                title: "非常危险", 
		                text: "你确定要批量删除已选中的账号吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除这些账号!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/bank/automaticDelete','id=');?>" + $(this).val(), function(result){
						            	swal("操作提示", '当前操作已经执行完毕!', "success");
						              	setTimeout(function(){location.href = '';},1500);
				                	  });
				           });  
						  
		              });
		           
				}


			function showBtn(){
				var Inc = 0;
				$("input[name='items']:checkbox").each(function(){
                    if(this.checked){
                    	$('#deletes').show();
                    	return true;
                    }
                    Inc++;
              });
	              if($("input[name='items']:checkbox").length == Inc){
	            	  $('#deletes').hide();
		          }
			}

            </script>
            

<!-- End Moda Code -->


 
  </div>
  <!-- End Row -->
  
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
<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="<?php echo URL_VIEW;?>/static/console/js/bootstrap-select/bootstrap-select.js"></script>

<script>


$(function(){
       //实现全选与反选  
       $("#checkboxAll").click(function() {
           if (this.checked){
               $("input[name='items']:checkbox").each(function(){   
                     $(this).prop("checked", true);
               });
               showBtn();
           } else {     
               $("input[name='items']:checkbox").each(function() {     
                     $(this).prop("checked", false);    
               });
               showBtn();
           }   
       });  
   });  
</script>

</body>
</html>