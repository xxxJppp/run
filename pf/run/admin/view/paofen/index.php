<?php
use xh\library\url;
use xh\library\model;
use xh\library\ip;
include_once (PATH_VIEW . 'common/header.php'); //头部
$fix = DB_PREFIX;
?>

<!-- START CONTENT -->

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
          跑分 Automatic 管理
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-hover" style="width:  1500px;">
            <thead>
              <tr>
                <th>ID</th>

                <th>收款人名称</th>

                <th>轮训开关</th>
                <th>网关开关</th>
                <th>今日收入/手续费</th>
                <th>今日成功量/总数量/成功率</th>
                <th>昨日收入/手续费</th>
                <th>昨日成功量/总数量/成功率</th>
                <th>全部收入/手续费</th>
                <th>全部订单数量</th>
                <th>操作  <div class="checkbox checkbox-warning" style="display:inline-block;margin:0 0 0 25px;padding:0;position:relative;top:6px;">
                        <input id="checkboxAll" type="checkbox">

                        
                        <button type="button" id="deletes" onclick="deletes();" class="btn btn-option1 btn-xs" style="display:none;position:relative;top:-8px;"><i class="fa fa-trash-o"></i>删除</button>
                        
                    </div></th>
              </tr>
            </thead>
            <tbody>
            <?php  foreach ($result['result'] as $ru){?>
              <tr>

              <td><?php echo $ru['id'];?></td>

              <td><?php echo $ru['name'] ;?></td>


             <td><?php echo $ru['training'] == 1 ? '<span style="color:#4caf50;">开 ( <a href="#" style="color:#006064;" onclick="startAutomaticRb('.$ru['id'].');">关闭 </a> )</span>' : '<span style="color:red;">关 ( <a href="#" style="color:#e57373;" onclick="startAutomaticRb('.$ru['id'].');">启动 </a>)</span>';?></td>

             <td><?php echo $ru['receiving'] == 1 ? '<span style="color:#4caf50;">开 ( <a href="#" style="color:#006064;" onclick="startAutomaticGateway('.$ru['id'].');">关闭 </a> )</span>' : '<span style="color:red;">关 ( <a href="#" style="color:#e57373;" onclick="startAutomaticGateway('.$ru['id'].');">启动 </a>)</span>';?></td>

                
             <?php //查询今日收入
                 $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                 $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$nowTime} and status=4");
                 $total = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$nowTime}");
                 if($total[0]['count']){
                     $today_per =round($order[0]['count']/$total[0]['count']*100,2)."%";
                 }else{
                     $today_per =  '0%';
                 }
                 ?>
                  <td><?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span>' ;?></td>

                  <td><?php echo '<span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$total[0]['count'].'/'.$today_per.'</span> '; ?></td>

             <?php
                    $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
                      $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4");
                      $total = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime}");
                      if($total[0]['count']){
                          $yester_per = round($order[0]['count']/$total[0]['count']*100,2).'%';
                      }else{
                          $yester_per =  '0%';
                      }
                      ?>
                  <td> <?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> /  <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span> ' ;?></td>
                  <td><?php echo '<span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$total[0]['count'].'/'.$yester_per.'</span> ' ;?>
             </td>

             <?php
                 $order = $mysql->select("select sum(amount) as money,count(id) as count,sum(fees) as fees from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and status=4"); ?>
              <td><?php echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> / 手续费: <span style="color:blue;">'. number_format($order[0]['fees'],3) .'</span> ' ?></td>
             <td><?php echo '<span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span>'; ?></td>
               
             <td>
                <p style="margin-top: -15px;"><div class="checkbox checkbox-danger checkbox-circle">
                        <input onclick="showBtn()" name="items" value="<?php echo $ru['id'];?>" id="checkbox<?php echo $ru['id'];?>" type="checkbox">
                        <label for="checkbox<?php echo $ru['id'];?>">
                        </label>
                    </div></p>
                </td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
          <!--分页-->
          <div style="float:right;">
              <?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?>
          </div>
          <div style="clear: both"></div>

      </div>
    </div>
    <!-- End Panel -->  
            <script type="text/javascript">
            function startAutomaticRb(id){
            	  swal({
                      title: "跑分提醒", 
                      text: "当前操作是更改跑分轮训状态,您是否继续?", 
                      type: "warning", 
                      showCancelButton: true, 
                      confirmButtonColor: "#DD6B55", 
                      confirmButtonText: "确认", 
                      closeOnConfirm: false 
                    },
                    function(){
                       $.get("<?php echo url::s('admin/paofen/startAutomaticRb',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("跑分提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("跑分提示", result.msg, "error");
            	              }
                      	  });
                    });	
              }

            function startAutomaticGateway(id){
            	  swal({
                      title: "跑分提醒", 
                      text: "当前操作是更改网关状态,您是否继续?", 
                      type: "warning", 
                      showCancelButton: true, 
                      confirmButtonColor: "#DD6B55", 
                      confirmButtonText: "是的,继续!", 
                      closeOnConfirm: false 
                    },
                    function(){
                       $.get("<?php echo url::s('admin/paofen/startAutomaticGateway',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("跑分提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("跑分提示", result.msg, "error");
            	              }
                      	  });
                    });	
              }

            function startAutomaticLogOut(id){
            	  swal({
                      title: "跑分提醒", 
                      text: "您是否要退出当前跑分?", 
                      type: "warning", 
                      showCancelButton: true, 
                      confirmButtonColor: "#DD6B55", 
                      confirmButtonText: "是的,我要退出!", 
                      closeOnConfirm: false 
                    },
                    function(){
                       $.get("<?php echo url::s('admin/paofen/startAutomaticLogOut',"id=");?>" + id, function(result){
                      	 if(result.code == '200'){
            	            	swal("跑分提示", result.msg, "success");
            	              	setTimeout(function(){location.href = '';},1000);
            	              }else{
            	            	swal("跑分提示", result.msg, "error");
            	              }
                      	  });
                    });	
              }

			function del(id){
		              swal({
		                title: "跑分提醒", 
		                text: "你确定要删除该跑分吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除该跑分!", 
		                closeOnConfirm: false 
		              },
		              function(){
		                 $.get("<?php echo url::s('admin/paofen/automaticDelete','id=');?>" + id, function(result){

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
		                text: "你确定要批量删除已选中的跑分吗？", 
		                type: "warning", 
		                showCancelButton: true, 
		                confirmButtonColor: "#DD6B55", 
		                confirmButtonText: "是的,我要删除这些跑分!", 
		                closeOnConfirm: false 
		              },
		              function(){
				           $("input[name='items']:checked").each(function(){
				        	 $.get("<?php echo url::s('admin/paofen/automaticDelete','id=');?>" + $(this).val(), function(result){
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