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
            <!-- Search for small screen -->
            <div class="header-search-wrapper grey hide-on-large-only">
                <i class="mdi-action-search active"></i>
                <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
            </div>
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Automatic <?php echo SYSTEM_VERSION; ?></h5>
                <ol class="breadcrumbs">
                    <li><a href="#">收钱吧</a></li>
                    <li class="active">Automatic</li>
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
            <a href="<?php echo url::s("index/shouqianba/automaticOrder");?>" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-editor-border-all left" style="width: 10px;"></i>全部订单</a>
         
            <a onclick="addNew();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加收钱吧支付宝</a>
                <a onclick="addhongbao();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加收钱吧微信</a>

            </p>
        

            <!--Striped Table-->
            <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                          <th>标识ID</th>
                          <th>名称/状态</th>
                        <th>配置</th>
                          <th>收款信息</th>
                         
                          <th>Important</th>
                          <th>备注信息</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                        <td><?php echo $ru['id'];?></td>
                        <td>
                        APP登录用户名: <?php echo $ru['app_user'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['app_user'].'</span>';?>[ <a href="#" onclick="edit('<?php echo $ru['id'];?>');">修改名称</a> ] <font color=red>( <?php if($ru['type'] == '1'){ echo "收钱吧支付宝"; }else { echo "收钱吧微信" ;}  ?> )</font> <br>
                           收钱吧账号: <?php echo $ru['account'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['account'].'</span>';?><br>
                          <?php if($ru['type'] == '1'){ echo "账号ID：".$ru['pid']; }else { echo "收款二维码：".$ru['pid'] ;}  ?>
                            <br>( <a href="#" onclick="del('<?php echo $ru['id'];?>');" style="color:#757575;">删除账户</a> )
                       
                            <br>
                        </td>
                        
                        <td>
                             <p><font color="red">设置0为无限制</font></p>
                             当天最大收款额度：  <?php echo $ru['max_amount']?>
                          [ <a href="#" onclick="editMaxAmount('<?php echo $ru['id'];?>');">修改</a> ]
                              <br/>
                              当天最大收款笔数：  <?php echo $ru['max_dd']?>
                          [ <a href="#" onclick="editMaxdd('<?php echo $ru['id'];?>');">修改</a> ]
                              <br/>
                            指定收款地区：   <?php echo $ru['area']; ?>
                              [ <a href="#" onclick="addArea('<?php echo $ru['id'];?>');">修改</a> ]
                              <br/>
                          </td>
                         
                          <td>
                              <b>今日收入:</b> <?php //查询今日收入
                              $nowTime = strtotime(date("Y-m-d",time()) . ' 00:00:00');
                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where shouqianba_id={$ru['id']} and creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              $today_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where shouqianba_id={$ru['id']} and creation_time > {$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                              if($order[0]['count']!=0){
                                  $today_rate = round($order[0]['count']/ $today_order_all[0]['count']* 100,2).'%';
                              }else{
                                  $today_rate = '0%';
                              }
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 成功/全部 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$today_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$today_rate.'</span> )';
                              ?><br>
                              <b>昨日收入:</b> <?php
                              $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间

                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where shouqianba_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              $yesterday_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where shouqianba_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                              if($order[0]['count']!=0){
                                  $yesterday_rate = round($order[0]['count']/ $yesterday_order_all[0]['count']* 100,2).'%';
                              }else{
                                  $yesterday_rate = '0%';
                              }
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$yesterday_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$yesterday_rate.'</span> )';
                              ?><br>
                              <b>全部收入:</b> <?php
                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_shouqianba_automatic_orders where shouqianba_id={$ru['id']} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                              ?>
                          </td>
                       
                        
                        <td><b>DEVICE Key: </b> <?php echo $ru['key_id'];?><br>
                        <b>ROUND Robin: </b><?php echo $ru['training'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticRb('.$ru['id'].');">关闭轮训 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticRb('.$ru['id'].');">启动轮训 </a>)</span>';?><br>
                        <b>Gateway: </b><?php echo $ru['receiving'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticGateway('.$ru['id'].');">停止网关 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticGateway('.$ru['id'].');">启动网关 </a>)</span>';?><br>[ <a href="#" onclick="gatewayTest('<?php echo $ru['key_id'];?>')">单通道测试</a> ]
                        </td>
                          <td>
                              <?php echo $ru['note']?>
                              <br>
                              [ <a href="#" onclick="editNote('<?php echo $ru['id'];?>');">修改</a> ]</td>
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
          function add(){
              swal({
                      title: "收钱吧提醒",
                      text: "您确定要新增加一个收钱吧服务通道吗?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "是的,我要新增!",
                      closeOnConfirm: false
                  },
                  function(){
                      $.get("<?php echo url::s('index/shouqianba/automaticAdd');?>", function(result){
                          if(result.code == '200'){
                              swal("收钱吧提示", result.msg, "success");
                              setTimeout(function(){location.href = '';},1000);
                          }else{
                              swal("收钱吧提示", result.msg, "error");
                          }
                      });
                  });
          }
      function addNew(){
          swal({   title: "请输入配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "收钱吧帐号<input type='text' id='account' value=''>"
                 +"账号ID<a target='_blank' href='https://cli.im/deqr'>点击这里获取</a><input type='text' id='pid' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('index/shouqianba/automaticAdd',"account=");?>" +$('#account').val() +'&name='+ $('#name').val() +'&pid='+ $('#pid').val()+'&type=1', function(result){
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
        
         function addhongbao(){
          swal({   title: "请输入配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "收钱吧帐号<input type='text' id='account' value=''>"
                  +"二维码连接<a target='_blank' href='https://cli.im/deqr'>点击这里获取</a><input type='text' id='pid' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("收钱吧帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('index/shouqianba/automaticAdd',"account=");?>" +$('#account').val() +'&name='+ $('#name').val() +'&pid='+ $('#pid').val()+'&type=2', function(result){
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

      function withdraw(key_id,status) {
          var id = 0;
          if(status != '4'){
              swal("通道在线才可申请提现");
              return;
          }
          swal({
                  title: "提现提示(提交后会关闭网关，提现成功后需手动开启)",
                  type: "input", showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "请输入收钱吧支付密码",
                  confirmButtonText: "确认提现"
              },
              function (inputValue) {
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入支付密码!");
                      return false
                  }
                  $.get("<?php echo url::s('index/shouqianba/withdraw', "id=");?>" + id + "&pwd=" + inputValue +"&key_id="+key_id +"&type=shouqianba", function (result) {
                      if (result.code == '200') {
                          swal("微信提醒", result.msg, "success");
                          setTimeout(function () {
                              location.href = '';
                          }, 2000);
                      } else {
                          swal.showInputError(result.msg);
                      }
                  });
              });
          $('.showSweetAlert input').attr('type', 'text');
      }

      function editMaxAmount(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "最大收款",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的最大收款金额!");
                      return false
                  }
                  $.get("<?php echo url::s('index/shouqianba/editMaxAmount',"id=");?>" + id + "&amount=" + inputValue, function(result){
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
        
          function addArea(id){
          swal({   title: "请选择收款地区",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "<select id='area' name='area' style='display:block;'><option value='aaaa'>请选择收款地区</option><option value='0'>全国收款（无限制）</option><?php echo $areaStr;?></select>",
                  confirmButtonText: "提交" },
              function(inputValue){
                
                  $.get("<?php echo url::s('index/shouqianba/areaAdd',"id=");?>" + id + "&area=" +$('#area').val() , function(result){
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
                  $.get("<?php echo url::s('index/shouqianba/editMaxdd',"id=");?>" + id + "&dd=" + inputValue, function(result){
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
      function editNote(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "备注",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的备注");
                      return false
                  }
                  $.get("<?php echo url::s('index/shouqianba/editNote',"id=");?>" + id + "&note=" + inputValue, function(result){
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
      function edit(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "APP用户登录名称",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的收钱吧名称!");
                      return false
                  }
                  $.get("<?php echo url::s('index/shouqianba/automaticEditName',"id=");?>" + id + "&app_user=" + inputValue, function(result){
                      if(result.code == '200'){
                          swal("收钱吧提醒", result.msg, "success");
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
              title: "收钱吧提醒", 
              text: "当前操作是更改收钱吧轮训状态,您是否继续?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "是的,我要更改!", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/shouqianba/startAutomaticRb',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("收钱吧提示", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("收钱吧提示", result.msg, "error");
    	              }
              	  });
            });	
      }
      
      function startAutomaticGateway(id){
    	  swal({
              title: "收钱吧提醒", 
              text: "当前操作是更改网关状态,您是否继续?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "是的,继续!", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/shouqianba/startAutomaticGateway',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("收钱吧提示", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("收钱吧提示", result.msg, "error");
    	              }
              	  });
            });	
      }

      function startAutomaticLogOut(id){
    	  swal({
              title: "收钱吧提醒", 
              text: "您是否要退出当前收钱吧?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "是的,我要退出!", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('index/shouqianba/startAutomaticLogOut',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("收钱吧提示", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("收钱吧提示", result.msg, "error");
    	              }
              	  });
            });	
      }

      function login(id){
    	  swal({   title: "收钱吧登录",   
              text: "您即将开始登录收钱吧,是否继续?",   
              type: "info",   showCancelButton: true,   
              closeOnConfirm: false,   
              showLoaderOnConfirm: true,
              confirmButtonText: "立即登录"
               }, 
              function(){
              //开始请求收钱吧登录
            	   $.get("<?php echo url::s('index/shouqianba/startAutomaticLogin',"id=");?>" + id, function(result){
                  	 if(result.code == '200'){
                   		    $('.showSweetAlert p').html(result.msg);
                     		login_listen(id);
        	              }else{
        	            	swal("收钱吧登录", result.msg, "error");
        	             }
              		});
                  
         });
      }
      var listen_login = 0;
      var music = 0;
      //伪造线程
      function login_listen(id){
      	listen_login = setInterval(function(){ $.get("<?php echo url::s('index/shouqianba/getAutomaticStatus',"id=");?>" + id, function(result){
      		if(result.code > 0){	
      			if(result.code == '2' || result.code == '3' ){ $('.showSweetAlert p').html(result.msg); }
      			if(result.code == '7'){
				//将二维码展现出来扫码
      				$('.showSweetAlert h2').html('请使用收钱吧扫一扫');
      				$('.showSweetAlert p').html("<img style='width:200px;height:200px;' src='data:image/png;base64," + result.data.img + "'/>");
      				if(music == 0){
      					play(['<?php echo FILE_CACHE . "/download/sound/收钱吧扫一扫1.mp3";?>']);
      					music = 1;
          			}
              	}
      			if(result.code == '4'){
	            	swal("收钱吧登录", result.msg, "success");
	              	setTimeout(function(){location.href = '';},1000);
                }
             }else{
            	 swal("收钱吧登录", result.msg, "error");
            	 setTimeout(function(){location.href = '';},1000);
             }
      	  });  },1000);
      }

	  function del(id){
		  swal({   title: "提醒",   
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
             $.get("<?php echo url::s('index/shouqianba/automaticDelete',"id=");?>" + id + "&pwd=" + inputValue, function(result){
              	 if(result.code == '200'){
               		    swal("提醒", result.msg, "success");
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

		       window.open('<?php echo url::s("index/shouqianba/robinTest");?>' + '?amount=' + $('#amount').val() + '&callback_url=' + $('#callback_url').val());
			   location.href='';
		      })
		 
		 $('.showSweetAlert fieldset input').attr('type','hidden');
		 $('#amount').val('1.00');
		 $('#callback_url').val('<?php echo URL_ROOT; ?>/index/index/callback.do');
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

		       window.open('<?php echo url::s("index/shouqianba/gatewayTest");?>' + '?amount=' + $('#amount').val()  + "&keyId=" + id + '&callback_url=' + $('#callback_url').val());
			   location.href='';
		      })
		 
		 $('.showSweetAlert fieldset input').attr('type','hidden');
		 $('#amount').val('1.00');
		 $('#callback_url').val('<?php echo URL_ROOT; ?>/index/index/callback.do');
	  }

		//收钱吧设置
	  function setting(){ 
		  layer.open({
			  type: 2,
			  title: '收钱吧配置',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['600px', '400px'],
			  content: '<?php echo url::s('index/shouqianba/automaticConfig');?>' //iframe的url
			}); 
	  }

		//下载apk
	  function apk(){
		  swal({   title: "APK下载提醒",   
              text: "当前下载安卓软件环境包，包含XP框架（免root版），XP框架（root版），<?php echo WEB_NAME; ?>v1.1（自动生成二维码必启动）",
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
   