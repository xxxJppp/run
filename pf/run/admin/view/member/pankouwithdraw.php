<?php
use xh\library\url;
use xh\library\model;
use xh\library\ip;
include_once (PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>
<link href="<?php echo str_replace("admin", 'index', URL_VIEW);?>/static/js/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet" media="screen,projection">
<!-- START CONTENT -->

  <!-- Start Page Header -->
  <div class="page-header">
   
      <ol class="breadcrumb">
        <li><a href="<?php echo url::s('admin/index/home');?>">控制台</a></li>
        <li class="active">盘口提现</li>
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
          提现记录 <span style="font-size: 15px;margin-left:20px;">[ 所有用户总提现金额: <?php //查询全部提现 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_pankouwithdraw where types=2");
                        echo '<span style="font-weight:bold;font-size:20px;color:red;"> '.floatval($order[0]['money']) .' </span> / 总提现笔数: <span style="color:green;font-weight:bold;">'.intval($order[0]['count']).'</span> ';
                        ?>] </span>   
        </div>

          <div>
              <form action="" style="margin-top: 20px;margin-bottom: 20px;">
                  <input type="text" name="flow_no" placeholder="订单号" value="<?php echo $flow_no;?>">
                  <input type="text" style="width: 120px;" name="username" placeholder="用户名" value="<?php echo $username;?>">

                  <select name="types">
                      <option value="0" <?php if($_GET['types'] == 0){ echo 'selected';} ?>>提现状态</option>
                      <option value="1" <?php if($_GET['types'] == 1){ echo 'selected';} ?>>银行处理中</option>
                      <option value="2" <?php if($_GET['types'] == 2){ echo 'selected';} ?>>银行到账</option>
                      <option value="3" <?php if($_GET['types'] == 3){ echo 'selected';} ?>>钱款驳回</option>
                      <option value="4" <?php if($_GET['types'] == 4){ echo 'selected';} ?>>资金异常</option>
                  </select>

                  <input type="submit" style="border:0px" value="查询" class="btn btn-success">
              </form>

          </div>

        <div class="panel-body table-responsive">
          <table class="layui-table" style="width:1800px;" cellspacing="0" cellpadding="0" border="0">
            <thead>
              <tr>
                <th>订单号</th>
                <th>用户名</th>
                <th>手机号</th>
                <th>提现前余额</th>
                <th>提现后余额</th>
                <th>提现余额</th>
                <th>实际打款</th>
                <th>手续费用</th>
<!--                <th>银行信息</th>-->
                <th>提现状态</th>
                <th>提现时间</th>
                <th>处理时间</th>
                <th>打款信息</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
            <?php if (!is_array($result['result'][0])) echo '<tr><td colspan="6" style="text-align: center;">暂时没有查询到订单!</td></tr>';?>
            
            <?php  foreach ($result['result'] as $ru){ $find_user = $mysql->query("client_user","id={$ru['user_id']}")[0];?>
              <tr>
               
                <td><?php echo $ru['flow_no'];?></p></td>
                        
                <td><?php $user = $mysql->query("client_user","id={$ru['user_id']}")[0]; echo isset($user['username'])?$user['username']:'';?></td>

                <td><?php echo $user['phone'];?></td>

                <td><?php echo $ru['old_amount'];?></td>

                <td><?php echo $ru['new_amount'];?></td>

                <td><?php echo $ru['amount'];?></td>

                <td><?php echo $ru['amount']-$ru['fees'];?></td>

                <td><?php echo $ru['fees'];?></td>

<!--                <td>--><?php //echo $ru['content'];?><!--</td>-->

                <td><?php
                    if ($ru['types'] == 1) echo '<span style="color:#039be5;">银行处理中..</span>';
                    if ($ru['types'] == 2) echo '<span style="color:green;">银行到账</span>';
                    if ($ru['types'] == 3) echo '<span style="color:#bdbdbd;">钱款驳回</span>';
                    if ($ru['types'] == 4) echo '<span style="color:red;">资金异常</span>';
                    ?><?php if ($ru['status'] == 4) echo ' (' . date("Y/m/d H:i:s",$ru['pay_time']) . ')';?>
                </td>
                        
                <td><?php echo date("Y/m/d H:i:s",$ru['apply_time']);?></td>
                <td><?php if ($ru['deal_time'] != 0) {echo date("Y/m/d H:i:s",$ru['deal_time']);}else {echo '处理中';};?></td>

                <td><?php echo $ru['types'] == 1 ? "处理中":'已处理';?></td>
                        

                <td>
                <p><?php if ($ru['types'] == 1){?><a href="#" onclick="ok('<?php echo $ru['id'];?>')" class="btn btn-success btn-xs"><i class="fa fa-user-md"></i>确认</a>  <a href="#" onclick="turnDown('<?php echo $ru['id'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-reply-all"></i>驳回</a>  <a href="#" onclick="error('<?php echo $ru['id'];?>')" class="btn btn-warning btn-xs"><i class="fa fa-close"></i>异常</a><?php }else {echo '处理完成';}?></p>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
          <div style="float:right;">
              <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
          </div>
          <div style="clear: both"></div>

      </div>
    </div>
    <!-- End Panel -->

      <script src="<?php echo URL_VIEW;?>/static/console/js/sweet-alert/sweet-alert.min.js"></script>
            <script type="text/javascript">

              function ok(id){
            
      		           swal({
      		                title: "确认打款", 
      		                text: "你确认已经为该提现订单打过款了吗？", 
      		                type: "warning", 
      		                showCancelButton: true, 
      		                confirmButtonColor: "#DD6B55", 
      		                confirmButtonText: "我已打款!", 
      		                closeOnConfirm: false 
      		              },
      		              function(){
        				         $.get("<?php echo url::s('admin/member/updatepankouWithdraw',"type=2&id=");?>" + id, function(result){
          	                      	 if(result.code == '200'){
          	                       		    swal("操作提醒", result.msg, "success");
          	            	              	setTimeout(function(){location.href = '';},1000);
          	            	              }else{
          	            	            	swal.showInputError(result.msg);     
          	            	             }
          	                  		});
      						  
      		              });
      			
                  }

              function turnDown(id){
            	  swal({   title: "驳回确认",   
                      text: "请输入驳回信息反馈给用户:",   
                      type: "input",   showCancelButton: true,   
                      closeOnConfirm: false,   
                      animation: "slide-from-top",   
                      inputPlaceholder: "驳回信息",
                      confirmButtonText: "驳回" }, 
                      function(inputValue){   
                          if (inputValue === false) return false;      
                          if (inputValue === "") {     
                          swal.showInputError("请输入驳回信息!");     
                          return false   
                          }
                     $.get("<?php echo url::s('admin/member/updatepankouWithdraw',"type=3&id=");?>" + id + "&msg=" + inputValue, function(result){
                      	 if(result.code == '200'){
                       		    swal("驳回提醒", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal.showInputError(result.msg);     
            	             }
                  		});
                 });
        		  $('.showSweetAlert input').val('您的收款账号有误,钱款已经退回至您的账户,请更新收款账户后重新提现!');
                  }

              function error(id){
            	  swal({   title: "异常确认",   
                      text: "请输入异常信息反馈给用户:",   
                      type: "input",   showCancelButton: true,   
                      closeOnConfirm: false,   
                      animation: "slide-from-top",   
                      inputPlaceholder: "异常信息",
                      confirmButtonText: "异常该提现" }, 
                      function(inputValue){   
                          if (inputValue === false) return false;      
                          if (inputValue === "") {     
                          swal.showInputError("请输入异常信息!");     
                          return false   
                          }
                     $.get("<?php echo url::s('admin/member/updatepankouWithdraw',"type=4&id=");?>" + id + "&msg=" + inputValue, function(result){
                      	 if(result.code == '200'){
                       		    swal("操作提醒", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal.showInputError(result.msg);     
            	             }
                  		});
                 });
        		  $('.showSweetAlert input').val('当前提现资金来源异常,暂时冻结该款项,如有疑问,请联系客服!');
                  }

              function wechat(){
                  var wechat = $('#wechat').val();
                  console.log(wechat);
                  location.href = "<?php echo url::s('admin/alipay/automaticOrder',"sorting=alipay&code=");?>" + wechat;
                  
                  }

            </script>
  </div>
</div>