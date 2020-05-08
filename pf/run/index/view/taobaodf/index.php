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
            <a onclick="add();" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-content-add left" style="width: 10px;"></i>添加淘宝代付</a>
      
    
			

            </p>
        

            <!--Striped Table-->
             <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                          <th>店铺ID</th>
                          <th>店铺</th>

                          <th>收款信息</th>
                          <th>轮训/网关</th>
                        <th>上传二维码</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                        <td><?php echo $ru['id'];?></td>
                        <td>
                          【通道 Key填写到pc监控上】<br>
                          <b>通道 Key: </b> <?php echo $ru['key_id'];?><br>
                        淘宝会员名: <?php echo $ru['name'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['name'].'</span>';?>[ <a href="#" onclick="edit('<?php echo $ru['id'];?>');">修改淘宝会员名称</a> ]
                              <br>( <a href="#" onclick="del('<?php echo $ru['id'];?>');" style="color:#757575;">删除淘宝代付账户</a> )
                        </td>
                          
                        <td>
                        <b>今日收入:</b> <?php //查询今日收入
                        $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where taobaodf_id={$ru['id']} and creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                        $today_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where taobaodf_id={$ru['id']} and creation_time > {$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                            if($order[0]['count']!=0){
                                $today_rate = round($order[0]['count']/ $today_order_all[0]['count']* 100,2).'%';
                            }else{
                                $today_rate = '0%';
                            }
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 成功/全部 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$today_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$today_rate.'</span> )';
                        ?><br>
                        <b>昨日收入:</b> <?php 
                        $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间
  
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where taobaodf_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                        $yesterday_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where taobaodf_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                            if($order[0]['count']!=0){
                                $yesterday_rate = round($order[0]['count']/ $yesterday_order_all[0]['count']* 100,2).'%';
                            }else{
                                $yesterday_rate = '0%';
                            }
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$yesterday_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$yesterday_rate.'</span> )';
                        ?><br>
                        <b>全部收入:</b> <?php 
                        $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_taobaodf_automatic_orders where taobaodf_id={$ru['id']} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                        echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                        ?>
                        </td>   
                        
                        <td>
                        <b>轮训: </b><?php echo $ru['training'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticRb('.$ru['id'].');">关闭轮训 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticRb('.$ru['id'].');">启动轮训 </a>)</span>';?><br>
                        <b>网关: </b><?php echo $ru['receiving'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticGateway('.$ru['id'].');">停止网关 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticGateway('.$ru['id'].');">启动网关 </a>)</span>';?><br>[ <a href="#" onclick="gatewayTest('<?php echo $ru['key_id'];?>')">单通道测试</a> ]
                        </td>
                  
                  <td> <a href="#" onclick="addewm('<?php echo $ru['id'];?>','<?php echo $ru['key_id'];?>')" style="font-size: 14px;" class="btn waves-effect waves-light indigo">上传代付二维码</a></td>
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
        
          function addArea(id){
          swal({   title: "请选择收款地区",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "<select id='area' name='area' style='display:block;'><option value='aaaa'>请选择收款地区</option><option value='0'>全国收款（无限制）</option><?php echo $areaStr;?></select>",
                  confirmButtonText: "提交" },
              function(inputValue){
                
                  $.get("<?php echo url::s('index/taobaodf/areaAdd',"id=");?>" + id + "&area=" +$('#area').val() , function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }

        
        
        
      function add(){
		  layer.open({
			  type: 2,
			  title: '添加收款账号',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['620px', '560px'],
			  content: '<?php echo url::s('index/taobaodf/viewAdd');?>' //iframe的url
			}); 
	  }
        
         function addewm(id,key_id){
		  layer.open({
			  type: 2,
			  title: '添加收款账号',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['620px', '560px'],
			  content: '<?php echo url::s('index/taobaodf/upewm',"id=");?>' + id + "&key_id=" + key_id //iframe的url
			}); 
	  }
        
        function upewm(id,key_id){
          swal({   title: "请添加二维码",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "二维码地址：<input type='text' id='ewm_url' value=''>"
                    +"金额：<input type='text' id='price' value=''>"
                     +"<a href='https://jiema.wwei.cn/' target='_blank'>点击这里解析二维码</a>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("金额不能为空");
                      return false
                  }
                 $.get("<?php echo url::s('index/taobaodf/automaticAddqrcode',"id=");?>" + id + "&ewm_url=" + $('#ewm_url').val() + "&price=" + $('#price').val()+ "&key_id=" + key_id, function(result){
                      if(result.code == '200'){
                          swal("成功提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert fieldset input').attr('type','hidden');
      }

         function edit(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "淘宝会员名",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("APP商户号");
                      return false
                  }
                  $.get("<?php echo url::s('index/taobaodf/automaticEditName',"id=");?>" + id + "&app_user=" + inputValue, function(result){
                      if(result.code == '200'){
                          swal("淘宝代付提醒", result.msg, "success");
                          setTimeout(function(){location.href = '';},1000);
                      }else{
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert input').attr('type','text');
      }
        
        
	  
      function startAutomaticRb(id){
    	  swal({
              title: "淘宝代付提醒", 
              text: "当前操作是更改淘宝代付轮训状态,您是否继续?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "是的,我要更改!", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/taobaodf/startAutomaticRb',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("淘宝代付提示", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("淘宝代付提示", result.msg, "error");
    	              }
              	  });
            });	
      }
      
      function startAutomaticGateway(id){
    	  swal({
              title: "淘宝代付提醒", 
              text: "当前操作是更改网关状态,您是否继续?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "是的,继续!", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/taobaodf/startAutomaticGateway',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("淘宝代付提示", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("淘宝代付提示", result.msg, "error");
    	              }
              	  });
            });	
      }

      function startAutomaticLogOut(id){
    	  swal({
              title: "淘宝代付提醒", 
              text: "您是否要退出当前淘宝代付?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "是的,我要退出!", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/taobaodf/startAutomaticLogOut',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("淘宝代付提示", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("淘宝代付提示", result.msg, "error");
    	              }
              	  });
            });	
      }

      function login(id){
    	  swal({   title: "淘宝代付登录",   
              text: "您即将开始登录淘宝代付,是否继续?",   
              type: "info",   showCancelButton: true,   
              closeOnConfirm: false,   
              showLoaderOnConfirm: true,
              confirmButtonText: "立即登录"
               }, 
              function(){
              //开始请求淘宝代付登录
            	   $.get("<?php echo url::s('index/taobaodf/startAutomaticLogin',"id=");?>" + id, function(result){
                  	 if(result.code == '200'){
                   		    $('.showSweetAlert p').html(result.msg);
                     		login_listen(id);
        	              }else{
        	            	swal("淘宝代付登录", result.msg, "error");
        	             }
              		});
                  
         });
      }
      var listen_login = 0;
      var music = 0;
      //伪造线程
      function login_listen(id){
      	listen_login = setInterval(function(){ $.get("<?php echo url::s('index/taobaodf/getAutomaticStatus',"id=");?>" + id, function(result){
      		if(result.code > 0){	
      			if(result.code == '2' || result.code == '3' ){ $('.showSweetAlert p').html(result.msg); }
      			if(result.code == '7'){
				//将二维码展现出来扫码
      				$('.showSweetAlert h2').html('请使用淘宝代付扫一扫');
      				$('.showSweetAlert p').html("<img style='width:200px;height:200px;' src='data:image/png;base64," + result.data.img + "'/>");
      				if(music == 0){
      					play(['<?php echo FILE_CACHE . "/download/sound/淘宝代付扫一扫1.mp3";?>']);
      					music = 1;
          			}
              	}
      			if(result.code == '4'){
	            	swal("淘宝代付登录", result.msg, "success");
	              	setTimeout(function(){location.href = '';},1000);
                }
             }else{
            	 swal("淘宝代付登录", result.msg, "error");
            	 setTimeout(function(){location.href = '';},1000);
             }
      	  });  },1000);
      }

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
             $.get("<?php echo url::s('index/taobaodf/automaticDelete',"id=");?>" + id + "&pwd=" + inputValue, function(result){
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
   