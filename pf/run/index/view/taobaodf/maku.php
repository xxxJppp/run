<?php
use xh\library\url;
use xh\library\model;
$fix = DB_PREFIX;
?>
	<?php include_once (PATH_VIEW . 'common/header.php');?>
	
    <!-- START CONTENT -->
      <section id="content">
        
        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <!--
\u706b\u5c71\u652f\u4ed8\u0020\u4f5c\u8005\u0051\u0051\uff1a\u0033\u0038\u0032\u0033\u0039\u0030\u0033\u0020\u4e92\u7ad9\u5e97\u94fa\uff1a\u0068\u0074\u0074\u0070\u0073\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0068\u0075\u007a\u0068\u0061\u006e\u002e\u0063\u006f\u006d\u002f\u0069\u0073\u0068\u006f\u0070\u0038\u0035\u0030\u0032\u002f

-->
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">淘宝代付固码支付</h5>
                <ol class="breadcrumbs">
                    <li><a href="<?php echo url::s('index/panel/home');?>">仪表盘</a></li>
                    <li><a href="#">淘宝代付信息列表</a></li>
                   
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->
        <!--start container-->
        <div class="container">
          <div class="section">

            <p class="caption">
            <a href="<?php echo url::s("index/taobaodf/automaticOrder");?>" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-editor-border-all left" style="width: 10px;"></i>全部订单</a>
     
      
    
			

            </p>
        

            <!--Striped Table-->
             <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  
                  
                  <div style="font-size:16px;padding:15px">
                    <b>未使用总金额:</b> <?php //查询今日收入
                        $order = $mysql->select("select sum(price) as money,count(id) as count from {$fix}client_taobaodf_qrcode where status=1 and user_id={$_SESSION['MEMBER']['uid']}");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 元 ( 码数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?>
                  
                   
                    <b style="margin-left:20px;">,已使用总金额:</b> <?php //查询今日收入
                        $order1 = $mysql->select("select sum(price) as money,count(id) as count from {$fix}client_taobaodf_qrcode where status=2 and user_id={$_SESSION['MEMBER']['uid']}");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order1[0]['money']) .' </span> 元 ( 码数量: <span style="color:green;font-weight:bold;">'.$order1[0]['count'].'</span> )';
                        ?>
                  
                   <b style="margin-left:20px;">,锁定总金额:</b> <?php //查询今日收入
                        $order2 = $mysql->select("select sum(price) as money,count(id) as count from {$fix}client_taobaodf_qrcode where status=3 and user_id={$_SESSION['MEMBER']['uid']}");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order2[0]['money']) .' </span> 元 ( 码数量: <span style="color:green;font-weight:bold;">'.$order2[0]['count'].'</span> )';
                        ?>
                   
                  </div>
                  
                  
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                          <th>店铺ID</th>
                          <th>代付链接</th>
                          <th>淘宝订单号</th>
                          <th>金额</th>
                          <th>添加/核销/锁定时间</th>
                          <th>状态</th>
                          <th>操作</th>
                      </tr>
                    </thead>

                    
                    <tbody>
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                        <td>店铺ID：<?php echo $ru['shop_id'];?></td>
                        <td>
                        
 <b> https://qr.alipay.com/_d?_b=pe[<a title="<?php echo $ru['ewm_url']; ?>" href="<?php echo $ru['ewm_url']; ?>" target="_blank" >打开</a>]<br>
           
                             
                        </td>
                           <td>
                            <?php echo $ru['taobao_orderid'];?>
                          </td>
                           <td>
                            <?php echo $ru['price'];?>
                          </td>
                  
                           <td>
                             添加时间:<?php echo date("Y-m-d H:i:s",$ru['addtime']);?></br>
                             核销时间:<?php echo date("Y-m-d H:i:s",$ru['hexiaotime']);?></br>
                           <?php if($ru['suodingtime'] != 0 ){ echo "锁定时间:". date("Y-m-d H:i:s",$ru['suodingtime']);}?>
                          </td>
                  
                        <td>
                          <?php if($ru['status'] == 1) { echo "未使用";} else if($ru['status'] == 2) { echo "已使用";} else if($ru['status'] == 3) { echo "锁定中";}  ?>
                        </td>   
                        
                        <td>
                         <a href="#" onclick="del('<?php echo $ru['id'];?>');" style="color:#757575;">删除淘宝代付二维码</a> 
                  </td>
                      </tr>
                    <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
              
              <div class="row"><ul class="pagination"><?php (new model())->load('page', 'turn')->auto($result['info']['pageAll'], $result['info']['page'], 10); ?></ul></div>
  
            </div>
            
            

          </div>


        </div>
        <!--end container-->

      </section>


      <!-- END CONTENT -->
      <script type="text/javascript">
        


	  function del(id){
		  swal({   title: "淘宝代付提醒",   
              text: "请验证您的登录密码:",   
              type: "input",   showCancelButton: true,   
              closeOnConfirm: false,   
              animation: "slide-from-top",   
              inputPlaceholder: "会员登录密码",
              confirmButtonText: "确认删除" }, 
              function(inputValue){   
                  if (inputValue === false) return false;      
                  if (inputValue === "") {     
                  swal.showInputError("请输入您的登录密码!");     
                  return false   
                  }
             $.get("<?php echo url::s('index/taobaodf/automaticqrcodeDelete',"id=");?>" + id + "&pwd=" + inputValue, function(result){
              	 if(result.code == '200'){
               		    swal("淘宝代付提醒", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal.showInputError(result.msg);     
    	             }
          		});
         });
		  $('.showSweetAlert input').attr('type','password');
	  }

	 //轮训测试
	  function robinTest(id){
		  swal({
		      title: "轮训通道测试",
		      text: "请输入要测试支付的金额<input type='text' id='amount' value='1.00'>"
		      +"请输入要接收异步通知的回调url<input type='text' id='callback_url'>",showCancelButton: true,   
		      html: true,
              confirmButtonText: "确认测试" , 
		      type: "prompt",
		  }, function(){

		       window.open('<?php echo url::s("index/taobaodf/robinTest");?>' + '?amount=' + $('#amount').val() + '&callback_url=' + $('#callback_url').val());
			   location.href='';
		      })
		 
		 $('.showSweetAlert fieldset input').attr('type','hidden');
		 $('#amount').val('1.00');
		 $('#callback_url').val('https://www.baidu.com');
	  }

	  function gatewayTest(id){
		  swal({
		      title: "单通道测试",
		      text: "请输入要测试支付的金额<input type='text' id='amount' value='1.00'>"
		      +"请输入要接收异步通知的回调url<input type='text' id='callback_url'>",showCancelButton: true,   
		      html: true,
              confirmButtonText: "确认测试" , 
		      type: "prompt",
		  }, function(){

		       window.open('<?php echo url::s("index/taobaodf/gatewayTest");?>' + '?amount=' + $('#amount').val()  + "&keyId=" + id + '&callback_url=' + $('#callback_url').val());
			   location.href='';
		      })
		 
		 $('.showSweetAlert fieldset input').attr('type','hidden');
		 $('#amount').val('1.00');
		 $('#callback_url').val('https://www.baidu.com');
	  }

         function editMaxAmount(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "当天最大收款",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的最大收款金额!");
                      return false
                  }
                  $.get("<?php echo url::s('index/taobaodf/editMaxAmount',"id=");?>" + id + "&amount=" + inputValue, function(result){
                      if(result.code == '200'){
                          swal("提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert input').attr('type','text');
      }
        
        
         function editMaxdd(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "当天最大订单数",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的最大收款金额!");
                      return false
                  }
                  $.get("<?php echo url::s('index/taobaodf/editMaxdd',"id=");?>" + id + "&dd=" + inputValue, function(result){
                      if(result.code == '200'){
                          swal("提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert input').attr('type','text');
      }
        
        
		//淘宝代付设置
	  function setting(){ 
		  layer.open({
			  type: 2,
			  title: '淘宝代付配置',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['600px', '400px'],
			  content: '<?php echo url::s('index/taobaodf/automaticConfig');?>' //iframe的url
			}); 
	  }

		//下载apk
	  function apk(){
		  swal({   title: "APK下载提醒",   
              text: "当前下载淘宝代付监控APP",   
              type: "input", 
              showCancelButton: true,   
              closeOnConfirm: false,   
              animation: "slide-from-top",   
              inputPlaceholder: "请输入您的会员登录密码",
              confirmButtonText: "立即下载" }, 
              function(inputValue){   
                  if (inputValue === false) return false;      
                  if (inputValue === "") {     
                  swal.showInputError("请输入您的登录密码!");     
                  return false   
                  }
             $.get("<?php echo url::s('index/apk/verification',"pwd=");?>" + inputValue, function(result){
              	 if(result.code == '200'){
               		    swal("下载提醒", result.msg, "success");
               		    var url = "<?php echo url::s('index/apk/download',"pwd=");?>" + inputValue;
    	              	setTimeout(function(){location.href=url},1000);
    	              }else{
    	            	swal.showInputError(result.msg);     
    	             }
          		});
         });
		  $('.showSweetAlert input').attr('type','password');
	  }
	  
		//下载pc
	  function pc(){
		  swal({   title: "软件下载提醒",   
              text: "由于云端数据处理庞大，以及服务器消耗都是巨大的，所以我们提供给客户自行挂机的辅助软件，当然，挂机版手续费相对云端版的手续费，会降低很多。",   
              type: "input",   showCancelButton: true,   
              closeOnConfirm: false,   
              animation: "slide-from-top",   
              inputPlaceholder: "请输入您的会员登录密码",
              confirmButtonText: "立即下载" }, 
              function(inputValue){   
                  if (inputValue === false) return false;      
                  if (inputValue === "") {     
                  swal.showInputError("请输入您的登录密码!");     
                  return false   
                  }
             $.get("<?php echo url::s('index/pc/verification',"pwd=");?>" + inputValue, function(result){
              	 if(result.code == '200'){
               		    swal("下载提醒", result.msg, "success");
               		    var url = "<?php echo url::s('index/pc/download',"pwd=");?>" + inputValue;
    	              	setTimeout(function(){window.open(url)},1000);
    	              }else{
    	            	swal.showInputError(result.msg);     
    	             }
          		});
         });
		  $('.showSweetAlert input').attr('type','password');
	  }
	  </script>
      <?php include_once (PATH_VIEW . 'common/footer.php');?>    
   