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
                <h5 class="breadcrumbs-title">跑分模式</h5>
                <ol class="breadcrumbs">
                    <li><a href="#">跑分模式</a></li>
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
            <a href="<?php echo url::s("mashang/paofen/automaticOrder");?>" style="font-size: 14px;" class="btn waves-effect waves-light  cyan darken-2"><i class="mdi-editor-border-all left" style="width: 10px;"></i>全部订单</a>
         
            <a onclick="addalipay();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加支付宝固码收款</a>
              
<!--            <a onclick="addwechat();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加微信收款</a>-->
              
<!--            <a onclick="addwechatdy();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加微信店员模式收款</a>-->
              
            <a onclick="addqita();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加其他收款码</a>

          <a onclick="addalipaypid();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加支付宝转账模式</a>
              
<!--              <a onclick="addbank();" style="font-size: 14px;background-color: red;!important;" class="btn waves-effect waves-light  cyan " ><i class="mdi-content-add left" style="width: 10px;"></i>添加支付宝微信转卡</a>-->
            </p>
        

            <!--Striped Table-->
            <div id="striped-table">

              <div class="row">
   
                <div class="col s12 m12 l12">
                  <table class="striped"  style="font-size: 14px;">
                    <thead>
                      <tr>
                            <td>筛选类型  <br>[ <a href="<?php echo url::s('mashang/paofen/automatic','sorting=type&code=go');?>">全部</a> / <a href="<?php echo url::s('mashang/paofen/automatic','sorting=type&code=1');?>">支付宝</a> / <a href="<?php echo url::s('mashang/paofen/automatic','sorting=type&code=2');?>">微信</a> / <a href="<?php echo url::s('mashang/paofen/automatic','sorting=type&code=3');?>">其他</a>  / <a href="<?php echo url::s('mashang/paofen/automatic','sorting=type&code=4');?>">支付宝转账模式</a>/ <a href="<?php echo url::s('mashang/paofen/automatic','sorting=type&code=5');?>">微信支付宝转卡</a>/ <a href="<?php echo url::s('mashang/paofen/automatic','sorting=type&code=6');?>">微信店员</a>]</td>

                          <th>名称/状态</th>
                         <th>当天最大收款/元</th>
                          <th>收款信息</th>
                          <th>Important</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result['result'] as $ru){?>
                      <tr>
                        <td><?php echo $ru['id'];?></td>
                        <td>
                        APP商户号: <?php echo $ru['app_user'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['app_user'].'</span>';?>[ <a href="#" onclick="edit('<?php echo $ru['id'];?>');">修改名称</a> ] <font color=red>( <?php if($ru['type'] == '1'){ echo "支付宝"; }else  if($ru['type'] == '2'){ echo "微信"; }else if($ru['type'] == '3'){ echo $ru['typename']; }else if($ru['type'] == '4'){ echo '支付宝转账模式'; }else if($ru['type'] == '5'){ echo '支付宝/微信转卡'; }else if($ru['type'] == '6'){ echo '微信店员'; }  ?> )</font> <br>
                           备注: <?php echo $ru['name'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['name'].'</span>';?><br>
                          
                          <?php  if($ru['type'] == '4'){   ?>
                      支付宝账号: <?php echo $ru['account'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['account'].'</span>';?><br>
                           PID: <?php echo $ru['pid'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['pid'].'</span>';?>
                          <?php } else if($ru['type'] == '5'){ ?>
                           姓名：<?php echo $ru['gathering_name'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['gathering_name'].'</span>';?><br>
                           卡号：<?php echo $ru['account_no'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['account_no'].'</span>';?> <br>
                          CARDID：<?php echo $ru['cardid'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['cardid'].'</span>';?>     <br>             
                          银行：<?php echo $ru['bank_id'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['bank_id'].'</span>';?>                  
                                                             
                                                        <?php  } else  if($ru['type'] == '6'){ ?>
                           微信名称 : <?php echo $ru['dy_name'] ;?>  [ <a href="#" onclick="editdyname('<?php echo $ru['id'];?>');">修改</a> ]<br>
                           收款码链接: <?php echo $ru['ewm_url'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['ewm_url'].'</span>';?>
                          
                          <?php }else { ?>
                          
                            收款码链接: <?php echo $ru['ewm_url'] == '0' ? '<span style="color:red;">Unused</span>' : '<span style="color:green;">'.$ru['ewm_url'].'</span>';?>
                          
                          <?php } ?>
                          
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
                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              $today_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                              if($order[0]['count']!=0){
                                  $today_rate = round($order[0]['count']/ $today_order_all[0]['count']* 100,2).'%';
                              }else{
                                  $today_rate = '0%';
                              }
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 成功/全部 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$today_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$today_rate.'</span> )';
                              ?><br>
                              <b>昨日收入:</b> <?php
                              $zrTime = strtotime(date("Y-m-d",$nowTime-86400) . ' 00:00:00'); //昨日的时间

                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              $yesterday_order_all = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and creation_time > {$zrTime} and creation_time<{$nowTime} and user_id={$_SESSION['MEMBER']['uid']}");
                              if($order[0]['count']!=0){
                                  $yesterday_rate = round($order[0]['count']/ $yesterday_order_all[0]['count']* 100,2).'%';
                              }else{
                                  $yesterday_rate = '0%';
                              }
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'/'.$yesterday_order_all[0]['count'].'&nbsp;成功率&nbsp;'.$yesterday_rate.'</span> )';
                              ?><br>
                              <b>全部收入:</b> <?php
                              $order = $mysql->select("select sum(amount) as money,count(id) as count from {$fix}client_paofen_automatic_orders where paofen_id={$ru['id']} and status=4 and user_id={$_SESSION['MEMBER']['uid']}");
                              echo '<span style="color:red;font-weight:bold;"> '.floatval($order[0]['money']) .' </span> 人民币 ( 订单数量: <span style="color:green;font-weight:bold;">'.$order[0]['count'].'</span> )';
                              ?>
                          </td>
                       
                        
                        <td><b>DEVICE Key: </b> <?php echo $ru['key_id'];?><br>
                        <b>ROUND Robin: </b><?php echo $ru['training'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticRb('.$ru['id'].');">关闭轮训 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticRb('.$ru['id'].');">启动轮训 </a>)</span>';?><br>
                        <b>Gateway: </b><?php echo $ru['receiving'] == 1 ? '<span style="color:#4caf50;">open ( <a href="#" style="color:#006064;" onclick="startAutomaticGateway('.$ru['id'].');">停止网关 </a> )</span>' : '<span style="color:red;">closed ( <a href="#" style="color:#e57373;" onclick="startAutomaticGateway('.$ru['id'].');">启动网关 </a>)</span>';?><br>[ <a href="#" onclick="gatewayTest('<?php echo $ru['key_id'];?>')">单通道测试</a> ]
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
	        url:"<?php echo url::s('mobile/paofen/jiexiup','id=' . $result['id']);?>",
	        type:"post",
	        // Form数据
	        data: fd,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success:function(data){
	            if(data.code == '200'){

                   layer.msg(data.msg, {icon: 1});
	         
                   document.getElementById("ewm_url").value = data.data.img;
	            }else{
                   layer.msg(data.msg, {icon: 2});
	            }
	        }
	    });
	                    
	}
        
        
        
          function add(){
              swal({
                      title: "跑分提醒",
                      text: "您确定要新增加一个跑分服务通道吗?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "是的,我要新增!",
                      closeOnConfirm: false
                  },
                  function(){
                      $.get("<?php echo url::s('index/paofen/automaticAdd');?>", function(result){
                          if(result.code == '200'){
                              swal("跑分提示", result.msg, "success");
                              setTimeout(function(){location.href = '';},1000);
                          }else{
                              swal("跑分提示", result.msg, "error");
                          }
                      });
                  });
          }
        
      function addalipay(){
          swal({   title: "请输入跑分配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "<input type='hidden' id='ceshi' value='111' style='display:none'>"
                 +"<p style='text-align:center'>上传二维码</p><img id='avatar' onclick='imgSelect();' style='width: 100px;border-radius:50%;margin: 0 auto;margin-top:15px' alt='/static/js/upload.png' src='/static/js/upload.png'></td><input type='file' name='avatar' id='avatarImg'  style='display:none;' onchange='uploadPic();'>"
               +" <p style='text-align:center'>（上传二维码等10秒左右自动解析）</p><input type='text' id='ewm_url' value=''>"
                +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
            
                    var ewm_url = $('#ewm_url').val();
                  if(ewm_url == false || ewm_url == null){
                      swal.showInputError("二维码解析不能为空，请上传二维码");
                      return false
                  }
                 
                  $.get("<?php echo url::s('mashang/paofen/automaticAdd',"name=");?>" +$('#name').val() +'&ewm_url='+ $('#ewm_url').val()+'&type=1', function(result){
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
        
         function addwechat(){
          swal({   title: "请输入跑分配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                 text: "<input type='hidden' id='ceshi' value='111' style='display:none'>"
                 +"<p style='text-align:center'>上传二维码</p><img id='avatar' onclick='imgSelect();' style='width: 100px;border-radius:50%;margin: 0 auto;margin-top:15px' alt='/static/js/upload.png' src='/static/js/upload.png'></td><input type='file' name='avatar' id='avatarImg'  style='display:none;' onchange='uploadPic();'>"
               +" <p style='text-align:center'>（上传二维码等10秒左右自动解析）</p><input type='text' id='ewm_url' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                    var ewm_url = $('#ewm_url').val();
                  if(ewm_url == false || ewm_url == null){
                      swal.showInputError("二维码解析不能为空，请上传二维码");
                      return false
                  }
                  $.get("<?php echo url::s('mashang/paofen/automaticAdd',"name=");?>" +$('#name').val() +'&ewm_url='+ $('#ewm_url').val()+'&type=2', function(result){
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
        
          //添加微信
               function addwechatdy(){
            swal({   title: "请输入微信宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                 text: "<input type='hidden' id='ceshi' value='111' style='display:none'>"
                 +"<p style='text-align:center'>上传二维码</p><img id='avatar' onclick='imgSelect();' style='width: 100px;border-radius:50%;margin: 0 auto;margin-top:15px' alt='/static/js/upload.png' src='/static/js/upload.png'></td><input type='file' name='avatar' id='avatarImg'  style='display:none;' onchange='uploadPic();'>"
               +" <p style='text-align:center'>（上传二维码等10秒左右自动解析）</p><input type='text' id='ewm_url' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                   var ewm_url = $('#ewm_url').val();
                 
                  $.get("<?php echo url::s('mashang/paofen/automaticAdd',"ewm_url=");?>" +$('#ewm_url').val() +'&name='+ $('#name').val()+'&type=6', function(result){
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
              
           function editdyname(id){
                swal({   title: "修改提醒",
                        type: "input",   showCancelButton: true,
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        inputPlaceholder: "店长微信名称",
                        confirmButtonText: "确认提交" },
                    function(inputValue){
                       
                        $.get("<?php echo url::s('mashang/paofen/editdyname',"id=");?>" + id + "&dyname=" + inputValue, function(result){
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
        
         function addqita(){
          swal({   title: "请输入跑分配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                   text: "<input type='hidden' id='ceshi' value='111' style='display:none'>"
                 +"<p style='text-align:center'>上传二维码</p><img id='avatar' onclick='imgSelect();' style='width: 100px;border-radius:50%;margin: 0 auto;margin-top:15px' alt='/static/js/upload.png' src='/static/js/upload.png'></td><input type='file' name='avatar' id='avatarImg'  style='display:none;' onchange='uploadPic();'>"
               +" <p style='text-align:center'>（上传二维码等10秒左右自动解析）</p><input type='text' id='ewm_url' value=''>"
                  +"收款类型<input type='text' id='typename' value='' placeholder='比如：银行固码,云闪付固码 等等'>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                
                  $.get("<?php echo url::s('mashang/paofen/automaticAdd',"name=");?>" +$('#name').val() +'&ewm_url='+ $('#ewm_url').val()+'&typename='+ $('#typename').val()+'&type=3', function(result){
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
        
         function addalipaypid(){
          swal({   title: "请输入支付宝配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "支付宝帐号<input type='text' id='account' value=''>"
                 +"支付宝PID<input type='text' id='pid' value=''>"
                  +"备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("支付宝帐号不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('mashang/paofen/automaticAdd',"account=");?>" +$('#account').val() +'&name='+ $('#name').val() +'&pid='+ $('#pid').val()+'&type=4', function(result){
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
        
           function addbank(){
          swal({   title: "请输入账户配置信息",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "收款人姓名<input type='text' id='gathering_name'>"
                      +"卡号<input type='text' id='account_no'>"
                  +"<select id='bank_id' name='bank_id' style='display:block;padding:6px;margin-bottom:10px'><option value='0'>请选择银行</option><?php echo $bankStr;?></select>"
                  +"cardid(<a href='http://120.79.231.25/cardid.php' target='_blank' style='margin-top:10px'>点击查看如何获取</a>)<input type='text' id='cardid'>"
                + "备注<input type='text' id='name' value=''>",
                  confirmButtonText: "提交" },
              function(inputValue){
                
                  var bank_id = $('#bank_id').val();
                  if(bank_id == false || bank_id == null){
                      swal.showInputError("请选择银行");
                      return false
                  }
                  var gathering_name = $('#gathering_name').val();
                  if(gathering_name == false || gathering_name == null){
                      swal.showInputError("收款人不能为空");
                      return false
                  }
                 
                  var account_no = $('#account_no').val();
                  if(account_no == false || account_no == null){
                      swal.showInputError("卡号不能为空");
                      return false
                  }
            
              var cardid = $('#cardid').val();
                  if(cardid == false || cardid == null){
                      swal.showInputError("cardid不能为空");
                      return false
                  }
                  $.get("<?php echo url::s('mashang/paofen/automaticAdd',"name=");?>" +$('#name').val() +'&gathering_name='+ $('#gathering_name').val()+'&cardid='+ $('#cardid').val()+'&bank_id='+bank_id+'&account_no='+account_no + '&type=5', function(result){
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
                  inputPlaceholder: "请输入跑分支付密码",
                  confirmButtonText: "确认提现"
              },
              function (inputValue) {
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入支付密码!");
                      return false
                  }
                  $.get("<?php echo url::s('mashang/paofen/withdraw', "id=");?>" + id + "&pwd=" + inputValue +"&key_id="+key_id +"&type=paofen", function (result) {
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

      function addArea(id){
          swal({   title: "请选择收款地区",
                  type: "input",
                  showCancelButton: true,
                  closeOnConfirm: false,
                  html: true,
                  text: "<select id='area' name='area' style='display:block;'><option value='aaaa'>请选择收款地区</option><option value='0'>全国收款（无限制）</option><?php echo $areaStr;?></select>",
                  confirmButtonText: "提交" },
              function(inputValue){
                
                  $.get("<?php echo url::s('mashang/paofen/areaAdd',"id=");?>" + id + "&area=" +$('#area').val() , function(result){
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
                  $.get("<?php echo url::s('mashang/paofen/editMaxdd',"id=");?>" + id + "&dd=" + inputValue, function(result){
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
        
      function editMaxAmount(id){
          swal({   title: "修改提醒",
                  type: "input",   showCancelButton: true,
                  closeOnConfirm: false,
                  animation: "slide-from-top",
                  inputPlaceholder: "当天最大收款额度",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("请输入您的最大收款金额!");
                      return false
                  }
                  $.get("<?php echo url::s('mashang/paofen/editMaxAmount',"id=");?>" + id + "&amount=" + inputValue, function(result){
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
                  $.get("<?php echo url::s('mashang/paofen/editNote',"id=");?>" + id + "&note=" + inputValue, function(result){
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
                  inputPlaceholder: "APP商户号",
                  confirmButtonText: "确认提交" },
              function(inputValue){
                  if (inputValue === false) return false;
                  if (inputValue === "") {
                      swal.showInputError("APP商户号!");
                      return false
                  }
                  $.get("<?php echo url::s('mashang/paofen/automaticEditName',"id=");?>" + id + "&app_user=" + inputValue, function(result){
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
      function startAutomaticRb(id){
    	  swal({
              title: "跑分提醒", 
              text: "当前操作是更改跑分轮训状态,您是否继续?", 
              type: "warning", 
              showCancelButton: true, 
              confirmButtonColor: "#DD6B55", 
              confirmButtonText: "是的,我要更改!", 
              closeOnConfirm: false 
            },
            function(){
               $.get("<?php echo url::s('mashang/paofen/startAutomaticRb',"id=");?>" + id, function(result){
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
               $.get("<?php echo url::s('mashang/paofen/startAutomaticGateway',"id=");?>" + id, function(result){
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
               $.get("<?php echo url::s('mashang/paofen/startAutomaticLogOut',"id=");?>" + id, function(result){
              	 if(result.code == '200'){
    	            	swal("跑分提示", result.msg, "success");
    	              	setTimeout(function(){location.href = '';},1000);
    	              }else{
    	            	swal("跑分提示", result.msg, "error");
    	              }
              	  });
            });	
      }

      function login(id){
    	  swal({   title: "跑分登录",   
              text: "您即将开始登录跑分,是否继续?",   
              type: "info",   showCancelButton: true,   
              closeOnConfirm: false,   
              showLoaderOnConfirm: true,
              confirmButtonText: "立即登录"
               }, 
              function(){
              //开始请求跑分登录
            	   $.get("<?php echo url::s('mashang/paofen/startAutomaticLogin',"id=");?>" + id, function(result){
                  	 if(result.code == '200'){
                   		    $('.showSweetAlert p').html(result.msg);
                     		login_listen(id);
        	              }else{
        	            	swal("跑分登录", result.msg, "error");
        	             }
              		});
                  
         });
      }
      var listen_login = 0;
      var music = 0;
      //伪造线程
      function login_listen(id){
      	listen_login = setInterval(function(){ $.get("<?php echo url::s('index/paofen/getAutomaticStatus',"id=");?>" + id, function(result){
      		if(result.code > 0){	
      			if(result.code == '2' || result.code == '3' ){ $('.showSweetAlert p').html(result.msg); }
      			if(result.code == '7'){
				//将二维码展现出来扫码
      				$('.showSweetAlert h2').html('请使用跑分扫一扫');
      				$('.showSweetAlert p').html("<img style='width:200px;height:200px;' src='data:image/png;base64," + result.data.img + "'/>");
      				if(music == 0){
      					play(['<?php echo FILE_CACHE . "/download/sound/跑分扫一扫1.mp3";?>']);
      					music = 1;
          			}
              	}
      			if(result.code == '4'){
	            	swal("跑分登录", result.msg, "success");
	              	setTimeout(function(){location.href = '';},1000);
                }
             }else{
            	 swal("跑分登录", result.msg, "error");
            	 setTimeout(function(){location.href = '';},1000);
             }
      	  });  },1000);
      }

	  function del(id){
		  swal({   title: "跑分提醒",   
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
             $.get("<?php echo url::s('mashang/paofen/automaticDelete',"id=");?>" + id + "&pwd=" + inputValue, function(result){
              	 if(result.code == '200'){
               		    swal("跑分提醒", result.msg, "success");
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

		       window.open('<?php echo url::s("mashang/paofen/robinTest");?>' + '?amount=' + $('#amount').val() + '&callback_url=' + $('#callback_url').val());
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

		       window.open('<?php echo url::s("mashang/paofen/gatewayTest");?>' + '?amount=' + $('#amount').val()  + "&keyId=" + id + '&callback_url=' + $('#callback_url').val());
			   location.href='';
		      })
		 
		 $('.showSweetAlert fieldset input').attr('type','hidden');
		 $('#amount').val('1.00');
		 $('#callback_url').val('<?php echo URL_ROOT; ?>/mashang/index/callback.do');
	  }

		//跑分设置
	  function setting(){ 
		  layer.open({
			  type: 2,
			  title: '跑分配置',
			  shadeClose: true,
			  shade: 0.8,
			  area: ['600px', '400px'],
			  content: '<?php echo url::s('mashang/paofen/automaticConfig');?>' //iframe的url
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
             $.get("<?php echo url::s('mashang/apk/verification',"pwd=");?>" + inputValue, function(result){
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
             $.get("<?php echo url::s('mashang/pc/verification',"pwd=");?>" + inputValue, function(result){
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
   